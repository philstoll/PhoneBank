<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {
	
	public $userId;
	public $fullName;

	public function __construct()
	{
		parent::__construct();
		
		
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
	
	public function index()
	{
		//Check if the time is a valid calling time.
		if(!$this->validate_time())
		{
			//If not redirect to the Offline location.
		}
		
		//print_r($this->session->all_userdata());
		//If the user id is stored in session then auto redirect to the home page.
		if($this->session->userdata('authUserId'))
		{
			redirect('home');
		}
		
		if (!$this->input->post('btnSignIn'))
		{		
			$this->load->view('signin_view');
		}
		else
		{
			$this->form_validation->set_rules('txtUsername', 'Username', 'required|callback_user_check');
			//$this->form_validation->set_rules('txtPassword', 'Password', 'required');
			
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('signin_view');
			}
			else
			{	
				$session = array(
						'authUserId' => $this->userId,
						'authName' => $this->fullName
				);
				
				$this->session->set_userdata($session);
				
				if($this->input->post('txtPassword') != 'liberty')
				{
					redirect('home/instructions');
				}
				else
				{
					redirect('credentials');
					
				}
			}
		}
				
	}
	
	
	public function user_check($value)
	{
		$sql = $this->db->where('Username', $value)->get('Users');
		$password = $this->input->post('txtPassword');
		
		if ($sql->num_rows > 0)
		{
			$row = $sql->row();
				
			if($row->Password === $password)
			{
		
				$result = $row;
			}
			else
			{
				$result = FALSE;
			}
		}
		else
		{
			$result = FALSE;
		}
		
		
		if(!$result)
		{
			$this->form_validation->set_message('user_check', 'Invalid username and password.');
			return FALSE;
		}
		else
		{
			$this->userId = $result->UserId;
			$this->fullName = $result->FullName;
			return TRUE;
		}
	}
	
	private function validate_time()
	{
		$valid = false;
		
		$day = date('w', strtotime('+2 hours'));
		$hour = date('G', strtotime('+2 hours'));
		$minute = intval(date('i', strtotime('+2 hours')));
		
		//echo $day . ' ' . $hour . ' ' . $minute;
		
		//echo date('h:i:s A', strtotime('+2 hours'));   //12 hour format
		//echo date('H:i:s', strtotime('+2 hours'));	//24 hour format
		
		switch ($day)
		{
			//Monday - Friday
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
				//Allow calling between 8am and 7:45pm
				if ($hour >= 8 && $hour < 20)
				{
					$valid = true;
					if($hour == 19 && $minute > 45)
					{
						$valid = false;
					}
				}
				break;
			case 6:		//Saturday
				//Allow calling until 6pm
				if ($hour >= 8 && $hour < 18)
				{
					$valid = true;
				}
				break;
			case 0:		//Sunday
				//Allow calling between 2pm and 6pm
				if ($hour >= 14 && $hour < 18)
				{
					$valid = true;
				}
				break;
			default:
				//code to be executed if n is different from both label1 and label2;
		}
		
		return $valid;
		
	}
}