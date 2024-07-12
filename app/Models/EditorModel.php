<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of EditorModel
 *
 * @author Ashok
 */
class EditorModel extends Model
{
    public function allActive($status, $editor_id)
    {
        /*
        $q = $this->db->query("select * from submission where status_id in($status) order by submissionID desc");
        $data = $q->getResult();
        if ($data) {
            return $data;
        } else {
            return false;
        }
        */
        $builder = $this->db->table('submission');
        $builder->select('*');
        $builder->join('journal', 'journal.id = submission.jid', 'left');
        $builder->where('editor_id', $editor_id);
        $builder->whereIn('status_id', $status);
        $builder->orderBy('submissionID', 'DESC');
        $query = $builder->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
    }
    public function getJournal($id)
    {
        $builder = $this->db->table('journal');
        $builder->where('id', $id);
        $row = $builder->get()->getRow();
        if ($row) {
            return $row;
        } else {
            return false;
        }

    }

    public function getAutor($authorID)
    {
        //$Q = $this->db->table('users')->select('*')->where('userID', $authorID);
        $Q = $this->db->query("select * from users where userID='" . $authorID . "'");
        $row = $Q->getRow();
        if ($row) {
            return $row;
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
    public function discussion($data)
    {
        $Q = $this->db->table('notifications');
        if ($Q->insert($data)) {
            return true;
        } else {
            return false;
        }
    }
    public function getDiscussion($submissionID)
    {
        $Q = $this->db->table('notifications');
        //$data = [];
        $Q->where('submissionID', $submissionID);
        $Q->where('role', 3);
        $Q->orderBy('date_created', 'DESC');
        $query = $Q->get()->getResult();
        if ($query) {
            return $query;
        } else {
            return false;
        }

        /*
        foreach ($query as $row) {
            $usr = $this->getUser($row->sender_id);
            if ($usr->roleID == 2) {
                $data['editor'][] = $row;
            } elseif ($usr->roleID == 3) {
                $data['author'][] = $row;
            } elseif ($usr->roleID == 4) {
                $data['peer'][] = $row;
            } elseif ($usr->roleID == 6) {
                //6 copy-editor
                $data['copyeditor'][] = $row;
            }
        }
        if ($data) {
            return $data;
        } else {
            return false;
        }
        */
    }

    public function peerDiscussion($submissionID)
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
    public function cpEditorDiscussions($submissionID)
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

    public function publisherDiscussions($submissionID)
    {
        $Q = $this->db->table('notifications');
        //$data = [];
        $Q->where('submissionID', $submissionID);
        $Q->where('role', 6);
        $Q->orderBy('date_created', 'DESC');
        $query = $Q->get()->getResult();
        if ($query) {
            return $query;
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

    public function getPeerDiscussion($recipeint_id, $submissionID)
    {
        $Q = $this->db->table('editor_peer_notifications');
        $Q->where('recipient_id', $recipeint_id);
        $Q->where('submissionID', $submissionID);
        $query = $Q->get()->getResult();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function getRevisionFile($id)
    {
        $Q = $this->db->table('submission_content');
        $Q->where('id', $id);
        $result = $Q->get()->getRow();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function updateSubmissionContent($id, $data)
    {
        $Q = $this->db->table('submission_content');
        $Q->where('id', $id);
        $Q->update($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProductionMailSend($id)
    {
        $Q = $this->db->table('submission');
        $Q->where('submissionID', $id);
        $Q->update(['production_copy_send' => 1]);
        if ($this->db->affectedRows() == 1) {
            return true;
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

    public function getReviewer($role = 4, $email = '', $jid = 1)
    {


        $rows = [];
        /*
        $query = $this->db->query("SELECT * FROM user_roles
        RIGHT JOIN users ON user_roles.user_id = users.userID
        WHERE user_roles.role_id=$role AND users.status='active' AND users.email !='$email'");
        */

        $query = $this->db->query("SELECT * FROM user_roles
        INNER JOIN users ON user_roles.user_id = users.userID
        INNER JOIN journal_peer j ON j.pid  = users.userID
        WHERE user_roles.role_id=$role AND users.status='active' AND users.email !='$email' AND j.jid='$jid'");

        foreach ($query->getResult() as $row) {
            $rows[] = $row;
        }

        if ($rows) {
            return $rows;
        } else {
            return false;
        }

    }


    public function insertReview($data)
    {
        $Q = $this->db->table('reviews');
        if ($Q->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function insertReviewContent($data)
    {
        $Q = $this->db->table('review_content');
        if ($Q->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    public function insertCopyediting($data)
    {
        $Q = $this->db->table('copyediting');
        if ($Q->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function insertProduction($data)
    {
        $Q = $this->db->table('production');
        if ($Q->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    public function insertCopyeditingContent($data)
    {
        $Q = $this->db->table('copyediting_content');
        if ($Q->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function insertProductionContent($data)
    {
        $Q = $this->db->table('production_content');
        if ($Q->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function reviewStatus($submissionID)
    {
        $query = $this->db->query('Select submissionID, status from reviews where submissionID=' . $submissionID . '');
        $result = $query->getRow();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function checkPeer($peer, $submissionid)
    {
        $Q = $this->db->table('reviews');
        $Q->where('submissionID', $submissionid);
        $Q->where('reviewerID', $peer);
        $qry = $Q->get();
        $result = $qry->getRow();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function checkPublisher($pubid, $submissionid)
    {
        $Q = $this->db->table('production');
        $Q->where('submissionID', $submissionid);
        $Q->where('publisher_id', $pubid);
        $qry = $Q->get();
        $result = $qry->getRow();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insertEditorialUploads($data)
    {
        $Qr = $this->db->table('editor_uploads');
        if ($Qr->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function getEditorialUploads($id)
    {
        $Q = $this->db->table('editor_uploads');
        $Q->where('decisionID', $id);
        $data = $Q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function getEditorialUploadsBySubId($subId)
    {
        $Q = $this->db->table('editor_uploads');
        $Q->where('submissionID', $subId);
        $data = $Q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function getReviewsBySubId($subId)
    {
        $Q = $this->db->table('reviews');
        $Q->where('submissionID', $subId);
        $data = $Q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function getCopyeditingBySubId($subId)
    {
        $Q = $this->db->table('copyediting');
        $Q->where('submissionID', $subId);
        $data = $Q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getProductionBySubId($subId)
    {
        $Q = $this->db->table('production');
        $Q->where('submissionID', $subId);
        $data = $Q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function getCopyeditorBySubId($subId)
    {
        $Q = $this->db->table('editorial_decision');
        $Q->where('submissionID', $subId);
        $data = $Q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function deleteEditorUpload($id)
    {
        $Q = $this->db->table('editor_uploads');
        $Q->where('decisionID', $id);
        $Q->delete();
        return;
    }

    public function uploadEditorResponseToPeer($data)
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
        $data = $q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getCopyeditor($email = '')
    {
        /*
        // looks like not in use
        $Q = $this->db->table('users');
        $Q->where('roleID', 7); //copy editor role is 5
        $result = $Q->get()->getResult();
        if ($result) {
            return $result;
        } else {
            return false;
        }
            */
        $rows = [];
        $query = $this->db->query("SELECT * FROM user_roles
            INNER JOIN users ON user_roles.user_id = users.userID
            
            WHERE user_roles.role_id=5 AND users.status='active' AND users.email !='$email'");

        foreach ($query->getResult() as $row) {
            $rows[] = $row;
        }

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getPublisher($email = '')
    {

        $rows = [];
        $query = $this->db->query("SELECT * FROM user_roles
            INNER JOIN users ON user_roles.user_id = users.userID
            
            WHERE user_roles.role_id=6 AND users.status='active' AND users.email !='$email'");

        foreach ($query->getResult() as $row) {
            $rows[] = $row;
        }

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }
    public function sendToCopyEditor($data)
    {
        $builder = $this->db->table('editorial_decision');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function getEditorialDecision($id)
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

    public function getEditorialDecision_bySubid($submissionID)
    {
        $q = $this->db->table('editorial_decision');
        $q->where('submissionID', $submissionID);
        $data = $q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getCopyeditorNote($recipient, $subid)
    {
        $q = $this->db->table('editorial_decision');
        $q->where('recipient', $recipient);
        $q->where('submissionID', $subid);
        $data = $q->get()->getResult();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getEditoriealStatus($subId)
    {
        $Q = $this->db->table('editorial_decision');
        $Q->where('submissionID', $subId);
        $Q->where('status >=', 1);
        //$data = $Q->get()->getRow();
        $data = $Q->get()->getResult();
        if ($data) {
            return $data;
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

    public function coauthorBySubmission($subid)
    {
        $Q = $this->db->table('coauthor');
        $Q->where('submission_id', $subid);
        $query = $Q->get();
        if ($query) {
            return $query->getResult();
        } else {
            return false;
        }
    }
    public function preReview($subid)
    {
        $q = $this->db->query("SELECT id FROM notifications where submissionID=" . $subid . " LIMIT 1");
        $row = $q->getRow();
        if ($row) {
            return $row->id;
        } else {
            return false;
        }
    }

    public function updateBellNotifications($id)
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

    public function accepted($submissionID, $status)
    {
        $Q = $this->db->table('submission');
        $Q->where('submissionID', $submissionID);
        $Q->update(['status_id' => $status]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTableStatus($table, $submissionID, $status)
    {
        $Q = $this->db->table($table);
        $Q->where('submissionID', $submissionID);
        $Q->update(['status' => $status]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTableReviewUploads($id)
    {
        $Q = $this->db->table('review_uploads');
        $Q->where('id', $id);
        $Q->update(['added' => 1]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function updateTableCopyeditingUploads($id)
    {
        $Q = $this->db->table('copyediting_uploads');
        $Q->where('id', $id);
        $Q->update(['added' => 1]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function updateTableProductionUploads($id)
    {
        $Q = $this->db->table('production_uploads');
        $Q->where('id', $id);
        $Q->update(['added' => 1]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function requestRevision($submissionID)
    {
        $Q = $this->db->table('notifications');
        //$data = [];
        $Q->where('submissionID', $submissionID);
        $Q->where('role', 4);
        $Q->orderBy('date_created', 'DESC')->limit(3);
        $query = $Q->get()->getResult();
        if ($query) {
            return $query;
        } else {
            return false;
        }


    }

    public function getSubmission($submissionID)
    {
        $Q = $this->db->table('submission');
        $Q->where('submissionId', $submissionID);
        $row = $Q->get()->getRow();
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }


    public function editorialDecision($data)
    {
        $builder = $this->db->table('editorial_decision');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function getFinalupload($subid)
    {
        $builder = $this->db->table('review_uploads');
        $builder->where('submission_id', $subid);
        $row = $builder->get()->getRow();
        if ($row) {
            return $row;
        } else {
            return false;
        }

    }


    public function getCopyFinalupload($subid)
    {
        $builder = $this->db->table('copyediting_uploads');
        $builder->where('submission_id', $subid);
        $row = $builder->get()->getRow();
        if ($row) {
            return $row;
        } else {
            return false;
        }

    }

    public function getPublisherFinalupload($subid)
    {
        $builder = $this->db->table('production_uploads');
        $builder->where('submission_id', $subid);
        $row = $builder->get()->getRow();
        if ($row) {
            return $row;
        } else {
            return false;
        }

    }
    function reset_all($sid)
    {
        $r = $this->db->table('reviews');
        $r->where("submissionID", $sid);
        $r->delete();
        $rc = $this->db->table('review_content');
        $rc->where("submission_id", $sid);
        $rc->delete();
        $ru = $this->db->table('review_uploads');
        $ru->where("submission_id", $sid);
        $ru->delete();

        $c = $this->db->table('copyediting');
        $c->where("submissionID", $sid);
        $c->delete();
        $cc = $this->db->table('copyediting_content');
        $cc->where("submission_id", $sid);
        $cc->delete();
        $cu = $this->db->table('copyediting_uploads');
        $cu->where("submission_id", $sid);
        $cu->delete();

        $p = $this->db->table('production');
        $p->where("submissionID", $sid);
        $p->delete();
        $pc = $this->db->table('production_content');
        $pc->where("submission_id", $sid);
        $pc->delete();
        $pu = $this->db->table('production_uploads');
        $pu->where("submission_id", $sid);
        $pu->delete();

        //update submission sttatus
        $sub = $this->db->table('submission');
        $sub->where('submissionID', $sid);
        $sub->update(['status_id' => 0]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }

    }

}
