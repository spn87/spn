<?php require_once dirname(__FILE__)."/../../conf/conf.php";?>
<div style="border:1px solid #ccc; background:#eee; width:500px; margin:0px auto; padding:25px;">
	<div style="margin-bottom:15px; font-size:20px;">Welcome to <?php echo SITE_NAME?></div>
	<form action="index.php?m=login" method="post">
		<div class="tbl"><label for="u">Username:</label> <input type="text" name="u" id="u" /></div>
		<div class="tbl"><label for="p">Password:&nbsp;</label> <input type="password" name="p" id="p" /></div>
		<div class="tbl"><input type="submit" value="Submit" /></div>
	</form>
</div>
<style>
.tbl
{
	margin-bottom:5px;
}
.tbl label
{
	color:gray;
}
</style>