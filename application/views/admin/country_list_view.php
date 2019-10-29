<div align="center">
  <h3>Admin Panel</h3>
  your ip address is <?php echo $this->input->ip_address();?>
  
  <?php  echo form_open('whatthehell/people');?>
  <?php if ($selected==0 and $first== FALSE){echo'<p class="error"> Please select a country!   ';}?>
  <select name="country">
    <option value="0">select a country</option>
    <?php foreach ($list as $row):?>
    <option <?php if ($row->active==0) { ?> class="unactive"<?php } ?> value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
    <?php endforeach;?>
  </select>
  <?php echo form_submit(array('name'=>'submit'),'select');?>
  <?php echo form_close();?>
  <a style=" margin-right:20px" href="<?php echo base_url(); echo index_page();?>/whatthehell">Home</a>
  <a href="<?php echo base_url(); echo index_page();?>/whatthehell/logout">Logout</a> 
  <p>
</div>
