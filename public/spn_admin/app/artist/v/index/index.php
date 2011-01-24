<h2>Artist Management</h2>
<div><a href="index.php?m=artist&a=add">Add new artist</a></div>
<?php $user = $this->artists;?>
<table class="grid" width="100%">
	<tr>
		<th>No</th>
		<th>Name</th>
		<th>Email</th>
		<th>Tel</th>
		<th colspan="2">Operation</th>		
	</tr>
	<?php $i=0;foreach ($user as $u):?>
	<tr>
		<td><?php echo ++$i;?></td>		
		<td><?php echo $u->name;?></td>
		<td><?php echo $u->tel;?></td>
		<td><?php echo $u->email;?></td>		
		<td><a href="index.php?m=artist&a=edit&id=<?php echo $u->id;?>">Edit</a></td>
		<td><a href="javascript:void(0);" onclick="deleteUser(<?php echo $u->id;?>);">Delete</a></td>
	</tr>
	<?php 
		
	endforeach;
	?>
</table>
<script>
function deleteUser(id)
{
	if(confirm("Are you sure you want to delete?"))
	{
		window.location = "index.php?m=artist&a=delete&id="+id;
	}
}
</script>