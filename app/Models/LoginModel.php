<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of LoginModel
 *
 * @author Ashok
 */
class LoginModel extends Model
{
    public function verifyEmail($email)
    {
        $q = $this->db->table('users');
        $q->select("userID, title, username, middle_name, last_name, uniid,roleID, status, email, password");
        $q->where('email', $email);
        $result = $q->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function getRole($user_id)
    {
        $role = [];
        $query = $this->db->query("SELECT r.id
        FROM role r
        JOIN user_roles ur ON r.id = ur.role_id
        WHERE ur.user_id = $user_id");

        foreach ($query->getResult() as $row) {
            $role[] = $row->id;
        }
        return $role;
    }
}
