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
}
