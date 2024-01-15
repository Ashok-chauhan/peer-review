<?php

namespace App\Models;
use CodeIgniter\Model;
/**
 * Description of SubmissionModel
 *
 * @author Ashok
 */
class SubmissionModel extends Model{
    public function createSubmission($data) {
     $builder = $this->db->table('submission');
     $result = $builder->insert($data);
     if($this->db->affectedRows()){
         return $this->db->insertID();
     } else {
         return false; 
     }
        
 }
 
 public function createSubmissionContent($data) {
     $Q = $this->db->table('submission_content');
     $result = $Q->insertBatch($data);
     if($this->db->affectedRows()){
         return $this->db->insertID();
     }else{
         return false;
     }
     
 }
 
 public function getByAutorId($authorID) {
    $Q = $this->db->table('submission')->select('*')->where('authorID', $authorID);
    $query    = $Q->get();
     if($query){
         return $query->getResult();
     }else{
         return false;
     }
 }
 
 public function getBySubmissionId($submissionID) {
    $Q = $this->db->table('submission_content')->select('*')->where('submissionID', $submissionID);
    $query    = $Q->get();
     if($query){
         return $query->getResult();
     }else{
         return false;
     }
 }
 
 public function getNoticeCount($recipientid, $submissionID){
    //$count =  $this->db->table('notifications')->where('recipient_id', $recipientid)->countAllResults();
     $Q = $this->db->table('notifications');
     $Q->where('recipient_id', $recipientid);
     $Q->where("submissionID", $submissionID);
     $count = $Q->countAllResults();
     if($count){
         return $count;
     }else{
         return false;
     }
     
}

public function getNotice($recipientid, $submissionID){
     $query = $this->db->query('select * from notifications where recipient_id='.$recipientid.' and submissionID='.$submissionID);
     $result = $query->getResult();
     if($result){
         return $result;
     }else{
         return false;
     }
    }
    
    public function discussion($data){
        $Q = $this->db->table('notifications');
        if($Q->insert($data)){
            return $this->db->insertID();
        }else{
            return false;
        }
    }
    
    public function createContributorUsers($data) {
     $builder = $this->db->table('users');
     $result = $builder->insert($data);
     if($this->db->affectedRows()){
         return $this->db->insertID();
     } else {
         return false; 
     }
        
 }
}
