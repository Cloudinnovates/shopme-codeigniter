<?php
Class Admin_model extends CI_Model
{


	 function getLastId($user_type){
	 	$query = $this->db->query('
	 								SELECT MAX(item_id) as last_id 
	 								FROM '.$user_type.'_items;');

	 	if($query -> num_rows() == 1)
		   {
		     return $query->result();
		   }
		   else
		   {
		     return false;
		   }
	}
	 

	function insertitem($user_type,$cat,$data){

			$data=array(
				'item_id' =>$data['item_id'],
			    'item_category'=>$cat,
			    'item_brand'=>$data['item_brand'],
			    'item_cost'=>$data['item_cost'],
			    'item_description'=>$data['item_description'],
			    'item_path' => $data['item_path']
		    );
		  $this->db->insert($user_type.'_items',$data);


		}

		function getCartItems(){
		$this -> db -> select('*');
	   $this -> db -> from('cart');
	   $query = $this -> db -> get();

		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return FALSE;
		}

	}

	function getitem($user_type,$item_id){
		
		$this -> db -> select('*');
	   $this -> db -> from($user_type.'_items');
	   $this -> db -> where('item_id', $item_id);
	   $query = $this -> db -> get();

		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}

	function deleteuserrequest($user_id,$cat_type,$image_id){

		$query = $this->db->query("DELETE FROM cart
									WHERE user_id = ".$user_id."
									AND category = '".$cat_type."'
									AND image_id = ".$image_id.";");


	}

	function approveuserrequest($user_id,$cat_type,$image_id){

		$data['user_id'] = $user_id;
		$data['category'] = $cat_type;
		$data['image_id'] = $image_id;

		$this->db->insert('shipping',$data);

	}

	function getmoneyrequests(){

		$query = $this->db->query('SELECT *
									FROM transaction_requests
									;');

		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return false;
		}

	}

	function approvemoney($user_id,$amount,$transaction_id){

		$query1 = $this->db->query("UPDATE users
									SET wallet = wallet + ".$amount."
									WHERE id = ".$user_id.";");

		$query2 = $this->db->query("DELETE FROM transaction_requests
									WHERE transaction_id = ".$transaction_id.";");

	}

	function rejectmoney($user_id,$amount,$transaction_id){


		$query1 = $this->db->query("DELETE FROM transaction_requests
									WHERE transaction_id = ".$transaction_id.";");

		$query2 = $this->db->query("DELETE FROM transaction_ids
									WHERE transaction_id = ".$transaction_id.";");

	}

	function chatdatauserlist(){

		$query = $this->db->query("SELECT *
									FROM msgseen
									ORDER BY adminseen;");

		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return false;
		}

	}

	function getusername($id){

		$query = $this->db->query('SELECT username
									FROM users 
									WHERE id = '.$id);

		if($query->num_rows()>0){
			return $query->result();
		}
		else return false;

	}

	function getmessages($id){

		$query = $this->db->query('SELECT *
									FROM chat 
									WHERE sender = '.$id.'
									OR receiver = '.$id.'
									ORDER BY at;');

		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return FALSE;
		}

	}

	function isuserseen($user_id){

		$query = $this->db->query('SELECT userseen
									FROM msgseen
									WHERE user_id = '.$user_id.';');

		if($query->num_rows()>0){
			return $query->result();
		}
		else return false;

	}

	function markseen($user_id){

		$query = $this->db->query('UPDATE msgseen
									SET adminseen = 1
									WHERE user_id = '.$user_id.';');

	}


	function insertmsg($data){

		$this->db->insert('chat',$data);

		$query = $this->db->query('UPDATE msgseen
									SET userseen = 0
									WHERE user_id = '.$data['receiver'].';');

	}

	function insertshop($data){
		$this->db->insert('shops',$data);
	}

	function searchfor($table,$words){

		$this->db->select('*');
		$this->db->from($table.'_items');
		if($words){
			foreach ($words as $word) {
				if(!preg_match('/'.$word.'/i', $table))
				$this->db->or_where("item_description LIKE '%".$word."%'");
			}
		}

		$query = $this->db->get();

		if($query->num_rows()>0){
				return $query->result();
		}
		else return false;

	}

	function searchcompany($table,$words){
		if(!$words)return false;
		$this->db->select('*');
		$this->db->from($table.'_items');

			foreach ($words as $word) {
				$this->db->or_where("item_brand LIKE '%".$word."%'");
			}


		$query = $this->db->get();

		if($query->num_rows()>0){
				return $query->result();
		}
		else return false;

	}

	function edititem($user_type,$cat,$data){

		$this->db->query("UPDATE ".$user_type."_items
							SET item_category = '".$cat."',
								item_brand = '".$data['item_brand']."',
								item_cost = '".$data['item_cost']."',
								item_description = '".$data['item_description']."',
								item_path = '".$data['item_path']."'
								WHERE item_id = ".$data['item_id'].";");


	}

	function deleteitem($user_type,$item_id){

		$this->db->query("DELETE FROM ".$user_type."_items
							WHERE item_id = ".$item_id.";");

	}




}
?>