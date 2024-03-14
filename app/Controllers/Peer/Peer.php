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
    }

    public function index()
    {
        $data = [];
        $uid = session()->get('userID');

        $reviews = $this->peerModel->getReviewRequest($uid);

        ///////////
        /*
        if ($reviews)

            $editorPeerContent = $this->peerModel->getEditoriealUploads($reviews[0]->submissionID);
        $noteCount = $this->peerModel->noteCount($uid);

        $data['reviews'] = $reviews;
        $data['noteCount'] = ($noteCount) ? $noteCount : 0;
        if (isset($editorPeerContent))
            $data['editorPeerContent'] = $editorPeerContent;
        */
        //////
        if ($reviews) {
            foreach ($reviews as $review) {
                $editorPeerContent[] = $this->peerModel->getEditoriealUploads($review->submissionID);
                $noteCount[] = $this->peerModel->noteCount($uid, $review->submissionID);
            }
        }

        $data['reviews'] = $reviews;
        if (isset($noteCount)) {
            $data['noteCount'] = $noteCount;
        }
        if (isset($editorPeerContent))
            $data['editorPeerContent'] = array_filter($editorPeerContent);
        return view('peer/index', $data);
    }
    public function detailview()
    {

        $status = $this->request->getVar('consent');
        $rev_id = $this->request->getVar('rev_id');
        $this->peerModel->updateReview($rev_id, $status);
        $submission_id = $this->request->getVar('submission_id');
        $data = [];
        $data['details'] = $this->peerModel->getReviewDetailBySubid($submission_id);
        $data['discussions'] = $this->peerModel->getDiscussion($submission_id);
        $data['submission_id'] = $submission_id;

        return view('peer/detailview', $data);
    }

    public function accept()
    {
        /*
        if ($this->request->getMethod() == 'post') {
            $status = $this->request->getVar('consent');
            $rev_id = $this->request->getVar('rev_id');
            $this->peerModel->updateReview($rev_id, $status);
            return redirect()->to('peer');
        } else {
*/
        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $revId = $uri->getSegment(4);
        $reviewRow = $this->peerModel->getReviewRow($submission_id);
        $data['completion_date'] = $reviewRow->completion_date;
        $data['submission_id'] = $submission_id;
        $data['rev_id'] = $revId;

        return view('peer/accept', $data);
        // }
    }


    public function notify()
    {

        $submissionTitle = $this->peerModel->getBySubmissionId('submission', $this->request->getVar('submissionID'));
        $author = $this->peerModel->getUser($this->request->getVar('recipient_id'));
        $fullName = $author->title . ' ' . $author->username . ' ' . $author->middle_name . ' ' . $author->last_name;
        $sub_title = $submissionTitle[0]->title;
        $mailData['fullName']  = $fullName;
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
            $notification['message'] = $this->request->getVar('message-text');

            $note = $this->peerModel->discussion($notification);
            if ($note) {
                $mail = $this->notificationEmail($this->request->getVar('recipient'), $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $mailData, $journalName);
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
                            //print $note;

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
        $q = $this->peerModel->updateReview($revId, $status);

        if ($q) {
            $success = array('success' => 'Review status has been updated successfully!');
            return json_encode($success);
        } else {
            $error = array('error' => 'Somethng went wrong!');
            return json_encode($error);
        }
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
        $mailData['title'] = $title;
        $mailData['message'] = $message;
        if ($file) {
            $link = base_url() . '/author/downloads/' . $file;
            $mailData['link'] = $link;
        }

        $subject = 'Update Required for Your Article Submission titled "' . $mail['sub_title'] . '(Manuscript ' . $mail['sub_id'] . ')"';
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body =  view('mails/toauthor', $mailData);
        $this->email->setMessage($body);
        //$sent = $this->email->send();
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }
    }
}
