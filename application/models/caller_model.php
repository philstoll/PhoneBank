<?php
class Caller_model extends CI_Model {

	var $title   = '';
	var $content = '';
	var $date    = '';

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_all_voters()
	{
		$sql = "SELECT CallerId, FirstName, LastName, Address1, City, State, Zip, Zip4 FROM CallerList WHERE Latitude IS NULL;";
		$query = $this->db->query($sql);
		//print_r($query);die;
		return $query->result();
	}
	
	public function build_user_call_queue($userId)
	{
		// Check to see the queue count for the user
		$sql = "SELECT COUNT(*) AS Count FROM PhoneNumbers WHERE Status = 'Q$userId';";
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		$count = $result[0]->Count;
		
			
		$limit = 5 - $count;
		
		if($limit > 0)
		{
			$sql = "SELECT PhoneId FROM PhoneNumbers WHERE Status IS NULL ORDER BY PhoneId LIMIT $limit";
			$query = $this->db->query($sql);
			
			$select = '';
			
			foreach($query->result() as $phone)
			{
				$select .= "'" . $phone->PhoneId . "',";
				
			}
			
			$select = substr_replace($select ,"",-1);
			
			
			$this->update_phone_status($userId, $select);
		}
	}
	
	public function get_next_phone_number($userId)
    {
    	$sql = "SELECT PhoneId, PhoneNumber FROM PhoneNumbers WHERE Status = 'Q$userId' ORDER BY PhoneId LIMIT 1;";
        $query = $this->db->query($sql);
        //print_r($query);die;
        return $query->result();
    }
    
    public function get_callers_by_phone_number($phoneNumber)
    {
    	$sql = "SELECT FirstName, LastName, MiddleName FROM CallerList WHERE Phone = '" . $phoneNumber . "';";
    	$query = $this->db->query($sql);
    	
    	//print_r($query);die;
    	return $query->result();
    }
    
    private function update_phone_status($userId, $select)
    {
    	$sql = "UPDATE PhoneNumbers SET Status = 'Q$userId' WHERE PhoneId IN ($select)";
    	$query = $this->db->query($sql);
    }
    
    public function update_phone_number($phoneId, $status, $comment, $userId)
    {
    	$sql = "UPDATE PhoneNumbers SET Status = '$status', Comment = '$comment', UserId = $userId, CallTime = NOW() WHERE PhoneId = $phoneId";
    	$query = $this->db->query($sql);
    }
    
    public function update_caller($callerId, $lat, $long)
    {
    	$sql = "UPDATE CallerList SET Latitude = '$lat', Longitude = '$long' WHERE CallerId = $callerId";
    	$query = $this->db->query($sql);
    }
}