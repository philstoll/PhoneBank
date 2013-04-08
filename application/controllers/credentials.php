<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credentials extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
	
	public function index()
	{
		
		
		if (!$this->input->post('btnSubmit'))
		{
			$data['userid'] = $this->session->userdata('authUserId');
			
			$this->session->unset_userdata('authUserId');
			$this->session->unset_userdata('authName');
			
			$this->load->view('credentials_view', $data);
		}
		else
		{
			$this->form_validation->set_rules('txtFirstName', 'First Name', 'required|max_length[20]|xss_clean');
			$this->form_validation->set_rules('txtLastName', 'Last Name', 'required|max_length[30]|xss_clean');
			$this->form_validation->set_rules('txtPassword', 'Password', 'required|min_length[6]|max_length[12]|alpha_dash');
			$this->form_validation->set_rules('txtConfirmPassword', 'Confirm Password', 'required|matches[txtPassword]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('credentials_view');
			}
			else
			{
				$this->load->model('user_model', 'User');
				
				$userid = $this->input->post('hddnUserId');
				$fullname = $this->input->post('txtFirstName') . ' ' . $this->input->post('txtLastName');
				$password = $this->input->post('txtPassword');
				
				
				$updated = $this->User->update_user_id($userid, $fullname, $password);
				
				$session = array(
						'authUserId' => $userid,
						'authName' => $fullname
				);
				
				$this->session->set_userdata($session);
				
				redirect('home/instructions');
			}
		}
	}
}