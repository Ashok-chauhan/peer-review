<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\ProductionModel;
use App\Models\UserModel;

/**
 * Description of Production
 *
 * @author Ashok
 */
class Production extends BaseController
{

    public $production;
    public $userModel;
    public $session;
    public $email;

    public function __construct()
    {
        helper(['url', 'form', 'role']);
        $this->production = new ProductionModel();
        $this->userModel = new UserModel;

        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        if (session()->get('role') == 6) {
        } elseif (isset($_GET['r'])) {
            session()->set('role', base64_decode($_GET['r']));
        } elseif (session()->get('role') != 6) {
            session_destroy();
            die('Access denied');
        }
        session()->remove('roles'); //multiple role
    }

    public function index()
    {
        $data = [];
        $uid = session()->get('userID');

        $editings = $this->production->getProductionRequest($uid);
        $completed = $this->production->getProductionCompleted($uid);

        if ($editings) {
            foreach ($editings as $edit) {
                $editorPeerContent[] = $this->production->getEditoriealUploads($edit->submissionID);
                $noteCount[] = $this->production->noteCount($uid, $edit->submissionID);
            }
        }

        $data['completed'] = $completed;
        $data['list'] = $editings;
        if (isset($noteCount)) {
            $data['noteCount'] = $noteCount;
        }
        if (isset($editorPeerContent))
            $data['editorPeerContent'] = array_filter($editorPeerContent);

        return view('production/index', $data);
    }

    public function detailview()
    {

        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $reviewTableId = $uri->getSegment(4); //to update review table
        $data = [];
        $data['reviewTableId'] = $reviewTableId;
        $data['peerUploads'] = $this->production->getCopyUploads($submission_id);

        $data['details'] = $this->production->getProductionDetailBySubid($submission_id);
        $data['discussions'] = $this->production->getDiscussion($submission_id);
        $data['editor'] = $this->production->getUser($data['details']->publisher_id);
        $data['submission_id'] = $submission_id;

        return view('production/detailview', $data);
    }

    public function accept()
    {
        if ($this->request->getMethod() == 'post') {
            $status = $this->request->getVar('consent');
            $id = $this->request->getVar('id');
            $sid = $this->request->getVar('submission_id');
            $this->production->updateProduction($id, $status);
            $this->production->updateSubmissionStatus($this->request->getVar('submission_id'), $status);
            $result = $this->production->checkStatus($id);
            if ($result->status == '20')
                return redirect()->to('production');
            return redirect()->to('production/detailview/' . $sid . '/' . $id);
            // echo 'consent updated.';
        }

        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $reviewTableId = $uri->getSegment(4); //to update review table
        $data = [];
        //$data['reviewTableId'] = $reviewTableId;
        $data['copyTerms'] = $this->production->copyTerms(session()->get('userID'), $submission_id);
        $result = $this->production->checkStatus($reviewTableId);

        //if ($result->status > 1 && $result->status <= 6) {
        if ($result->status == 10) {
            $data['status'] = true;
            return redirect()->to('production/detailview/' . $submission_id . '/' . $reviewTableId);
        } else if ($result->status == '12') {

            return redirect()->to('production');

        } else {
            $data['status'] = false;
        }
        $data['data'] = $result;
        return view('production/accept', $data);

    }

    public function update_copyediting()
    {

        $uid = session()->get('userID');

        // $revId = $this->request->getVar('reviewID');
        $status = $this->request->getVar('status');
        $submissionid = $this->request->getVar('submissionid');
        $production_id = $this->request->getVar('production_id');
        $sub = $this->production->getSubmission($submissionid);
        if ($sub) {
            $journal = $this->production->getJournal($sub->jid);
            $editor = $this->production->getUser($journal->editor_id);
        }
        $mailData['subtitle'] = $sub->title;
        $mailData['journal'] = $journal->journal_name;
        $to = $editor->email;
        $q = $this->production->updateProduction($production_id, $status);
        $this->production->updateSubmissionStatus($submissionid, $status);
        if ($q) {
            $success = array('success' => 'Production status has been updated successfully!');
            // return redirect()->to('production/detailview/' . $submissionid . '/' . $copyediting_id);
            return redirect()->to('production/');

        } else {
            $error = array('error' => 'Somethng went wrong!');
            //return json_encode($error);
            echo json_encode($error);
        }
        if ($status == 11) {
            //send mail to editor
            $this->mailToEditor($to, $mailData);
        }
    }

    public function notify()
    {


        $submissionTitle = $this->production->getBySubmissionId('submission', $this->request->getVar('submissionID'));
        $author = $this->production->getUser($this->request->getVar('recipient_id'));
        $fullName = $author->title . ' ' . $author->username . ' ' . $author->middle_name . ' ' . $author->last_name;
        $sub_title = $submissionTitle[0]->title;
        $mailData['fullName'] = $fullName;
        $mailData['sub_title'] = $sub_title;
        $mailData['sub_id'] = $submissionTitle[0]->submissionID;
        if ($this->request->getVar('recommondation'))
            $mailData['recommondation'] = $this->request->getVar('recommondation');

        $journal = $this->production->getJournal($submissionTitle[0]->jid);
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
                        $note = $this->production->discussion($notification);

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

            $note = $this->production->discussion($notification);
            if ($note) {
                $mail = $this->notificationEmail($this->request->getVar('recipient'), $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $mailData, null, $journalName);
            }
            echo '<p>successfully replied</p>';
        }

        //#return view('editor/notify');
    }

    public function discussion()
    {
        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $editor_id = $uri->getSegment(4);
        $data = [];
        $data['submission_id'] = $submission_id;
        $data['editor_id'] = $editor_id;
        $data['editorDiscussions'] = $this->production->getDiscussion(session()->get('userID'), $submission_id);
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
                        $editor = $this->userModel->getUser($this->request->getVar('editor_id'));
                        $notification['sender'] = session()->get('username');
                        $notification['sender_email'] = session()->get('logged_user');
                        $notification['copyeditor_id'] = session()->get('userID');
                        $notification['recipient_email'] = $editor->email;
                        $notification['recipient'] = $editor->userID;
                        $notification['editorID'] = $editor->userID;
                        $notification['submissionID'] = $this->request->getVar('submission_id');
                        $notification['upload_content'] = $newName;
                        $notification['decision'] = $this->request->getVar('title');
                        $notification['comments'] = $this->request->getVar('message');

                        $note = $this->production->sendToEditor($notification);

                        if ($note) {
                            //send email
                            $mailContent = '';
                            $editorData = $this->production->getEditorialDecisionByid($note); //$revision_id or $note
                            $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorData->upload_content . '>' . $editorData->upload_content . '</a></p>';
                            $mailMsg = $this->request->getVar('message');
                            $body = $mailMsg . $mailContent;
                            $this->email->setTo($editor->email);
                            $this->email->setFrom(session()->get('logged_user'), 'Info');
                            $this->email->setSubject($this->request->getVar('title'));
                            $this->email->setMessage($body);
                            if ($this->email->send()) {
                                $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                                return redirect()->to('production');
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
        return view('production/discussion', $data);
    }

    public function notificationEmail($to, $title, $message, $mail, $file = null, $journal = null)
    {
        $mailData = [];
        if (is_array($mail)) {
            $mailData['sub_id'] = $mail['sub_id'];
            $mailData['fullName'] = $mail['fullName'];
            $mailData['sub_title'] = $mail['sub_title'];
            $mailData['recommondation'] = $mail['recommondation'];
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
        $body = view('mails/letter_from_copyeditor_to_editor_comment', $mailData);
        $this->email->setMessage($body);

        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }
    }

    public function finalupload()
    {
        $data = [];
        $uri = $this->request->getUri();
        $data['submission_id'] = $uri->getSegment(3);
        $data['production_id'] = $uri->getSegment(4);
        return view('production/finalupload', $data);

    }

    public function updateProduction()
    {

        $uid = session()->get('userID');

        $prodId = $this->request->getVar('production_id');
        $status = $this->request->getVar('status');
        $submissionid = $this->request->getVar('submissionid');
        $sub = $this->production->getSubmission($submissionid);
        if ($sub) {
            $journal = $this->production->getJournal($sub->jid);
            $editor = $this->production->getUser($journal->editor_id);
        }
        $mailData['subtitle'] = $sub->title;
        $mailData['journal'] = $journal->journal_name;
        $to = $editor->email;
        $q = $this->production->updateProduction($prodId, $status);
        $this->production->updateSubmissionStatus($submissionid, $status);
        //upload final file to review_uploads table

        $rules_title_page = [
            'title_page' => 'uploaded[title_page]|ext_in[title_page,png,jpg,gif,doc,docx,pdf,jpeg]',
        ];
        if ($this->validate($rules_title_page)) {
            $file = $this->request->getFile('title_page');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName() . '_' . $file->getClientName();
                if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                    $copyeditorUploads['title_page'] = $newName;
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
                    $copyeditorUploads['article_text'] = $newName;
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
                    $copyeditorUploads['article_file'] = $newName;
                } else {
                    echo $file->getErrorString() . " " . $file->getError();
                }
            }
        }

        $copyeditorUploads['submission_id'] = $submissionid;
        $copyeditorUploads['production_id'] = $prodId;
        $copyeditorUploads['status'] = $status;
        $copyeditorUploads['article_type'] = $this->request->getVar('article_type');
        $this->production->productionUpload($copyeditorUploads);
        // eof review_uploads table


        if ($status == 11) {
            //send mail to editor
            $this->mailToEditor($to, $mailData);
        }
        return redirect()->to('production');
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
        $data['notifications'] = $this->production->getBellNotification(session()->get('userID'));
        $updated = $this->production->updateBellNotifications(session()->get('userID'));
        return view('production/notification', $data);
    }
    public function update_bellnotification()
    {
        if ($this->request->getMethod() == 'post') {

            $updated = $this->production->updateBellNotifications(session()->get('userID'));
            if ($updated) {
                return '1';
            } else {
                return '0';
            }
        }
    }

}
