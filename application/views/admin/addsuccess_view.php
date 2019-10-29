<div class="result" >
<h3>New person was succefully added</h3>
 <table align="center" border="0">
  <tr>
    <th><img src="<?php echo base_url()?>images/big/person_L_<?php echo $id ;?>.jpg" width="200" height="200" border="0"></th>
    <th align="left"><ul>

<li><?php echo'country: <FONT COLOR="red">'. $country;?></FONT>
<li><?php echo'name: <FONT COLOR="red">'. $name;?></FONT>
<li><?php echo 'description: <FONT COLOR="red">'.$description;?></FONT>
<li><?php echo 'wikipedia: <FONT COLOR="red">'.$wlink;?></FONT>
<li><?php echo 'sex: <FONT COLOR="red">'.$sex;?></FONT>
<li><?php echo 'main person in the country: <FONT COLOR="red">'; if($defult){echo 'YES';}else{echo 'NO';};?></FONT>
<li><?php echo 'enabled: <FONT COLOR="red">'; if($active){echo 'YES';}else{echo 'NO';};?></FONT>

</ul></th>
  </tr>
</table>
<?php // echo anchor(site_url().'/admin','Home');?>
</div>