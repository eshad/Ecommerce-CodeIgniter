<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Account extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Account_model');
		$this->load->library("form_validation");
    } 

	
	function login()
	{
		
		if(IsAdminLogin()==TRUE)
		{			
			$this->load->view("admin/dashboard");
		}
		
		
		
		
		$this->form_validation->set_rules('username1', 'Username', 'required');
		$this->form_validation->set_rules('password1', 'Password', 'required');

		
		
		//die();
		if($this->form_validation->run() == TRUE)
		{
			
			$userName = $this->input->post("username1");
			$password = md5($this->input->post("password1"));
			
			
			if($this->Account_model->Login($userName,$password)==TRUE)
			{
				$this->session->set_userdata("login",array("username"=>$userName,"isLogin"=>TRUE));				
				redirect("admin/dashboard");
			}
			else{
				$data["cserror"]="username or password is wrong";
				$this->load->view("admin/account/login",$data);	
			}
		}
		else{
			$data["cserror"]="";
			$this->load->view("admin/account/login",$data);	
		}
		
	}
	
	function logout()
	{		
		$this->session->unset_userdata("login");
						redirect("admin/account/login");

	}
	
    
}