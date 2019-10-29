<div class="list">
<h3>list of people in <?php echo $country_data->name; ?></h3>
<table border="0"  align="center"  cellpadding="10" cellspacing="2">
    <tr><td>  
        <?php echo form_open('/whatthehell/add_people');//send form to funtion of adding new people 
		echo form_submit(array('name'=>'add'),'add new person');
		echo form_hidden('country',$country_data->name); // send the selected country name
		echo form_hidden('countryid',$selected);
		echo form_close();?>
		</td>
    <?php if (!$empty) {?>
    <td>    
	<?php echo form_open('/whatthehell/active_country');?>
	<?php echo $country_data->name; ?> is :<?php if($country_data->active)
	{   ?>Active <?php echo form_submit(array('name'=>'active'),'deactivate it');?>   
	<?php } else { ?> NOT Active <?php echo form_submit(array('name'=>'active'),'activate it');?> 
	<?php } 
	echo form_hidden('countryid',$selected);
	echo form_close();?>
    </td>
    <?php }?>
    
    
    </tr>
    </table>
    <table border="0"  align="center"  cellpadding="10" cellspacing="2">
<?php if (!$empty) {?>
  <?php foreach ($people as $row):?>
    <tr class="people">
      <td>ID: <?php echo $row['id'];?></td>
      <td><a href="<?php echo base_url();?>/images/big/person_L_<?php echo $row['id'];?>.jpg""><img src="<?php echo base_url();?>/images/smal/person_S_<?php echo $row['id'];?>.jpg" width="50" height="50" alt="<?php echo $row['name'];?>" dynsrc="">
      </a> </td>
      <td><?php echo $row['name'];?></td>
      <td><?php echo $row['description'];?></td>      
      <td><a href="<?php echo $row['wlink'];?>">Wikepida</a></td>
      <?php if ($row['defult']=='TRUE'){?>
      <td class="worning">Main</td> 
	  <?php } else {?>
      <td>-</td>
	         <?php }?>
     
      <?php if ($row['active']=='TRUE'){?>
      <td class="active">Active</td> 
	  <?php } else {?>
      <td>Unactive</td>
	         <?php }?>
     
     

     
     
     
      <td bgcolor="#DDDDDD">
	  <?php  echo form_open('/whatthehell/edit_people');//opening a form to edit people 
       echo form_hidden('person', $row['id']);//sending the person id
	   echo form_hidden('country', $selected);//sending the country id
	   echo form_hidden('first_time', TRUE );
	   
	   //echo form_hidden($row['id']);
	   echo form_submit(array('name'=>'edit'),'edit');
	   //the name of button sublim is the same id of the person
       
	   echo form_close();// end of the form?>
      </td>
    </tr>
   <?php endforeach;?>
</table>
<?php 
}
else { echo '<p class="error"> no people were aded to this country yet </p>';}

 ?>

</div>