<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of AdminModel
 *
 * @author Ashok
 */
class AdminModel extends Model {
    public function allActive($status) {
        $q = $this->db->table('submission');
       $query =  $q->getWhere(['status_id'=>$status]);
       
       $data = $query->getResult();
       if($data){
           return $data;
       }else{
           return false;
       }
     }
     
     public function getUsers(){
         $Q = $this->db->table('users');
        $data = $Q->get()->getResult();
         if($data){
             return $data;
         }else{
             return false;
         }
     }
     public function updateUser($id,$role, $status){
         $data=[
             'roleID'=> $role,
             'status'=> $status,
         ];
         $Q = $this->db->table('users');
         $Q->where('userID', $id);
         $Q->update($data);
     }
     
     public function getAllSubmission(){
         $Q = $this->db->table('submission');
         $result = $Q->get()->getResult();
         if($result){
             return $result;
         }else{
             return false;
         }
     }
}
