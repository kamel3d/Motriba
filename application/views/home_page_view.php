<div class="world-map">
  <div class="wmap">
    <p class="big-p">Vote for any leader in the world<br>
      from any where in the world.</p>
    	<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });                    
            $(".dropdown dd ul li a").click(function() {
                var ctryname = $(this).html();
                $(".dropdown dt a span").html(ctryname);
                $(".dropdown dd ul").hide();					
            });                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }
            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });
        });
    </script>
    <div>
        <dl id="sample" class="dropdown">
        <dt><a><span>Please select a country</span></a></dt>
       
        <dd>
        
            <ul >
            
			<?php foreach ($list as $row): ?>
                <li><a href="<?php echo reduce_double_slashes( site_url()."/country/".url_title(strtolower ($row->name)));?>"><img class="flag" src="<?php echo base_url();?>images/s-flags/<?php echo strtolower($row->code);?>.png"><?php echo $row->name;?><span class="value"><?php echo $row->name;?></span></a></li> 
            <?php endforeach;?>      
          
            </ul>
        
        </dd>
         
        
    </dl>
    
    </div>
    
    <?php /*
    <div id="main_list" align="center">
         
	  echo form_open('/country');           	  
	  $options = array();
	  $js = 'id="country" onChange="window.location.href= this.form.CTRY.options[this.form.CTRY.selectedIndex].value"';
	  $options['#']  = "Select a country" ; 
	  foreach ($list as $row):      
	  $value= site_url()."/country/".url_title($row->name);	  
	  $options[$value]  = $row->name ;   
	  endforeach; 
	  echo form_dropdown('CTRY', $options,'',$js);	  
	  $data =array ('number' => 10);	  
	  echo form_hidden($data);
      // echo form_submit('submit', 'Submit');
       echo form_close(); */?>
         
       <?php /* 
	  $attributes = array('id' => 'form1');  
	  echo form_open('country',$attributes);           	  
	  $options = array();
	  $options['#']  = "Please select a country" ; 
	  foreach ($list as $row):	   
      $value= $row->id;	  
	  $options[$value]  = $row->name ;   
	  endforeach; 
	  echo form_dropdown('countrylist',$options,'','id="country"');	  
	  $data =array ('bar'=> 5);// this is just for test i might change it or delete it later	  
	  echo form_hidden($data);
      // echo form_submit('submit', 'Submit');
       echo form_close(); 
    </div>
  */ ?>
  </div>
</div>
