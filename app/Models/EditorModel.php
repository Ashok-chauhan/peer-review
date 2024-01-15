<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 * Description of EditorModel
 *
 * @author Ashok
 */
class EditorModel extends Model {
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
    
    
   public function getAutor($authorID) {
    //$Q = $this->db->table('users')->select('*')->where('userID', $authorID);
    $Q = $this->db->query("select * from users where userID='".$authorID."'");
    $row = $Q->getRow();
    if($row){
            return $row;
        }else{
            return false;
        }
    }
 
     public function getBySubmissionId($table, $submissionID) {
     $Q = $this->db->table($table)->select('*')->where('submissionID', $submissionID);
     $query    = $Q->get();
        if($query){
            return $query->getResult();
        }else{
            return false;
        }
    }
    public function discussion($data){
        $Q = $this->db->table('notifications');
        if($Q->insert($data)){
            return true;
        }else{
            return false;
        }
    }
    public function getDiscussion($recipeint_id,$submissionID){
        $Q = $this->db->table('notifications');
        $Q->where('recipient_id', $recipeint_id);
        $Q->where('submissionID', $submissionID);
        $query = $Q->get()->getResult();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
    
    public function getPeerDiscussion($recipeint_id,$submissionID){
        $Q = $this->db->table('editor_peer_notifications');
        $Q->where('recipient_id', $recipeint_id);
        $Q->where('submissionID', $submissionID);
        $query = $Q->get()->getResult();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
    
    public function getRevisionFile($id){
        $Q = $this->db->table('submission_content');
        $Q->where('id', $id);
        $result = $Q->get()->getRow();
        if($result){
            return $result;
           }else{
               return false;
               
           }
    }
    public function getReviewer(){
        $Q= $this->db->table('users');
        $Q->where('roleID',4);
        $result = $Q->get()->getResult();
        if($result){
            return $result;
        }else{
            return false;
            
        }
    }
    
    
    public function insertReview($data){
        $Q = $this->db->table('reviews');
        if($Q->insert($data)){
            return $this->db->insertID();
        }else{
            return false;
        }
    }
    
    public function insertReviewContent($data){
        $Q = $this->db->table('review_content');
        if($Q->insert($data)){
            return $this->db->insertID();
        }else{
            return false;
        }
    }
    
    public function reviewStatus($submissionID){
       $query = $this->db->query('Select submissionID, status from reviews where submissionID='.$submissionID.'');
       $result= $query->getResult();
       if($result){
           return $result;
       }else{
           return false;
       }
       
    }
    
    public function checkPeer($peer, $submissionid){
        $Q = $this->db->table('reviews');
        $Q->where('submissionID', $submissionid);
        $Q->where('reviewerID',$peer);
        $qry = $Q->get();
        $result = $qry->getRow();
        if($result){
            return true;
        }else{
            return false;
        }
    }
   /* 
    public function uploadEditorResponseToPeer($data) {
     $builder = $this->db->table('editor_peer_content');
     $result = $builder->insert($data);
     if($this->db->affectedRows()){
         return $this->db->insertID();
     } else {
         return false; 
     }
        
 }
 */
 public function insertEditorialUploads($data){
        $Qr = $this->db->table('editor_uploads');
        if($Qr->insert($data)){
            return $this->db->insertID();
        }else{
            return false;
        }
    }
    
    public function getEditorialUploads($id){
        $Q = $this->db->table('editor_uploads');
        $Q->where('decisionID', $id);
        $data = $Q->get()->getRow();
        if($data){
            return $data;
            }else{
                return false;
            }
    }
    public function getEditorialUploadsBySubId($subId){
        $Q = $this->db->table('editor_uploads');
        $Q->where('submissionID', $subId);
        $data = $Q->get()->getRow();
        if($data){
            return $data;
            }else{
                return false;
            }
    }
    public function getReviewsBySubId($subId){
        $Q = $this->db->table('reviews');
        $Q->where('submissionID', $subId);
        $data = $Q->get()->getRow();
        if($data){
            return $data;
            }else{
                return false;
            }
    }
    public function getCopyeditorBySubId($subId){
        $Q = $this->db->table('editorial_decision');
        $Q->where('submissionID', $subId);
        $data = $Q->get()->getRow();
        if($data){
            return $data;
            }else{
                return false;
            }
    }
    
    public function deleteEditorUpload($id){
        $Q = $this->db->table('editor_uploads');
        $Q->where('decisionID', $id);
        $Q->delete();
        return;
    }
    
    public function uploadEditorResponseToPeer($data) {
     $builder = $this->db->table('editor_peer_notifications');
     $result = $builder->insert($data);
     if($this->db->affectedRows()){
         return $this->db->insertID();
     } else {
         return false; 
     }
        
 }
 
 public function getEditorPeerContent($id){
     $q = $this->db->table('editor_peer_notifications');
     $q->where('id',$id);
     $data = $q->get()->getRow();
     if($data){
         return $data;
     }else{
         return false;
     }
 }
 
 public function getCopyeditor(){
        $Q= $this->db->table('users');
        $Q->where('roleID',7);
        $result = $Q->get()->getResult();
        if($result){
            return $result;
        }else{
            return false;
            
        }
    }
    
    public function sendToCopyEditor($data) {
     $builder = $this->db->table('editorial_decision');
     $result = $builder->insert($data);
     if($this->db->affectedRows()){
         return $this->db->insertID();
     } else {
         return false; 
     }
        
 }
 
 public function getEditorialDecision($id){
     $q = $this->db->table('editorial_decision');
     $q->where('id',$id);
     $data = $q->get()->getRow();
     if($data){
         return $data;
     }else{
         return false;
     }
 }
 
 public function getCopyeditorNote($recipient, $subid){
     $q = $this->db->table('editorial_decision');
     $q->where('recipient', $recipient);
     $q->where('submissionID', $subid);
     $data = $q->get()->getResult();
     if($data){
         return $data;
     }else{
         return false;
     }
 }
 
 public function getEditoriealStatus($subId){
        $Q = $this->db->table('editorial_decision');
        $Q->where('submissionID', $subId);
        $Q->where('status >=', 1);
        //$data = $Q->get()->getRow();
        $data = $Q->get()->getResult();
        if($data){
            return $data;
            }else{
                return false;
            }
    }

}
