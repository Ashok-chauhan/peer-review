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
    public function updateUserRoles($id, $role)
    {
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
            }

        }

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
}
