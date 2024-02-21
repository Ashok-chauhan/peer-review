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
}
