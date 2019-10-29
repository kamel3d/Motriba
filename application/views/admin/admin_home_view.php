<div align="center">
<p> <?php echo form_open('/whatthehell/active_site');?>
	site is :<?php if($site)
	{   ?>Active <?php echo form_submit(array('name'=>'active'),'deactivate it');?>   
	<?php } else { ?> NOT Active <?php echo form_submit(array('name'=>'active'),'activate it');?> 
	<?php } 	
	echo form_close();?>
    </p>
</div>