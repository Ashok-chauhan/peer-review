<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of PeerModel
 *
 * @author Ashok
 */
class PeerModel extends Model
{

    public function getReviewRequest($reviewerID)
    {

        $builder = $this->db->table('submission');
        $builder->select('*');
        $builder->join('reviews', 'reviews.submissionID = submission.submissionID');
        $builder->where('reviewerID', $reviewerID);
        $builder->where('status <=', 3);
        $query = $builder->get()->getResult();

        foreach ($query as $key => $qry) {
            $q = $this->db->table('review_content');
            $q->select('*');
            $q->join('submission_content', 'review_content.submission_content_id= submission_content.id');
            $q->where('peer_id', $qry->reviewerID);
            $revContents = $q->get()->getResult();
            foreach ($revContents as $revContent) {
                if ($query[$key]->submissionID == $revContent->submissionID) {
                    $query[$key]->reviewContents[] = $revContent;
                }
            }
        }

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }


    public function getReviewCompleted($reviewerID)
    {

        $builder = $this->db->table('submission');
        $builder->select('*');
        $builder->join('reviews', 'reviews.submissionID = submission.submissionID AND submission.status_id IN (4,5,6,7,8,9,10)');
        $builder->where('reviewerID', $reviewerID);

        $query = $builder->get()->getResult();
        foreach ($query as $key => $qry) {
            $q = $this->db->table('review_content');
            $q->select('*');
            $q->join('submission_content', 'review_content.submission_content_id= submission_content.id');
            $q->where('peer_id', $qry->reviewerID);
            $revContents = $q->get()->getResult();
            foreach ($revContents as $revContent) {
                if ($query[$key]->submissionID == $revContent->submissionID) {
                    $query[$key]->reviewContents[] = $revContent;
                }
            }
        }

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function getReviewDetailBySubid($id, $revId)
    {

        $builder = $this->db->table('submission');
        $builder->select('*');
        $builder->join('reviews', 'reviews.submissionID = submission.submissionID');
        $builder->where('submission.submissionID', $id);
        $builder->where('reviews.reviewID', $revId);

        $query = $builder->get()->getRow();

        if (isset($query->reviewerID)) {
            $q = $this->db->table('review_content');
            $q->select('*');
            $q->join('submission_content', 'review_content.submission_content_id= submission_content.id');
            //$q->where('peer_id', $query->reviewerID);
            $q->where('review_id', $revId);


            $revContents = $q->get()->getResult();
            foreach ($revContents as $revContent) {
                if ($query->submissionID == $revContent->submissionID) {
                    $query->reviewContents[] = $revContent;
                }
            }
        }

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function uploadPeerResponseToEditor($data)
    {
        $builder = $this->db->table('editor_peer_notifications');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function getEditorPeerContent($id)
    {
        $q = $this->db->table('editor_peer_notifications');
        $q->where('id', $id);
        $data = $q->get()->getResult();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getEditoriealUploads($sid)
    {
        $q = $this->db->table('editor_uploads');
        $q->where('submissionID', $sid);
        $data = $q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getReviewRow($sid)
    {
        $q = $this->db->table('reviews');
        $q->where('submissionID', $sid);
        $data = $q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function noteCount($uid, $subid)
    {
        $q = $this->db->table('editor_peer_notifications');
        $q->where('recipient_id', $uid);
        $q->where('submissionID', $subid);
        $count = $q->countAllResults();
        if ($count) {
            return $count;
        } else {
            return false;
        }
    }

    public function updateReview($revId, $status)
    {
        $query = $this->db->query("Update reviews SET status=" . $status . " WHERE reviewID=" . $revId . "");

        if ($this->db->affectedRows()) {
            return true;
        } else {
            return false;
        }
    }

    public function discussion($data)
    {
        $Q = $this->db->table('notifications');
        if ($Q->insert($data)) {
            return true;
        } else {
            return false;
        }
    }


    public function getBySubmissionId($table, $submissionID)
    {
        $Q = $this->db->table($table)->select('*')->where('submissionID', $submissionID);
        $query = $Q->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
    }

    public function getUser($uid)
    {
        $Q = $this->db->table('users');
        $Q->where('userID', $uid);
        $user = $Q->get()->getRow();
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function getDiscussion($submissionID)
    {
        $Q = $this->db->table('notifications');
        //$data = [];
        $Q->where('submissionID', $submissionID);
        $Q->where('role', 4);
        $Q->orderBy('date_created', 'DESC');
        $query = $Q->get()->getResult();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function getJournal($id)
    {
        $Q = $this->db->table('journal');
        $Q->where('id', $id);
        $query = $Q->get()->getRow();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }


    public function checkStatus($reviewid)
    {
        $Q = $this->db->table('reviews');
        $Q->where('reviewID', $reviewid);
        $qry = $Q->get();
        $result = $qry->getRow();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    public function getReviewsByPeerNsubmission($peerid, $sid)
    {
        $Q = $this->db->table('reviews');
        $Q->where('reviewID', $peerid);
        $Q->where('submissionID', $sid);
        $qry = $Q->get();
        $result = $qry->getRow();
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }


    public function updateSubmissionStatus($subid, $status)
    {
        $query = $this->db->query("Update submission SET status_id=" . $status . " WHERE submissionID=" . $subid . "");

        if ($this->db->affectedRows()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateNotifications($id)
    {

        $builder = $this->db->table('notifications');
        $builder->where('recipient_id', $id);
        $builder->update(['status' => 1]);
        if ($this->db->affectedRows()) {
            return true;
        } else {
            return false;
        }
    }

    public function getBellNotification($recipeint_id)
    {
        $Q = $this->db->table('notifications');
        $Q->where('recipient_id', $recipeint_id);
        $Q->orderBy('date_created', 'DESC');
        $query = $Q->get()->getResult();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function peerTerms($recipeint_id, $subid)
    {
        $Q = $this->db->table('notifications');
        $Q->where('recipient_id', $recipeint_id);
        $Q->where('submissionID', $subid);
        $Q->orderBy('date_created', 'ASC');
        $query = $Q->get()->getRow();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function getSubmission($id)
    {
        $Q = $this->db->table('submission');
        $Q->where('submissionID', $id);
        $row = $Q->get()->getRow();
        if ($row) {
            return $row;
        } else {
            return false;
        }

    }
    public function peerUpload($data)
    {
        $Q = $this->db->table('review_uploads');
        $Q->where('submission_id', $data['submission_id']);
        $Q->where('peer_id', $data['peer_id']);

        $row = $Q->get()->getRow();
        if ($row) {
            //update
            $updateData = [
                'message' => $data['message'],
                'article_file' => $data['article_file'],
                'status' => $data['status']
            ];
            $builder = $this->db->table('review_uploads');
            $builder->where('submission_id', $data['submission_id']);
            $builder->where('peer_id', $data['peer_id']);
            $builder->update($updateData);
        } else {

            $builder = $this->db->table('review_uploads');
            $result = $builder->insert($data);
            if ($this->db->affectedRows()) {
                return $this->db->insertID();
            } else {
                return false;
            }
        }
    }




}
