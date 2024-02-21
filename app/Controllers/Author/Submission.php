<?php

namespace App\Controllers\Author;

use App\Controllers\BaseController;
use App\Models\SubmissionModel;

/**
 * Description of Author
 *
 * @author Ashok
 */
class Submission extends BaseController
{

    public $submissionModel;
    public $email;
    public function __construct()
    {
        helper(['url', 'form']);
        $this->email = \Config\Services::email();
        $this->submissionModel = new SubmissionModel();
    }

    public function index()
    {
        $data = [];
        $data['validation'] = null;
        $coAuthors = $this->submissionModel->getCoAuthor(session()->get('userID'));
        $data['coAuthors'] = $coAuthors;
        if ($this->request->getMethod() == 'post') {
            // print '<pre>';
            // print_r($_POST);
            // exit;
            $rules = [
                'title' => 'required',
                'keyword' => 'required',
                'language' => 'required',
                'editor_comment' => 'required',
                'abstract' => 'required',
                'reference' => 'required',
                'title' => 'required',

            ];
            if ($this->validate($rules)) {
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
                $terms1 = $this->request->getVar('terms1');
                $terms2 = $this->request->getVar('terms2');
                $terms3 = $this->request->getVar('terms3');
                $terms4 = $this->request->getVar('terms4');
                $terms5 = $this->request->getVar('terms5');
                $coauthorNames = $this->request->getVar('coauthorName');
                $coauthorIds = $this->request->getVar('coauthorId');
                $coauthorEmails = $this->request->getVar('coauthorEmails');
                //$coauthor_id = $this->request->getVar('coauthor');
                $coauthor_primaryContact = $this->request->getVar('primary_contact');


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
                    //'coauthor' => $coAuthor,
                    // 'coauthor' => $coauthor_id, not used
                    'terms1' => $terms1,
                    'terms2' => $terms2,
                    'terms3' => $terms3,
                    'terms4' => $terms4,
                    'terms5' => $terms5,

                ];

                $submissionID = $this->submissionModel->createSubmission($submission);


                $tempFie = $this->submissionModel->getAllTempUploads(session()->get("userID"));
                if ($tempFie) {

                    $dataSet = [];

                    foreach ($tempFie as $k => $val) {

                        $dataSet['content'] = $val->content;
                        $dataSet['article_component'] = $val->component;
                        $dataSet['submissionID'] = $submissionID;
                        $result = $this->submissionModel->createSubmissionContent($dataSet);
                        if ($result) $this->submissionModel->deleteTempFile($val->id);
                    }

                    if ($result) {
                        $data['success'][] = "Uploaded successfully";
                    } else {
                        $data['validation'] = "Error occured!"; //$doc->getErrorString();
                    }
                    //update coauthor with submission id
                    if (isset($coauthorIds)) {
                        foreach ($coauthorIds as $coauthor_id) {
                            $this->submissionModel->updateCoauthor($coauthor_id, $submissionID);
                        }
                    }
                    //updating primary conteact of coauthor.
                    if (isset($coauthor_primaryContact)) $this->submissionModel->updateCoauthorPrimaryContacct($coauthor_primaryContact);
                    //sending emails bof
                    $coa_names = '';
                    if (isset($coauthorNames)) {
                        foreach ($coauthorNames as $coa) {
                            $coa_names .= $coa . ', ';
                        }
                    }
                    $fullName = session()->get("title") . ' ' . session()->get("username") . ' ' . session()->get("middle_name") . ' ' . session()->get("last_name");
                    $mailSent = $this->sendEmail(session()->get("logged_user"), $title, $fullName, $coa_names, $submissionID, $coauthorEmails);
                    //sending email eof
                    return redirect()->to('author/submissionComplete');
                } else {
                    //delete submission
                    $this->submissionModel->deleteById($submissionID);
                    $data['validation'] = $this->validator;
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('author/submission', $data);
    }

    public function listView()
    {
        $data = [];
        $submission = $this->submissionModel->getByAutorId(session()->get("userID"));

        $completed = $this->submissionModel->getCompleted(session()->get("userID"));

        foreach ($submission as $key => $subid) {
            $submission_content = $this->submissionModel->getBySubmissionId($subid->submissionID);
            $coauthor = $this->submissionModel->coauthorBySubmission(session()->get("userID"), $subid->submissionID);
            $user = $this->submissionModel->getUser($subid->authorID);
            $submission[$key]->author = $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->last_name;
            $submission[$key]->author_email = $user->email;
            $submission[$key]->submission_content = $submission_content;

            if ($coauthor) {
                $submission[$key]->coauthor = $coauthor; //$coauthor[0]->name;

            }
            $note = $this->submissionModel->getNoticeCount(session()->get("userID"), $subid->submissionID);
            if ($note) {
                $submission[$key]->notification = $note;
            }
        }

        foreach ($completed as $key => $subid) {
            $coauthor = $this->submissionModel->coauthorBySubmission(session()->get("userID"), $subid->submissionID);
            $user = $this->submissionModel->getUser($subid->authorID);
            $completed[$key]->author = $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->last_name;
            $completed[$key]->author_email = $user->email;
            if ($coauthor) {
                $completed[$key]->coauthor = $coauthor;
            }
            $note = $this->submissionModel->getNoticeCount(session()->get("userID"), $subid->submissionID);
            if ($note) {
                $completed[$key]->notification = $note;
            }
        }
        $data['list'] = $submission;
        $data['completed'] = $completed;

        return view('author/listview', $data);
    }

    public function downloads()
    {
        $uri = $this->request->getUri();
        $name = WRITEPATH . 'uploads/' . $uri->getSegment(3);
        return $this->response->download($name, null);
    }

    public function revision()
    {

        if ($this->request->getMethod() == 'post' && ($_FILES['revisionFile']['size'] > 0)) {
            $revFileId = '';
            if ($this->request->getVar('updateFileId')) {
                $revFileId = $this->request->getVar('updateFileId');
            }
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

                        if ($revFileId) {
                            $revision_id = $this->submissionModel->updateSubmissionContent($revFileId, $submission_content);
                        } else {
                            $revision_id = $this->submissionModel->createSubmissionContent($submission_content);
                        }
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

    public function reply()
    {
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

    public function discussion()
    {
        $uri = $this->request->getUri();
        $submissionid = $uri->getSegment(3);
        $notice = $this->submissionModel->getNotice(session()->get("userID"), $submissionid);
        $data['submissionid'] = $submissionid;
        $data['notice'] = $notice;

        return view('author/discussion', $data);
    }

    public function contributor()
    {

        if ($this->request->getMethod() == 'post') {
            $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
            $data = [];

            $data['author_id'] = session()->get("userID");
            $data['title'] = $this->request->getVar("co-title");
            $data['name'] = $this->request->getVar('c-name');
            $data['m_name'] = $this->request->getVar('m_name');
            $data['l_name'] = $this->request->getVar('l_name');
            $data['email'] = $this->request->getVar('c-email');
            $data['suffix'] = $this->request->getVar('suffix');
            $data['url'] = $this->request->getVar('url');
            $data['orcid'] = $this->request->getVar('orcid');
            $data['affiliation'] = $this->request->getVar('affiliation');
            $data['bio_statement'] = $this->request->getVar('bio_statement');
            $data['contact'] = $this->request->getVar('contact');
            $data['browse_list'] = $this->request->getVar('browse_list');
            $data['role'] = $this->request->getVar('c-roleID');
            $data['uniid'] = $uniid;
            $data['country'] = $this->request->getVar('c-country');
            $contributorId = $this->submissionModel->createContributorUsers($data);
            if ($contributorId) {
                echo $contributorId;
            }
        }
    }
    public function submissionComplete()
    {
        return view('author/submission_complete');
    }
    public function deleteCoauthor()
    {
        $id = $this->request->getVar('id');
        $result = $this->submissionModel->deleteCoauthor($id);
        if ($result) {
            $data = ['response' => 1];
            echo json_encode($data);
        } else {
            $data = ['response' => 0];
            echo json_encode($data);
        }
    }

    public function deleteTempFile()
    {
        $id = $this->request->getVar('id');
        $result = $this->submissionModel->deleteTempFile($id);
        if ($result) {
            $data = ['response' => 1];
            echo json_encode($data);
        } else {
            $data = ['response' => 0];
            echo json_encode($data);
        }
    }




    //Temporary file upload

    public function authorTempUpload()
    {

        if ($this->request->getMethod() == 'post' && ($_FILES['articlefile']['size'] > 0)) {

            $editor_uploads = [];

            $rules = [
                'articlefile' => 'uploaded[articlefile]|ext_in[articlefile,png,jpg,gif,doc,docx,pdf,jpeg]',
            ];
            if ($this->validate($rules)) {
                $file = $this->request->getFile('articlefile');
                if ($file->isValid() && !$file->hasMoved()) {

                    $newName = $file->getRandomName() . '_' . $file->getClientName();
                    //$newName = $file->getClientName();

                    //if ($file->move(WRITEPATH . 'uploads/' . session()->get('logged_user') . '/', $newName)) {
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        // echo '<p>Uploaded successfully</p>';

                        $editor_uploads['author_id'] = session()->get('userID');
                        $editor_uploads['component'] = $this->request->getVar('article_type');
                        $editor_uploads['content'] = $newName;

                        $decision_id = $this->submissionModel->insertTempUploads($editor_uploads);
                        $editorial = $this->submissionModel->getTempUploads($decision_id);

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

    public function detailview()
    {
        $uri = $this->request->getUri();
        $submission_id = $uri->getSegment(3);
        $data = [];
        $submission = $this->submissionModel->getById($submission_id);
        $submission_content = $this->submissionModel->getBySubmissionId($submission_id);
        $coauthor = $this->submissionModel->coauthorBySubmission(session()->get("userID"), $submission_id);
        $user = $this->submissionModel->getUser($submission->authorID);

        $data['submission'] = $submission;
        $data['submission_content'] = $submission_content;
        $data['coauthor'] = $coauthor;
        $data['user'] = $user;

        return view('author/detailview', $data);
    }

    public function sendEmail($to, $title, $fullName, $coauthor, $id, $coEmails, $journal = 'Orthopedic')
    {
        $mailData = [];
        $mailData['title'] = $title;
        $mailData['fullName'] = $fullName;
        $mailData['coauthors'] = $coauthor;
        //$mailData['coauthorEmails'] = $coEmails;
        $mailData['journal'] = $journal;
        $mailData['id'] = $id;
        $subject = 'Confirmation of Manuscript Submission of ' . $journal . ' ' . $title;
        $subject = $subject;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setCC($coEmails);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body =  view('submission_email', $mailData);
        $this->email->setMessage($body);
        $this->email->send();
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
}
