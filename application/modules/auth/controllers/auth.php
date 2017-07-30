<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
 	{
	   parent::__construct();
	   $this->load->database();
     $this->load->model('Auth_model');
	   $this->load->helper(array('form','url'));
	   $this->load->library('form_validation');
	   
 	}
 
 function index()
 {
   if($this->session->userdata('logged_in')){
        $session_data = $this->session->userdata('logged_in');
        if($session_data['admin'] == '1')
        redirect('admin','refresh');
        else redirect('user','refresh');
     }
     $this->load->view('auth/login_view');
 }

 function verifylogin()
 {
     $username = $this->input->post('username');
     $password = $this->input->post('password');
     $result = $this->Auth_model->login($username, $password);
      if($result)
     {
       $sess_array = array();
       foreach($result as $row)
       {
         $sess_array = array(
           'id' => $row->id,
           'username' => $row->username,
           'admin' => $row->admin,
           'wallet' => $row->wallet,
           'user' =>'user'
         );
          if($sess_array['admin']==1)$sess_array['user']='admin';
         $this->session->set_userdata('logged_in', $sess_array);
         $this->Auth_model->viewincrement($sess_array['id']);

       }

       $viewss = $this->Auth_model->getviews();
        $view_array = array();
          if($viewss)
          foreach ($viewss as $views) {
            $view_array['views'] = $views->vws;
          }
          $this->session->set_userdata('views',$view_array);
       redirect('auth', 'refresh');
     }
     else
     {
       $this->session->set_flashdata('login_message', 'Invalid username or password');
       redirect('auth', 'refresh');
     }
 }
 
 function logout()
  {
     $this->session->unset_userdata('logged_in');
     $this->session->sess_destroy();

     redirect('auth','refresh');
  }

 function register(){

  if($this->session->userdata('logged_in')){
        $session_data = $this->session->userdata('logged_in');
        if($session_data['admin'] == '1')
        redirect('admin','refresh');
        else redirect('user','refresh');
     }
  
 	$this->load->view('register_view');
 }


 function verifyregister()
	 {
      $success = true;
	    $username=$this->input->post('username');
	    $password=$this->input->post('password');
      $conpassword = $this->input->post('conpassword');
      $emailid=$this->input->post('emailid');
      if($username==''||$password==''||$emailid==''){
        $this->session->set_flashdata('register_message','enter your details');
        $success = false;
      }
      if($conpassword!=$password){
        $this->session->set_flashdata('register_message','password does not match with conform password');
        $success = false;
      }
	    
      if($success&&$this->Auth_model->isexists($username,$emailid)){
        $success = false;
        $this->session->set_flashdata('register_message','username or emailid already exists');
      }

      $last_id = $this->Auth_model->getmaxid();
      if($last_id)
    foreach ($last_id as $ids) {
      $id = $ids->last_id;
    }
    if(!$last_id) $id=1;
    else $id++;

      $config = array(
      'upload_path' => './assets/images/users',
      'allowed_types' => "gif|jpg|png|jpeg|pdf",
      'overwrite' => TRUE,
      'max_size' => "2048000",
      'max_height' => "2000",
      'max_width' => "2000",
      'file_name' => $id
      );
      if ( ! is_dir($config['upload_path']) ){
        $this->session->set_flashdata('register_message', 'THE UPLOAD DIRECTORY DOES NOT EXIST');
          $success = false;
        } 
      $this->load->library('upload', $config);
      if($this->upload->do_upload('user_pic'))
        {
          $image_path = $this->upload->data()['file_name'];

        }
        else
        {
          $this->session->set_flashdata('register_message', 'image upload failed');
          $success = false;
        }    

      if($success){

         $this->Auth_model->add_user($id,$username,$password,$emailid,$image_path);
         $this->session->set_flashdata('register_message','successfully registered');
          redirect('auth', 'refresh');

      }
      else{
        redirect('auth/register', 'refresh');
      }
	  

	 }


}
