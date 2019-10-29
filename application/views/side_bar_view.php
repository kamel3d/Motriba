<?php 
      // make sure before you upload this to server you remove slashes / before country 
      // and you should leave them for the local host version 
?>
<div class="same-country">
  People from same country
</div>
<div class="suggetion">
  
  <?php foreach ($other_people as $row):?>
  <div class="sugest">
  <table border="0">
  <tr>
    <th><a href="<?php echo reduce_double_slashes(site_url()."/country/").$country_uri."/".url_title(trim($row['name']));?>"> <img src="<?php echo base_url();?>/images/smal/person_S_<?php echo $row['id'];?>.jpg" width="50" height="50" alt="<?php echo $row['name'];?>" dynsrc=""></a></th>
    <th class="table-text"><div class="sugest-text"> <strong> <a href="<?php echo reduce_double_slashes(site_url()."/country/").$country_uri."/".url_title(strtolower ( trim($row['name'])));?>"> <?php echo $row['name'];?> </a> </strong></div>
      <br><span><?php echo $row['description'];?></span> </th>
  </tr>
  
</table>
  
    
  </div>

<?php endforeach; ?>
</div>