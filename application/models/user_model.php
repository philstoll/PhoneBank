<?php
class User_model extends CI_Model {

	var $title   = '';
	var $content = '';
	var $date    = '';

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
    
    public function update_user_id($userId, $fullname, $password)
    {
    	$sql = "UPDATE Users SET Password = '$password', FullName = '$fullname' WHERE UserId = $userId";
    	$query = $this->db->query($sql);
    }
}