<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of SubmissionModel
 *
 * @author Ashok
 */
class SubmissionModel extends Model
{
    public function createSubmission($data)
    {
        $builder = $this->db->table('submission');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function createSubmissionContent($data)
    {
        $Q = $this->db->table('submission_content');
        $result = $Q->insertBatch($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function updateSubmissionContent($id, $data)
    {
        $Q = $this->db->table('submission_content');
        //$result = $Q->insertBatch($data);
        $Q->where('id', $id);
        //$Q->update(['submission_id' => $subid]);
        $Q->update($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getByAuthorId($authorID)
    {
        /*
        $Q = $this->db->table('submission')->select('*')->where('authorID', $authorID);
        $Q->orderBy('submissionID', 'DESC');
        $query    = $Q->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
        */
        $builder = $this->db->table('submission');
        $builder->select('*');
        $builder->join('journal', 'journal.id = submission.submissionID', 'left');
        $builder->where('authorID', $authorID);
        $builder->orderBy('submissionID', 'DESC');
        $query = $builder->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
    }
    public function getCompleted($authorID)
    {
        $Q = $this->db->table('submission');
        $Q->orderBy('submissionID', 'DESC');
        $Q->where('authorID', $authorID);
        $Q->where('status_id', 3);
        $query    = $Q->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
    }

    public function getById($submissionID)
    {
        $Q = $this->db->table('submission');
        $Q->where('submissionID', $submissionID);
        $query    = $Q->get()->getRow();
        if ($query) {
            return $query; //->getResult();
        } else {
            return false;
        }
    }

    public function getJournal($id)
    {
        $Q = $this->db->table('journal');
        $Q->where('id', $id);
        $query    = $Q->get()->getRow();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function getBySubmissionId($submissionID)
    {
        $Q = $this->db->table('submission_content')->select('*')->where('submissionID', $submissionID);
        $query    = $Q->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
    }

    public function getNoticeCount($recipientid, $submissionID)
    {
        //$count =  $this->db->table('notifications')->where('recipient_id', $recipientid)->countAllResults();
        $Q = $this->db->table('notifications');
        $Q->where('recipient_id', $recipientid);
        $Q->where("submissionID", $submissionID);
        $count = $Q->countAllResults();
        if ($count) {
            return $count;
        } else {
            return false;
        }
    }

    public function getNotice($recipientid, $submissionID)
    {
        // $query = $this->db->query('select * from notifications where recipient_id=' . $recipientid . ' and submissionID=' . $submissionID . ' order by date_created desc');
        $query = $this->db->query('select * from notifications where submissionID=' . $submissionID . ' order by date_created desc');
        $result = $query->getResult();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function discussion($data)
    {
        $Q = $this->db->table('notifications');
        if ($Q->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function getSentDiscussion($sender_id, $submissionID)
    {
        $Q = $this->db->table('notifications');
        $Q->where('sender_id', $sender_id);
        $Q->where('submissionID', $submissionID);
        $Q->orderBy('date_created', 'DESC');
        $query = $Q->get()->getResult();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function createContributorUsers($data)
    {
        /*
        $builder = $this->db->table('users');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
        */
        $builder = $this->db->table('coauthor');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            // return $this->db->insertID();
            $data['id'] = $this->db->insertID();
            return json_encode($data);
        } else {
            return false;
        }
    }

    public function deleteById($id)
    {
        $Q = $this->db->table('submission');
        $Q->where('submissionID', $id);
        $Q->delete();
        return;
    }

    public function getCoauthor($author_id)
    {
        $Q = $this->db->table('coauthor')->select('*')->where('author_id', $author_id);
        $query    = $Q->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
    }
    public function coauthorBySubmission($author_id, $subid)
    {
        $Q = $this->db->table('coauthor');
        $Q->where('author_id', $author_id);
        $Q->where('submission_id', $subid);

        $query    = $Q->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
    }
    public function updateCoauthor($id, $subid)
    {

        $builder = $this->db->table('coauthor');
        $builder->where('id', $id);
        $builder->update(['submission_id' => $subid]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function updateCoauthorPrimaryContacct($id)
    {

        $builder = $this->db->table('coauthor');
        $builder->where('id', $id);
        $builder->update(['primary_contact' => 1]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCoauthor($id)
    {
        $Q = $this->db->table('coauthor');
        $Q->where('id', $id);
        if ($Q->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertTempUploads($data)
    {
        $Qr = $this->db->table('temp_files');
        if ($Qr->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function getTempUploads($id)
    {
        $Q = $this->db->table('temp_files');
        $Q->where('id', $id);
        $data = $Q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getAllTempUploads($id)
    {
        $Q = $this->db->table('temp_files');
        $Q->where('author_id', $id);
        $data = $Q->get()->getResult();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function deleteTempFile($id)
    {
        $Q = $this->db->table('temp_files');
        $Q->where('id', $id);
        if ($Q->delete()) {
            return true;
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
    public function getCoauthorbyId($id)
    {
        $Q = $this->db->table('coauthor');
        $Q->where('id', $id);
        $user = $Q->get()->getRow();
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function getCoauthorSubid($id)
    {
        $Q = $this->db->table('coauthor');
        $Q->where('submission_id', $id);
        $Q->where('primary_contact', 1);
        $user = $Q->get()->getRow();
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }
    public function getEditors()
    {
        $Q = $this->db->table('users');
        $Q->where('roleID', 2);
        $user = $Q->get()->getResult();
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function preReview($subid)
    {
        $q = $this->db->query("SELECT id FROM notifications where submissionID=" . $subid . " LIMIT 1");
        $row   = $q->getRow();
        if ($row) {
            return $row->id;
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
}
