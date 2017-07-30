<?php
Class Auth_model extends CI_Model
{

	function login($username, $password)
	 {
	   $this -> db -> select('id, username, password,wallet,admin');
	   $this -> db -> from('users');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', MD5($password));
	   $this -> db -> limit(1);

	   $query = $this -> db -> get();


	   if($query -> num_rows() == 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	 }

	public function add_user($id,$username,$password,$emailid,$image_path)
	 {
	  $data=array(
	  	'id'=>$id,
	    'username'=>$username,
	    'password'=>md5($password),
	    'emailid'=>$emailid,
	    'image_path'=>$image_path
	  );
	  $this->db->insert('users',$data);

	  $this->db->query('INSERT INTO msgseen(user_id) values('.$id.');');
	 }

	 public function getmaxid()
	 {
	  
	  $this -> db -> select('MAX(ID) as last_id');
	   $this -> db -> from('users');
	   $query = $this -> db -> get();
	  if($query -> num_rows() > 0)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	 }

	 function isexists($username,$emailid){

	 	$query = $this->db->query("SELECT * 
	 								FROM users 
	 								WHERE username = '".$username."'
	 								OR emailid = '".$emailid."';");

	 	if($query->num_rows()>0){
	 		return TRUE;
	 	}
	 	else return FALSE;

	 }

	 function viewincrement($id){

	 	$query = $this->db->query("UPDATE users
	 								SET views = views+1
	 								WHERE id=".$id.";");

	 }

	 function getviews(){

	 	$query = $this->db->query("SELECT SUM(views) as vws FROM users;");

	 		return $query->result();


	 }


	 
	 

}
?>