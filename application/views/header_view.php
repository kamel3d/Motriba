<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <LINK REL="SHORTCUT ICON" HREF="favicon.ico" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>style.css">
<?php /*?>    <link rel="stylesheet" href="<?php echo base_url();?>button-style.css" type="text/css"  media="screen" />
    <link rel="stylesheet" href="<?php echo base_url();?>jquery-ui-1.8.18.custom.css" type="text/css"  media="screen" />
<?php */?>
<?php if (! $person_page){?>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="<?php echo base_url()?>images/motriba-logo-share.gif"/>
    <meta property="og:url" content="<?php echo current_url();?>"/>
    <meta property="og:title" content="Motriba - Voice of the People" />
    <meta property="og:description" content="Motriba.com is a place where you can vote daily on any leader in the world from wherever you are. You can vote for the leader of the country you belong to, and any other country in the world."/>
    <meta property="og:site_name" content="Motriba" />
<?php } ?>    
<?php if ($home){?>	
<title>Motriba - Voice of the People</title>
   <meta name="Description" content="Motriba.com is a place where you can vote daily on any leader in the world from wherever you are. You can vote for the leader of the country you belong to, and any other country in the world just by clicking Like or Dislike. Also you can see real time votes coming from elsewhere in the world, allowing you to track the popularity of these leaders and how well they are doing.">

<style type="text/css">
.dropdown dd, .dropdown dt, .dropdown ul {width:200px; margin:auto; padding:0px;}
        .dropdown dd { position:relative; }
        .dropdown a, .dropdown a:visited { color:#676767; text-decoration:none; outline:none;}
        .dropdown a:hover { color:#545353;}
        .dropdown dt a:hover { color:#545353; border: 1px solid #A3A2A2;}
        .dropdown dt a {background:#D4D3D3 url(<?php echo base_url();?>/images/arrow.png) no-repeat scroll right center; 
		                display:block;padding-right:20px;border:1px solid #BABABA;width:200px;}
        .dropdown dt a span {cursor:pointer; display:block; padding:5px; text-align:left;}
        .dropdown dd ul { background:#F4F4F4 none repeat scroll 0 0; 
						  border:1px solid #D4D3D3; 
						  color:#CCCCCC; display:none;
                          left:0px; 
						  padding:5px 0px; 
						  position:absolute; 
						  top:2px; 
						  width:auto; 
						  min-width:170px; 
						  list-style:none;
						  text-align:left;
						  margin:auto;
						  height: 250px;                    
						  overflow: scroll;}
        .dropdown span.value { display:none;}
        .dropdown dd ul li a { padding:5px; display:block; width:195px;}
        .dropdown dd ul li a:hover {
			 background-color:#CCCCCC;
			 }   	      
        .dropdown img.flag { border:none; vertical-align:middle; margin-right:10px; }          
</style>

<?php } ?>
<?php if ($privacy){ ?>
<style type="text/css">
        .dropdown-inside dd, .dropdown-inside dt, .dropdown-inside ul { margin:0px 0px; padding:0px; }
        .dropdown-inside dd { position:relative; }
        .dropdown-inside a, .dropdown-inside a:visited { color:#676767; text-decoration:none; outline:none;}
        .dropdown-inside a:hover { color:#545353;}
        .dropdown-inside dt a:hover { color:#545353;}
        .dropdown-inside dt a {background:#F4F4F4 url(<?php echo base_url();?>/images/arrow.png) no-repeat scroll right center !important; 
		                display:block; 
						padding-right:20px;
                        border:1px solid #D4D3D3; 
						width:200px;}
        .dropdown-inside dt a span {cursor:pointer; display:block; padding:5px; }
        .dropdown-inside dt a img { padding:5px 0 0 5px; float:left;}
        .dropdown-inside dd ul { background:#F4F4F4 none repeat scroll 0 0; 
						  border:1px solid #D4D3D3; 
						  color:#CCCCCC; display:none;
                          left:0px; 
						  padding:5px 0px; 
						  position:absolute; 
						  top:2px; 
						  width:auto; 
						  min-width:170px; 
						  list-style:none;
						  text-align:left;
						  margin:auto;
						  height: 400px;						                   
						  overflow: scroll;
						 }
        .dropdown-inside span.value { display:none;}
        .dropdown-inside dd ul li a { padding:5px; display:block; width:195px;}
        .dropdown-inside dd ul li a:hover { background-color:#CCCCCC;}
        .dropdown-inside img.flag { border:none; vertical-align:middle; margin-right:10px; }      
</style>
<?php } ?>

<?php if ($person_page){ ?>
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

<title><?php echo $person->name;?></title>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="<?php echo base_url()?>images/big/person_L_<?php echo $person->id;?>.jpg"/>
    <meta property="og:url" content="<?php echo current_url();?>"/>
    <meta property="og:title" content="<?php echo $person->name;?> | <?php echo $country->name;?>" />
    <meta property="og:description" content="Popularity for today: <?php echo number_format($total_like_pst, 1, '.',',');?>% Likes | <?php echo number_format($total_hate_pst, 1, '.',',');?>% Hates | <?php echo $totalvote;?> Votes. Vote on <?php echo $person->name;?> and any other leader in the world" />
    <meta property="og:site_name" content="Motriba - Voice of the people" />
    <meta name="Description" content="Motriba.com is a place where you can vote daily on any leader in the world from wherever you are. You can vote for the leader of the country you belong to, and any other country in the world just by clicking Like or Dislike. Also you can see real time votes coming from elsewhere in the world, allowing you to track the popularity of these leaders and how well they are doing.">
    <meta name="keywords" content="<?php echo $person->name;?>,<?php echo $country->name;?>,<?php echo $person->description;?>" />
<style type="text/css">
        .dropdown-inside dd, .dropdown-inside dt, .dropdown-inside ul { margin:0px 0px; padding:0px; }
        .dropdown-inside dd { position:relative; }
        .dropdown-inside a, .dropdown-inside a:visited { color:#676767; text-decoration:none; outline:none;}
        .dropdown-inside a:hover { color:#545353;}
        .dropdown-inside dt a:hover { color:#545353;}
        .dropdown-inside dt a {background:#F4F4F4 url(<?php echo base_url();?>/images/arrow.png) no-repeat scroll right center !important; 
		                display:block; 
						padding-right:20px;
                        border:1px solid #D4D3D3; 
						width:200px;}
        .dropdown-inside dt a span {cursor:pointer; display:block; padding:5px; }
        .dropdown-inside dt a img { padding:5px 0 0 5px; float:left;}
        .dropdown-inside dd ul { background:#F4F4F4 none repeat scroll 0 0; 
						  border:1px solid #D4D3D3; 
						  color:#CCCCCC; display:none;
                          left:0px; 
						  padding:5px 0px; 
						  position:absolute; 
						  top:2px; 
						  width:auto; 
						  min-width:170px; 
						  list-style:none;
						  text-align:left;
						  margin:auto;
						  height: 400px;				                      
						  overflow: scroll;
						 }
        .dropdown-inside span.value { display:none;}
        .dropdown-inside dd ul li a { padding:5px; display:block; width:195px;}
        .dropdown-inside dd ul li a:hover { background-color:#CCCCCC;}
        .dropdown-inside img.flag { border:none; vertical-align:middle; margin-right:10px; }      
</style>
    <script src="<?php echo base_url();?>js/amcharts.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>js/raphael.js" type="text/javascript"></script>
    <meta property="fb:app_id" content="300816873307266"/> 
<?php } ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#country").live("change keyup", function () {
                $("#form1").submit();
                
			});
			
        });
    </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29699082-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>    
<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ff6f785e-bde6-474a-968d-970207aebfe2"}); </script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/jquery-ui-1.8.18.custom.min.js"></script>


</head>
    <body>
<div id="fb-root"></div>   
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=300816873307266";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <div id="header">
      <div class="header">
        <div class="logo"> <a href="<?php echo site_url();?>"><img src="<?php echo base_url();?>images/motriba-logo.png" height="40" width="183"></a> </div>
        <div class="top-menu">      
       <?php  $x=10; 
	if ($person_page & $x > 100){ 
					// this condition up here is impossible and that just to stop the code below from getting generated
		            // the code is to show google advert on the top the horizental one 
					?>
           
           <div class="top-ad">
            <script type="text/javascript"><!--
            google_ad_client = "ca-pub-6058448787633530";
            /* graphic-horizental */
            /* this is commented now so the advert on top wont a pear */
            google_ad_slot = "5383784948";
            google_ad_width = 468;
            google_ad_height = 60;
            //
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>
            </div>
				
       <?php } ?>
        </div>
		<?php if ( $person_page || $privacy){?> 
		        
        <div class="top-list">
          <script type="text/javascript">
        $(document).ready(function() {
    
            $(".dropdown-inside dt a").click(function() {
                $(".dropdown-inside dd ul").toggle();
            });
                        
            $(".dropdown-inside dd ul li a").click(function() {
				$(".dropdown-inside dd ul li a img").hide();
                var ctryname = $(this).html();
                $(".dropdown-inside dt a span").html(ctryname);
                $(".dropdown-inside dd ul").hide();			
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown-inside"))
                    $(".dropdown-inside dd ul").hide();					
            });   
        });
    </script>
    <dl id="sample" class="dropdown-inside">
        <dt><a>
		<?php if($person_page){?>
        <img class="flag" src="<?php echo base_url();?>images/s-flags/<?php echo strtolower($country->code);?>.png"><span><?php echo $country->name;?>
        </span>
		<?php }else{// any thing else as long as it is not in person page so no specivic country is needed?>
        <span>Select a country</span>		
		<?php } ?></a></dt>
        <dd>
            <ul>
            <?php foreach ($list as $row): ?>
                <li><a href="<?php echo reduce_double_slashes(strtolower ( site_url()."/country/".url_title($row->name)));?>"><img class="flag" src="<?php echo base_url();?>images/s-flags/<?php echo strtolower($row->code);?>.png"><?php echo $row->name;?><span class="value"><?php echo $row->name;?></span></a></li> 
            <?php endforeach;?>      
            </ul>
        </dd>
    </dl>
    
         <?php    
			 /* echo form_open('/country');           	  
			  $options = array();
			  $js = 'id="country" onChange="window.location.href= this.form.CTRY.options[this.form.CTRY.selectedIndex].value"';
			  $options['#']  = "Select a country" ; 
			  foreach ($list as $row):      
			  $value= site_url()."/country/".url_title($row->name);	  
			  $options[$value]  = $row->name ;   
			  endforeach;
			  $selected = site_url()."/country/".url_title(trim($country->name));	 
			  echo form_dropdown('CTRY', $options,$selected,$js);
			  echo form_close(); */?>
        </div>
        
        <?php } ?>
    
      </div>
    </div>