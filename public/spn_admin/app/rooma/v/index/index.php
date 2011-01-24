<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 * copyright All right reserved
 * Nov 1, 2010
 */
 

?>
<script>
$(function(){
	$("#sbDate").datepicker({"dateFormat":"yy-mm-dd"});
	$("#search").click(function(){
		window.location = "?m=rooma&date="+($("#sbDate").val());
	});
});
</script>
<h2>Room availability</h2>
<div style="padding-bottom:20px;">
	Search date: <input name="date"type="text" id="sbDate" value="<?php echo $this->date; ?>"/> <input type="button" value="Search" id="search" />
</div>


<table width="100%" border="1px" cellspacing="0">
	<tr>
		<th>No</th>
		<th>Room num</th>
		<th>Available</th>
		<th>Booking</th>
	</tr>
<?php
	$i = 0;
	foreach ($this->rooms as $r): $i++;
	
?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $r->room_num;?></td>
		<td><?php echo ($r->is_booked) ? "<span style='color:green;'>Available</span>":"<span style='color:red;'>Not available</span>"?></td>
		<td>
		<?php if ($r->is_booked):?>
		<a href="javascript:void(0);" onclick="deleteBooking(<?php echo $r->id?>,'<?php echo $this->date?>')">Delete booking</a>
		<?php else: ?>
		<a href="?m=rooma&amp;a=add&amp;rid=<?php echo $r->id ?>&amp;date=<?php echo $this->date;?>">Add booking</a>
		<?php endif;?>
		</td>
<?php	endforeach; ?>
	</tr>
</table>
<script>
function deleteBooking(id, date)
{
	if (confirm("Are you sure?"))
	{
		window.location = "?m=rooma&a=delete&rid="+id+"&date="+date;
	}
}
</script>