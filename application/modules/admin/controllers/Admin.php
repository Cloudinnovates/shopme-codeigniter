<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	function __construct()
 	{
	   parent::__construct();
	   $this->load->model('Admin_model');
	   $this->load->database();
	   $this->load->helper(array('form','url'));
	   $this->load->library('form_validation');
	   if($this->session->userdata('logged_in')){
        if($this->session->userdata('logged_in')['admin']==0)
        redirect('user','refresh');
     }
     else redirect('auth','refresh');
 	}

 	public function index()
	{
		$this->home();
	}

	public function home()
	{
		$this->admin_render('home');
	}


	public function mens($cat = ''){
		$data = '';
		if($cat=='')$view = 'mens';
		else{
			$data['cat'] = $cat;
			$data['user_type']='mens';
			$view = 'category_display';
		}
		$this->admin_render($view,$data);
	}

	public function womens($cat = ''){
		$data = '';
		if($cat=='')$view = 'womens';
		else{
			$data['cat'] = $cat;
			$data['user_type']='womens';
			$view = 'category_display';
		}
		$this->admin_render($view,$data);
	}

	public function kids($cat = ''){
		$data = '';
		if($cat=='')$view = 'kids';
		else{
			$data['cat'] = $cat;
			$data['user_type']='kids';
			$view = 'category_display';
		}
		$this->admin_render($view,$data);
	}

	public function electronics($cat = ''){
		$data = '';
		if($cat=='')$view = 'electronics';
		else{
			$data['cat'] = $cat;
			$data['user_type']='electronics';
			$view = 'category_display';
		}
		$this->admin_render($view,$data);
	}

	public function books($cat = ''){
		$data = '';
		if($cat=='')$view = 'books';
		else{
			$data['cat'] = $cat;
			$data['user_type']='books';
			$view = 'category_display';
		}
		$this->admin_render($view,$data);
	}

	public function others($cat = ''){
		$data = '';
		if($cat=='')$view = 'others';
		else{
			$data['cat'] = $cat;
			$data['user_type']='others';
			$view = 'category_display';
		}
		$this->admin_render($view,$data);
	}

	public function uploadimage($user_type,$cat){
		$last_id = $this->Admin_model->getLastId($user_type);
		foreach ($last_id as $ids) {
			$id = $ids->last_id;
		}
		if(!$last_id) $id=1;
		else $id++;
		$data['item_id'] = $id;
		$data['item_brand'] = $this->input->post('item_brand');
     	$data['item_cost'] = $this->input->post('item_cost');
     	$data['item_description'] = $this->input->post('item_description');
		$config = array(
			'upload_path' => './assets/images/shopme/'.$user_type.'/'.$cat,
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000",
			'max_height' => "768",
			'max_width' => "1024",
			'file_name' => $id
			);
			if ( ! is_dir($config['upload_path']) ) die($config['upload_path']."THE UPLOAD DIRECTORY DOES NOT EXIST");
			$this->load->library('upload', $config);
			if($this->upload->do_upload('item_pic'))
				{
					$this->session->set_flashdata('upload_message','success');
					$data['item_path'] = $user_type.'/'.$cat.'/'.$this->upload->data()['file_name'];
					$this->Admin_model->insertitem($user_type,$cat,$data);

				}
				else
				{
					$this->session->set_flashdata('upload_message', 'failed');
				}    
			
			redirect('admin/'.$user_type.'/'.$cat,'refresh');
		
	}

	public function cart(){
		$data['items'] = array();
		$cart_items = $this->Admin_model->getCartItems();
		if($cart_items){
			foreach ($cart_items as $cart_item) {
				$item_array = $this->Admin_model->getitem($cart_item->category,$cart_item->image_id);
				foreach ($item_array as $item) {
					$item->user_type = $cart_item->category;
					$item->requestor = $cart_item->user_id;
					array_push($data['items'], $item);
				}
			}

		}		
		$this->admin_render('cart_view',$data);
	}

	public function deleterequest($user_id,$cat_type,$image_id){

		$this->Admin_model->deleteuserrequest($user_id,$cat_type,$image_id);

		$data['msg'] = 'ok';

		echo json_encode($data);

	}

	public function approverequest($user_id,$cat_type,$image_id){

		$this->Admin_model->approveuserrequest($user_id,$cat_type,$image_id);

		$data['msg'] = 'ok';

		echo json_encode($data);

	}

	public function account(){
		$data['users'] = $this->Admin_model->getmoneyrequests();
		$this->admin_render('account',$data);
	}

	public function approvemoney($user_id,$amount,$transaction_id){

		$this->Admin_model->approvemoney($user_id,$amount,$transaction_id);

		$data['msg'] = 'ok';

		echo json_encode($data);

	}

	public function rejectmoney($user_id,$amount,$transaction_id){

		$this->Admin_model->rejectmoney($user_id,$amount,$transaction_id);

		$data['msg'] = 'ok';

		echo json_encode($data);

	}


	public function admin_render($view,$data = ''){
		$this->load->view('header');
		$this->load->view('ads');
		$this->load->view($view,$data);

		$user_ids = $this->Admin_model->chatdatauserlist();

		$chat_data['users_list'] = array();

		foreach ($user_ids as $user_id) {
			$temp['user_id'] = $user_id->user_id;
			$temp['seen'] = $user_id->adminseen;
			$ttemp = $this->Admin_model->getusername($user_id->user_id);
			foreach ($ttemp as $username) {
				$temp['username'] = $username->username;
			}
			

			array_push($chat_data['users_list'], $temp);
		}

		$this->load->view('chat',$chat_data);
		$this->load->view('footer');
	}

	function getmessages($user_id){

		$data['msgs'] = $this->Admin_model->getmessages($user_id);

		$seens = $this->Admin_model->isuserseen($user_id);
		foreach ($seens as $seen) {
			$data['seen'] = $seen->userseen;
		}
		echo json_encode($data);

	}

	function markseen($user_id){

		$this->Admin_model->markseen($user_id);
		$data['msg'] = "ok";
		echo json_encode($data);

	}

	function sendmessage($user_id){

		$data['message'] = $this->input->post('msg');
		$data['sender'] = $this->session->userdata('logged_in')['id'];
		$data['receiver'] = $user_id;

		$this->Admin_model->insertmsg($data);

		$data['msgsuccess'] = "yes";
		echo json_encode($data);

	}

	function getmsglist(){

		$user_ids = $this->Admin_model->chatdatauserlist();

		$chat_data = array();

		foreach ($user_ids as $user_id) {
			$temp['user_id'] = $user_id->user_id;
			$temp['seen'] = $user_id->adminseen;
			$ttemp = $this->Admin_model->getusername($user_id->user_id);
			foreach ($ttemp as $username) {
				$temp['username'] = $username->username;
			}
			

			array_push($chat_data, $temp);
		}

		echo json_encode($chat_data);

	}

	function nearbyshops(){

		$this->admin_render('nearbyshops');

	}

	function uploadshop(){

		$data['shop_name'] = $this->input->post('shop_name');
		$data['shop_type'] = $this->input->post('shop_type');
		$data['shop_city'] = $this->input->post('shop_city');
		$data['shop_lat'] = $this->input->post('shop_lat');
		$data['shop_long'] = $this->input->post('shop_long');

		if($data['shop_name']==''||$data['shop_type']==''||$data['shop_city']==''||$data['shop_lat']==''||$data['shop_long']==''){
			$this->session->set_flashdata('upload_shop',"enter something");
			$this->admin_render('nearbyshops');
		}

		$this->Admin_model->insertshop($data);

		$this->session->set_flashdata('upload_shop',"successfully inserted");
			$this->admin_render('nearbyshops');

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

			$cat_searches = $this->Admin_model->searchfor("womens",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "womens";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'men') !== false){

			$cat_searches = $this->Admin_model->searchfor("mens",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "mens";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'kid') !== false){

			$cat_searches = $this->Admin_model->searchfor("kids",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "kids";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'other') !== false){

			$cat_searches = $this->Admin_model->searchfor("others",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "others";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'electronic') !== false){

			$cat_searches = $this->Admin_model->searchfor("electronics",$words);
			if($cat_searches)
			foreach ($cat_searches as $cat_search) {
				$cat_search->{'user_type'} = "electronics";
				array_push($data['items'],$cat_search);
			}

		}
		else if(strpos($search_query, 'book') !== false){

			$cat_searches = $this->Admin_model->searchfor("books",$words);
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

		$company_search = $this->Admin_model->searchcompany("mens",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "mens";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->Admin_model->searchcompany("womens",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "womens";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->Admin_model->searchcompany("kids",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "kids";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->Admin_model->searchcompany("electronics",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "electronics";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->Admin_model->searchcompany("books",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "books";
				array_push($data['items'],$com_search);
			}
		}

		$company_search = $this->Admin_model->searchcompany("others",$words);
		if($company_search){
			foreach ($company_search as $com_search) {
				$com_search->{'user_type'} = "others";
				array_push($data['items'],$com_search);
			}
		}



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
		$this->load->view('products_view',$data);
		$this->load->view('chat');
		$this->load->view('footer');



	}

	public function itemdetails($user_type,$item_id){

		$this->load->view('header');
		$this->load->view('ads');
			$data['user_type'] = $user_type;
			$data['items']=$this->Admin_model->getitem($user_type,$item_id);
			$this->load->view('item_display',$data);
			$this->load->view('chat');
		$this->load->view('footer');

	}

	public function edititem($user_type,$id,$cat){

		$data['item_id'] = $id;
		$data['item_brand'] = $this->input->post('item_brand');
     	$data['item_cost'] = $this->input->post('item_cost');
     	$data['item_description'] = $this->input->post('item_description');
     	$data['item_category'] = $cat;
		$config = array(
			'upload_path' => './assets/images/shopme/'.$user_type.'/'.$cat.'/',
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000",
			'max_height' => "768",
			'max_width' => "1024",
			'file_name' => $id
			);
			if ( ! is_dir($config['upload_path']) ) die($config['upload_path']."THE UPLOAD DIRECTORY DOES NOT EXIST");
			$this->load->library('upload', $config);
			if($this->upload->do_upload('item_pic'))
				{
					$this->session->set_flashdata('edit_message','success');
					$data['item_path'] = $user_type.'/'.$cat.'/'.$this->upload->data()['file_name'];
					$this->Admin_model->edititem($user_type,$cat,$data);

				}
				else
				{
					$this->session->set_flashdata('edit_message', 'failed');
				}    
			
			redirect('admin/itemdetails/'.$user_type.'/'.$id,'refresh');
		
	}

	function deleteitem($user_type,$item_id){
		$this->Admin_model->deleteitem($user_type,$item_id);
		$data['msg'] = "ok";
		echo json_encode($data);
	}



}
