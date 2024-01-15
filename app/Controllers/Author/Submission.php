<?php

namespace App\Controllers\Author;

use App\Controllers\BaseController;
use App\Models\SubmissionModel;

/**
 * Description of Author
 *
 * @author Ashok
 */
class Submission extends BaseController {

    public $submissionModel;

    public function __construct() {
        helper(['url', 'form']);
        $this->submissionModel = new SubmissionModel();
    }

    public function index() {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $articleComponent = $this->request->getPost('article_type');
            $editorComment = $this->request->getPost('editor_comment');
            $contactConsent = $this->request->getPost('contact');
            $dataConsent = $this->request->getPost('data');

            $prefix = $this->request->getPost('prefix');
            $title = $this->request->getPost('title');
            $subtitle = $this->request->getPost('subtitle');
            $abstract = $this->request->getPost('abstract');
            $language = $this->request->getPost('language');
            $keyword = $this->request->getPost('keyword');
            $reference = $this->request->getPost('reference');
            $coAuthor = 0;
             if(isset($_COOKIE['coauthor'])) {
              $coAuthor = $_COOKIE['coauthor']; 
               unset($_COOKIE['coauthor']); 
                setcookie('coauthor', '', -1, '/author');
               }
            $submission = [
                'content' => $editorComment,
                'consent_contact' => $contactConsent,
                'consent_store' => $dataConsent,
                'prefix' => $prefix,
                'title' => $title,
                'subtitle' => $subtitle,
                'abstract' => $abstract,
                'language' => $language,
                'keyword' => $keyword,
                'reference' => $reference,
                'authorID' => session()->get("userID"),
                'coauthor' => $coAuthor,
                
            ];
                     
            $submissionID = $this->submissionModel->createSubmission($submission);

            $rules = [
                'article' => 'uploaded[article.0]|ext_in[article,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];
            if ($this->validate($rules)) {

                $files = $this->request->getFiles();
                foreach ($files['article'] as $doc) {
                    if ($doc->isValid() && !$doc->hasMoved()) {

                        $newName = $doc->getRandomName() . '_' . $doc->getClientName();
                        if ($doc->move(WRITEPATH . 'uploads/', $newName)) {
                            // $data['success'][] =$doc->getName()." is uploaded successfully";
                            $dataToInsert[]['content'] = $newName;
                            // $dataToInsert[]['article_component']= $this->request->getPost('article_type');
                        } else {
                            $data['validation'] = $doc->getErrorString();
                        }
                    }
                }

                $dataSet = [];
                $component = $this->request->getPost('article_type');
                foreach ($dataToInsert as $key => $value) {
                    foreach ($value as $k => $val) {

                        $dataSet[$key]['content'] = $val;
                        $dataSet[$key]['article_component'] = $component[$key];
                        $dataSet[$key]['submissionID'] = $submissionID;
                    }
                }
                $result = $this->submissionModel->createSubmissionContent($dataSet);
                if ($result) {
                    // $data['success'][] =$doc->getName()." is uploaded successfully";
                    $data['success'][] = "Uploaded successfully";
                } else {
                    $data['validation'] = $doc->getErrorString();
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('author/submission', $data);
    }

    public function listView() {
        $data = [];
        $submission = $this->submissionModel->getByAutorId(session()->get("userID"));
        //$data['noticeCount'] = $this->submissionModel->getNoticeCount(session()->get("userID"));
       
        foreach ($submission as $key => $subid) {
            $data['list'][$subid->title] = $this->submissionModel->getBySubmissionId($subid->submissionID);
            $data['notification'][$subid->title] = $this->submissionModel->getNoticeCount(session()->get("userID"), $subid->submissionID);
        }
        
        return view('author/listview', $data);
    }

    public function downloads() {
        $uri = $this->request->getUri();
        $name = WRITEPATH . 'uploads/' . $uri->getSegment(3);
        return $this->response->download($name, null);
    }

    public function revision() {
        if ($this->request->getMethod() == 'post' && ($_FILES['revisionFile']['size'] > 0)) {

            $submission_content = [];
           
            $rules = [
                'revisionFile' => 'uploaded[revisionFile]|ext_in[revisionFile,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];
            if ($this->validate($rules)) {
                $file = $this->request->getFile('revisionFile');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName() . '_' . $file->getClientName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        echo '<p>Uploaded successfully</p>';
                        $submission_content['submissionID'] = $this->request->getVar('submissionID');
                        $submission_content['content'] = $newName;
                        $submission_content['article_component'] = $this->request->getVar('article_type');
                        $revision_id = $this->submissionModel->createSubmissionContent($submission_content);
                        
                    } else {
                        echo $file->getErrorString() . " " . $file->getError();
                    }
                }
            } else {
                $data['validation'] = $this->validator;
            }
        } elseif ($this->request->getMethod() == 'post') {
            $data['validation'] = 'Files are required to upload.';
            echo '<p>Error: Files need to upload</p>';
        }
    }

    public function reply() {
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
                        $submission_content['submissionID'] = $this->request->getVar('submission');
                        $submission_content['content'] = $newName;
                        $submission_content['article_component'] = $this->request->getVar('article_type');
                        $revision_id = $this->submissionModel->createSubmissionContent($submission_content);
                        $notification['sender'] = session()->get('username');
                        $notification['sender_email'] = session()->get('logged_user');
                        $notification['sender_id'] = session()->get('userID');
                        $notification['recipient'] = $this->request->getVar('recipient');
                        $notification['recipient_id'] = $this->request->getVar('recipient_id');
                        $notification['submissionID'] = $this->request->getVar('submission');
                        $notification['content_id'] = $revision_id;
                        $notification['title'] = $this->request->getVar('subject-title');
                        $notification['message'] = $this->request->getVar('message-text');

                        $note = $this->submissionModel->discussion($notification);
                        print_r($submission_content);
                        print_r($notification);
                    } else {
                        echo $file->getErrorString() . " " . $file->getError();
                    }
                }
            } else {
                $data['validation'] = $this->validator;
            }
        } elseif ($this->request->getMethod() == 'post') {

            $notification['sender'] = session()->get('username');
            $notification['sender_email'] = session()->get('logged_user');
            $notification['sender_id'] = session()->get('userID');
            $notification['recipient'] = $this->request->getVar('recipient');
            $notification['recipient_id'] = $this->request->getVar('recipient_id');
            $notification['submissionID'] = $this->request->getVar('submission');
            $notification['title'] = $this->request->getVar('subject-title');
            $notification['message'] = $this->request->getVar('message-text');

            $note = $this->submissionModel->discussion($notification);
            echo '<p>successfully replied</p>';
        }
        //return view('author/reply');
    }

    public function discussion() {
        $uri = $this->request->getUri();
        $submissionid = $uri->getSegment(3);
        $notice = $this->submissionModel->getNotice(session()->get("userID"), $submissionid);
        $data['submissionid'] = $submissionid;
        $data['notice'] = $notice;

        return view('author/discussion', $data);
    }
    
    public function contributor(){
        
        if ($this->request->getMethod() == 'post') {
            $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz'.time()));
            $data=[];
            $data['username'] = $this->request->getVar('c-name');
            $data['email'] = $this->request->getVar('c-email');
            $data['roleID'] = $this->request->getVar('c-roleID');
            $data['uniid'] = $uniid;
            $data['country'] = $this->request->getVar('c-country');
            $contributorId = $this->submissionModel->createContributorUsers($data);
            if($contributorId){
                echo $contributorId;
            }
        }
         
        
    }
}
