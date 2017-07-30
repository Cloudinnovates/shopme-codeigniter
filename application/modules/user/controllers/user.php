<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {


	function __construct()
 	{
	   parent::__construct();
	   $this->load->database();
	   $this->load->model('User_model');
	   $this->load->helper(array('form','url'));
	   $this->load->library('form_validation');
	   $this->load->plugin('geo_location');

	   if($this->session->userdata('logged_in')){
        if($this->session->userdata('logged_in')['admin']==1)
        redirect('admin','refresh');
     }
     else redirect('auth','refresh');
 	}

	public function index()
	{
		$this->home();
	}


	public function home()
	{
		$this->load->view('header');
		$this->load->view('ads');
		$this->load->view('user/home');
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function mens($cat = ''){
		$this->load->view('header');
		$this->load->view('ads');
		if($cat=='')$this->load->view('mens');
		else{
			$data['cat'] = $cat;
			$data['user_type']='mens';
			$data['items']=$this->User_model->getitems($data['user_type'],$cat);
			$this->load->view('category_display',$data);
		}
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function womens($cat = ''){
		$this->load->view('header');
		$this->load->view('ads');
		if($cat=='')$this->load->view('womens');
		else{
			$data['cat'] = $cat;
			$data['user_type']='womens';
			$data['items']=$this->User_model->getitems($data['user_type'],$cat);
			$this->load->view('category_display',$data);
		}
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function kids($cat = ''){
		$this->load->view('header');
		$this->load->view('ads');
		if($cat=='')$this->load->view('kids');
		else{
			$data['cat'] = $cat;
			$data['user_type']='kids';
			$data['items']=$this->User_model->getitems($data['user_type'],$cat);
			$this->load->view('category_display',$data);
		}
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function electronics($cat = ''){
		$this->load->view('header');
		$this->load->view('ads');
		if($cat=='')$this->load->view('electronics');
		else{
			$data['cat'] = $cat;
			$data['user_type']='electronics';
			$data['items']=$this->User_model->getitems($data['user_type'],$cat);
			$this->load->view('category_display',$data);
		}
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function books($cat = ''){
		$this->load->view('header');
		$this->load->view('ads');
		if($cat=='')$this->load->view('books');
		else{
			$data['cat'] = $cat;
			$data['user_type']='books';
			$data['items']=$this->User_model->getitems($data['user_type'],$cat);
			$this->load->view('category_display',$data);
		}
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function others($cat = ''){
		$this->load->view('header');
		$this->load->view('ads');
		if($cat=='')$this->load->view('others');
		else{
			$data['cat'] = $cat;
			$data['user_type']='others';
			$data['items']=$this->User_model->getitems($data['user_type'],$cat);
			$this->load->view('category_display',$data);
		}
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function itemdetails($user_type,$item_id){

		$this->load->view('header');
		$this->load->view('ads');
			$data['user_type'] = $user_type;
			$data['carted'] = $this->User_model->isCarted($this->session->userdata('logged_in')['id'],$user_type,$item_id);
			$data['items']=$this->User_model->getitem($user_type,$item_id);
			$this->load->view('item_display',$data);
			$this->load->view('chat');
		$this->load->view('footer');

	}

	public function addtocart($user_type,$item_id){
			$this->User_model->addtocart($this->session->userdata('logged_in')['id'],$user_type,$item_id);
			$data = "ok";
			echo json_encode($data);
	}

	public function removefromcart($user_type,$item_id){
			$this->User_model->removefromcart($this->session->userdata('logged_in')['id'],$user_type,$item_id);
			$data = "ok";
			echo json_encode($data);
	}

	public function cart(){
		$this->load->view('header');
		$this->load->view('ads');
		$data['items'] = array();
		$cart_items = $this->User_model->getCartItems($this->session->userdata('logged_in')['id']);
		if($cart_items){
			foreach ($cart_items as $cart_item) {
				$item_array = $this->User_model->getitem($cart_item->category,$cart_item->image_id);
				foreach ($item_array as $item) {
					$item->user_type = $cart_item->category;
					array_push($data['items'], $item);
				}
			}

		}
		
			
		$this->load->view('cart_view',$data);
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function account(){
		$this->load->view('header');
		$this->load->view('ads');
		$data['users'] = $this->User_model->userDetails($this->session->userdata('logged_in')['id']);
		$this->load->view('user/account',$data);
		$this->load->view('chat');
		$this->load->view('footer');
	}

	public function editdetails(){

		$edited = false;
		$data['id'] = $this->session->userdata('logged_in')['id'];

		$data['emailid'] = $this->input->post('emailid');
		if($this->User_model->isexists($data['emailid'])){
			$this->session->set_flashdata('upload_message','email error');
			redirect('user/account','refresh');
		}
		else if($data['emailid']){
				$this->User_model->changeemail($data);
				$edited = true;
		}
		
		$config = array(
			'upload_path' => './assets/images/users',
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000",
			'max_height' => "2000",
			'max_width' => "2000",
			'file_name' => $this->session->userdata('logged_in')['id']
			);
			if ( ! is_dir($config['upload_path']) ) die($config['upload_path']."THE UPLOAD DIRECTORY DOES NOT EXIST");
			$this->load->library('upload', $config);

				if($this->upload->do_upload('user_pic'))
				{
					$data['image_path'] = $this->upload->data()['file_name'];
					$this->User_model->changeimage($data);
					$edited = true;

				}
				else
				{
					$this->session->set_flashdata('upload_message', 'image upload failed');
				}    

			if($edited) $this->session->set_flashdata('upload_message', 'successfully changed');
			
				redirect('user/account','refresh');
	}


	function buyfromcart($item_cat,$item_id,$item_cost){

			if($item_cost > $this->session->userdata('logged_in')['wallet'])
			{
				$data['msg'] = "nomoney";
				echo json_encode($data);return;
			}
			

		$data['user_id'] = $this->session->userdata('logged_in')['id'];
		$data['item_cat'] = $item_cat;
		$data['item_id'] = $item_id;
		$sess_array = $this->session->userdata('logged_in');
		$sess_array['wallet'] = $this->session->userdata('logged_in')['wallet']-$item_cost;
          if($sess_array['admin']==1)$sess_array['user']='admin';
         $this->session->set_userdata('logged_in', $sess_array);
		$this->User_model->buyfromcart($data,$this->session->userdata('logged_in')['wallet']);
		
		$data['msg'] = "ok";
				echo json_encode($data);

	}

	function sendmessage(){

		$data['message'] = $this->input->post('msg');
		$data['sender'] = $this->session->userdata('logged_in')['id'];
		$data['receiver'] = '2';

		$this->User_model->insertmsg($data);

		$d['msgsuccess'] = 'ok';
		echo json_encode($d);

	}

	function getmessages(){

		$data['msgs'] = $this->User_model->getmessages($this->session->userdata('logged_in')['id']);

		$seens = $this->User_model->isadminseen($this->session->userdata('logged_in')['id']);
		foreach ($seens as $seen) {
			$data['seen'] = $seen->adminseen;
		}
		echo json_encode($data);

	}

	function addmoney(){

		$money = $this->input->post('amount');
		$transaction_id = $this->input->post('transaction');
		if($money == ''||$transaction_id == ''){
			$this->session->set_flashdata('transaction_message','enter something');
			redirect('user/account','refresh');
		}

		if($this->User_model->isvalid_trans($transaction_id)==false){
			$this->session->set_flashdata('transaction_message','transaction id already used');
			redirect('user/account','refresh');
		}

		$this->User_model->addmoney($money,$transaction_id,$this->session->userdata('logged_in')['id']);

		$this->session->set_flashdata('transaction_message','successfully requested');
			redirect('user/account','refresh');

	}

	function markseen(){

		$this->User_model->markseen($this->session->userdata('logged_in')['id']);
		$data['msg'] = "ok";
		echo json_encode($data);

	}

	function checknewmsgs(){

		$newmsgs = $this->User_model->checknewmsgs($this->session->userdata('logged_in')['id']);

		foreach ($newmsgs as $newmsg) {
			if($newmsg->userseen == 0)$data['msg'] = 'yes';
			else $data['msg'] = 'no';
		}

		echo json_encode($data);

	}

	public function nearbyshops()
	{
		$this->load->view('header');
		$this->load->view('ads');

		

		$this->load->view('user/nearbyshops');
		$this->load->view('chat');
		$this->load->view('footer');
	}

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {

			//K M N  kilometres miles nautical miles

			  $theta = $lon1 - $lon2;
			  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			  $dist = acos($dist);
			  $dist = rad2deg($dist);
			  $miles = $dist * 60 * 1.1515;
			  $unit = strtoupper($unit);

			  if ($unit == "K") {
			    return ($miles * 1.609344);
			  } else if ($unit == "N") {
			      return ($miles * 0.8684);
			    } else {
			        return $miles;
			      }
	}


	function getshops($lat1,$long1){



		$data['shops'] = $this->User_model->getshops();
		

		foreach ($data['shops'] as $shop) {
			$dist = $this->distance($lat1,$long1,$shop->shop_lat,$shop->shop_long,"K");
			$shop->shop_dist = sprintf('%0.2f', $dist);
		}

		usort($data['shops'], function($a, $b)
		{
		    return $a->shop_dist > $b->shop_dist;
		});


		echo json_encode($data);

	}

	function search(){


		

		$search_query = strtolower($this->input->post('searchquery'));



	

		$words   = preg_split('/\s+/', $search_query);

			//echo count($words);

			foreach ($words as $key=>$word) {
				$words[$key] = rtrim($word,'s');

			}


		$data['items'] = array();

		if(strpos($search_query, 'women') !== false){

			$cat_searches = $this->User_model->searchfor("womens",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "womens";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'men') !== false){

			$cat_searches = $this->User_model->searchfor("mens",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "mens";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'kid') !== false){

			$cat_searches = $this->User_model->searchfor("kids",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "kids";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'other') !== false){

			$cat_searches = $this->User_model->searchfor("others",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "others";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'electronic') !== false){

			$cat_searches = $this->User_model->searchfor("electronics",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "electronics";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'book') !== false){

			$cat_searches = $this->User_model->searchfor("books",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "books";
				array_push($data['items'],$cat_search);
			}

		}

		$words = array_filter($words, function($w) { 
     			return !preg_match('/(men|kid|book|electronic|other)/i', $w); 
				});
		//echo count($words);
		/*
		$company_search = $this->User_model->searchcompany("mens",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "mens";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->User_model->searchcompany("womens",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "womens";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->User_model->searchcompany("kids",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "kids";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->User_model->searchcompany("electronics",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "electronics";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->User_model->searchcompany("books",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "books";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->User_model->searchcompany("others",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "others";
				array_push($data['items'],$com_search);
			}
		}

		*/

		$sort_by = $this->input->post("sort_cat");

	

		if($sort_by=="item_cost_asc"){

			usort($data['items'], function($a, $b)
			{
			    return $a->item_cost > $b->item_cost;
			});

		}

		else if($sort_by=="item_cost_des"){

			usort($data['items'], function($a, $b)
			{
			    return $a->item_cost < $b->item_cost;
			});

		}

		if(!$sort_by)$data['sort_by'] = "Relevance";
		else 	
		$data['sort_by'] = $sort_by;
		//echo $data['items']['1']->user_type;
		$data['search'] = $search_query;
		$this->load->view('header');
		$this->load->view('ads');
		$this->load->view('category_display',$data);
		$this->load->view('chat');
		$this->load->view('footer');



	}

	function loadsearch(){



	}



}
