<?php

namespace App\Controllers\Editor;

use App\Controllers\BaseController;
use App\Models\EditorModel;
use App\Models\UserModel;

$pager = \Config\Services::pager();

/**
 * Description of Editor
 *
 * @author Ashok
 * Submissions:
 *1 = Sent to peer
 *2 = Accepted , under review
 *3 = Review completed
 *4 = Rejected
 *Editorial Decision:
 *1 = sent to copy-editor
 *2 = Accepted , under copy-editor

 */

class Editor extends BaseController
{

    public $editorModel;
    public $session;
    public $email;
    public $user;


    public function __construct()
    {
        helper(['url', 'form', 'role']);
        $this->editorModel = new EditorModel();


        $this->user = new UserModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();

        if (session()->get('role') == 2) {
        } elseif (isset($_GET['r'])) {
            session()->set('role', base64_decode($_GET['r']));
        } elseif (session()->get('role') != 2) {

            session_destroy();

            die('Access denied');
        }
        session()->remove('roles'); //multiple role


    }

    public function index()
    {
        $data = [];
        $revData = [];
        $status = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]; //'0,1,2';
        $complete_status = [12];//[6, 8, 9]; //'3,4';
        $submissions = $this->editorModel->allActive($status, session()->get("userID"));
        $completed = $this->editorModel->allActive($complete_status, session()->get("userID"));

        if ($submissions) {

            foreach ($submissions as $key => $submission) {
                $submission_content = $this->editorModel->getBySubmissionId('submission_content', $submission->submissionID);
                $underReviw = $this->editorModel->reviewStatus($submission->submissionID);
                $editorialDecision = $this->editorModel->getEditoriealStatus($submission->submissionID);
                $submissions[$key]->reviewStatus = $underReviw;
                $submissions[$key]->editorialDecision = $editorialDecision;

                $submissions[$key]->submission_content = $submission_content;

                $user = $this->editorModel->getUser($submission->authorID);
                if (isset($user->email)) {
                    $mail = $user->email;
                    $title = $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->last_name;
                }
                $submissions[$key]->author_email = $mail;
                $submissions[$key]->author = $title;
                $coauthor = $this->editorModel->coauthorBySubmission($submission->submissionID);
                $preReview = $this->editorModel->preReview($submission->submissionID);
                $submissions[$key]->preReview = '';
                if ($preReview) {
                    $submissions[$key]->preReview = $preReview;
                }
                if ($coauthor) {
                    $submissions[$key]->coauthor = $coauthor; //$coauthor[0]->name;
                }
                $note = $this->editorModel->getNoticeCount(session()->get("userID"), $submission->submissionID);
                if ($note) {
                    $submissions[$key]->notification = $note;
                }

                $peerState = $this->editorModel->getBySubmissionId('reviews', $submission->submissionID);

                $peerStatus = [];
                if (count($peerState) > 0) {
                    foreach ($peerState as $pstate) {
                        $peerStatus[] = $pstate->status;
                    }
                    $peerStatus = max($peerStatus);
                }
                $submissions[$key]->peerStatus = ($peerStatus) ? $peerStatus : '';
            }
        }
        if (is_array($completed)) {
            foreach ($completed as $key => $submission) {
                $submission_content = $this->editorModel->getBySubmissionId('submission_content', $submission->submissionID);
                $coauthor = $this->editorModel->coauthorBySubmission($submission->submissionID);
                $user = $this->editorModel->getUser($submission->authorID);
                $completed[$key]->author = $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->last_name;
                $completed[$key]->author_email = $user->email;
                $completed[$key]->submission_content = $submission_content;
                if ($coauthor) {
                    $completed[$key]->coauthor = $coauthor;
                }
                $note = $this->editorModel->getNoticeCount(session()->get("userID"), $submission->submissionID);
                if ($note) {
                    $completed[$key]->notification = $note;
                }
            }
        }

        if ($submissions) {
            $data['list'] = $submissions;
        } else {
            $data['list'] = [];
        }
        $data['completed'] = $completed;

        return view('editor/index', $data);
    }

    public function byAuthor()
    {

        $data = [];
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $peerData = $this->editorModel->getReviewsBySubId($submissionID);

        if ($peerData) {
            $data['peer'] = $this->user->getUser($peerData->reviewerID);
        } else {
            $data['peer'] = '';
        }
        $cpeditorData = $this->editorModel->getCopyeditingBySubId($submissionID);
        if ($cpeditorData) {
            $data['copyeditor'] = $this->user->getUser($cpeditorData->copyeditor_id);
        } else {
            $data['copyeditor'] = '';
        }
        $publisher = $this->editorModel->getProductionBySubId($submissionID);
        if ($publisher) {
            $data['publisher'] = $this->user->getUser($publisher->publisher_id);
        } else {
            $data['publisher'] = '';
        }

        $coauthor = $this->editorModel->coauthorBySubmission($submissionID);
        $revisionFile = $this->editorModel->getRevisionFile($submissionID);
        $submissionTitle = $this->editorModel->getBySubmissionId('submission', $submissionID);
        //$editorialDecision = $this->editorModel->getEditorialUploadsBySubId($submissionID);
        $editorialDecision = $this->editorModel->getEditorialDecision_bySubid($submissionID); //need to remove since multi peer activated.
        $editorial_decision = $this->editorModel->getCopyeditorNote(session()->get('userID'), $submissionID);
        $user = $this->editorModel->getAutor($submissionTitle[0]->authorID);

        $data['authorName'] = $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->middle_name . ' ' . $user->last_name;
        $data['authorEmail'] = $user->email;
        $data['userid'] = $user->userID;
        $data['role'] = $user->roleID;
        $data['title'] = $submissionTitle[0]->title;
        $data['contents'] = $this->editorModel->getBySubmissionId('submission_content', $submissionID);
        $data['discussions'] = $this->editorModel->getDiscussion($submissionID);
        $data['revisionFile'] = $revisionFile;
        // $data['peerDiscussions'] = $this->editorModel->getPeerDiscussion(session()->get('userID'), $submissionID);
        $data['peerDiscussions'] = $this->editorModel->peerDiscussion($submissionID);
        $data['cpEditorDiscussions'] = $this->editorModel->cpEditorDiscussions($submissionID);
        $data['publisherDiscussions'] = $this->editorModel->publisherDiscussions($submissionID);

        $data['editorialDecision'] = $editorialDecision;
        $data['submission_id'] = $submissionID;
        $data['editorial_decision'] = $editorial_decision;
        $data['submission'] = $submissionTitle[0];
        $data['submission']->contributor = $coauthor;
        $data['sentMessages'] = $this->editorModel->getSentDiscussion(session()->get('userID'), $submissionID);
        $data['editorialHistory'] = $this->editorialHistory($submissionID);
        $data['copyEditorUploads'] = $this->editorModel->getCopyFinalupload($submissionID);
        $data['productionUploads'] = $this->editorModel->getPublisherFinalupload($submissionID);
        //####$data['peer_final_uploads'] = $this->editorModel->getFinalupload($submissionID);
        $peerAssigned = $this->editorModel->peerAssigned($submissionID);
        $data['peerAssigned'] = $peerAssigned;
        $peerState = $this->editorModel->getBySubmissionId('reviews', $submissionID);
        $peerStatus = [];
        if ($peerState) {
            foreach ($peerState as $pstate) {
                $peerStatus[] = $pstate->status;
            }
            $peerStatus = max($peerStatus);
        }
        $data['peerStatus'] = ($peerStatus) ? $peerStatus : '';

        return view('editor/byauthor', $data);
    }

    public function production()
    {

        $data = [];
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $peerData = $this->editorModel->getFinalupload($submissionID, $this->request->getVar('peer_id'));

        if ($peerData) {
            $data['peer'] = $this->user->getUser($peerData->peer_id);
        } else {
            $data['peer'] = '';
        }


        $cpeditorData = $this->editorModel->getCopyFinalupload($submissionID);
        if ($cpeditorData) {
            $data['copyeditor'] = $this->user->getUser($cpeditorData->copyeditor_id);
        } else {
            $data['copyeditor'] = '';
        }
        $data['publisher_final_file'] = $this->editorModel->getPublisherFinalupload($submissionID);
        $coauthor = $this->editorModel->coauthorBySubmission($submissionID);
        $revisionFile = $this->editorModel->getRevisionFile($submissionID);
        $submissionTitle = $this->editorModel->getBySubmissionId('submission', $submissionID);
        //$editorialDecision = $this->editorModel->getEditorialUploadsBySubId($submissionID);
        $editorialDecision = $this->editorModel->getEditorialDecision_bySubid($submissionID);
        $editorial_decision = $this->editorModel->getCopyeditorNote(session()->get('userID'), $submissionID);
        $user = $this->editorModel->getAutor($submissionTitle[0]->authorID);

        $data['authorName'] = $user->title . ' ' . $user->username . ' ' . $user->middle_name . ' ' . $user->middle_name . ' ' . $user->last_name;
        $data['authorEmail'] = $user->email;
        $data['userid'] = $user->userID;
        $data['role'] = $user->roleID;
        $data['title'] = $submissionTitle[0]->title;
        $data['contents'] = $this->editorModel->getBySubmissionId('submission_content', $submissionID);
        $data['discussions'] = $this->editorModel->getDiscussion($submissionID);
        $data['revisionFile'] = $revisionFile;
        // $data['peerDiscussions'] = $this->editorModel->getPeerDiscussion(session()->get('userID'), $submissionID);
        $data['peerDiscussions'] = $this->editorModel->peerDiscussion($submissionID);
        $data['cpEditorDiscussions'] = $this->editorModel->cpEditorDiscussions($submissionID);
        // $data['editorialDecision'] = $editorialDecision;
        $data['submission_id'] = $submissionID;
        $data['editorial_decision'] = $editorial_decision;
        $data['submission'] = $submissionTitle[0];
        $data['submission']->contributor = $coauthor;
        // $data['sentMessages'] = $this->editorModel->getSentDiscussion(session()->get('userID'), $submissionID);
        //#####$data['editorialHistory'] = $this->editorialHistory($submissionID);
        $data['copyeditor_final_file'] = $cpeditorData;
        $data['peer_final_file'] = $peerData;
        // print '<pre>';
        // print_r($peerData);

        return view('editor/production', $data);
    }

    public function downloads()
    {
        $uri = $this->request->getUri();
        $name = WRITEPATH . 'uploads/' . urldecode($uri->getSegment(3));
        return $this->response->download($name, null);
    }

    public function notify()
    {


        $submissionTitle = $this->editorModel->getBySubmissionId('submission', $this->request->getVar('submissionID'));
        $author = $this->user->getUser($this->request->getVar('recipient_id'));
        $fullName = $author->title . ' ' . $author->username . ' ' . $author->middle_name . ' ' . $author->last_name;
        $sub_title = $submissionTitle[0]->title;
        $mailData['fullName'] = $fullName;
        $mailData['sub_title'] = $sub_title;
        $mailData['sub_id'] = $submissionTitle[0]->submissionID;


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
                        $note = $this->editorModel->discussion($notification);
                        $submission_content['submissionID'] = $this->request->getVar('submissionID');
                        $submission_content['content'] = $newName;
                        $submission_content['article_component'] = $this->request->getVar('article_type');

                        if ($revFileId) {
                            $revision_id = $this->editorModel->updateSubmissionContent($revFileId, $submission_content);
                        } else {
                            $revision_id = $this->editorModel->createSubmissionContent($submission_content);
                        }

                        if ($note) {
                            $mail = $this->notificationEmail($this->request->getVar('recipient'), $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $mailData, $newName);
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

            $note = $this->editorModel->discussion($notification);
            if ($note) {
                $mail = $this->notificationEmail($this->request->getVar('recipient'), $this->request->getVar('subject-title'), $this->request->getVar('message-text'), $mailData);
            }
            echo '<p>successfully replied</p>';
        }

        //#return view('editor/notify');
    }

    function getRevisionFile()
    {
        $uri = $this->request->getUri();
        $content_id = $uri->getSegment(3);
        $resp = $this->editorModel->getRevisionFile($content_id);
        // header('Content-Type: application/json; charset=utf-8');
        //header('Access-Control-Allow-Origin: *');
        //echo json_encode($resp);
        //print_r($resp);
        echo $resp->content . '#' . $resp->submission_date;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function toReview()
    {
        $subid = $this->request->getVar('submissionid');
        $submission = $this->editorModel->getSubmission($subid);
        $reviewer = $this->editorModel->getReviewer(4, session()->get('logged_user'), $submission->jid); //param roee, email toexclude

        //$title = $this->request->getVar('title');
        $editorContent = $this->editorModel->getEditorialUploadsBySubId($subid);
        $subContents = $this->editorModel->getBySubmissionId('submission_content', $subid);


        $peer = [];
        if (is_array($reviewer)) {
            foreach ($reviewer as $review) {
                $peer[$review->userID] = $review->title . ' ' . $review->username . ' ' . $review->middle_name . ' ' . $review->last_name;
            }
        }

        $data['peers'] = $reviewer;
        $data['peer'] = $peer;
        $data['title'] = $submission->title; //$title;
        $data['submissionid'] = $subid;
        $data['subContents'] = $subContents;
        $data['editorContent'] = $editorContent;

        $peerfile = fopen(FCPATH . 'message_formats/peer.txt', "r") or die("Unable to open file!");
        $peer_message = fread($peerfile, filesize(FCPATH . 'message_formats/peer.txt'));
        fclose($peerfile);
        $data['peer_message'] = $peer_message;
        // print '<pre>';
        // print_r($reviewer);
        // print_r($peer);
        //exit;
        return view('editor/toreview', $data);
    }

    public function sendtopeer()
    {
        if ($this->request->getMethod() == 'post') {

            if (!$this->editorModel->checkPeer($this->request->getVar('peer'), $this->request->getVar('submissionid'))) {
                $submision = $this->editorModel->getBySubmissionId('submission', $this->request->getVar('submissionid'));
                $journal = $this->editorModel->getJournal($submision[0]->jid);
                $data_reviews['submissionID'] = $this->request->getVar('submissionid');
                $data_reviews['reviewerID'] = $this->request->getVar('peer');
                $data_reviews['editor_id'] = session()->get('userID');
                $data_reviews['completion_date'] = $this->request->getVar('completion_date');
                $reviewId = $this->editorModel->insertReview($data_reviews);
                $review_content['submission_id'] = $this->request->getVar('submissionid');
                $review_content['peer_id'] = $this->request->getVar('peer');
                $review_content['review_id'] = $reviewId;
                foreach ($this->request->getVar('contentid') as $content) {
                    $review_content['submission_content_id'] = $content;
                    $revContentId = $this->editorModel->insertReviewContent($review_content);
                }
                $peer = $this->editorModel->getAutor($this->request->getVar('peer'));
                $peerFullName = $peer->title . ' ' . $peer->username . ' ' . $peer->middle_name . ' ' . $peer->last_name;
                $note['sender'] = session()->get('username');
                $note['sender_email'] = session()->get('logged_user');
                $note['sender_id'] = session()->get('userID');
                $note['submissionID'] = $this->request->getVar('submissionid');
                $note['recipient'] = $peer->email;
                $note['recipient_id'] = $this->request->getVar('peer');
                $note['title'] = $this->request->getVar('title');
                $note['message'] = $this->request->getVar('message');
                $insertNote = $this->editorModel->discussion($note);
                //#$affected_id = $this->editorModel->accepted($this->request->getVar('submissionid'), 1); // sent to peer.

                if ($insertNote) {
                    //send email

                    $subMissionTitle = $submision[0]->title;
                    $sbjTitle = $this->request->getVar('title');
                    $mailMsg = $this->request->getVar('message');
                    // $body = $mailMsg . $mailContent; //file link not needed in peer mail
                    $body = $mailMsg;
                    $completion_date = $this->request->getVar('completion_date');
                    $this->mailToPeer($peer->email, $peerFullName, $sbjTitle, $subMissionTitle, $completion_date, $body, $journal->journal_name); //, $journal = null
                    $this->session->setTempdata("success", "Notification sent successfully to the Reviewer.", 3);
                    return redirect()->to('editor/byauthor/' . $this->request->getVar('submissionid'));
                }
            } else {
                $this->session->setTempdata("error", "Alredy sent to this reviewer!", 3);
                return redirect()->to('editor/byauthor/' . $this->request->getVar('submissionid'));
            }
        }
    }

    public function send_to_copyeditor()
    {

        // bof inserting peer uploaded file into submission_content table
        $contentid = $this->request->getVar('content_id');
        $content_id = $this->request->getVar('contentid');
        if (is_array($contentid) && is_array($content_id)) {
            $mergedContentId = array_merge($content_id, $contentid);
        } else {
            $mergedContentId = $content_id;
        }
        if (isset($_SESSION['peerFiles']) && !empty($_SESSION['peerFiles'])) {
            $peerFiles = $_SESSION['peerFiles'];
            if (is_array($peerFiles)) {
                foreach ($peerFiles as $key => $peer_File) {
                    if (is_array($contentid)) {
                        foreach ($contentid as $cid) {
                            if ($cid == $peer_File->id) {
                                $peerUpload[] = $peer_File;
                            }
                        }
                    }
                }
            }
        }

        // if (is_array($peerFiles)) {
        //     foreach ($peerFiles as $key => $peer_File) {
        //         if (is_array($contentid)) {
        //             foreach ($contentid as $cid) {
        //                 if ($cid == $peer_File->id) {
        //                     $peerUpload[] = $peer_File;
        //                 }
        //             }
        //         }
        //     }
        // }
        $_SESSION['peerFiles'] = '';
        // eof submission_content table



        if ($this->request->getMethod() == 'post') {


            if (!$this->editorModel->checkPeer($this->request->getVar('peer'), $this->request->getVar('submissionid'))) {

                $submision = $this->editorModel->getBySubmissionId('submission', $this->request->getVar('submissionid'));
                $journal = $this->editorModel->getJournal($submision[0]->jid);
                $data_reviews['submissionID'] = $this->request->getVar('submissionid');
                $data_reviews['copyeditor_id'] = $this->request->getVar('peer');
                $data_reviews['editor_id'] = session()->get('userID');
                $data_reviews['completion_date'] = $this->request->getVar('completion_date');
                //insert into submission_content tabel
                if (isset($peerUpload) && is_array($peerUpload)) {
                    $insertid = [];
                    foreach ($peerUpload as $peerfile) {
                        $submission_content['submissionID'] = $this->request->getVar('submissionid');
                        $submission_content['content'] = $peerfile->file;
                        $submission_content['article_component'] = $peerfile->article_component;
                        $submission_content['submission_date'] = $peerfile->date_created;
                        $insertid[] = $this->editorModel->createSubmissionContent($submission_content);
                    }
                    if (is_array($this->request->getVar('contentid'))) {
                        $contentIDS = array_merge($this->request->getVar('contentid'), $insertid);
                    } else {
                        $contentIDS = $insertid;
                    }
                } else {
                    $contentIDS = $this->request->getVar('contentid');
                }
                // eof submission_content table
                $copyediting_id = $this->editorModel->insertCopyediting($data_reviews);
                $review_content['submission_id'] = $this->request->getVar('submissionid');
                $review_content['copyeditor_id'] = $this->request->getVar('peer');
                $review_content['copyediting_id'] = $copyediting_id;


                // foreach ($this->request->getVar('contentid') as $content) {
                //     $review_content['submission_content_id'] = $content;
                //     $revContentId = $this->editorModel->insertCopyeditingContent($review_content);
                // }
                if ($contentIDS) {
                    foreach ($contentIDS as $content) {
                        $review_content['submission_content_id'] = $content;
                        $revContentId = $this->editorModel->insertCopyeditingContent($review_content);
                    }
                }

                $cpEditor = $this->editorModel->getAutor($this->request->getVar('peer'));
                $peerFullName = $cpEditor->title . ' ' . $cpEditor->username . ' ' . $cpEditor->middle_name . ' ' . $cpEditor->last_name;
                $note['sender'] = session()->get('username');
                $note['sender_email'] = session()->get('logged_user');
                $note['sender_id'] = session()->get('userID');
                $note['submissionID'] = $this->request->getVar('submissionid');
                $note['recipient'] = $cpEditor->email;
                $note['recipient_id'] = $this->request->getVar('peer');
                $note['title'] = $this->request->getVar('title');
                $note['message'] = $this->request->getVar('message');


                $insertNote = $this->editorModel->discussion($note);
                $affected_id = $this->editorModel->accepted($this->request->getVar('submissionid'), 5); // sent to copyeditor.

                $this->editorModel->updateReviews($this->request->getVar('submissionid'), $this->request->getVar('reviewID'), 5);
                $this->editorModel->updateTableStatus("copyediting", $this->request->getVar('submissionid'), 5); // set status of copyediting table.
                if ($this->request->getVar('final_upload')) {
                    $this->editorModel->updateTableReviewUploads($this->request->getVar('final_upload'));
                }
                if ($insertNote) {
                    //send email

                    $mailContent = '';
                    // foreach ($this->request->getVar('contentid') as $contId) {
                    if ($contentIDS) {
                        foreach ($contentIDS as $contId) {

                            $content = $this->editorModel->getRevisionFile($contId);
                            $editorFile = $this->editorModel->getEditorialUploads($contId);
                            if ($content) {
                                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $content->content . '>' . $content->content . '</a></p>';
                            } elseif ($editorFile) {
                                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorFile->upload_content . '>' . $editorFile->upload_content . '</a></p>';
                            }
                        }
                    }
                    $subMissionTitle = $submision[0]->title;
                    $sbjTitle = $this->request->getVar('title');
                    $mailMsg = $this->request->getVar('message');
                    $body = $mailMsg . $mailContent;
                    $completion_date = $this->request->getVar('completion_date');
                    $this->mailToPeer($cpEditor->email, $peerFullName, $sbjTitle, $subMissionTitle, $completion_date, $body, $journal->journal_name); //, $journal = null
                    $this->session->setTempdata("success", "Notification sent successfully to the Copy editor.", 3);
                    return redirect()->to('editor/byauthor/' . $this->request->getVar('submissionid'));


                }

            } else {

                $this->session->setTempdata("error", "Alredy sent to this reviewer!", 3);
                return redirect()->to('editor/byauthor/' . $this->request->getVar('submissionid'));

            }
        }
    }

    public function send_to_production()
    {

        // bof inserting peer uploaded file into submission_content table
        $contentid = $this->request->getVar('content_id');
        $content_id = $this->request->getVar('contentid');
        if (is_array($contentid) && is_array($content_id)) {
            $mergedContentId = array_merge($content_id, $contentid);
        } else {
            $mergedContentId = $content_id;
        }
        if (isset($_SESSION['peerFiles']) && !empty($_SESSION['peerFiles'])) {
            $peerFiles = $_SESSION['peerFiles'];
            if (is_array($peerFiles)) {
                foreach ($peerFiles as $key => $peer_File) {
                    if (is_array($contentid)) {
                        foreach ($contentid as $cid) {
                            if ($cid == $peer_File->id) {
                                $peerUpload[] = $peer_File;
                            }
                        }
                    }
                }
            }
        }

        $_SESSION['peerFiles'] = '';
        // eof submission_content table



        if ($this->request->getMethod() == 'post') {


            if (!$this->editorModel->checkPublisher($this->request->getVar('peer'), $this->request->getVar('submissionid'))) {

                $submision = $this->editorModel->getBySubmissionId('submission', $this->request->getVar('submissionid'));
                $journal = $this->editorModel->getJournal($submision[0]->jid);
                $data_reviews['submissionID'] = $this->request->getVar('submissionid');
                $data_reviews['publisher_id'] = $this->request->getVar('peer');
                $data_reviews['editor_id'] = session()->get('userID');
                $data_reviews['completion_date'] = $this->request->getVar('completion_date');
                //insert into submission_content tabel
                if (isset($peerUpload) && is_array($peerUpload)) {
                    $insertid = [];
                    foreach ($peerUpload as $peerfile) {
                        $submission_content['submissionID'] = $this->request->getVar('submissionid');
                        $submission_content['content'] = $peerfile->file;
                        $submission_content['article_component'] = $peerfile->article_component;
                        $submission_content['submission_date'] = $peerfile->date_created;
                        $insertid[] = $this->editorModel->createSubmissionContent($submission_content);
                    }
                    if (is_array($this->request->getVar('contentid'))) {
                        $contentIDS = array_merge($this->request->getVar('contentid'), $insertid);
                    } else {
                        $contentIDS = $insertid;
                    }
                } else {
                    $contentIDS = $this->request->getVar('contentid');
                }
                // eof submission_content table
                $production_id = $this->editorModel->insertProduction($data_reviews);
                $review_content['submission_id'] = $this->request->getVar('submissionid');
                $review_content['publisher_id'] = $this->request->getVar('peer');
                $review_content['production_id'] = $production_id;

                if ($contentIDS) {
                    foreach ($contentIDS as $content) {
                        $review_content['submission_content_id'] = $content;
                        $revContentId = $this->editorModel->insertProductionContent($review_content);
                    }
                }

                $cpEditor = $this->editorModel->getAutor($this->request->getVar('peer'));
                $peerFullName = $cpEditor->title . ' ' . $cpEditor->username . ' ' . $cpEditor->middle_name . ' ' . $cpEditor->last_name;
                $note['sender'] = session()->get('username');
                $note['sender_email'] = session()->get('logged_user');
                $note['sender_id'] = session()->get('userID');
                $note['submissionID'] = $this->request->getVar('submissionid');
                $note['recipient'] = $cpEditor->email;
                $note['recipient_id'] = $this->request->getVar('peer');
                $note['title'] = $this->request->getVar('title');
                $note['message'] = $this->request->getVar('message');


                $insertNote = $this->editorModel->discussion($note);
                $affected_id = $this->editorModel->accepted($this->request->getVar('submissionid'), 9); // sent to production.
                $this->editorModel->updateTableStatus("production", $this->request->getVar('submissionid'), 9); // set status of production table.
                if ($this->request->getVar('final_upload')) {
                    $this->editorModel->updateTableCopyeditingUploads($this->request->getVar('final_upload'));
                }
                if ($insertNote) {
                    //send email

                    $mailContent = '';
                    // foreach ($this->request->getVar('contentid') as $contId) {
                    if ($contentIDS) {
                        foreach ($contentIDS as $contId) {

                            $content = $this->editorModel->getRevisionFile($contId);
                            $editorFile = $this->editorModel->getEditorialUploads($contId);
                            if ($content) {
                                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $content->content . '>' . $content->content . '</a></p>';
                            } elseif ($editorFile) {
                                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $editorFile->upload_content . '>' . $editorFile->upload_content . '</a></p>';
                            }
                        }
                    }
                    $subMissionTitle = $submision[0]->title;
                    $sbjTitle = $this->request->getVar('title');
                    $mailMsg = $this->request->getVar('message');
                    $body = $mailMsg . $mailContent;
                    $completion_date = $this->request->getVar('completion_date');
                    $this->mailToPeer($cpEditor->email, $peerFullName, $sbjTitle, $subMissionTitle, $completion_date, $body, $journal->journal_name); //, $journal = null
                    $this->session->setTempdata("success", "Notification sent successfully to the Production.", 3);
                    return redirect()->to('editor/byauthor/' . $this->request->getVar('submissionid'));


                }

            } else {

                $this->session->setTempdata("error", "Alredy sent to this production!", 3);
                return redirect()->to('editor/byauthor/' . $this->request->getVar('submissionid'));

            }
        }
    }


    public function tocopyedit()
    {

        $copy_editor = $this->editorModel->getCopyeditor(session()->get('logged_user')); //param roee, email toexclude
        $subid = $this->request->getVar('submissionid');
        $title = $this->request->getVar('title');
        $editorContent = $this->editorModel->getEditorialUploadsBySubId($subid);
        $subContents = $this->editorModel->getBySubmissionId('submission_content', $subid);

        $copyeditor = [];
        if (is_array($copy_editor)) {
            foreach ($copy_editor as $review) {
                $copyeditor[$review->userID] = $review->title . ' ' . $review->username . ' ' . $review->middle_name . ' ' . $review->last_name;
            }
        }

        $data['peers'] = $copy_editor;
        $data['peer'] = $copyeditor;
        $data['title'] = $title;
        $data['submissionid'] = $subid;
        $data['subContents'] = $subContents;
        $data['editorContent'] = $editorContent;
        $data['peerFiles'] = $this->editorModel->peerDiscussion($subid);
        $data['final_upload'] = $this->editorModel->getFinalupload($subid, $this->request->getVar('peer_id'));

        return view('editor/tocopyedit', $data);

    }

    public function toproduction()
    {

        $copy_editor = $this->editorModel->getPublisher(session()->get('logged_user')); //param roee, email toexclude
        $subid = $this->request->getVar('submissionid');
        $title = $this->request->getVar('title');
        $editorContent = $this->editorModel->getEditorialUploadsBySubId($subid);
        $subContents = $this->editorModel->getBySubmissionId('submission_content', $subid);

        $copyeditor = [];
        if (is_array($copy_editor)) {
            foreach ($copy_editor as $review) {
                $copyeditor[$review->userID] = $review->title . ' ' . $review->username . ' ' . $review->middle_name . ' ' . $review->last_name;
            }
        }

        $data['peers'] = $copy_editor;
        $data['peer'] = $copyeditor;
        $data['title'] = $title;
        $data['submissionid'] = $subid;
        $data['subContents'] = $subContents;
        $data['editorContent'] = $editorContent;
        // $data['peerFiles'] = $this->editorModel->cpEditorDiscussions($subid);
        $data['final_upload'] = $this->editorModel->getCopyFinalupload($subid);

        return view('editor/toproduction', $data);


    }
    public function editorUpload()
    {

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

    public function deleteEditorUpload()
    {
        $uri = $this->request->getUri();
        $subId = $uri->getSegment(3);
        $id = $uri->getSegment(4);
        $this->editorModel->deleteEditorUpload($id);
        return redirect()->to('editor/byauthor/' . $subId);
    }

    public function peerDiscussion()
    {

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

                //$this->email->setTo($editor->email);
                $this->email->setTo($editorData->email); // may be true
                $this->email->setFrom(session()->get('logged_user'), 'Info');
                $this->email->setSubject($this->request->getVar('title'));
                $this->email->setMessage($body);
                $this->email->send();
                $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                /*
                if ($this->email->send()) {
                    $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                } else {
                    $this->session->setTempdata("error", "Something happen wrong!", 3);
                }
                */
            }
        }
    }

    public function copyeditorDiscussion()
    {

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
                $this->email->send();
                $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                /*
                if ($this->email->send()) {
                    $this->session->setTempdata("success", "Notification sent successfully to the Editor.", 3);
                } else {
                    $this->session->setTempdata("error", "Something happen wrong!", 3);
                }
                */
            }
        }
    }

    public function tocpeditor()
    {
        //may be not used
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
    public function sendCopyEditor()
    {
        //if ($this->request->getMethod() == 'post' && ($_FILES['cpFile']['size'] > 0)) {
        if ($this->request->getMethod() == 'post') {
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
                            $this->email->send();
                            $this->session->setTempdata("success", "Notification sent successfully to the Copy Editor.", 3);
                            return redirect()->to('editor/byauthor/' . $this->request->getVar('submission_id'));
                            /*
                            if ($this->email->send()) {
                                $this->session->setTempdata("success", "Notification sent successfully to the Copy Editor.", 3);
                                return redirect()->to('editor/byauthor/' . $this->request->getVar('submission_id'));
                            } else {
                                $this->session->setTempdata("error", "Something happen wrong!", 3);
                            }
                            */
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

    public function downloadZip()
    {
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $submission_content = $this->editorModel->getBySubmissionId('submission_content', $submissionID);

        $length = count($submission_content) - 1;
        $component = '';
        foreach ($submission_content as $key => $value) {

            if ($key == 0) {
                $component .= $submissionID . '-' . $value->article_component;
            } else if ($key != $length) {
                $component .= ', ' . $submissionID . '-' . $value->article_component;
            } else {
                $component .= ', ' . $submissionID . '-' . $value->article_component;
            }

        }


        if (!$submission_content)
            return false;
        $zip = new \ZipArchive();
        $zipFilename = '/tmp/articles.zip'; ///tmp/article.zip';
        $zipName = $component . '.zip';

        if ($zip->open($zipFilename, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            // Add files to the zip (replace with your actual file paths)

            if ($submission_content) {
                foreach ($submission_content as $content) {
                    $zip->addFile(WRITEPATH . 'uploads/' . $content->content, $submissionID . '-' . $content->content);

                }
            }

            // Close the zip file
            $zip->close();
            // Force download the zip file
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipName . '"');
            header('Content-Length: ' . filesize($zipFilename));
            header('Pragma: no-cache');
            header('Expires: 0');
            readfile($zipFilename);

            // Delete the zip file after download (optional)
            unlink($zipFilename);
            exit;
        } else {
            echo 'Failed to create zip file';
        }
    }

    public function downloadpeerZip()
    {
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $submission_content = $this->editorModel->peerDiscussion($submissionID);
        if (!$submission_content)
            return false;
        $zip = new \ZipArchive();
        $zipFilename = '/tmp/article.zip';
        if ($zip->open($zipFilename, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            // Add files to the zip (replace with your actual file paths)
            if ($submission_content) {
                foreach ($submission_content as $content) {
                    $zip->addFile(WRITEPATH . 'uploads/' . $content->file, $content->file);
                }
            }
            // Close the zip file
            $zip->close();
            // Force download the zip file
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
            header('Content-Length: ' . filesize($zipFilename));
            header('Pragma: no-cache');
            header('Expires: 0');
            readfile($zipFilename);
            // Delete the zip file after download (optional)
            unlink($zipFilename);
            exit;
        } else {
            echo 'Failed to create zip file';
        }
    }


    public function downloadcopyEditorZip()
    {
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $copyeditorFile = $this->editorModel->getCopyFinalupload($submissionID);

        if (!$copyeditorFile)
            return false;
        $zip = new \ZipArchive();
        $zipFilename = '/tmp/article.zip';
        if ($zip->open($zipFilename, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            // Add files to the zip (replace with your actual file paths)
            if ($copyeditorFile) {
                $zip->addFile(WRITEPATH . 'uploads/' . $copyeditorFile->title_page, $copyeditorFile->title_page);
                $zip->addFile(WRITEPATH . 'uploads/' . $copyeditorFile->article_file, $copyeditorFile->article_file);
                $zip->addFile(WRITEPATH . 'uploads/' . $copyeditorFile->article_text, $copyeditorFile->article_text);

            }
            // Close the zip file
            $zip->close();
            // Force download the zip file
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
            header('Content-Length: ' . filesize($zipFilename));
            header('Pragma: no-cache');
            header('Expires: 0');
            readfile($zipFilename);
            // Delete the zip file after download (optional)
            unlink($zipFilename);
            exit;
        } else {
            echo 'Failed to create zip file';
        }
    }

    public function downloadproductionZip()
    {
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $porductionfile = $this->editorModel->getPublisherFinalupload($submissionID);

        if (!$porductionfile)
            return false;
        $zip = new \ZipArchive();
        $zipFilename = '/tmp/article.zip';
        if ($zip->open($zipFilename, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            // Add files to the zip (replace with your actual file paths)
            if ($porductionfile) {
                $zip->addFile(WRITEPATH . 'uploads/' . $porductionfile->title_page, $porductionfile->title_page);
                $zip->addFile(WRITEPATH . 'uploads/' . $porductionfile->article_file, $porductionfile->article_file);
                $zip->addFile(WRITEPATH . 'uploads/' . $porductionfile->article_text, $porductionfile->article_text);

            }
            // Close the zip file
            $zip->close();
            // Force download the zip file
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
            header('Content-Length: ' . filesize($zipFilename));
            header('Pragma: no-cache');
            header('Expires: 0');
            readfile($zipFilename);
            // Delete the zip file after download (optional)
            unlink($zipFilename);
            exit;
        } else {
            echo 'Failed to create zip file';
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

        $subject = 'You have received a new comment from Editor for ' . $mail['sub_title'];
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        //$body = view('mails/toauthor', $mailData);
        $body = view('mails/letter_editor_reply_reviewer_comment', $mailData);
        $this->email->setMessage($body);

        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }
    }

    public function mailToPeer($to, $name, $title, $submissionTitle, $completion_date, $body, $journal = null)
    {
        $mailData = [];
        $scheme = $_SERVER['REQUEST_SCHEME'] . '://';
        $mailData['title'] = $title;
        $mailData['name'] = $name;
        $mailData['host'] = $scheme . $_SERVER['SERVER_NAME'];
        $mailData['submissionTitle'] = $submissionTitle;
        if ($journal) {
            $mailData['journal'] = $journal;
        } else {
            $mailData['journal'] = 'Arthopedics';
        }
        $mailData['date'] = date("l jS \of F Y h:i:s A", strtotime($completion_date));
        $mailData['body'] = $body;


        $subject = 'You have a new article  ' . $submissionTitle . ' to review';
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        //$body = view('mails/toPeer', $mailData);
        $body = view('mails/letter_reviewer_assign', $mailData);
        $this->email->setMessage($body);
        //$sent = $this->email->send();
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }
    }
    public function bellnotification()
    {
        $data = [];

        $notifications = $this->editorModel->getBellNotification(session()->get('userID'));
        if ($notifications) {
            foreach ($notifications as $key => $notification) {
                $user = $this->editorModel->getUser($notification->sender_id);
                if (array_key_exists($user->roleID, roles())) {
                    $notifications[$key]->role = roles()[$user->roleID];
                }
            }
        }
        $updated = $this->editorModel->updateBellNotifications(session()->get('userID'));
        $data['notifications'] = $notifications;
        return view('editor/bellnotification', $data);
    }
    public function update_bellnotification()
    {
        if ($this->request->getMethod() == 'post') {

            $updated = $this->editorModel->updateBellNotifications(session()->get('userID'));
            if ($updated) {
                return '1';
            } else {
                return '0';
            }
        }
    }
    public function accepted()
    {
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);

        $submission = $this->editorModel->getBySubmissionId('submission', $submissionID);
        $subtitle = $submission[0]->title;
        $journal = $this->editorModel->getJournal($submission[0]->jid);
        $reveData = $this->editorModel->getReviewsBySubId($submission[0]->submissionID);
        $reviewer = $this->editorModel->getUser($reveData->reviewerID);
        $author = $this->editorModel->getUser($submission[0]->authorID);
        $peerFullname = $reviewer->title . ' ' . $reviewer->username . ' ' . $reviewer->middle_name . ' ' . $reviewer->last_name;
        $authorFullname = $author->title . ' ' . $author->username . ' ' . $author->middle_name . ' ' . $author->last_name;
        $status_id = $uri->getSegment(4);
        $reviewtable_id = $uri->getSegment(5);


        //update reviews table status.
        $status = $this->editorModel->updateReviews($submissionID, $reviewtable_id, $status_id);

        if ($status) {
            $this->thnakyouMailtoPeer($reviewer->email, $subtitle, $peerFullname, $journal->journal_name);
            //send email to Author
            $this->thnakyouMailtoAuthor($author->email, $subtitle, $authorFullname, $journal->journal_name);
        }
        if ($status) {
            // return redirect()->to('editor/byauthor/' . $submissionID);
            return redirect()->to('editor/getAssignedPeer/' . $reviewtable_id);
        }
    }
    public function accepted_copyediting()
    {
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $status_id = $uri->getSegment(4);
        //update submission table status_id
        $status = $this->editorModel->accepted($submissionID, $status_id);
        //update copyediting table status.
        $this->editorModel->updateTableStatus('copyediting', $submissionID, $status_id);

        $submission = $this->editorModel->getBySubmissionId('submission', $submissionID);
        $subtitle = $submission[0]->title;
        $journal = $this->editorModel->getJournal($submission[0]->jid);
        $reveData = $this->editorModel->getCopyeditingBySubId($submission[0]->submissionID);
        $reviewer = $this->editorModel->getUser($reveData->copyeditor_id);
        $author = $this->editorModel->getUser($submission[0]->authorID);
        $peerFullname = $reviewer->title . ' ' . $reviewer->username . ' ' . $reviewer->middle_name . ' ' . $reviewer->last_name;

        //insert editorial_decision table appropriate data.
        $data = [
            'submissionID' => $submissionID,
            'editorID' => session()->get('userID'),
            'recipient' => session()->get('userID'),
            'sender' => session()->get('userID'),
            'sender_email' => session()->get('logged_user'),
            'recipient_email' => session()->get('logged_user'),
            'decision' => 'Accepted copy-editing of submission by Editor',
            'comments' => 'Accepted copy-editing of submission by Editor',
            'new_revision_round' => 1,
            'send_email' => 0,
            'status' => $submission[0]->status_id,

        ];
        $Edecision = $this->editorModel->editorialDecision($data);
        // eof editorial_decision

        if ($Edecision) {

            $this->thnakyouMailtoCopyeditor($reviewer->email, $subtitle, $peerFullname, $journal->journal_name);
            //send email to Author
            $this->thnakyouMailtoAuthor($author->email, $subtitle, $peerFullname, $journal->journal_name);
        }
        if ($Edecision) {

            return redirect()->to('editor/byauthor/' . $submissionID);
        }
    }

    public function accepted_production()
    {
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $status_id = $uri->getSegment(4);
        //update submission table status_id
        $status = $this->editorModel->accepted($submissionID, $status_id);
        //update copyediting table status.
        $this->editorModel->updateTableStatus('production', $submissionID, $status_id);

        $submission = $this->editorModel->getBySubmissionId('submission', $submissionID);
        $subtitle = $submission[0]->title;
        $journal = $this->editorModel->getJournal($submission[0]->jid);
        $reveData = $this->editorModel->getProductionBySubId($submission[0]->submissionID);
        $reviewer = $this->editorModel->getUser($reveData->publisher_id);
        $author = $this->editorModel->getUser($submission[0]->authorID);
        $peerFullname = $reviewer->title . ' ' . $reviewer->username . ' ' . $reviewer->middle_name . ' ' . $reviewer->last_name;

        //insert editorial_decision table appropriate data.
        $data = [
            'submissionID' => $submissionID,
            'editorID' => session()->get('userID'),
            'recipient' => session()->get('userID'),
            'sender' => session()->get('userID'),
            'sender_email' => session()->get('logged_user'),
            'recipient_email' => session()->get('logged_user'),
            'decision' => 'Accepted production copy of submission by publisher',
            'comments' => 'Accepted production copy  of submission by publisher',
            'new_revision_round' => 1,
            'send_email' => 0,
            'status' => $submission[0]->status_id,

        ];
        $Edecision = $this->editorModel->editorialDecision($data);
        // eof editorial_decision

        if ($Edecision) {

            $this->thnakyouMailtoCopyeditor($reviewer->email, $subtitle, $peerFullname, $journal->journal_name);
            //send email to Author
            $this->thnakyouMailtoAuthor($author->email, $subtitle, $peerFullname, $journal->journal_name);
        }
        if ($Edecision) {

            return redirect()->to('editor/byauthor/' . $submissionID);
        }
    }


    public function thnakyouMailtoPeer($to, $subtitle, $name, $journalName)
    {
        $mailData['subtitle'] = $subtitle;
        $mailData['journal'] = $journalName;
        $mailData['name'] = $name;

        $subject = 'Thank you for completing the review of ' . $subtitle;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);

        $body = view('mails/letter_thank_you_reviewer_complete_review', $mailData);
        $this->email->setMessage($body);
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }

    }

    public function thnakyouMailtoCopyeditor($to, $subtitle, $name, $journalName)
    {
        $mailData['subtitle'] = $subtitle;
        $mailData['journal'] = $journalName;
        $mailData['name'] = $name;

        $subject = 'Thank you for completing the review of ' . $subtitle;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);

        $body = view('mails/letter_thank_you_copyeditor_complete', $mailData);
        $this->email->setMessage($body);
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }

    }

    public function thnakyouMailtoAuthor($to, $subtitle, $name, $journalName)
    {
        $mailData['subtitle'] = $subtitle;
        $mailData['journal'] = $journalName;
        $mailData['name'] = $name;

        $subject = 'Submission has been accepted ' . $subtitle;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);

        $body = view('mails/letter_thank_you_author_accepted', $mailData);
        $this->email->setMessage($body);
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }

    }

    public function requestrevision()
    {
        $uri = $this->request->getUri();
        $subid = $uri->getSegment(3);
        $submission = $this->editorModel->getSubmission($subid);
        $journal = $this->editorModel->getJournal($submission->jid);

        if ($this->request->getMethod() == 'post') {

            if ($this->request->getVar('new_revision_round')) {
                $decision = 'Revisions will be subject to a new round of peer reviews';
            } else {
                $decision = 'Revisions will not be subject to a new round of peer reviews';
            }
            $author = $this->editorModel->getUser($this->request->getVar('authorid'));
            $message = $this->request->getVar('message');
            $data = [
                'submissionID' => $subid,
                'editorID' => session()->get('userID'),
                'recipient' => $author->userID,
                'sender' => session()->get('userID'),
                'sender_email' => session()->get('logged_user'),
                'recipient_email' => $author->email,
                'decision' => $decision,
                'comments' => $message,
                'new_revision_round' => $this->request->getVar('new_revision_round'),
                'send_email' => $this->request->getVar('send_email'),

            ];
            $Edecision = $this->editorModel->editorialDecision($data);
            $name = $author->title . ' ' . $author->username . ' ' . $author->middle_name . ' ' . $author->last_name;
            if ($this->request->getVar('send_email'))
                $this->requestRevisionMail($author->email, $submission->title, $name, $journal->journal_name, $message);
            $this->session->setTempdata("success", "Revision requested!", 3);
            return redirect()->to('editor/byauthor/' . $subid);
        } else {
            $data = [];
            $data['submission'] = $submission;
            $data['mails'] = $this->editorModel->requestRevision($subid);
            return view('editor/requestrevision', $data);
        }


    }

    public function requestRevisionMail($to, $subtitle, $name, $journalName, $message)
    {
        $mailData['subtitle'] = $subtitle;
        $mailData['journal'] = $journalName;
        $mailData['name'] = $name;
        $mailData['message'] = $message;

        $subject = $subtitle;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);

        $body = view('mails/request_revision', $mailData);
        $this->email->setMessage($body);
        if ($this->email->send()) {

            return true;
        } else {
            return false;
        }

    }

    public function editorialHistory_all()
    {
        $uri = $this->request->getUri();
        $submissionID = $uri->getSegment(3);
        $model = new \App\Models\NotificationsModel();

        $data = [
            'notifications' => $model->where('submissionID', $submissionID)->paginate(20),
            'pager' => $model->pager,
        ];

        return view('editorial_history/index', $data);
    }
    public function editorialHistory($subid)
    {
        $model = new \App\Models\NotificationsModel();

        $data = [
            'notifications' => $model->where('submissionID', $subid)->paginate(9),
            'pager' => $model->pager,
        ];
        return $data;
        // return view('editorial_history/index', $data);
    }


    public function final_email()
    {
        if ($this->request->getMethod() == 'post') {

            $sid = $this->request->getVar('submissionid');
            $productin_files = $this->editorModel->getPublisherFinalupload($sid);
            $authorid = $this->editorModel->getSubmission($sid);
            $journal = $this->editorModel->getJournal($authorid->jid);
            $journal_name = $journal->journal_name;
            $title = $authorid->title;
            $id = $authorid->submissionID;
            $user = $this->editorModel->getUser($authorid->authorID);

            $coAuthors = $this->editorModel->coauthorBySubmission($sid);
            //production files
            $mailContent = '';
            if ($productin_files->title_page) {
                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $productin_files->title_page . ' target="_blank">' . $productin_files->title_page . '</a></p>';
            }
            if ($productin_files->article_text) {
                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $productin_files->article_text . ' target="_blank">' . $productin_files->article_text . '</a></p>';
            }
            if ($productin_files->article_file) {
                $mailContent .= '<p><a href=' . base_url() . 'editor/downloads/' . $productin_files->article_file . ' target="_blank">' . $productin_files->article_file . '</a></p>';
            }
            $body = $mailContent;


            //mail to primary contact
            $coauthor = '';
            foreach ($coAuthors as $cauthor) {
                $coauthor .= $cauthor->title . ' ' . $cauthor->name . ' ' . $cauthor->m_name . ' ' . $cauthor->l_name . ', ';
            }

            if ($coAuthors) {
                foreach ($coAuthors as $author) {
                    if ($author->primary_contact) {
                        $fullName = $author->title . ' ' . $author->name . ' ' . $author->m_name . ' ' . $author->l_name;
                        $to = $author->email;
                        $this->sendEmail($to, $title, $fullName, $coauthor, $id, $body, $journal_name);
                        //send email to coauthor 'email'
                        break;
                    }
                }
            }

            //send email to author
            $authorFullname = $user->title . ' ' . $user->middle_name . ' ' . $user->last_name;
            $mailsend = $this->sendEmail($user->email, $title, $authorFullname, $coauthor, $id, $body, $journal_name);
            if ($mailsend) {

                $this->editorModel->updateProductionMailSend($id);

            }
            if (!$mailsend) {
                $err = ['error' => 'Something went wrong.'];

                return json_encode($err);
            } else {
                $success = ['success' => 'email sent successfully.'];

                return json_encode($success);
            }
        }

    }

    public function sendEmail($to, $title, $fullName, $coauthor, $id, $body, $journal = 'Orthopedic')
    {
        $mailData = [];
        $mailData['title'] = $title;
        $mailData['fullName'] = $fullName;
        $mailData['coauthors'] = $coauthor;
        $mailData['journal'] = $journal;
        $mailData['id'] = $id;
        $mailData['body'] = $body;

        $subject = 'Productin files of Manuscript Submission of ' . $journal . ' ' . $title;
        $this->email->setMailType('html');
        $this->email->setTo($to);
        // $this->email->setCC($coEmails); blocked 12/6/2024 since send mail to all co-authors by full name
        $this->email->setBCC('creativeplus92@gmail.com');
        $this->email->setSubject($subject);
        $body = view('mails/production_copy_to_author', $mailData);
        $this->email->setMessage($body);
        // $this->email->send();

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }

    }

    public function reset_all()
    {

        if ($this->request->getMethod() == 'post') {
            $sid = $this->request->getVar('submission_id');
            $id = $this->editorModel->reset_all($sid);
            if ($id) {
                return redirect()->to('/editor');
            }
        }
    }
    public function reject_peer()
    {
        $uri = $this->request->getUri();
        $sid = $uri->getSegment(3);
        $reviewsTableId = $uri->getSegment(4);
        $reviwerid = $uri->getSegment(5);
        $id = $this->editorModel->reject_peer($sid, $reviewsTableId, $reviwerid);
        if ($id) {
            return redirect()->to('/editor/byauthor/' . $sid);
        }

    }

    public function editor_upload()
    {
        $uri = $this->request->getUri();
        $sid = $uri->getSegment(3);
        if ($this->request->getMethod() == 'post' && ($_FILES)) {

            foreach ($_FILES as $key => $value) {

                $file = $this->request->getFile($key);
                if (!$file->hasMoved()) {
                    $newName = $this->request->getVar($key) . '_' . time() . '_' . $file->getClientName();

                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {

                        $this->editorModel->updateSubmissionContent($key, ['content' => $newName]);
                        // Setting a flash message in a controller
                        $session = session();
                        $session->setFlashdata('success', 'Files uploaded successfully!');
                        return redirect()->to('editor/byauthor/' . $sid);

                    } else {
                        echo $file->getErrorString() . " " . $file->getError();
                    }
                }

            }

        } else {
            $uri = $this->request->getUri();
            $sid = $uri->getSegment(3);
            $submission_content = $this->editorModel->getBySubmissionId('submission_content', $sid);
            $data['contents'] = $submission_content;
            return view('editor/editor_upload', $data);
        }

    }

    function getAssignedPeer()
    {
        $data = [];
        $uri = $this->request->getUri();
        $subid = $uri->getSegment(2);
        $peerid = $uri->getSegment(3);
        $peerDetails = $this->editorModel->getAssignedPeer($peerid);
        $data['peerDetails'] = $peerDetails;
        $data['submission'] = $this->editorModel->getSubmission($peerDetails->submissionID);
        $data['peerUpload'] = $this->editorModel->peerFinalupload($peerDetails->submissionID, $peerDetails->reviewID);
        $data['peerDiscussions'] = $this->editorModel->peerDiscussion($peerDetails->submissionID);
        $content_data = $this->editorModel->getContentIds($peerDetails->submissionID, $peerDetails->reviewerID);
        $data['peer'] = $this->editorModel->getUser($peerDetails->reviewerID);
        $editorialDecision = $this->editorModel->getEditorialDecisionBySubidPeerid($subid, $peerDetails->reviewerID);
        $data['editorialDecision'] = $editorialDecision;
        // $data['contents'] = $this->editorModel->getSubmissionContentById('submission_content', $submissionID);
        $data['contents'] = $content_data;

        // print '<pre>';
        // print_r($data);

        return view('editor/peer', $data);

    }

}
