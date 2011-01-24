<h1>Artist form</h1>
<?php $artist = $this->artist;

?>

<form method="post" action="index.php?m=artist&a=update">
<?php 
echo $this->editForm;
?>
</form>
<script>
$(function(){
	$("#btnCancel").click(function(){
		window.location = "index.php?m=artist";
	});
});
</script>