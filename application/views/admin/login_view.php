<div align="center">
  
  <?php echo validation_errors('<p class="error">', '</p>'); ?> <?php echo form_open('whatthehell/verifylogin'); ?>
<?php /*?>  <label for="username">Username:</label><?php */?>  
<input type="input" size="20" id="username" name="username" value=""/>
  <br/>
  <?php /*?><label for="password">Password:</label><?php */?>
  <input type="password" size="20" id="passowrd" name="password" value=""/>
  <br/>
  <input type="submit" value="-----"/>
  </form>
</div>
