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
class Peer extends BaseController {

    public $peerModel;
    public $editorModel;
    public $userModel;
    public $submissionModel;
    public $session;
    public $email;

    public function __construct() {
        helper(['url', 'form']);
        $this->peerModel = new PeerModel();
        $this->userModel = new UserModel();
        $this->editorModel = new EditorModel;
        $this->submissionModel = new SubmissionModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

    public function index() {
        $data = [];
        $uid = session()->get('userID');
        $reviews = $this->peerModel->getReviewRequest($uid);
        if($reviews)
        $editorPeerContent = $this->peerModel->getEditoriealUploads($reviews[0]->submissionID);
        $noteCount = $this->peerModel->noteCount($uid);
        $data['reviews'] = $reviews;
        $data['noteCount'] = ($noteCount) ? $noteCount: 0;
        if(isset($editorPeerContent))
        $data['editorPeerContent'] = $editorPeerContent;
        
        return view('peer/index', $data);
    }

    public function discussion() {
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

                        if ($note) {
                            //send email
//print $note;

                            $mailContent = '';
                            $editorData = $this->peerModel->getEditorPeerContent($note); //$revision_id or $note

                            $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorData->content . '>' . $editorData->content . '</a></p>';

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
    public function updateReview(){
        $uid = session()->get('userID');
        
        $revId = $this->request->getVar('reviewID');
        $status = $this->request->getVar('status');
        $q = $this->peerModel->updateReview($revId, $status);
      
        if($q){
            $success = array('success'=>'Review status has been updated successfully!');
            return json_encode($success);
            
        }else{
             $error = array('error'=>'Somethng went wrong!');
           return json_encode($error);
             
        }
        
    }
}
