<div class="edit">
<h3>Edit person</h3>
<hr>
<table align="center" class="dataform" cellspacing="15" border="0" cellpadding="5">
     <?php // echo validation_errors(); ?>
     <?php echo form_open_multipart('/whatthehell/edit_people'); ?>
    
     <tr>
     <td class="dataform"></td>
     <td class="dataform">
     <img src="<?php echo base_url()?>images/big/person_L_<?php echo $query->id;?>.jpg" width="200" height="200" border="0" />
     <?php $this->upload->display_errors('<p class="error">', '</p>');?>
	 <br> <input type="file" name="userfile" size="20"/>
	 
     </td>
     </tr>
     <tr>
     <td class="dataform">Full Name :</td>
     <td class="dataform">
	 
	 <?php if ($first_time== TRUE)
	 {?>
    <input type="text" name="fullname" value="<?php echo $query->name;?>" size="30" /><?php 
	} else 
	{ echo form_error('fullname','<p class="error">', '</p>');//show error message in case of error ?>
	<input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>" size="30" /> 
	
	<?php }?>
      
      
    </td>
    </tr>
    <tr>
    <td class="dataform">Sex:</td>
    <td class="dataform">Male<?php
	    if($query->sex =='male') {echo form_radio('sex', 'male', TRUE);?> 
           Female<?php echo form_radio('sex', 'female', FALSE);}
		if($query->sex =='female') {echo form_radio('sex', 'male', FALSE);?> 
           Female<?php echo form_radio('sex', 'female', TRUE);}?>
    </td>
    </tr>
    <tr>
      <td class="dataform">Description :</td> <td class="dataform">
	   <?php if ($first_time== TRUE)
	 {?>
    <input type="text" name="description" value="<?php echo $query->description;?>" size="30" /><?php 
	} else 
	{ echo form_error('description','<p class="error">', '</p>');//show error message in case of error ?>
	<input type="text" name="description" value="<?php echo set_value('description'); ?>" size="30" /> 
	
	<?php }?>
      </td>
    </tr>
    <tr>
      <td class="dataform">Wikipedia Link :</td><td class="dataform">
	  <?php if ($first_time== TRUE)
	 {?>
    <input type="text" name="wlink" value="<?php echo $query->wlink;?>" size="30" /><?php 
	} else 
	{ echo form_error('wlink','<p class="error">', '</p>');//show error message in case of error ?>
	<input type="text" name="wlink" value="<?php echo set_value('wlink'); ?>" size="30" /> 
	
	<?php }?>
    </td>
    </tr>
    <tr>
      <td class="dataform">Main person</td>
      <td class="dataform">
	  <?php 
	  if($query->defult=='TRUE') { echo form_checkbox('defult', 'defult', TRUE);}
	  if($query->defult=='FALSE'){ echo form_checkbox('defult', 'defult', FALSE);}
	  ?>
      </td>
    </tr>
 
 <?php $idmain = '';// cleaning
         if ($main_person and ($main_person->id!=$query->id)){ 
		 $idmain = $main_person->id; //main equal the id of the maon person 
		 ?>
		<tr> <td align="right"><img src="<?php echo base_url()?>images/smal/person_S_<?php echo $main_person->id;?>.jpg" width="50" height="50" border="1"></td><td class="worning">Main person in <?php echo $country_data->name; ?> is  
      
         <br><b><?php echo $main_person->name ;?></b>
    </td></tr>
		
		 <?php }?>
 
    
    <tr>
      <td class="dataform">Active</td>
      <td class="dataform">
	  <?php if($query->active=='TRUE'){ echo form_checkbox('active', 'active', TRUE);}
	        if($query->active=='FALSE'){ echo form_checkbox('active', 'active', FALSE);}
	  ?>
      </td>
       <?php // here i should add a worning box to tell that some one else is the main person if that existes ?>
    </tr>
    <tr>
    <td class="dataform">
	<?php echo anchor('admin','Cancel');?></td>
    <td align="right" class="dataform"><?php echo form_submit('submit', 'Submit');?></td>
    </tr>

<?php
 $backdata = array(
                     'country'=> $country,// to return the county id back
					 'person'  => $query->id,
                     'first_time'=> FALSE
			        ); 
echo form_hidden($backdata);
echo form_close();?>
</table>
</div>