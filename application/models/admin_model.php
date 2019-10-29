<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model {

function get_all_countries()
   {
	
    $query = $this->db->get('countries');
	
	foreach($query-> result() as $row) { $data[] = $row; }
	
    return $data;// this function return an object contain contries id and names and every thing in table of countries
   }
   
function get_country_data($id_country)
   { 
   
    //getting the country name  
	
	$this->db->where('id',$id_country );
	$query = $this->db->get('countries');

	//$query = $this->db->query("SELECT name FROM countries WHERE id=$id_country"); //OLD VERSION
	
	$row = $query->row();
	//$country_name = $row->name; //country name OLD VERSION
	
	
	return $row;
	   
    }
// toggle activation of country, active if non active, desactivate if active 
function toggle_active_country($id_country)
{
	$this->db->where('id',$id_country );
    $query = $this->db->get('countries');
    $row = $query->row();
    $active = $row->active;
if ($active)
{
  $data = array('active' => 0); 
}
else 
{
  $data = array('active' => 1); 
}
      
	$this->db->where('id',$id_country );
	$this->db->update('countries', $data); 

}

function get_people($selected_country)
   
   {
	
	//getting the person details 
	
	//$query = $this->db->query("SELECT*FROM person WHERE countryid =$selected_country" );
	
	$data = array();
	
	$query = $this->db->get_where('person', array('countryid' => $selected_country));
	
	foreach($query-> result_array() as $row)
	
	  {
	  $data[] = $row;
	  /*
	  echo $row->name.'<br>';
	  echo $row->description .'<br>';
	  echo $row->wlink .'<br>';
	  */
	  }
	
	return $data;
	
	}

	
// add new person to table person in database	
function add_person($datafull)
       {   
	   
	   date_default_timezone_set("GMT");// gmt as defult
       $today = date('Y-m-d');// semply get time in gmt 
	   
	       // removing dashes and spaces on both ends   
	       $datafull['name']=str_replace("-"," ",trim($datafull['name']));
		   
		   
		   $data = array(
                  'countryid' =>   $datafull['countryid'],
                  'name' =>        $datafull['name'],
                  'description' => $datafull['description'],
                  'wlink' =>       $datafull['wlink'],
                  'sex' =>         $datafull['sex'],
                  'defult' =>      $datafull['defult'],
                  'active' =>      $datafull['active']
                  ); 
				  if ($datafull['defult'])
				  {$data['defult'] = 'TRUE';}else{$data['defult'] = 'FALSE'; }
				  
				  if ($datafull['active'])
				  {$data['active'] = 'TRUE';}else{$data['active'] = 'FALSE'; }
		      
			  
		   $this->db->insert('person', $data); //insert person details intodatabase
		   $id=$this->db->insert_id(); //get the last insert id

		   //creating new entery in to statistics tables [stats] and [stats_temp]
 		   //--------------------------------------------------------------------------
		   //$today = date("d.m.Y");
		   $stat_data = array(
                  'personid' =>   $id,
                  'inlike'   =>   0,
                  'inhate'   =>   0,
                  'outlike'  =>   0,
                  'outlike'  =>   0,                     
                  ); 
		   
		   $this->db->set($stat_data);	  
	                                       // there is no date in 'stats_temp' table 
		   $this->db->insert('stats_temp');// creating new entery to temporary table stats
		   
		   $this->db->set($stat_data);	  
		   $this->db->set('date',$today);	  
		   $this->db->insert('stats');// creating new entery to table stats
		   //--------------------------------------------------------------------------
	
		   $iamgepath="./images/big/"; //base image name 
		   $thumpath="./images/smal/";
		   $oldname=$iamgepath."temp.jpg";//image file name 
		   $newname=$iamgepath."person_L_".$id.".jpg";//new image name 
		   $newthumname=$thumpath."person_S_".$id.".jpg";
		   copy($oldname,$newthumname);//copy new file to thumnails folder and renaming it
	       rename($oldname,$newname);//renaming the temp image 
		   
		   // resizing the image in small folder
		  
 		   $config['image_library'] = 'gd2';
           $config['source_image']	= $newthumname;
		   $config['new_image']	= $newthumname;
		   $config['create_thumb'] = FALSE;
           $config['maintain_ratio'] = TRUE;
           $config['width']	 = 50;
           $config['height'] = 50;
		   $this->load->library('image_lib', $config);// initialise image librarry
		  
		   if ( ! $this->image_lib->resize()) // resizing the picture 
          {
             echo 'image resizing is not working';
			 echo $this->image_lib->display_errors();
            } 
		
	
        return $id;
	   }
	   
// this function detects if some one is main person in a specific country	
function detect_main($countryid)
    {
    
	$this->db->where('countryid', $countryid);
	$this->db->where('defult', 'TRUE' );
	$query = $this->db->get('person');     

	//$query = $this->db->query("SELECT*FROM person WHERE countryid=$countryid AND defult='1' " );
	 
	$row = $query->row();
	 
	 return $row;
	}
   
// this function is to change the statuce of give person from main to no main 
function not_main($id)
   {
	
	$data = array('defult' => 'FALSE');         
	$this->db->where('id', $id);
	$this->db->update('person', $data); 

	}
	
// get all details of a person with given id
function get_person($id)
   {
	$this->db->where('id',$id);
	$query = $this->db->get('person');
	$row = $query->row();
	return $row;
	}	
function edit_person($datafull)
   {
	  // removing dashes and spaces on both ends   
	   $datafull['name']=str_replace("-"," ",trim($datafull['name']));
	 
	 $id=$datafull['id'];
	 $data = array(
                  'name' =>        $datafull['name'],
                  'description' => $datafull['description'],
                  'wlink' =>       $datafull['wlink'],
                  'sex' =>         $datafull['sex']
                  ); 
				  
				   if ($datafull['defult'])
				  {$data['defult'] = 'TRUE';}else{$data['defult'] = 'FALSE'; }
				  
				  if ($datafull['active'])
				  {$data['active'] = 'TRUE';}else{$data['active'] = 'FALSE'; }
     
	 $this->db->where('id', $id);
     $this->db->update('person', $data);
	
   }
   
// delete image file stil working on    
function replace_image($id)
    {
	       $iamgepath="./images/big/"; //base image name 
		   $thumpath="./images/smal/";
		   $oldname=$iamgepath."temp.jpg";//image file name 
		   $newname=$iamgepath."person_L_".$id.".jpg";//new image name 
		   $newthumname=$thumpath."person_S_".$id.".jpg";
		   if(file_exists($newname))
		   {
		   unlink($newname);// delete the big picture
		   unlink($newthumname);// delete the thumnail 
		   }
		   copy($oldname,$newthumname);//copy new file to thumnail folder and renaming it
	       rename($oldname,$newname);//renaming the temp image 
		   
		   // resizing the image in small folder
		  
 		   $config['image_library'] = 'gd2';
           $config['source_image']	= $newthumname;
		   $config['new_image']	= $newthumname;
		   $config['create_thumb'] = FALSE;
           $config['maintain_ratio'] = TRUE;
           $config['width']	 = 50;
           $config['height'] = 50;
		   $this->load->library('image_lib', $config);//initialise image librarry
		  
		   if ( ! $this->image_lib->resize()) // resizing the picture 
          {
             echo 'image resizing is not working';
			 echo $this->image_lib->display_errors();
            } 
			
	
	
	}// end of function
//admin loging function
function login($username, $password)
 {
   $this -> db -> select('id, username, password');
   $this -> db -> from('admin');
   $this -> db -> where('username = ' . "'" . $username . "'");
   $this -> db -> where('password = ' . "'" . MD5($password) . "'");
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
// function to activate and desactivate site for matenance 
function toggle_active_site()
{
	$this->db->where('id_table',0 );// there is just one row in table site with id "0"
    $query = $this->db->get('site');
    $row = $query->row();
    $active = $row->active;
if ($active)
{
  $data = array('active' => 0); 
}
else 
{
  $data = array('active' => 1); 
}
      
	$this->db->where('id_table',0 );
	$this->db->update('site', $data); 
}

// function to detecte if site is active or not 
function is_site_active()
{
	$this->db->where('id_table',0);
	$query = $this->db->get('site');
	$row = $query->row();
    $active = $row->active;
	if ($active == 1)
	{
	return TRUE;
	}
	else
	{
	return FALSE;
	}
}
/*
								ooooooooooooooooooooooooooooooooooooooooooooooooo
								ooooooooooooooooooooooooooooooooooooooooooooooooo
								ooooooooooooooooooooooooooooooooooooooooooooooooo
								oooooooooooooo CRON JOBS SECTION oooooooooooooooo
								ooooooooooooooooooooooooooooooooooooooooooooooooo
								ooooooooooooooooooooooooooooooooooooooooooooooooo
								ooooooooooooooooooooooooooooooooooooooooooooooooo

*/

// cron jobs functions
// copy data from stats_temp table to stats table and clean stats_temp table
// this should be run every hour
function copy_temp($today)
{      
			  $inlike  = 0;
			  $outlike = 0;
			  $inhate  = 0;
			  $outhate = 0;
			  
			  //date_default_timezone_set("GMT");// gmt as defult
			  //$today = date('Y-m-d');// semply get time in gmt 
			  
			  $query=$this->db->get('stats_temp');
			  
			  foreach($query->result() as $row): //geeting data from stats_temp 
				 
					$id=$row->personid;
					$stats=$this->db->get_where('stats',array('personid' => $id, 'date' => $today),1);		
					foreach( $stats->result() as $input ):// this loop here is just to not get the error 
														  //it is usless cos i have limited the result just to one 
					//$input = $stats->row();
						
					$inlike  = $input->inlike  + $row->inlike;
					$outlike = $input->outlike + $row->outlike;
					$inhate  = $input->inhate  + $row->inhate;
					$outhate = $input->outhate + $row->outhate;
					endforeach;
					$array = array(
									'inlike' => $inlike, 
								   'outlike' => $outlike, 
									'inhate' => $inhate, 
								   'outhate' => $outhate					      
								   );
					//updating data for each row			   
					$this->db->set($array);
					$this->db->where('personid', $id);
					$this->db->where('date', $today);		
					$this->db->update('stats');
					
			  endforeach;
			  // cleaning old data from 'sats_temp' table 
			  $array = array(
							   'inlike' => 0, 
							   'outlike' => 0, 
							   'inhate' => 0, 
							   'outhate' => 0 
							   );
							   
			  $this->db->update('stats_temp',$array);
  
}

// function to creat new entries for all people in stats table
// this should be run every day after midnight GMT
function nex_day_stats()
{
			date_default_timezone_set("GMT");// gmt as defult
			$today = date('Y-m-d');// simply get time in gmt 
			
			$query=$this->db->get('person');
				
				foreach($query-> result() as $row):
					   
					   $id=$row->id;
						// testing if the date exist already before just to provide more security 
						$testexist=$this->db->get_where('stats',array('personid' => $id, 'date' => $today));
					  
					  if(!$testexist->result())
					  {
					   $array = array(
							   'personid' => $id,
							   'inlike' => 0, 
							   'outlike' => 0, 
							   'inhate' => 0, 
							   'outhate' => 0, 
							   'date' =>$today // insert gmt time in table
							   );	
					   $this->db->set($array);		   
					   $this->db->insert('stats'); 
					  } 
			else { 
			echo "this person:" .$row->name." ID:".$row->id." already has an entry in stat table for today:".$today.'<br><br>' ; 
			}
				endforeach;
				$this->db->limit(1);
				$this->db->set('today',$today);
				$this->db->update('site');
}

// this function is to wipe the ip adress table at midnight for new day
// because the ip will be allowed to vote again the next day   
function empty_ip_table()
{
	$this->db->empty_table('ip_address');
    $this->db->query('ALTER TABLE ip_address AUTO_INCREMENT=1');

}

//function to get the date in site table 
function get_today()
{
	$query = $this->db->get('site');
	$row = $query->row();
	$today = $row->today;
	
	return $today;

}


}
?>