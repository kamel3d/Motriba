<div id="wrapper">
        <div class="footer" <?php if ($home){?>style="border-top:none"<?php }?>>
         Motriba.com © <?php echo date("Y");?>
        <ul>
            <li><a href="<?php echo reduce_double_slashes(site_url()."/about");?>">About</a></li> -
            <li><a href="<?php echo reduce_double_slashes(site_url()."/privacy");?>">Privacy</a></li> -
            <li><a href="<?php echo reduce_double_slashes(site_url()."/contact");?>">Contact</a></li> -
            <li><a href="http://on.fb.me/Hl8pXI">Facebook</a></li> -
            <li><a href="http://bit.ly/HnGUwR">Twitter</a></li>
         </ul>
        </div>
    </div>
<!--<script src="http://cdn.wibiya.com/Toolbars/dir_1159/Toolbar_1159676/Loader_1159676.js" type="text/javascript"></script><noscript><a href="http://www.wibiya.com/">Web Toolbar by Wibiya</a></noscript> 
-->
<?php if (!$home){?>
<!--feedback script-->
<style type='text/css'>@import url('http://getbarometer.s3.amazonaws.com/assets/barometer/css/barometer.css');</style>
<script src='http://getbarometer.s3.amazonaws.com/assets/barometer/javascripts/barometer.js' type='text/javascript'></script>
<script type="text/javascript" charset="utf-8">
  BAROMETER.load('5Fp8sLy6R7ehgOyTzn9AN');
</script>
<?php }?>
</body>
</html>