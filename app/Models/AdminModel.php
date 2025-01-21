<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of AdminModel
 *
 * @author Ashok
 */
class AdminModel extends Model
{
    public function allActive($status)
    {
        $q = $this->db->table('submission');
        $query = $q->getWhere(['status_id' => $status]);

        $data = $query->getResult();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getUsers()
    {
        $Q = $this->db->table('users');
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


    public function getEditors()
    {
        $Q = $this->db->table('users');
        $Q->where('roleID', 2);
        $data = $Q->get()->getResult();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getJournal()
    {
        $Q = $this->db->table('journal');
        $data = $Q->get()->getResult();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function updateJournal($id, $editor_id)
    {
        $qry = $this->db->table('journal');
        $qry->where('editor_id', $editor_id);
        $result = $qry->get()->getResult();
        if ($result) {
            foreach ($result as $row) {
                $qry->where('id', $row->id);
                $qry->update(array('id' => $row->id, 'editor_id' => 0));
            }
        }

        $data = [
            'id' => $id,
            'editor_id' => $editor_id,
        ];
        $Q = $this->db->table('journal');
        $Q->where('id', $id);
        $Q->update($data);
    }
    public function updateUser($id, $role, $status)
    {
        $data = [
            'roleID' => $role,
            'status' => $status,
        ];
        $Q = $this->db->table('users');
        $Q->where('userID', $id);
        $Q->update($data);
    }
    public function updateUserRoles($id, $roles)
    {

        $Q = $this->db->table('user_roles');
        $Q->where('user_id', $id);
        $Q->delete();

        if ($roles) {
            $qry = $this->db->table('user_roles');
            foreach ($roles as $role) {
                $data = [
                    'user_id' => $id,
                    'role_id' => $role,
                ];
                $qry->insert($data);
            }
            return true;
        }

        /*
        $qry = $this->db->table('user_roles');
        $qry->where('user_id', $id);
        $result = $qry->get()->getResult();
        $currentRoles = [];
        if ($result) {
            foreach ($result as $row) {
                $currentRoles[] = $row->role_id;
            }
           
            if (!in_array($role, $currentRoles)) {
                $data = [
                    'user_id' => $id,
                    'role_id' => $role,
                ];
                $qry->insert($data);
            } else {

            }

        }
            */

    }

    public function getAllSubmission()
    {
        $Q = $this->db->table('submission');
        $result = $Q->get()->getResult();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getSubmissionByJid($jid)
    {
        $Q = $this->db->table('submission');
        $query = $Q->where('jid', $jid);
        $result = $query->get()->getResult();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function createUsers($data)
    {
        $builder = $this->db->table('users');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    public function userRoles($data)
    {
        $builder = $this->db->table('user_roles');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function rolesbyUserId($user_id)
    {
        $Q = $this->db->table('user_roles');
        $query = $Q->where('user_id', $user_id);
        $result = $query->get()->getResult();

        $rows = [];
        foreach ($result as $res) {
            $rows[] = $res->role_id;

        }
        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }


    public function useredit($id, $data)
    {
        $Q = $this->db->table('users');
        $Q->where('userID', $id);
        $Q->update($data);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function addJournal($data)
    {
        $builder = $this->db->table('journal');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    public function journalById($jid)
    {
        $Q = $this->db->table('journal');
        $Q->where('id', $jid);
        $data = $Q->get()->getRow();
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function updateJournalById($id, $data)
    {
        $Q = $this->db->table('journal');
        $Q->where('id', $id);
        $Q->update($data);
        if ($this->db->affectedRows()) {
            return true;
        } else {
            return false;
        }
    }

    public function getJournalEditorByid($jid)
    {

        $q = $this->db->query("select * from journal_editor Inner join users on journal_editor.eid = users.userID WHERE journal_editor.jid='" . $jid . "'");
        $data = $q->getResult();
        if ($data) {
            return $data;
        } else {
            return false;
        }


    }

    public function editorsList()
    {
        $rows = [];
        $query = $this->db->query("SELECT * FROM user_roles
        INNER JOIN users ON user_roles.user_id = users.userID where user_roles.role_id=2");
        // WHERE user_roles.role_id=$role AND users.status='active' AND users.email !='$email' AND j.jid='$jid'");

        foreach ($query->getResult() as $row) {
            $rows[] = $row;
        }

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }
    public function assigneditor($data)
    {
        $builder = $this->db->table('journal_editor');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    public function revoke($jid, $eid)
    {
        $Q = $this->db->table('journal_editor');
        $Q->where('jid', $jid);
        $Q->where('eid', $eid);
        $Q->delete();
        return;
    }
}
