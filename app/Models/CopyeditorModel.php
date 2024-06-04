<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of PeerModel
 *
 * @author Ashok
 */
class CopyeditorModel extends Model
{

    public function getEditingRequest($copyeditor_id)
    {

        $builder = $this->db->table('submission');
        $builder->select('*');
        $builder->join('copyediting', 'copyediting.submissionID = submission.submissionID');
        $builder->where('copyeditor_id', $copyeditor_id);
        $builder->where('status !=', 4);
        $query = $builder->get()->getResult();
        foreach ($query as $key => $qry) {
            $q = $this->db->table('copyediting_content');
            $q->select('*');
            $q->join('submission_content', 'copyediting_content.submission_content_id= submission_content.id');
            $q->where('copyeditor_id', $qry->copyeditor_id);
            $editingContents = $q->get()->getResult();
            foreach ($editingContents as $editingContent) {
                if ($query[$key]->submissionID == $editingContent->submissionID) {
                    $query[$key]->editContents[] = $editingContent;
                }
            }
        }

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }


    public function getEditingCompleted($copyeditor_id)
    {

        $builder = $this->db->table('submission');
        $builder->select('*');
        $builder->join('copyediting', 'copyediting.submissionID = submission.submissionID AND submission.status_id=4');
        $builder->where('copyeditor_id', $copyeditor_id);

        $query = $builder->get()->getResult();
        foreach ($query as $key => $qry) {
            $q = $this->db->table('copyediting_content');
            $q->select('*');
            $q->join('submission_content', 'copyediting_content.submission_content_id= submission_content.id');
            $q->where('copyeditor_id', $qry->copyeditor_id);
            $editingContents = $q->get()->getResult();
            foreach ($editingContents as $editContent) {
                if ($query[$key]->submissionID == $editContent->submissionID) {
                    $query[$key]->editContents[] = $editContent;
                }
            }
        }

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function getEditDetailBySubid($id)
    {

        $builder = $this->db->table('submission');
        $builder->select('*');
        $builder->join('copyediting', 'copyediting.submissionID = submission.submissionID');
        $builder->where('submission.submissionID', $id);
        $query = $builder->get()->getRow();

        if (isset($query->copyeditor_id)) {
            $q = $this->db->table('copyediting_content');
            $q->select('*');
            $q->join('submission_content', 'copyediting_content.submission_content_id= submission_content.id');
            $q->where('copyeditor_id', $query->copyeditor_id);
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

    public function updateCopyediting($id, $status)
    {
        $query = $this->db->query("Update copyediting SET status=" . $status . " WHERE id=" . $id . "");

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
        $Q->where('role', 5);
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

    public function checkStatus($id)
    {
        $Q = $this->db->table('copyediting');
        $Q->where('id', $id);
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




}
