<div style="margin:0 auto; width: 700px; border:1px solid #ccc; text-align:left; padding: 30px;">
<?php foreach ($this->contents as $c):?>
<h2><a href="c/<?php echo $c["url"]?>"><?php echo $c["title"]?></a></h2>
<div><?php echo $c["content"]?></div>
<div style="border-bottom:1px dashed #ccc;">&nbsp;</div>
<?php endforeach;?>
</div>