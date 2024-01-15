<?php

namespace App\Controllers\Editcopy;

use App\Controllers\BaseController;
use App\Models\EditcopyModel;
use App\Models\UserModel;

/**
 * Description of Editcopy
 *
 * @author Ashok
 */
class Editcopy extends BaseController {

    public $cpEditor;
    public $userModel;
    public $session;
    public $email;

    public function __construct() {
        helper(['url', 'form']);
        $this->cpEditor = new EditcopyModel();
        $this->userModel = new UserModel;

        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

    public function index() {
        $data = [];
        $contents = $this->cpEditor->getCopyeditingRequest(session()->get('userID'));
        $count = $this->cpEditor->noteCount(session()->get('userID'));

        $data['contents'] = $contents;
        $data['count'] = $count;
        return view('editcopy/index', $data);
    }

    public function discussion() {
        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $editor_id = $uri->getSegment(4);
        $data = [];
        $data['submission_id'] = $submission_id;
        $data['editor_id'] = $editor_id;
        $data['editorDiscussions'] = $this->cpEditor->getDiscussion(session()->get('userID'), $submission_id);
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

                        $note = $this->cpEditor->sendToEditor($notification);

                        if ($note) {
                            //send email
                            $mailContent = '';
                            $editorData = $this->cpEditor->getEditorialDecisionByid($note); //$revision_id or $note
                            $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorData->upload_content . '>' . $editorData->upload_content . '</a></p>';
                            $mailMsg = $this->request->getVar('message');
                            $body = $mailMsg . $mailContent;
                            $this->email->setTo($editor->email);
                            $this->email->setFrom(session()->get('logged_user'), 'Info');
                            $this->email->setSubject($this->request->getVar('title'));
                            $this->email->setMessage($body);
                            if ($this->email->send()) {
                                $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                                return redirect()->to('editcopy');
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
        return view('editcopy/discussion', $data);
    }
}
