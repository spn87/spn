<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 * copyright All right reserved
 * Nov 6, 2010
 */
 
class RoomaA_Model extends Spn_Model
{
	protected $_name = "room_availabilitys";
	public function addBooking($rid, $date)
	{
		
		$this->bind(array("room_id"=>$rid,"date"=>$date,"is_booked"=>1));
		$this->addBind();
		
	}
	
	public function deleteBooking($rid, $date)
	{
		$this->delete("room_id='$rid' AND date='$date'");
	}
	
	public function availableFor($startDate, $endDate, $person)
	{
		//$query = "SELECT * FROM hsh_room_availabilitys WHERE `date` BETWEEN '$startDate' AND '$endDate' AND `is_booked`=1";
		$rooms = $this->fetchAll("`date` BETWEEN '$startDate' AND '$endDate' AND `is_booked`=1");
		
		$notAvailableRooms = array();
		foreach ($rooms as $r)
		{
			
			$notAvailableRooms[] = $r->room_id;
		}
		$notAvailableRooms = implode(",",$notAvailableRooms);
		if ($notAvailableRooms != "")
			$query = "SELECT * FROM hsh_rooms WHERE id NOT IN ($notAvailableRooms)";
		else
			$query = "SELECT * FROM hsh_rooms";
		
		$availableRooms = $this->_db->fetchAll($query);
		//print_r($availableRooms);
		$totalPersonAvailable = 0;
		foreach ($availableRooms as $r)
		{
			$totalPersonAvailable += $r->guest_num;
		}
		
		if ($totalPersonAvailable >= $person)
		{
			return true;
		}
		return false;
	}
}
?>