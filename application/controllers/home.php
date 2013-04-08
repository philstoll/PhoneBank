<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


	
	public function __construct()
	{
		parent::__construct();
		
		
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}
	
	public function index($instructions=FALSE, $errorMessage='')
	{
		if($this->session->userdata('authUserId'))
		{
			$this->load->model('caller_model', 'Caller');
			
			//If the form was posted
			if ($this->input->post('btnSave'))
			{
				$result = '';
				
				if ($this->input->post('main_choice') == 'rbtnNoAnswer')
				{
					if ($this->input->post('sub_1'))
					{
						$result = 'VM';
					}
					else
					{
						$result = 'NA';
					}
				}
				else
				{
					if($this->input->post('sub_2') == 'rbtnPositive')
					{
						$result = 'PO';
					}
					elseif($this->input->post('sub_2') == 'rbtnNeutral')
					{
						$result = 'NT';
					}
					elseif($this->input->post('sub_2') == 'rbtnNegative')
					{
						$result = 'NE';
					}
					elseif($this->input->post('sub_2') == 'rbtnWrongNumber')
					{
						$result = 'WN';
					}
					elseif($this->input->post('sub_2') == 'rbtnHelp')
					{
						$result = 'HC';
					}
					elseif($this->input->post('sub_2') == 'rbtnOther')
					{
						$result = 'OT';
					}
				}
				
				$comment = '';
				
				if ($this->input->post('txtComment') != 'Enter Comment...')
				{
					$comment = $this->input->post('txtComment');
				}
				
				if ($result == '')
				{
					redirect('home/error');
				}
				else
				{
					$phoneId = $this->input->post('hddnPhoneId');
					
					$updated = $this->Caller->update_phone_number($phoneId, $result, $comment, $this->session->userdata('authUserId'));
				
					redirect('home');
				}
			}
			
			
			
			// Gets the next phone number to call;
			$this->Caller->build_user_call_queue($this->session->userdata('authUserId'));
			$phoneResult = $this->Caller->get_next_phone_number($this->session->userdata('authUserId'));
			
			$data['phone_number'] = $phoneResult[0]->PhoneNumber;
			$data['phone_id'] = $phoneResult[0]->PhoneId;
			$data['user_name'] = $this->session->userdata('authName');
			$data['instructions'] = $instructions;
			$data['error'] = $errorMessage;
			
			//reset errorMessage
			$this->errorMessage = '';
			
			// Gets the caller names associated with the phone number retrieved above.
			$data['callers'] = $this->Caller->get_callers_by_phone_number($phoneResult[0]->PhoneNumber);
			
			
			$this->load->view('home_view', $data);
		}
		else
		{
			redirect('signin');
		}		
	}
	
	public function instructions()
	{
		$this->index(TRUE);
	}
	
	public function error()
	{
		$errorMessage = '<p class="error">Save Failed! Please select the best fitting call result. If nothing matches, select <b>Other</b> and enter a comment.</p>';
		$this->index(FALSE, $errorMessage);
	}
	
	public function form_check($value)
	{
		
		if($value == '')
		{
			$this->form_validation->set_message('form_check', 'Please select the best fitting call result. If nothing matches, select Other and Enter a comment.');
			return FALSE;
		}
		elseif($value == 'AN')
		{
			$this->form_validation->set_message('form_check', 'Please select a sub-category of Answered.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function loaddata()
	{
		//$this->load->helper('file');
		$count = 0;
		
		//$file_handle = fopen('http://stollsoftware.com/mitch.csv', 'r');
		while (!feof($file_handle)) {
			$count++;
			
				$line = fgets($file_handle);
				$array = explode( '|', $line);
				if(count($array) == 11)
				{
					$sql = 'INSERT INTO CallerList (LastName,FirstName,MiddleName,Address1,City,State,Zip,Zip4,Address2,Phone,SourceId) ';
					$sql .= "VALUES ('$array[0]','$array[1]','$array[2]','$array[3]','$array[4]','$array[5]','$array[6]','$array[7]','$array[8]','$array[9]'," . trim($array[10]) . ")";
					
					//$query = $this->db->query($sql);
				
				}
				else
				{
					//echo $line . ' --- ' . $count . '<br/>';
				}
		}
		fclose($file_handle);
		
		//echo 'Doneski';
	}
	
	public function geocode()
	{
		$count = 0;
		$this->load->model('caller_model', 'Caller');
		
		$results = $this->Caller->get_all_voters();
		
		
		foreach($results as $caller)
		{
			$address = $caller->Address1 . '; ' . $caller->City . ', ' . $caller->State . ' ' . $caller->Zip . '-' . $caller->Zip4;
			
			if (!is_string($address))die("All Addresses must be passed as a string");
        $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
        $_result = false;
        if($_result = file_get_contents($_url)) {
                if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
                preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
                $_coords['lat'] = $_match[1];
                $_coords['long'] = $_match[2];
                
                $this->Caller->update_caller($caller->CallerId, $_coords['lat'], $_coords['long']);
                
                echo $count++ . ') ' . $address . ' -- ' . $_coords['lat'] . ' | ' . $_coords['long'] . '<br/>';
        }
			
			
			
			
		
		}exit;
		
	}

	
	
}