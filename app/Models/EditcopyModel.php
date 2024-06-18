<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of Copyediting
 *
 * @author Ashok
 * Thsi model not in use instead CopyeditorModel in use
 */
class EditcopyModel extends Model
{
    public function getCopyeditingRequest($id)
    {
        $q = $this->db->table('editorial_decision');
        $q->where('recipient', $id);
        $q->where('status >=', 1);
        $result = $q->get()->getResult();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    public function copyTerms($recipeint_id, $subid)
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
    public function noteCount($uid)
    {
        $q = $this->db->table('editorial_decision');
        $q->where('recipient', $uid);
        $q->where('status =', 0);
        $count = $q->countAllResults();
        return $count;
    }

    public function getDiscussion($recipeint, $submissionID)
    {
        $Q = $this->db->table('editorial_decision');
        $Q->where('recipient', $recipeint);
        $Q->where('submissionID', $submissionID);
        $Q->where('status', 0);
        $query = $Q->get()->getResult();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
    public function sendToEditor($data)
    {
        $builder = $this->db->table('editorial_decision');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }

    }

    public function getEditorialDecisionByid($id)
    {
        $q = $this->db->table('editorial_decision');
        $q->where('id', $id);
        $data = $q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

}
