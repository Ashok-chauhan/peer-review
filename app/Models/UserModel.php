<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of UserModel
 *
 * @author Ashok
 */
class UserModel extends Model {
    public function getUser($uid){
        $Q = $this->db->table('users');
        $Q->where('userID', $uid);
        $user = $Q->get()->getRow();
        if($user){
            return $user;
            }else{
                return false;
            }
    }
}
