<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 * copyright All right reserved
 * Oct 31, 2010
 */
 
class RoomIndex_Model extends Spn_Model
{
	protected $_name = "rooms";

	public function getAvailabilityRoom($date)
	{
		$query = "select * from hsh_room_availabilitys where date='$date'";
		$bookedRoom = $this->_db->fetchAll($query);

		$rooms = $this->fetchAll();
		
		$data = array();
		foreach ($rooms as $r)
		{
			$tmp = $r;
			$tmp->is_booked = 0;
			foreach ($bookedRoom as $br)
			{
				if ($r->id == $br->room_id)
				{
					$tmp->is_booked = 1;
					break;
				}
			}
			$data[] = $tmp;
		}

		return $data;
	}
}


?>
