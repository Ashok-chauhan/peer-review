<?php

namespace App\Controllers\Editor;

use App\Controllers\BaseController;
use App\Models\EditorModel;
use App\Models\UserModel;

/**
 * Description of Editor
 *
 * @author Ashok
 */
class Editor extends BaseController {

    public $editorModel;
    public $session;
    public $email;
    public $user;

    public function __construct() {
        helper(['url', 'form']);
        $this->editorModel = new EditorModel();
        $this->user = new UserModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

    public function index() {
        $data = [];
        $underReviw = [];
        $editorialDecision = [];
        $revData = [];
        $status = 0;
        $submissions = $this->editorModel->allActive($status);
        
        if($submissions){
        foreach ($submissions as $key => $submission) {
            $underReviw[] = $this->editorModel->reviewStatus($submission->submissionID);
            $editorialDecision[] = $this->editorModel->getEditoriealStatus($submission->submissionID);
        }
        }
//        print '<pre>';
//        print_r($underReviw);
//        print_r($editorialDecision);
//        exit;

        $data['submissions'] = $submissions;
        $data['editorialDecision'] = $editorialDecision;
        $data['reviewStatus'] = $underReviw; //$revData;

        return view('editor/index', $data);
    }

    public function byAuthor() {
       
        $data = [];
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $submissionTitle = $this->editorModel->getBySubmissionId('submission', $submissionID);
        $editorialDecision = $this->editorModel->getEditorialUploadsBySubId($submissionID);
        $editorial_decision = $this->editorModel->getCopyeditorNote(session()->get('userID'), $submissionID);
        $user = $this->editorModel->getAutor($submissionTitle[0]->authorID);
        $data['authorName'] = $user->username;
        $data['authorEmail'] = $user->email;
        $data['userid'] = $user->userID;
        $data['title'] = $submissionTitle[0]->title;
        $data['contents'] = $this->editorModel->getBySubmissionId('submission_content', $submissionID);
        $data['discussions'] = $this->editorModel->getDiscussion(session()->get('userID'), $submissionID);
        $data['peerDiscussions'] = $this->editorModel->getPeerDiscussion(session()->get('userID'), $submissionID);
        $data['editorialDecision'] = $editorialDecision;
        $data['submission_id'] = $submissionID;
        $data['editorial_decision'] = $editorial_decision;
        return view('editor/byauthor', $data);
    }

    public function downloads() {
        $uri = $this->request->getUri();
        $name = WRITEPATH . 'uploads/' . $uri->getSegment(3);
        return $this->response->download($name, null);
    }

    public function notify() {
        if ($this->request->getMethod() == 'post') {
            $uri = $this->request->getUri();
            $autorId = $uri->getSegment(3);
            $submissionid = $uri->getSegment(4);
            $user = $this->editorModel->getAutor($autorId);
            $title = $this->request->getPost('title');
            $message = $this->request->getPost('message');

            $data = [
                'sender' => session()->get("username"),
                'sender_email' => session()->get("logged_user"),
                'recipient' => $user->email,
                'sender_id' => session()->get("userID"),
                'recipient_id' => $user->userID,
                'submissionID' => $submissionid,
                'title' => $title,
                'message' => $message,
            ];
            if ($this->editorModel->discussion($data)) {
                //send mail  
                $this->email->setTo($user->email);
                $this->email->setFrom('ashok@whizti.com', 'Info');
                $this->email->setSubject($title);
                $this->email->setMessage($message);
                if ($this->email->send()) {
                    $this->session->setTempdata("success", "Notification sent successfully.", 3);
                    return redirect()->to('editor/byauthor/' . $submissionid);
                } else {
                    $this->session->setTempdata("error", "Something happen wrong!", 3);
                }
            }
        }
        //show template.
        return view('editor/notify');
    }

    function getRevisionFile() {
        $uri = $this->request->getUri();
        $content_id = $uri->getSegment(3);
        $resp = $this->editorModel->getRevisionFile($content_id);
        // header('Content-Type: application/json; charset=utf-8');
        //header('Access-Control-Allow-Origin: *');
        //echo json_encode($resp);
        //print_r($resp);
        echo $resp->content . '#' . $resp->submission_date;
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function toReview() {
        $reviewer = $this->editorModel->getReviewer();
        $subid = $this->request->getVar('submissionid');
        $title = $this->request->getVar('title');
        $editorContent = $this->editorModel->getEditorialUploadsBySubId($subid);
        $subContents = $this->editorModel->getBySubmissionId('submission_content', $subid);
        
        $peer = [];
        foreach ($reviewer as $review) {
            $peer[$review->userID] = $review->username;
        }

        $data['peers'] = $reviewer;
        $data['peer'] = $peer;
        $data['title'] = $title;
        $data['submissionid'] = $subid;
        $data['subContents'] = $subContents;
        $data['editorContent'] = $editorContent;
        return view('editor/toreview', $data);
    }

    public function sendtopeer() {
        if ($this->request->getMethod() == 'post') {
            if (!$this->editorModel->checkPeer($this->request->getVar('peer'), $this->request->getVar('submissionid'))) {
                $data_reviews['submissionID'] = $this->request->getVar('submissionid');
                $data_reviews['reviewerID'] = $this->request->getVar('peer');
                $data_reviews['editor_id'] = session()->get('userID');
                $reviewId = $this->editorModel->insertReview($data_reviews);
                $review_content['submission_id'] = $this->request->getVar('submissionid');
                $review_content['peer_id'] = $this->request->getVar('peer');
                $review_content['review_id'] = $reviewId;
                foreach ($this->request->getVar('contentid') as $content) {
                    $review_content['submission_content_id'] = $content;
                    $revContentId = $this->editorModel->insertReviewContent($review_content);
                }
                $peer = $this->editorModel->getAutor($this->request->getVar('peer'));
                $note['sender'] = session()->get('username');
                $note['sender_email'] = session()->get('logged_user');
                $note['sender_id'] = session()->get('userID');
                $note['submissionID'] = $this->request->getVar('submissionid');
                $note['recipient'] = $peer->email;
                $note['recipient_id'] = $this->request->getVar('peer');
                $note['title'] = $this->request->getVar('title');
                $note['message'] = $this->request->getVar('message');
                $insertNote = $this->editorModel->discussion($note);
                if ($insertNote) {
                    //send email

                    $mailContent = '';
                    foreach ($this->request->getVar('contentid') as $contId) {
                        $content = $this->editorModel->getRevisionFile($contId);
                        $editorFile = $this->editorModel->getEditorialUploads($contId);
                        if ($content) {
                            $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $content->content . '>' . $content->content . '</a></p>';
                        } elseif ($editorFile) {
                            $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorFile->upload_content . '>' . $editorFile->upload_content . '</a></p>';
                        }
                    }
                    $mailMsg = $this->request->getVar('message');
                    $body = $mailMsg . $mailContent;

                    $this->email->setTo($peer->email);
                    $this->email->setFrom(session()->get('logged_user'), 'Info');
                    $this->email->setSubject($this->request->getVar('title'));
                    $this->email->setMessage($body);
                    if ($this->email->send()) {
                        $this->session->setTempdata("success", "Notification sent successfully to the Reviewer.", 3);
                        return redirect()->to('editor/byauthor/' . $this->request->getVar('submissionid'));
                    } else {
                        $this->session->setTempdata("error", "Something happen wrong!", 3);
                    }
                }
            } else {
                $this->session->setTempdata("error", "Alredy sent to this reviewer!", 3);
                return redirect()->to('editor/byauthor/' . $this->request->getVar('submissionid'));
            }
        }
    }

    public function editorUpload() {
//        if($this->request->getMethod()=='post'){
//            $sid = $this->request->getVar('submission_id');
//            $editorData = $this->editorModel->getEditorialDecisionBySubId($sid);
//            if($editorData){
//                $err =['error' =>'You alredy have file, first delete and try to upload new file.'];
//            
//                return json_encode($err);
//            }
//        }
        if ($this->request->getMethod() == 'post' && ($_FILES['revisionFile']['size'] > 0)) {


            $sid = $this->request->getVar('submission_id');
            $editorData = $this->editorModel->getEditorialUploadsBySubId($sid);
            if ($editorData) {
                $err = array('error' => 'You alredy have file, first delete and try to upload new file');
                return json_encode($err);
            }


            $editor_uploads = [];

            $rules = [
                'revisionFile' => 'uploaded[revisionFile]|ext_in[revisionFile,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];
            if ($this->validate($rules)) {
                $file = $this->request->getFile('revisionFile');
                if ($file->isValid() && !$file->hasMoved()) {

                    $newName = $file->getRandomName() . '_' . $file->getClientName();

                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        // echo '<p>Uploaded successfully</p>';

                        $editor_uploads['editorID'] = session()->get('userID');
                        $editor_uploads['submissionID'] = $this->request->getVar('submission_id'); //$submission_id;
                        $editor_uploads['upload_content'] = $newName;

                        $decision_id = $this->editorModel->insertEditorialUploads($editor_uploads);
                        $editorial = $this->editorModel->getEditorialUploads($decision_id);

//print_r($editorial);
                        return json_encode($editorial);
                    } else {
                        echo $file->getErrorString() . " " . $file->getError();
                    }
                }
            } else {

                $data['validation'] = $this->validator;
            }
        }
    }

    public function deleteEditorUpload() {
        $uri = $this->request->getUri();
        $subId = $uri->getSegment(3);
        $id = $uri->getSegment(4);
        $this->editorModel->deleteEditorUpload($id);
        return redirect()->to('editor/byauthor/' . $subId);
    }

    public function peerDiscussion() {

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'editorfile' => 'uploaded[editorfile]|ext_in[editorfile,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];

            if ($this->validate($rules)) {
                $file = $this->request->getFile('editorfile');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName() . '_' . $file->getClientName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        //echo '<p>Uploaded successfully</p>';
                    }
                }
            }

            $rev = $this->editorModel->getReviewsBySubId($this->request->getVar('subId'));
            $peer = $this->user->getUser($rev->reviewerID);
            $notification['sender'] = session()->get('username');
            $notification['sender_email'] = session()->get('logged_user');
            $notification['sender_id'] = session()->get('userID');
            $notification['recipient'] = $peer->email;
            $notification['recipient_id'] = $peer->userID;
            $notification['submissionID'] = $this->request->getVar('subId');
            $notification['content'] = ($newName) ? $newName : '';
            $notification['title'] = $this->request->getVar('title');
            $notification['message'] = $this->request->getVar('message');
            $note = $this->editorModel->uploadEditorResponseToPeer($notification);
            //send mail to peer
            if ($note) {
                //send email
                $mailContent = '';
                $editorData = $this->editorModel->getEditorPeerContent($note); //$revision_id or $note

                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorData->content . '>' . $editorData->content . '</a></p>';

                $mailMsg = $this->request->getVar('message');
                $body = $mailMsg . $mailContent;

                $this->email->setTo($editor->email);
                $this->email->setFrom(session()->get('logged_user'), 'Info');
                $this->email->setSubject($this->request->getVar('title'));
                $this->email->setMessage($body);
                if ($this->email->send()) {
                    $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                    //return redirect()->to('peer');
                } else {
                    $this->session->setTempdata("error", "Something happen wrong!", 3);
                }
            }
        }
    }
    
        public function copyeditorDiscussion() {

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'editorfile' => 'uploaded[editorfile]|ext_in[editorfile,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];

            if ($this->validate($rules)) {
                $file = $this->request->getFile('editorfile');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName() . '_' . $file->getClientName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        //echo '<p>Uploaded successfully</p>';
                    }
                }
            }

            $rev = $this->editorModel->getCopyeditorBySubId($this->request->getVar('subId'));
            $cpeEitor = $this->user->getUser($rev->copyeditor_id);
            $notification['sender'] = session()->get('username');
            $notification['sender_email'] = session()->get('logged_user');
            $notification['editorID'] = session()->get('userID');
            $notification['copyeditor_id'] = $cpeEitor->userID;
            $notification['recipient'] = $cpeEitor->userID;
            $notification['recipient_email'] = $cpeEitor->email;
            $notification['submissionID'] = $this->request->getVar('subId');
            $notification['upload_content'] = ($newName) ? $newName : '';
            $notification['decision'] = $this->request->getVar('title');
            $notification['comments'] = $this->request->getVar('message');
            $note = $this->editorModel->sendToCopyEditor($notification);
            //send mail to peer
            if ($note) {
                //send email
                $mailContent = '';
                $editorData = $this->editorModel->getEditorialDecision($note); //$revision_id or $note

                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorData->upload_content . '>' . $editorData->upload_content . '</a></p>';

                $mailMsg = $this->request->getVar('message');
                $body = $mailMsg . $mailContent;

                $this->email->setTo($cpeEitor->email);
                $this->email->setFrom(session()->get('logged_user'), 'Info');
                $this->email->setSubject($this->request->getVar('title'));
                $this->email->setMessage($body);
                if ($this->email->send()) {
                    $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                    //return redirect()->to('peer');
                } else {
                    $this->session->setTempdata("error", "Something happen wrong!", 3);
                }
            }
        }
    }
    
     public function tocpeditor() {
        $cpEditor = $this->editorModel->getCopyeditor();
        $submissionid = $this->request->getVar('submissionid');
        $title = $this->request->getVar('title');
        
        $copyeditor = [];
        foreach ($cpEditor as $ceditor) {
            $copyeditor[$ceditor->userID] = $ceditor->username;
        }
        $data['cpEditor'] = $copyeditor;

        $data['submissionid'] = $submissionid;
        $data['title'] = $title;
        return view('editor/tocpeditor', $data);
    }
    public function sendCopyEditor(){
        if ($this->request->getMethod() == 'post' && ($_FILES['cpFile']['size'] > 0)) {

            $editorieal_decision = [];
            $notification = [];
            $rules = [
                'cpFile' => 'uploaded[cpFile]|ext_in[cpFile,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];
            if ($this->validate($rules)) {
                $file = $this->request->getFile('cpFile');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName() . '_' . $file->getClientName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        echo '<p>Uploaded successfully</p>';
                        $cpeEitor = $this->user->getUser($this->request->getVar('copyeditor'));
                        $editorieal_decision['editorID'] = session()->get('userID');
                        $editorieal_decision['sender'] = session()->get('username');
                        $editorieal_decision['sender_email'] = session()->get('logged_user');
                        $editorieal_decision['copyeditor_id'] = $this->request->getVar('copyeditor');
                        $editorieal_decision['recipient'] = $this->request->getVar('copyeditor');
                        $editorieal_decision['recipient_email'] = $cpeEitor->email;
                        $editorieal_decision['decision'] = $this->request->getVar('title');
                        $editorieal_decision['comments'] = $this->request->getVar('message');
                        $editorieal_decision['submissionID'] = $this->request->getVar('submission_id');
                        $editorieal_decision['upload_content'] = $newName;
                        $editorieal_decision['status'] = 1;
                        
                        $decision_id = $this->editorModel->sendToCopyEditor($editorieal_decision);
                        
                        $editor = $this->user->getUser($this->request->getVar('copyeditor'));
                        $notification['sender'] = session()->get('username');
                        $notification['sender_email'] = session()->get('logged_user');
                        $notification['sender_id'] = session()->get('userID');
                        $notification['recipient'] = $editor->email;
                        $notification['recipient_id'] = $editor->userID;
                        $notification['submissionID'] = $this->request->getVar('submission_id');
                        //$notification['content'] = $newName;
                        $notification['title'] = $this->request->getVar('title');
                        $notification['message'] = $this->request->getVar('message');


                        $note = $this->editorModel->discussion($notification);

                        if ($decision_id) {
                            //send email
                            $mailContent = '';
                            $editorData = $this->editorModel->getEditorialDecision($decision_id); 
                            $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorData->upload_content . '>' . $editorData->upload_content . '</a></p>';
                            $mailMsg = $this->request->getVar('message');
                            $body = $mailMsg . $mailContent;
                            $this->email->setTo($editor->email);
                            $this->email->setFrom(session()->get('logged_user'), 'Info');
                            $this->email->setSubject($this->request->getVar('title'));
                            $this->email->setMessage($body);
                            if ($this->email->send()) {
                                $this->session->setTempdata("success", "Notification sent successfully to the Copy Editor.", 3);
                                return redirect()->to('editor/byauthor/'.$this->request->getVar('submission_id'));
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
        
    }
}
