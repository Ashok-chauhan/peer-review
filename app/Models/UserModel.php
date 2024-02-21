<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of UserModel
 *
 * @author Ashok
 */
class UserModel extends Model
{
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

    public function getUserBymail($email)
    {
        $Q = $this->db->table('users');
        $Q->where('email', $email);
        $user = $Q->get()->getRow();
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function updatePassword($uniid, $password)
    {
        $builder = $this->db->table('users');
        $builder->where('uniid', $uniid);
        $builder->update(['password' => $password]);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
