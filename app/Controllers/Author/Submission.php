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
        helper(['url', 'form', 'role']);
        $this->email = \Config\Services::email();
        $this->submissionModel = new SubmissionModel();
    }

    public function index()
    {
        $data = [];
        $data['validation'] = null;
        $coAuthors = $this->submissionModel->getCoAuthor(session()->get('userID'));
        $data['coAuthors'] = $coAuthors;
        $data['journals'] = $this->submissionModel->getJournals();
        if ($this->request->getMethod() == 'post') {

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
                $jid = $this->request->getVar('jid');

                //$coauthor_id = $this->request->getVar('coauthor');
                $coauthor_primaryContact = $this->request->getVar('primary_contact');


                $submission = [
                    'jid' => $jid,
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
                $journal = $this->submissionModel->getJournal($submission['jid']);
                $journalName = $journal->journal_name;
                $submissionID = $this->submissionModel->createSubmission($submission);
                $tempFie = $this->submissionModel->getAllTempUploads(session()->get("userID"));
                if ($tempFie) {
                    $dataSet = [];
                    foreach ($tempFie as $k => $val) {

                        $dataSet['content'] = $val->content;
                        $dataSet['article_component'] = $val->component;
                        $dataSet['submissionID'] = $submissionID;
                        $result = $this->submissionModel->createSubmissionContent($dataSet);
                        if ($result)
                            $this->submissionModel->deleteTempFile($val->id);
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
                    if (isset($coauthor_primaryContact))
                        $this->submissionModel->updateCoauthorPrimaryContacct($coauthor_primaryContact);
                    //sending emails bof
                    $coa_names = '';
                    if (isset($coauthorNames)) {
                        foreach ($coauthorNames as $coa) {
                            $coa_names .= $coa . ', ';
                        }
                    }

                    //send email to all the co-authors
                    $primaryContact = $this->submissionModel->getCoauthorbyId($coauthor_primaryContact);
                    $primary_contact_name = $primaryContact->title . ' ' . $primaryContact->name . ' ' . $primaryContact->m_name . ' ' . $primaryContact->l_name;
                    if (isset($coauthorIds)) {
                        foreach ($coauthorIds as $coauthor_id) {
                            $coAuthorDetails[] = $this->submissionModel->getCoauthorbyId($coauthor_id);
                        }
                    }
                    if (isset($coAuthorDetails)) {
                        foreach ($coAuthorDetails as $coauth) {
                            $fname = $coauth->title . ' ' . $coauth->name . ' ' . $coauth->m_name . ' ' . $coauth->l_name;
                            $comailSent = $this->sendEmail($coauth->email, $title, $fname, $coa_names, $submissionID, $coauthorEmails, $primary_contact_name, $journalName);
                        }
                    }


                    $fullName = session()->get("title") . ' ' . session()->get("username") . ' ' . session()->get("middle_name") . ' ' . session()->get("last_name");
                    $mailSent = $this->sendEmail(session()->get("logged_user"), $title, $fullName, $coa_names, $submissionID, $coauthorEmails, $primary_contact_name, $journalName);
                    //to editor
                    $editors = $this->submissionModel->getEditors();
                    // $primaryContact = $this->submissionModel->getCoauthorbyId($coauthor_primaryContact);
                    if ($editors) {
                        foreach ($editors as $editor) {
                            $this->mailToEditor($editor->email, $title, $fullName, $coa_names, $submissionID, $coauthorEmails, $primaryContact->email, $journalName);
                        }
                    }
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
        $submission = $this->submissionModel->getByAuthorId(session()->get("userID"));

        $completed = $this->submissionModel->getCompleted(session()->get("userID"));
        $revisionRequested = [];
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
            $editorDecision = $this->submissionModel->getEditorialDecision($subid->submissionID);
            if ($editorDecision) {
                array_push($revisionRequested, $editorDecision->submissionID);
            }
            /////
            $peerState = $this->submissionModel->getByReviewStatus('reviews', $subid->submissionID);
            $peerStatus = [];
            if (count($peerState) > 0) {
                foreach ($peerState as $pstate) {
                    $peerStatus[] = $pstate->status;
                }
                $peerStatus = max($peerStatus);
            }
            $submission[$key]->peerStatus = ($peerStatus) ? $peerStatus : '';
            /////


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
        $data['revisionRequested'] = $revisionRequested;
        return view('author/listview', $data);
    }

    public function downloads()
    {
        $uri = $this->request->getUri();
        $name = WRITEPATH . 'uploads/' . urldecode($uri->getSegment(3));
        // $name = WRITEPATH . 'uploads/' . urlencode($uri->getSegment(3));
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
                $article_type = $this->request->getVar('article_type');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $article_type . '_' . time() . '_' . $file->getClientName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        //  echo '<p>Uploaded successfully</p>';
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
                //email bof
                $subid = $this->request->getVar('submissionID');
                $submission = $this->submissionModel->getById($subid);
                $subtitle = $submission->title;
                $subid = $submission->submissionID;
                $subDate = $submission->submission_date;
                $jornal = 'Orthopedic'; //$this->request->getVar('jornal');
                if (isset($jornal)) {
                    $jornal = $jornal;
                }
                $subjectTitle = $this->request->getVar('subject-title');
                $message = $this->request->getVar('message-text');
                if (isset($newName)) {
                    $revfile = $newName;
                }
                $editors = $this->submissionModel->getEditors();

                foreach ($editors as $editor) {
                    $editorFullName = $editor->title . ' ' . $editor->username . ' ' . $editor->middle_name . ' ' . $editor->last_name;
                    $response = $this->revisionMail($editor->email, $editorFullName, $subtitle, $subid, $subDate, $subjectTitle, $message, $jornal, $revfile);
                }
                // email eof
                // update revision status
                $this->submissionModel->updateRevisionStatus($subid);
                $journal = $this->submissionModel->getJournal($this->request->getVar('jid'));
                $user = $user = $this->submissionModel->getUser($journal->editor_id);
                $notification = [];
                $notification['title'] = $subjectTitle;
                $notification['message'] = $message;
                $notification['article_component'] = $this->request->getVar('article_type');
                $notification['file'] = ($newName) ? $newName : '';
                $notification['role'] = 3;
                $notification['sender'] = session()->get('fullName');
                $notification['sender_email'] = session()->get('logged_user');
                $notification['sender_id'] = session()->get('userID');
                $notification['submissionID'] = $this->request->getVar('submissionID');
                $notification['recipient'] = $user->email;
                $notification['recipient_id'] = $user->userID;


                $note = $this->submissionModel->discussion($notification);
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


        $Submission = $this->submissionModel->getById($this->request->getVar('submission'));
        $user = $this->submissionModel->getUser($this->request->getVar('recipient_id'));
        $primary = $this->submissionModel->getCoauthorSubid($this->request->getVar('submission'));
        if ($primary) {
            $pContact = $primary->title . ' ' . $primary->name . ' ' . $primary->m_name . ' ' . $primary->l_name;
        } else {
            $pContact = 'N/A';
        }

        $submissionDate = $Submission->submission_date;
        $fullName = $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' .' . $user->last_name;

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
                $article_component = $this->request->getVar('article_type');
                if ($file->isValid() && !$file->hasMoved()) {

                    $newName = $article_component . '_' . time() . '_' . $file->getClientName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {

                        $notification['sender'] = session()->get('fullName');
                        $notification['sender_email'] = session()->get('logged_user');
                        $notification['sender_id'] = session()->get('userID');
                        $notification['recipient'] = $this->request->getVar('recipient');
                        $notification['recipient_id'] = $this->request->getVar('recipient_id');
                        $notification['submissionID'] = $this->request->getVar('submission');
                        // $notification['content_id'] = $revision_id;
                        $notification['article_component'] = $this->request->getVar('article_type');
                        $notification['title'] = $this->request->getVar('subject-title');
                        $notification['message'] = $this->request->getVar('message-text');
                        $notification['file'] = $newName;
                        $notification['role'] = session()->get('role');
                        $note = $this->submissionModel->discussion($notification);
                        $submission_content['submissionID'] = $this->request->getVar('submission');
                        $submission_content['content'] = $newName;
                        $submission_content['article_component'] = $this->request->getVar('article_type');

                        if ($revFileId) {
                            $revision_id = $this->submissionModel->updateSubmissionContent($revFileId, $submission_content);
                        } else {
                            $revision_id = $this->submissionModel->createSubmissionContent($submission_content);
                        }

                        // $mail = $this->notificationEmail($this->request->getVar('recipient'), $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $newName);
                        echo '<p>Uploaded successfully+++</p>';

                        $this->disscusionMailtoEditor($this->request->getVar('recipient'), $Submission->submissionID, $Submission->title, $submissionDate, $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $fullName, $pContact, $newName);
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
            $notification['recipient'] = $this->request->getVar('recipient');
            $notification['recipient_id'] = $this->request->getVar('recipient_id');
            $notification['submissionID'] = $this->request->getVar('submission');
            $notification['title'] = $this->request->getVar('subject-title');
            $notification['message'] = $this->request->getVar('message-text');
            $notification['role'] = session()->get('role');
            $note = $this->submissionModel->discussion($notification);

            // $mail = $this->notificationEmail($this->request->getVar('recipient'), $this->request->getVar('subject-title'), $this->request->getVar('message-text'));
            $this->disscusionMailtoEditor($this->request->getVar('recipient'), $Submission->submissionID, $Submission->title, $submissionDate, $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $fullName, $pContact);
            echo '<p>successfully replied</p>';
        }

        //return view('author/reply');
    }

    public function discussion()
    {
        //Abandoned.
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
                $articleComponent = $this->request->getVar('article_type');
                if ($file->isValid() && !$file->hasMoved()) {

                    //$newName = $file->getRandomName() . '_' . $file->getClientName();
                    $newName = $articleComponent . '_' . time() . '_' . $file->getClientName();
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
        $revisionRequested = $this->submissionModel->getEditorialDecision($submission_id);
        $submission_content = $this->submissionModel->getBySubmissionId($submission_id);
        $coauthor = $this->submissionModel->coauthorBySubmission(session()->get("userID"), $submission_id);
        $user = $this->submissionModel->getUser($submission->authorID);
        $discussions = $this->submissionModel->getNotice(session()->get('userID'), $submission_id);
        if ($discussions) {
            foreach ($discussions as $key => $discussion) {
                $sender = $this->submissionModel->getUser($discussion->sender_id);
                $discussions[$key]->sender_role = $sender->roleID; //genrally editor 2
            }
        } else {
            $discussions = [];
        }


        $sentMessages = $this->submissionModel->getSentDiscussion(session()->get('userID'), $submission_id);
        if ($sentMessages) {
            foreach ($sentMessages as $key => $_discussion) {
                $sentMessages[$key]->sender_role = 3; //author role 
            }
        } else {
            $sentMessages = [];
        }
        $discussion_merge_sentDiscussion = array_merge($discussions, $sentMessages);
        // Sort the array
        usort($discussion_merge_sentDiscussion, function ($a, $b) {
            return strtotime($b->date_created) - strtotime($a->date_created);
        });
        // Getting status from Reviewr bof
        $peerState = $this->submissionModel->getByReviewStatus('reviews', $submission_id);
        $peerStatus = [];
        if (count($peerState) > 0) {
            foreach ($peerState as $pstate) {
                $peerStatus[] = $pstate->status;
            }
            $peerStatus = max($peerStatus);
        }
        $peerStat = ($peerStatus) ? $peerStatus : '';
        if (!$submission->status_id) {
            $submission->status_id = $peerStat;
        }
        // status eof 
        $data['discussions'] = $discussion_merge_sentDiscussion; //$discussions;
        $data['submission'] = $submission;
        $data['submission_content'] = $submission_content;
        $data['coauthor'] = $coauthor;
        $data['user'] = $user;
        $data['revisionRequested'] = $revisionRequested;
        //$data['sentMessages'] = $this->submissionModel->getSentDiscussion(session()->get('userID'), $submission_id);
        return view('author/detailview', $data);
    }



    public function sendEmail($to, $title, $fullName, $coauthor, $id, $coEmails, $primary_cotact, $journal = 'Orthopedic')
    {
        $mailData = [];
        $mailData['title'] = $title;
        $mailData['fullName'] = $fullName;
        $mailData['coauthors'] = $coauthor;
        $mailData['journal'] = $journal;
        $mailData['id'] = $id;
        $mailData['primary_contact'] = $primary_cotact;
        $subject = 'Confirmation of Manuscript Submission of ' . $journal . ' ' . $title;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        // $this->email->setCC($coEmails); blocked 12/6/2024 since send mail to all co-authors by full name
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body = view('submission_email', $mailData);
        $this->email->setMessage($body);
        // $this->email->send();

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }

    }

    public function mailToEditor($to, $title, $fullName, $coauthor, $id, $coEmails, $p_contact, $journal = 'Orthopedic')
    {
        $mailData = [];
        $mailData['title'] = $title;
        $mailData['fullName'] = $fullName;
        $mailData['coauthors'] = $coauthor;
        $mailData['journal'] = $journal;
        $mailData['id'] = $id;
        $mailData['primary_contact'] = $p_contact;
        $subject = 'A new submission titled Article :' . $id . ' ' . $title . ' by ' . $p_contact;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        // $this->email->setCC($coEmails);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body = view('mails/submissionMailToEditor', $mailData);
        $this->email->setMessage($body);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }

    }

    public function notificationEmail($to, $title, $message, $file = null)
    {
        //NOT IN USE , ABANDONED.
        $mailData = [];
        $mailData['title'] = $title;
        $mailData['message'] = $message;
        if ($file) {
            $link = base_url() . '/author/downloads/' . $file;
            $mailData['link'] = $link;
        }

        $subject = $title;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body = view('mails/notification', $mailData);
        $this->email->setMessage($body);
        //$sent = $this->email->send();
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }
    }

    public function disscusionMailtoEditor($to, $id, $title, $date, $sbjtitle, $message, $fullName, $p_contact, $file = null)
    {
        $mailData = [];
        $mailData['title'] = $title;
        $mailData['sbjtitle'] = $sbjtitle;
        $mailData['primaryContact'] = $p_contact;
        $mailData['journal'] = 'Ortopedic';
        $mailData['message'] = $message;
        $mailData['date'] = date("l jS \of F Y h:i:s A", strtotime($date));
        $mailData['fullName'] = $fullName;
        if ($file) {
            $link = base_url() . '/author/downloads/' . $file;
            $mailData['link'] = $link;
        }

        $subject = 'An update on Submission for[' . $id . ' ' . $title . ']';
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body = view('mails/disscussionMailToEditor', $mailData);
        $this->email->setMessage($body);
        //$sent = $this->email->send();
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }
    }

    public function revisionMail($to, $editorName, $subtitle, $subid, $subdate, $title, $message, $jornal = 'Orthopedic', $file = null)
    {
        $mailData = [];
        $mailData['title'] = $title;
        $mailData['jornal'] = trim($jornal);
        $mailData['editorName'] = $editorName;
        $mailData['subid'] = $subid;
        $mailData['subTitle'] = $subtitle;
        $mailData['date'] = date("l jS \of F Y h:i:s A", strtotime($subdate));
        $mailData['message'] = $message;
        if ($file) {
            $link = base_url() . '/author/downloads/' . $file;
            $mailData['link'] = $link;
        }
        $subject = 'An update on Submission for [Article ID: ' . $subid . ' Article ' . $subtitle . ']';
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body = view('mails/revisionFromAuthor', $mailData);
        $this->email->setMessage($body);
        $sent = $this->email->send();
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }
    }
}
