<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="addedit">
<h3>Add new person to <?php echo $country; ?></h3>
<hr>


<table class="dataform" cellspacing="10" border="0" cellpadding="0">
  <?php // echo validation_errors(); ?>
  <?php echo form_open_multipart('/whatthehell/add_people'); ?>
    
    <tr>
      <td class="dataform"><img src="<?php echo base_url()?>images/smal/person_s.jpg" width="100" height="100" border="1">
      </td> <td class="dataform"><?php echo $error;?> Upload picture (200X200px)
	  <input type="file" name="userfile" size="20" />
	  <?php //echo form_upload();?></td>
      
    </tr>
    <tr>
      <td class="dataform">Full Name :</td> <td class="dataform"><?php
	  echo form_error('fullname','<p class="error">', '</p>');//show error message in case of error
	  $namedata = array(
              'name'        => 'fullname',
              'id'          => '',
              'value'       => set_value('fullname'),
              'maxlength'   => '100',
              'size'        => '20',
              'style'       => 'width:100%',
            ); 
	  echo form_input($namedata);?></td>
    </tr>
    <tr>
      <td class="dataform">Sex:</td> <td class="dataform">Male<?php echo form_radio('sex', 'male', TRUE);?> 
           Female<?php echo form_radio('sex', 'female', FALSE);?></td>
    </tr>
    <tr>
      <td class="dataform">Description :</td> <td class="dataform"><?php 
	  echo form_error('description','<p class="error">', '</p>');//show error message in case of error
	  $desdata = array(
              'name'        => 'description',
              'id'          => '',
              'value'       => set_value('description'),
              'maxlength'   => '200',
              'size'        => '20',
              'style'       => 'width:100%',
            );
	  echo form_input($desdata);?> </td>
    </tr>
    <tr>
      <td class="dataform">Wikipedia Link :</td> <td class="dataform"><?php 
	  echo form_error('wlink', '<p class="error">', '</p>');//show error message in case of error
	  $wlinkdata = array(
              'name'        => 'wlink',
              'id'          => '',
              'value'       => set_value('wlink'),//get value back in case of correct and others false
              'maxlength'   => '200',
              'size'        => '20',
              'style'       => 'width:100%',
            );
	  echo form_input($wlinkdata);?></td>
    </tr>
    <tr>
      <td class="dataform">Main person</td> <td class="dataform"><?php echo form_checkbox('defult', 'defult', FALSE);?></td>
    </tr>
    

	<?php $idmain = '';// cleaning
         if ($query){ 
		 $idmain = $query->id; //main equal the id of the maon person 
		 ?>
		<tr> <td align="right"><img src="<?php echo base_url()?>images/smal/person_S_<?php echo $query->id;?>.jpg" width="50" height="50" border="1"></td><td class="worning">Main person in <?php echo $country; ?> is  
      
         <br><b><?php echo $query->name ;?></b>
    </td></tr>
		
		 <?php }?>
    
    
    
    <tr>
      <td class="dataform">Active</td> <td class="dataform"><?php echo form_checkbox('active', 'active', FALSE);?></td>
       <?php // here i should add a worning box to tell that some one else is the main person if that existes ?>
    </tr>
    <tr>
      <td class="dataform"></td> <td class="dataform"><?php echo form_submit('submit', 'Submit');?></td>
    </tr>
    <?php // this hidden filed is just to save the country name and id we where adding to, in case of the mistakes while feeling the form ?>
   <?php  
   $backdata = array(
                     'country'  => $country,
                     'countryid' => $countryid,
					 'idmain'=> $idmain
			        );
               
   
   echo form_hidden($backdata);?>
   
   
   <?php echo form_close();?>
</table>

</div>