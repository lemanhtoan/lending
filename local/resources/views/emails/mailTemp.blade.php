<h2>Email template</h2>
<?php 
if (count($arrNotfound)) {
	$i=0;
	foreach ($arrNotfound as $item) { $i++; ?>
	<p><?php echo $i;?>. <?php echo $item['id'];?></p>
<?php } }
?>