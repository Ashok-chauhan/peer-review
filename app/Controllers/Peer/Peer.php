<?php

namespace App\Controllers\Peer;

use App\Controllers\BaseController;
use App\Models\PeerModel;
use App\Models\EditorModel;
use App\Models\UserModel;
use App\Models\SubmissionModel;

/**
 * Description of Peer
 *
 * @author Ashok
 */
class Peer extends BaseController
{

    public $peerModel;
    public $editorModel;
    public $userModel;
    public $submissionModel;
    public $session;
    public $email;

    public function __construct()
    {
        helper(['url', 'form', 'role']);
        $this->peerModel = new PeerModel();
        $this->userModel = new UserModel();
        $this->editorModel = new EditorModel;
        $this->submissionModel = new SubmissionModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        if (session()->get('role') == 4) {
        } elseif (isset($_GET['r'])) {
            session()->set('role', base64_decode($_GET['r']));
        } elseif (session()->get('role') != 4) {
            session_destroy();
            die('Access denied');
        }
        session()->remove('roles'); //multiple role
    }

    public function index()
    {
        $data = [];
        $uid = session()->get('userID');

        $reviews = $this->peerModel->getReviewRequest($uid);
        $completed = $this->peerModel->getReviewCompleted($uid);

        if ($reviews) {
            foreach ($reviews as $review) {
                $editorPeerContent[] = $this->peerModel->getEditoriealUploads($review->submissionID);
                $noteCount[] = $this->peerModel->noteCount($uid, $review->submissionID);
            }
        }
        // $data['reviews'] = $reviews;
        $data['completed'] = $completed;
        $data['list'] = $reviews;
        if (isset($noteCount)) {
            $data['noteCount'] = $noteCount;
        }
        if (isset($editorPeerContent))
            $data['editorPeerContent'] = array_filter($editorPeerContent);
        return view('peer/index', $data);
    }
    public function detailview()
    {

        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $reviewTableId = $uri->getSegment(4); //to update review table
        $data = [];
        $data['reviewTableId'] = $reviewTableId;
        $result = $this->peerModel->checkStatus($reviewTableId);
        if ($result->status > 1 && $result->status < 6) {
            $data['status'] = true;
        } else if ($result->status == '7') {
            return redirect()->to('peer');
        } else {
            $data['status'] = false;
        }
        $data['completion_date'] = $result->completion_date;
        $data['details'] = $this->peerModel->getReviewDetailBySubid($submission_id);
        $data['discussions'] = $this->peerModel->getDiscussion($submission_id);
        $data['editor'] = $this->peerModel->getUser($data['details']->editor_id);
        $data['peerTerms'] = $this->peerModel->peerTerms(session()->get('userID'), $submission_id);
        $data['submission_id'] = $submission_id;

        return view('peer/detailview', $data);
    }

    /*
    modified to new one
    public function accept()
    {

        if ($this->request->getMethod() == 'post') {
            $status = $this->request->getVar('consent');
            $rev_id = $this->request->getVar('reviewTableId');
            $this->peerModel->updateReview($rev_id, $status);
            $this->peerModel->updateSubmissionStatus($this->request->getVar('submission_id'), $status);

            echo 'consent updated.';
        }

    }
*/
    public function accept()
    {
        if ($this->request->getMethod() == 'post') {
            $status = $this->request->getVar('consent');
            $id = $this->request->getVar('id');
            $sid = $this->request->getVar('submission_id');
            $this->peerModel->updateReview($id, $status);
            $this->peerModel->updateSubmissionStatus($this->request->getVar('submission_id'), $status);
            $result = $this->peerModel->checkStatus($id);
            if ($result->status == '20')
                return redirect()->to('peer');
            return redirect()->to('peer/detailview/' . $sid . '/' . $id);
            // echo 'consent updated.';
        }

        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $reviewTableId = $uri->getSegment(4); //to update review table
        $data = [];
        //$data['reviewTableId'] = $reviewTableId;
        $data['copyTerms'] = $this->peerModel->peerTerms(session()->get('userID'), $submission_id);
        $result = $this->peerModel->checkStatus($reviewTableId);

        //if ($result->status > 1 && $result->status <= 6) {
        if ($result->status == 2) {
            $data['status'] = true;
            return redirect()->to('peer/detailview/' . $submission_id . '/' . $reviewTableId);
        } else if ($result->status == '3') {

            return redirect()->to('peer');

        } else {
            $data['status'] = false;
        }
        $data['data'] = $result;
        return view('peer/accept', $data);

    }

    public function notify()
    {

        $submissionTitle = $this->peerModel->getBySubmissionId('submission', $this->request->getVar('submissionID'));
        $author = $this->peerModel->getUser($this->request->getVar('recipient_id'));
        $fullName = $author->title . ' ' . $author->username . ' ' . $author->middle_name . ' ' . $author->last_name;
        $sub_title = $submissionTitle[0]->title;
        $mailData['fullName'] = $fullName;
        $mailData['sub_title'] = $sub_title;
        $mailData['sub_id'] = $submissionTitle[0]->submissionID;

        $journal = $this->peerModel->getJournal($submissionTitle[0]->jid);
        $journalName = $journal->journal_name;


        if ($this->request->getMethod() == 'post' && ($_FILES['revisionFile']['size'] > 0)) {

            $revFileId = '';
            if ($this->request->getVar('updateFileId')) {
                $revFileId = $this->request->getVar('updateFileId');
            }
            $submission_content = [];

            $notification = [];
            $rules = [
                'revisionFile' => 'uploaded[revisionFile]|ext_in[revisionFile,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];
            if ($this->validate($rules)) {
                $file = $this->request->getFile('revisionFile');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName() . '_' . $file->getClientName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        echo '<p>Uploaded successfully</p>';
                        $notification['sender'] = session()->get('fullName');
                        $notification['sender_email'] = session()->get('logged_user');
                        $notification['sender_id'] = session()->get('userID');
                        $notification['role'] = $this->request->getVar('role');

                        $notification['recipient'] = $this->request->getVar('recipient');
                        $notification['recipient_id'] = $this->request->getVar('recipient_id');
                        $notification['submissionID'] = $this->request->getVar('submissionID');
                        // $notification['content_id'] = $revision_id;
                        $notification['article_component'] = $this->request->getVar('article_type');
                        $notification['title'] = $this->request->getVar('subject-title');
                        $notification['recommondation'] = $this->request->getVar('recommondation');
                        $notification['message'] = $this->request->getVar('message-text');
                        $notification['file'] = $newName;
                        $note = $this->peerModel->discussion($notification);

                        if ($note) {
                            $mail = $this->notificationEmail($this->request->getVar('recipient'), $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $mailData, $newName, $journalName);
                        }
                    } else {
                        echo $file->getErrorString() . " " . $file->getError();
                    }
                }
            } else {
                $data['validation'] = $this->validator;
            }
        } elseif ($this->request->getMethod() == 'post') {

            $notification['sender'] = session()->get('fullName');
            $notification['sender_email'] = session()->get('logged_user');
            $notification['sender_id'] = session()->get('userID');
            $notification['role'] = $this->request->getVar('role');

            $notification['recipient'] = $this->request->getVar('recipient');
            $notification['recipient_id'] = $this->request->getVar('recipient_id');
            $notification['submissionID'] = $this->request->getVar('submissionID');
            $notification['title'] = $this->request->getVar('subject-title');
            $notification['recommondation'] = $this->request->getVar('recommondation');

            $notification['message'] = $this->request->getVar('message-text');

            $note = $this->peerModel->discussion($notification);
            if ($note) {
                $mail = $this->notificationEmail($this->request->getVar('recipient'), $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $mailData, null, $journalName);
            }
            echo '<p>successfully replied</p>';
        }

        //#return view('editor/notify');
    }

    /* --------------------------------
     * ABENDONED NOT IN USEFUL INSTED USING .. notify()
     */
    public function discussion()
    {
        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $editor_id = $uri->getSegment(4);
        $data = [];
        $data['submission_id'] = $submission_id;
        $data['editor_id'] = $editor_id;

        //$data['discussions'] = $this->editorModel->getDiscussion(session()->get('userID'), $submission_id);
        $data['peerDiscussions'] = $this->editorModel->getPeerDiscussion(session()->get('userID'), $submission_id);
        if ($this->request->getMethod() == 'post' && ($_FILES['revisionFile']['size'] > 0)) {

            $submission_content = [];
            $notification = [];
            $rules = [
                'revisionFile' => 'uploaded[revisionFile]|ext_in[revisionFile,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];
            if ($this->validate($rules)) {
                $file = $this->request->getFile('revisionFile');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName() . '_' . $file->getClientName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        echo '<p>Uploaded successfully</p>';
                        /*
                        $submission_content['editor_id'] = $this->request->getVar('editor_id');
                        $submission_content['peer_id'] = session()->get('userID');
                        $submission_content['submission_id'] = $this->request->getVar('submission_id');
                        $submission_content['content'] = $newName;
                        $revision_id = $this->peerModel->uploadPeerResponseToEditor($submission_content);
table='editor_peer_content'
                        */
                        $editor = $this->userModel->getUser($this->request->getVar('editor_id'));
                        $notification['sender'] = session()->get('username');
                        $notification['sender_email'] = session()->get('logged_user');
                        $notification['sender_id'] = session()->get('userID');
                        $notification['recipient'] = $editor->email;
                        $notification['recipient_id'] = $editor->userID;
                        $notification['submissionID'] = $this->request->getVar('submission_id');
                        $notification['content'] = $newName;
                        $notification['title'] = $this->request->getVar('title');
                        $notification['message'] = $this->request->getVar('message');

                        $note = $this->peerModel->uploadPeerResponseToEditor($notification);
                        print_r($note);

                        if ($note) {
                            //send email

                            $mailContent = '';
                            $editorData = $this->peerModel->getEditorPeerContent($note); //$revision_id or $note
                            $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorData[0]->content . '>' . $editorData[0]->content . '</a></p>';

                            $mailMsg = $this->request->getVar('message');
                            $body = $mailMsg . $mailContent;

                            $this->email->setTo($editor->email);
                            $this->email->setFrom(session()->get('logged_user'), 'Info');
                            $this->email->setSubject($this->request->getVar('title'));
                            $this->email->setMessage($body);
                            if ($this->email->send()) {
                                $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                                return redirect()->to('peer');
                            } else {
                                $this->session->setTempdata("error", "Something happen wrong!", 3);
                            }
                        }
                    } else {
                        echo $file->getErrorString() . " " . $file->getError();
                    }
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('peer/discussion', $data);
    }
    public function updateReview()
    {

        $uid = session()->get('userID');

        $revId = $this->request->getVar('reviewID');
        $status = $this->request->getVar('status');
        $submissionid = $this->request->getVar('submissionid');
        $sub = $this->peerModel->getSubmission($submissionid);
        if ($sub) {
            $journal = $this->peerModel->getJournal($sub->jid);
            $editor = $this->peerModel->getUser($journal->editor_id);
        }
        $mailData['subtitle'] = $sub->title;
        $mailData['journal'] = $journal->journal_name;
        $to = $editor->email;
        $q = $this->peerModel->updateReview($revId, $status);
        $this->peerModel->updateSubmissionStatus($submissionid, $status);
        //upload final file to review_uploads table

        $rules_title_page = [
            'title_page' => 'uploaded[title_page]|ext_in[title_page,png,jpg,gif,doc,docx,pdf,jpeg]',
        ];
        if ($this->validate($rules_title_page)) {
            $file = $this->request->getFile('title_page');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName() . '_' . $file->getClientName();
                if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                    $peerUploads['title_page'] = $newName;
                } else {
                    echo $file->getErrorString() . " " . $file->getError();
                }
            }
        }

        $rules_article_text = [
            'article_text' => 'uploaded[article_text]|ext_in[article_text,png,jpg,gif,doc,docx,pdf,jpeg]',
        ];
        if ($this->validate($rules_article_text)) {
            $file = $this->request->getFile('article_text');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName() . '_' . $file->getClientName();
                if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                    $peerUploads['article_text'] = $newName;
                } else {
                    echo $file->getErrorString() . " " . $file->getError();
                }
            }
        }
        $rules_article_file = [
            'article_file' => 'uploaded[article_file]|ext_in[article_file,png,jpg,gif,doc,docx,pdf,jpeg]',
        ];
        if ($this->validate($rules_article_file)) {
            $file = $this->request->getFile('article_file');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName() . '_' . $file->getClientName();
                if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                    $peerUploads['article_file'] = $newName;
                } else {
                    echo $file->getErrorString() . " " . $file->getError();
                }
            }
        }

        $peerUploads['submission_id'] = $submissionid;
        $peerUploads['peer_id'] = $revId;
        $peerUploads['status'] = $status;
        $peerUploads['article_type'] = $this->request->getVar('article_type');
        $this->peerModel->peerUpload($peerUploads);
        // eof review_uploads table

        /*
        if ($q) {
            $success = array('success' => 'Review status has been updated successfully!');
            echo json_encode($success);
        } else {
            $error = array('error' => 'Somethng went wrong!');
            echo json_encode($error);
        }
            */

        if ($status == 3) {
            //send mail to editor
            $this->mailToEditor($to, $mailData);
        }
        return redirect()->to('peer');
    }


    public function notificationEmail($to, $title, $message, $mail, $file = null, $journal = null)
    {
        $mailData = [];
        if (is_array($mail)) {
            $mailData['sub_id'] = $mail['sub_id'];
            $mailData['fullName'] = $mail['fullName'];
            $mailData['sub_title'] = $mail['sub_title'];
        }
        if ($journal) {
            $mailData['journal'] = $journal;
        } else {
            $mailData['journal'] = 'Arthopedics';
        }
        $mailData['peerName'] = session()->get('fullName');
        $mailData['title'] = $title;
        $mailData['message'] = $message;
        if ($file) {
            $link = base_url() . '/author/downloads/' . $file;
            $mailData['link'] = $link;
        }

        $subject = 'You have received a new comment from ' . session()->get('fullName') . ' for ' . $mail['sub_title'];
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        // $body = view('mails/toauthor', $mailData);
        $body = view('mails/letter_from_reviewer_to_editor_comment', $mailData);
        $this->email->setMessage($body);

        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }
    }

    public function mailToEditor($to, $mail)
    {
        if (is_array($mail)) {
            $mailData['title'] = $mail['subtitle'];
            $mailData['journal'] = $mail['journal'];
        }
        $mailData['fullName'] = session()->get('fullName');
        $subject = session()->get('fullName') . ' has completed reviewing ' . $mail['subtitle'];
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);

        $body = view('mails/letter_to_editor_after_reviewer_finish_review', $mailData);
        $this->email->setMessage($body);

        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }


    }


    public function bellnotification()
    {
        $data = [];
        $data['notifications'] = $this->peerModel->getBellNotification(session()->get('userID'));
        $updated = $this->peerModel->updateNotifications(session()->get('userID'));
        return view('peer/notification', $data);
    }

    public function update_bellnotification()
    {
        if ($this->request->getMethod() == 'post') {

            $updated = $this->peerModel->updateNotifications(session()->get('userID'));
            if ($updated) {
                return '1';
            } else {
                return '0';
            }
        }
    }
    public function finalupload()
    {
        $data = [];
        $uri = $this->request->getUri();
        $data['submission_id'] = $uri->getSegment(3);
        $data['peer_id'] = $uri->getSegment(4);
        return view('peer/finalupload', $data);

    }
}
