<?php
date_default_timezone_set('GMT');
$cookiename = 'mtba_'.$person->id;//seting the cookie name
$now = time();
$exp = $now + 86400 - ($now % 86400);// midnight gmt time
if ($now < $exp) {
?>
<script>
// Count down milliseconds = server_end - server_now = client_end - client_now
var server_end = <?php echo $exp; ?> * 1000;
var server_now = <?php echo time(); ?> * 1000;
var client_now = new Date().getTime();
var end = server_end - server_now + client_now; // this is the real end time

var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour *24
var timer;

function showRemaining()
{
    var now = new Date();
    var distance = end - now;
    if (distance < 0 ) {
       clearInterval( timer );
       window.location.reload();/* reloar the page at midnight */
       return;
    }
    var days = Math.floor(distance / _day);
    var hours = Math.floor( (distance % _day ) / _hour );
    var minutes = Math.floor( (distance % _hour) / _minute );
    var seconds = Math.floor( (distance % _minute) / _second );

    var countdown = document.getElementById('hours');
    countdown.innerHTML = '';    
    countdown.innerHTML +=  hours;
    var countdown = document.getElementById('minuts');
	countdown.innerHTML = '';    
	countdown.innerHTML +=  minutes;
    var countdown = document.getElementById('seconds');
	countdown.innerHTML = '';    
	countdown.innerHTML +=  seconds;
}

timer = setInterval(showRemaining, 1000);
</script>
<?php
} else {
    echo "Times Up";
}
?>

<div id="wrapper">
	
  <div class="sidebar-left">
    <?php 
		$advert = false; //variable to turne on and off the advert
		if ($advert) {?> 
		<script type="text/javascript"><!--
google_ad_client = "ca-pub-6058448787633530";
/* long vertical */
google_ad_slot = "0659056975";
google_ad_width = 160;
google_ad_height = 600;
//-->
    </script> 
      <script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script> 
    <?php } //enf if ?>
  </div>
  <div class="main-content">
  <div>
   <div class="share-buttons">
    
       <span class='st_facebook_hcount' displayText='Facebook'></span>
       <span class='st_twitter_hcount' displayText='Tweet'></span>
       <span class='st_email_hcount'></span>
       <span class='st_sharethis_hcount' displayText='ShareThis'></span>
   </div>
      <div class="person-details">
        <div class="item">
          <div class="item-img" ><img src="<?php echo base_url()?>images/big/person_L_<?php echo $person->id ;?>.jpg" width="200" height="200" border="0"></div>
        </div>
        <div class="buto-text">
          <div class="item-detail">
            <h2><?php echo $person->name;?></h2>
            <h4><?php echo $person->description;?></h4>            
            <div class="wikilink"> <a href="<?php echo $person->wlink;?>" target="_blank">Learn more on Wikipedia</a> </div>
        </div>
        <?php  if (! isset($_COOKIE[$cookiename]) and  ($ip_allowed) ) {// if no cookie and if the ip is allowed then show vote box?>
        <div class="countdown">
        <span class="time" >Vote ends in: </span>
        <span class="nmbr-time" id="hours"></span>
        <span class="time">:</span>
        <span class="nmbr-time" id="minuts"></span>
        <span class="time">:</span>
        <span class="nmbr-time" id="seconds"></span>
        </div>       
        <div class="vote-box">
               <div class="vote-button">
                    <form id="like-form" action="" method="post" accept-charset="utf-8">
                    <input type="hidden" name="vote" id="vote" value="like" />
                    <input type="hidden" name="id" id="id" value="<?php echo $person->id; ?>" />
                    <input type="hidden" name="ip" id="ip" value="<?php echo $this->input->ip_address(); ?>" />
                    <input type="hidden" name="code" id="code" value="<?php echo $country->code; ?>" />
                    <button class="g-button green" id="like-button" type="submit" value="Like" name="like"><i class="icon icon-like"></i><br>Like</button>
                    </form>
               </div>
               <div class="vote-button">
                    <form   id="hate-form" action="" method="post" accept-charset="utf-8">
                    <input type="hidden" name="vote" id="vote" value="hate" />
                    <input type="hidden" name="id" id="id" value="<?php echo $person->id; ?>" />
                    <input type="hidden" name="ip" id="ip" value="<?php echo $this->input->ip_address(); ?>" />
                    <input type="hidden" name="code" id="code" value="<?php echo $country->code; ?>" />
                    <button class="g-button red" id="hate-button" type="submit" value="hate" name="hate"><i class="icon icon-hate"></i><br>Dislike</button>
                    </form>
               </div>
            <?php $urlvote = reduce_double_slashes(site_url().'/vote');//i got some essues in compatibility in localhost and server ?>
            <script type="text/javascript">
	  				    $("#like-button").click(function() {
                        $(".vote-button").hide();
                        $('#loading').delay(2000).show();
			  
					  $.ajax({ 
					          
							  type: "POST",
							  url: "<?php echo $urlvote?>",							  
							  data: $('#like-form').serialize(),
							  success: function() 
							  {   
								  $('.vote-box').html("<p>Thanks for voting</p>").fadein("slow");
								  
								  }
					  
			     			  });
							  return false;
							
	                          });
					
                        $("#hate-button").click(function() {
                        $(".vote-button").hide();
                        $('#loading').delay(2000).show();
  					  
					  $.ajax({ 
					          
							  type: "POST",
							  url: "<?php echo $urlvote?>",
							  data: $('#hate-form').serialize(),
							  success: function() 
							  {   
								  $('.vote-box').html("<p>Thank you for voting</p>").fadein("slow");}
					  
			     			  });
							  return false;
							
	                          });
							   
             		</script>
            <div id="loading">
              <p><img src="<?php echo base_url()?>images/ajax-loader.gif" /> Please Wait</p>
            </div>
            <?php }
				else
				{ ?>
                <script type="text/javascript">                                         
				
					  $(window).load(function(){
						$('.fade').fadeIn(1000);
						
					  });
					
					                  
				 </script> 
                    <div class="vote-box" style="margin-top:40px;">
                    <div class="countdown-in-box fade">        
                    <span class="time" >You can vote again after:</span><br>
                    <span class="in-time" id="hours"></span><span class="time">:</span>
                    <span class="in-time" id="minuts"></span> <span class="time">:</span>
                    <span class="in-time" id="seconds"></span>            
                    </div>
			<?php }?>			
        </div> <!--end vote-box-->       
        </div>
      </div>
    </div>
    <?php // all this is just calculations to get percentages of likes, hates and so on
                  $inlike    =  $stats->inlike;
				  $inhate    =  $stats->inhate;
				  $outlike   =  $stats->outlike;
				  $outhate   =  $stats->outhate;				  
				  $invote    =  $inlike+$inhate;    // total votes from inside
				  $outvote   =  $outlike+$outhate; // total votes from outside
				  $totalvote =  $invote + $outvote;
                  
				  if ($invote == 0){$inlike_pst=0; $inhate_pst =0;}
				  else
				  {
				  $inlike_pst   = ($inlike   * 100) / $invote  ; // persentage of inlikes 
				  $inhate_pst   = ($inhate   * 100) / $invote  ; // percentage of in hates
				  }
                  
				  if ($outvote == 0){$outlike_pst=0; $outhate_pst =0;}
				  else
				  {
				  $outlike_pst  = ($outlike  * 100) / $outvote ; // persentage of out likes
				  $outhate_pst  = ($outhate  * 100) / $outvote ; // percentage of out hates
                  }                  
				  
				  $total_like = $inlike + $outlike; // total number of likes 
				  $total_hate = $inhate + $outhate; // total number of hates 
				  $total_vote = $total_like + $total_hate; // total number of votes means inside and outside the country
				 
				  if ($total_vote == 0){$total_like_pst=0; $total_hate_pst=0;}
				  else
			      {
				  $total_like_pst =  ($total_like * 100) / $total_vote ; // percentage of total likes				
				  $total_hate_pst =  ($total_hate * 100) / $total_vote ; // percentage of total hates
				  }			
				  ?>
    <?php /*?>            
		<div class="fb-like" data-href="<?php echo current_url();?>" data-send="true" data-width="450" data-show-faces="true"></div>
    <?php */?> 
		<div class="person-page">
      <div class="main-map">
        <p><?php echo date("d F Y");?> | Popularity inside <?php echo $country->name;?></p>
      </div>
      <div class="map-detail">
        <div class="main-table">
          <table class="stat-table" border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <td><div class="green">
                  <?php 
			  if (is_int($inlike_pst)){ echo number_format($inlike_pst, 0, '.',',');}
			  else {echo number_format($inlike_pst, 1, '.',',');}?>
                  %</div></td>
              <td>=</td>
              <td class="vote-nbr"><p><?php echo number_format($inlike, 0, '.',',');?></p>
                <span class="votes">Votes</span></td>
              <td id="vertical-line"><BR></td>
              <td><div class="red">
                  <?php 
			  if (is_int($inhate_pst)){ echo number_format($inhate_pst, 0, '.',',');}
			  else {echo number_format($inhate_pst, 1, '.',',');}?>
                  %</div></td>
              <td>=</td>
              <td class="vote-nbr"><p><?php echo number_format($inhate, 0, '.',',');?></p>
                <span class="votes">Votes</span></td>
              <td id="vertical-line"><BR></td>
            </tr>
            <tr>
              <td><div class="likes">Likes</div></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td id="vertical-line"><BR></td>
              <td><div class="hates">Dislikes</div></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td id="vertical-line"><BR></td>
            </tr>
          </table>
        </div>
        <div class="stat-button">
          <button id="slider-button-1">Stats</button>
        </div>
        <script>
                   $('#slider-button-1').click(function (){   
                   $('#slider1').css("height","220px" );
                   $('#slider1').slideToggle("fast");
				  
                   }); 
				   
          </script>
        <div class="slider-graph" id="slider1" >
          <?php  $this->load->view('graph_in_view');?>
        </div>
      </div>
    </div>
    <div class="person-page">
      <div class="main-map">
        <p><?php echo date("d F Y");?> | Popularity outside <?php echo $country->name;?></p>
      </div>
      <div class="map-detail ">
        <div class="main-table">
          <table class="stat-table" border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <td ><div class="green">
                  <?php 
			  if (is_int($outlike_pst)){ echo number_format($outlike_pst, 0, '.',',');}
			  else {echo number_format($outlike_pst, 1, '.',',');}?>
                  %</div></td>
              <td >=</td>
              <td class="vote-nbr"><p><?php echo number_format($outlike, 0, '.',',');?></p>
                <span class="votes">Votes</span></td>
              <td id="vertical-line"><BR></td>
              <td ><div class="red">
                  <?php 
			  if (is_int($outhate_pst)){ echo number_format($outhate_pst, 0, '.',',');}
			  else {echo number_format($outhate_pst, 1, '.',',');}?>
                  %</div></td>
              <td >=</td>
              <td class="vote-nbr"><p><?php echo number_format($outhate, 0, '.',',');?></p>
                <span class="votes">Votes</span></td>
              <td id="vertical-line"><BR></td>
            </tr>
            <tr>
              <td><div class="likes">Likes</div></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td id="vertical-line"><BR></td>
              <td ><div class="hates">Dislikes</div></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td id="vertical-line"><BR></td>
            </tr>
          </table>
        </div>
        	<script>
	$(function() {
		$( ".stat-button button" ).button({
            icons: {
               
                secondary: "ui-icon ui-icon-signal"
            }
        })
	});
	</script>




        <div class="stat-button">
          <button id="slider-button-2">Stats</button>
        </div>
        <script>
			   $('#slider-button-2').click(function (){
			   $('#slider2').css("height","220px" );
			   $('#slider2').slideToggle("fast");   
			   });				   
        </script>
        <div class="slider-graph" id="slider2">
          <?php  $this->load->view('graph_out_view');?>
        </div>
      </div>
      <div class="person-page">
        <div class="main-map">
          <p><?php echo date("d F Y");?> | Total popularity</p>
        </div>
        <div class="map-detail">
          <div class="main-table">
            <table class="stat-table" border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td ><div class="green">
                    <?php 
			  if (is_int($total_like_pst)){ echo number_format($total_like_pst, 0, '.',',');}
			  else {echo number_format($total_like_pst, 1, '.',',');}?>
                    %</div></td>
                <td >=</td>
                <td class="vote-nbr"><p><?php echo number_format($total_like, 0, '.',',');?></p>
                  <span class="votes">Votes</span></td>
                <td id="vertical-line"><BR></td>
                <td ><div class="red">
                    <?php 
			  if (is_int($total_hate_pst)){ echo number_format($total_hate_pst, 0, '.',',');}
			  else {echo number_format($total_hate_pst, 1, '.',',');}?>
                    %</div></td>
                <td >=</td>
                <td class="vote-nbr"><p><?php echo number_format($total_hate, 0, '.',',');?></p>
                  <span class="votes">Votes</span></td>
                <td id="vertical-line"><BR></td>
              </tr>
              <tr>
                <td><div class="likes">Likes</div></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td id="vertical-line"><BR></td>
                <td><div class="hates">Dislikes</div></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td id="vertical-line"><BR></td>
              </tr>
            </table>
          </div>
          <div class="stat-button">
            <button id="slider-button-3">Stats</button>
          </div>
          <script>
                   $('#slider-button-3').click(function (){
                   $('#slider3').css("height","220px" );
				   $('#slider3').slideToggle("fast");
                   });				   
                </script>
          <div class="slider-graph" id="slider3">
            <?php  $this->load->view('graph_total_view');?>
          </div>
        </div>
      <?php 
		if ($advert) { //variable to turn on and off the advert it has been declared up in this code			
				?> 
				<div class="link-ad">
  
				<script type="text/javascript"><!--
google_ad_client = "ca-pub-6058448787633530";
/* horizental-low */
google_ad_slot = "7387899784";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
				<?php } //end if ?>
        <div class="fb-comments" data-href="<?php echo site_url().$this->uri->uri_string();?>" data-num-posts="2" data-width="500"></div>
      </div>
  <?php /*     <div class="link-ad">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6058448787633530";
google_ad_slot = "5383784948";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
       </div> 
       */?>
    </div>
  </div>

</div>
<div class="sidebar-right">
  <div>
    <?php if ($other_people){ $this->load->view('side_bar_view');} ?> 
 </div>
 <div class="social">
  <a href="http://bit.ly/HnGUwR"> <img src="<?php echo base_url();?>/images/twitter.png" width="108" height="41" alt="twitter" dynsrc=""></a>
  <a href="http://on.fb.me/Hl8pXI"> <img src="<?php echo base_url();?>/images/facebook.gif" width="109" height="41" alt="facebook" dynsrc=""></a>
  </div>
<?php /*?>   <div class="donate">
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="T7JYSGP98UPTG">
<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
   </div><?php */?>
  <?php /*?><div>
  <script type="text/javascript" src="http://ji.revolvermaps.com/t.js"></script><script type="text/javascript">rmt_ki101('0',178,'8bkrsmmsssg','ff0000');</script>
  </div><?php */?>
  
</div>
</div>