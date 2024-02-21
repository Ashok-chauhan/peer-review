<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of RegistrationModel
 *
 * @author Ashok
 */

namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{
    public function createUsers($data)
    {
        $builder = $this->db->table('users');
        $result = $builder->insert($data);
        if ($this->db->affectedRows()) {
            return true;
        } else {
            return false;
        }
    }
    public function verifyUniid($uniid)
    {
        $builder = $this->db->table('users');
        $builder->select('activation_date, uniid, status, email');
        $builder->where('uniid', $uniid);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRow();
        } else {
            return false;
        }
    }
    public function updateStatus($uniid)
    {
        $builder = $this->db->table('users');
        $builder->where('uniid', $uniid);
        $builder->update(['status' => 'active']);
        if ($this->db->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
