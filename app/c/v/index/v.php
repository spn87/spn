<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010
 * @package: 
 * Blog: souphorn.blogspot.com
 * Date: Jan 25, 2011 9:02:51 AM
 * 
 */

$row = $this->row;
?>

<h1><?php echo $row->title;?></h1>
<div style="font-size:small;"><span><?php echo $row->creator;?></span></div>
<div>
<?php echo $row->content;?>
</div>