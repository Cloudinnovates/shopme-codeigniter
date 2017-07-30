<?php
Class User_model extends CI_Model
{


	function getitems($user_type,$cat){
		
		$this -> db -> select('*');
	   $this -> db -> from($user_type.'_items');
	   $this -> db -> where('item_category', $cat);
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

	function isCarted($user_id,$user_type,$item_id){

		$this -> db -> select('*');
	   $this -> db -> from('cart');
	   $this -> db -> where('user_id', $user_id);
	   $this -> db -> where('category', $user_type);
	   $this -> db -> where('image_id', $item_id);
	   $query = $this -> db -> get();

		if($query->num_rows()>0){
			return TRUE;
		}
		else{
			return FALSE;
		}

	}

	function addtocart($user_id,$category,$image_id){
		$data=array(
	    'user_id'=>$user_id,
	    'category'=>$category,
	    'image_id'=>$image_id
	  	);
	  	$this->db->insert('cart',$data);
	}

	function removefromcart($user_id,$category,$image_id){
		$this->db->where('user_id',$user_id);
		$this->db->where('category',$category);
		$this->db->where('image_id',$image_id);
		$this->db->delete('cart');
	}

	function getCartItems($id){
		$this -> db -> select('*');
	   $this -> db -> from('cart');
	   $this->db->where('user_id',$id);
	   $query = $this -> db -> get();

		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return FALSE;
		}

	}

	function userDetails($user_id){
		$this -> db -> select('*');
	   $this -> db -> from('users');
	   $this->db->where('id',$user_id);
	   $query = $this -> db -> get();

		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return FALSE;
		}
	}

	function changeemail($data){

		$query = $this->db->query("UPDATE users 
									SET emailid = '".$data['emailid']."'
									WHERE id = ".$data['id']);
	}

	function changeimage($data){

		$query = $this->db->query("UPDATE users 
									SET image_path = '".$data['image_path']."'
									WHERE id = ".$data['id']);

	}

	function edituserdetails($data){
		if($data['emailid'])
		$d['emailid']=$data['emailid'];
		if($data['img'])
		$d['image_path']=$data['image_path'];
		$this->db->where('id', $data['id']);
		if($data['emailid']||$data['img'])
		$this->db->replace('users', $d);
	}

	function isexists($emailid){
		$this -> db -> select('*');
	   $this -> db -> from('users');
	   $this->db->where('emailid',$emailid);
	   $query = $this -> db -> get();

		if($query->num_rows()>0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function buyfromcart($data,$wallet){

	  	$this->db->insert('request_items',$data);

	  	$query = $this->db->query('UPDATE users
	  								SET wallet = '.
	  								$wallet.'
	  								WHERE id = '.$data['user_id'].';');
	}


	function insertmsg($data){

		$this->db->insert('chat',$data);

		$query = $this->db->query('UPDATE msgseen
									SET adminseen = 0
									WHERE user_id = '.$data['sender'].';');

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

	function isvalid_trans($transaction_id){

		$query = $this->db->query('SELECT *
									FROM transaction_ids 
									WHERE transaction_id = '.$transaction_id.'
									;');

		if($query->num_rows()>0){
			return false;
		}
		else{

			return true;
			
		}

	}

	function addmoney($amount,$transaction_id,$user_id){

		$data['amount'] = $amount;
		$data['transaction_id'] = $transaction_id;
		$data['user_id'] = $user_id;

		$this->db->insert('transaction_requests',$data);

		$data1['transaction_id'] = $transaction_id;
		$data1['user_id'] = $user_id;
		$this->db->insert('transaction_ids',$data1);

	}

	function markseen($user_id){

		$query = $this->db->query('UPDATE msgseen
									SET userseen = 1
									WHERE user_id = '.$user_id.';');

	}

	function isadminseen($user_id){

		$query = $this->db->query('SELECT adminseen
									FROM msgseen
									WHERE user_id = '.$user_id.';');

		if($query->num_rows()>0){
			return $query->result();
		}
		else return false;

	}


	function checknewmsgs($user_id){

		$query = $this->db->query('SELECT userseen
									FROM msgseen
									WHERE user_id = '.$user_id.';');

		if($query->num_rows()>0){
			return $query->result();
		}
		else return false;

	}

	function getshops(){

		$query = $this->db->query('SELECT *
									FROM shops;');

		if($query->num_rows()>0){
			return $query->result();
		}
		else return false;

	}

	function searchfor($table,$words){

		$this->db->select('*');
		$this->db->from($table.'_items');
		if($words){
			foreach ($words as $word) {
				if(!preg_match('/'.$word.'/i', $table))
				$this->db->or_where("item_description LIKE '%".$word."%'
					OR item_brand LIKE '%".$word."%'");
				//$this->db->or_where("item_brand LIKE '%".$word."%'");
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


}
?>