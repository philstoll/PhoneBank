<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin_model extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function verify_user($username, $password)
	{
		
		$sql = $this->db->where('Username', $username)->get('Users');
		
		
		if ($sql->num_rows > 0)
		{
			$row = $sql->row();
			
			if($row->Password === $password)
			{
				
				return $row;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
		
		
	}
}