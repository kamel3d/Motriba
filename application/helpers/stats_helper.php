<?php // stats_helper.php
if(!defined('BASEPATH')) exit('No direct script access allowed');

// geting percentages (likes and hates)
// this can be used for both in and out likes and hates
function percentage($like, $hate)
{
   // all this is just calculations to get percentages of likes, hates and so on
                 
				  $vote    =  $like+$hate;
                  
				  if ($vote == 0){$like_pst=0; $hate_pst =0;}
				  else
				  {
				  $like_pst   = ($like   * 100) / $vote  ; // persentage of inlikes 
				  $hate_pst   = ($hate   * 100) / $vote  ; // percentage of in hates
				  }
    
	              // formating the results 
				  if (is_int($like_pst))
				  { 
				  $like_pst = number_format($like_pst, 0, '.',',');
				  }
				  else 
				  { 
				  $like_pst = number_format($like_pst, 1, '.',',');
				  }
				  
				  if (is_int($hate_pst))
				  { 
				  $hate_pst = number_format($hate_pst, 0, '.',',');
				  }
				  else 
				  { 
				  $hate_pst = number_format($hate_pst, 1, '.',',');
				  }
	
	              
                  $data =array( 'likepst'=>$like_pst,'hatepst'=>$hate_pst );					
				  
return $data;

}