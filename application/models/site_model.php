<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_model extends CI_Model {

// this function will get only active countries
// this function return an object contain countries 
// id and names and every thing in table of countries	
function get_all_countries()
   {	
    $this->db->where('active','1');// only active countries
	$this->db->order_by('name', 'asc'); 
	$query = $this->db->get('countries');
	
	foreach($query-> result() as $row) { $data[] = $row; }
	
    return $data;
   }
   
// detecting the main person of a specific country   
function detect_main($countryid)
    {
    
	$this->db->where('countryid', $countryid);
	$this->db->where('defult', 'TRUE' );
	$query = $this->db->get('person');     	 
	$row = $query->row();
	 
	return $row;
	}
	
// get person details using his id	
function get_person($id)
   {
	$this->db->where('id',$id);
	$query = $this->db->get('person');
	$row = $query->row();
	return $row;
	}
	
// get country name using it's id 	
/*function get_country_name($id_country)
   { 
	$this->db->where('id',$id_country );
	$query = $this->db->get('countries');
	$row = $query->row();
	
	return $row;   
    }*/
  
// get country id using its name :D	
function get_country_perid($name_country)
   { 
	$this->db->where('name',$name_country );
	$query = $this->db->get('countries');
	$row = $query->row();
	
	return $row;   
    }
  
//get person id using his name 
function get_person_id($name_person)
   { 
	$this->db->where('name',$name_person );
	$query = $this->db->get('person');
	$row = $query->row();
	
	return $row;   
    }	
	
	
// geting people from same country giving the country id and persons id to avoid geting him back	
function people_from_same_country($id_country,$id_person)
   {
	   $data = FALSE;
	
	$this->db->limit(5);   // for the moment it is just limited to 5 person means total 6 per country
	$this->db->where('countryid',$id_country);
	$this->db->where('active','TRUE');
	$this->db->where('id !=', $id_person );
	$this->db->order_by('name', 'asc');
	$query = $this->db->get('person');

	if ($query){
			foreach($query-> result_array() as $row)
			{
			 $data[] = $row;
			} 	 
		}
	
	return $data;

   }
  
 // add vote to data base giving the persons id the vote kind and the location  
function add_vote($id,$vote,$inside)
{
	if ($vote == 'hate')
	{ 		  
	  if($inside)
	   { 		    
		$this->db->set('inhate', 'inhate+1', FALSE);			  
	   }
	   else //hate coming from outside
	   {		
		$this->db->set('outhate', 'outhate+1', FALSE);			
	   }
	}
	else
	{
	if($inside)// likes coming from inside
	   { 		   
		$this->db->set('inlike', 'inlike+1', FALSE);			  
	   }
	   else //like coming from outside
	   {			
		$this->db->set('outlike', 'outlike+1', FALSE);			
	   }
	}
   //$this->db->set('date','CURDATE()',FALSE); 
   $this->db->where('personid',$id);
   $this->db->update('stats_temp');	//this should be permanently on 'stats_temp' for some times to see immediate result 
                                    // I put it on 'stats' table instead 
}
  
// get stats for specific person giving his id  
function get_today_stats($id)
{   
	$this->db->where('personid',$id);// where personid equal to id
    $query = $this->db->get('stats_temp',1);
	$row = $query->row();
	
    return $row;
}
/* old get stats 
function get_stats($id)
{   

    // predifining row in case cron jobs made the entry late i made this because i got an error at midnight gmt
    $row = array (  'inlike' => 0,
                    'inhate' => 0,
				   'outlike' => 0,
				   'outhate' => 0,
                   'personid'=>$id
				 );
	$row = (object) $row; //conver row to an object			 
	date_default_timezone_set("GMT");// gmt as defult
    $today = date('Y-m-d');// semply get today date in gmt 
	$data = array();
	$this->db->where('personid',$id);// where personid equal to id
    if ( base_url() !== "http://localhost/")
	{// skip this is localhoste 
	$this->db->where('date',$today);
	}
    $query = $this->db->get('stats',1);
    if($query->num_rows > 0){// if data for today exist then return data else return null as defined in row at the begigng
	$row = $query->row();
	}
    return $row;
}*/
/*
I am so happy i made it it works finally
previousely i use the have errors shoing on persons page after seconds from midnight and that becuse 
coronjob might be late and didnt creat the row in time so when the request is sent there will be no data for today 
and now I made it to show 0 instead of erros and that should be just for few econds while the cronjob go and made new row 
and it dose not matter actually because the the results wont show untill after one hour from voting anyway
*/ 
//function just to know if ip is allowed to vote or not 
function is_ip_allowed($ip,$id,$maxip)
{
            $maxcount = 0;
			$unsigned_ip=sprintf("%u",ip2long($ip));
			$this->db->limit(1);
			$this->db->where('id_person',$id);
			$this->db->where('ip',$unsigned_ip);
			$query = $this->db->get('ip_address');
            if ($query->num_rows > 0)// if the query is not empty 
			{
				$row = $query->row();
				$maxcount = $row->maxcount;
				if ($maxcount < $maxip)
				{
				return TRUE;// if count less than 5 means ip is allowed
				}
	            else
				{
			    return FALSE;// if count 5 or more means it is not allowed
				}
			}
return TRUE;// there is not entry in db with the given ip so ip is allowed 	

}


// adding ip adress to DB
function add_ip($ip,$id,$maxip)
{          
            $unsigned_ip=sprintf("%u",ip2long($ip));
			$maxcount = 0;
			$this->db->limit(1);
			$this->db->where('id_person',$id);
			$this->db->where('ip',$unsigned_ip);
			$query = $this->db->get('ip_address');
						           
			if ($query->num_rows > 0)// if the query is not empty 
			{
				$row = $query->row();
			   
				//echo' not empty';
				$maxcount = $row->maxcount;
	        //++++++++++++++++++++++++++++++
			    if ($maxcount < $maxip )        
			//++++++++++++++++++++++++++++++	
				{ 				   
					$maxcount++;
					$this->db->where('ip',$unsigned_ip);
			        $this->db->where('id_person',$id);
					$this->db->set('maxcount',$maxcount);
					$this->db->update('ip_address');					
				   echo $maxcount.'time';
				}
	            else 
				{ // reatched the maximum number of votes alowed	
					return FALSE;
				}				
			}
            else// query is empty  
			{
				//echo 'first time';
				
				$data = array( 'id_person' => $id,
				                      'ip' => $unsigned_ip,
				                'maxcount' => 1
				              );
				$this->db->insert('ip_address',$data);
			}		

return TRUE;

}
/*function to get country code 
this time i made the dabase localy so I can detect the 
contry withouth relaying in outside cervice
*/
function get_country_code($ip)
{
    $unsigned_ip=sprintf("%u",ip2long($ip));//converting ip adres to integer
	
	$this->db->limit(1);
	$this->db->where('begin_num <=',$unsigned_ip);
	$this->db->where('end_num >=',$unsigned_ip);
	$query = $this->db->get('country_ip');
	if ($query->num_rows > 0)
	{
	$row = $query->row();
    $code = $row->code;
	}
	else
	{
	$code='XX'; // in case ip dont exist in db
	}

	return $code;

}

// get the country code for a given ip from www.hostip.info
function get_hostip_code($ip)
{
	
$host_url = 'http://api.hostip.info/country.php?ip='.$ip;
	
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $host_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE); 
// grab URL and pass it to the browser
curl_multi_getcontent ($ch);
$hostcode = curl_exec($ch);
// close cURL resource, and free up system resources
curl_close($ch);

return $hostcode;

}

// get data for the graphs 
function graph_data($id_person)
{   
    $this->db->limit(1);
	$query = $this->db->get('site');
	$row = $query->row();
    $today = $row->today;// geting today date from site table
    //echo $today.'<br>';
    $lastdate = date('Y-m-d', strtotime('-30 days', strtotime($today)));
   // this will return 31 results 
	
	$this->db->where('personid',$id_person);
	$this->db->where("date <= '$today'");
	$this->db->where("date >= '$lastdate'");
	$this->db->order_by('date', 'ase');
	$query = $this->db->get('stats');	
	$data = array();
	//print_r($query);        
	foreach($query-> result_array() as $row)
	{
	 $data[] = $row;
	} 	 
     //print_r($data);
    return $data;

}

// this function to return true if contry is active, false if not
function is_country_active($id_country)
{
	$this->db->where('id',$id_country);
	$query = $this->db->get('countries');
	$row = $query->row();
    $active = $row->active;
	if ($active== 1)
	{
	return TRUE;
	}
	else
	{
	return FALSE;
	}
}
// function to detecte if person is active or not 
function is_person_active($id_person)
{
	$this->db->where('id',$id_person);
	$query = $this->db->get('person');
	$row = $query->row();
    $active = $row->active;
	if ($active == 'TRUE')
	{
	return TRUE;
	}
	else
	{
	return FALSE;
	}
}

//function to return the maximum number of votes allowed from same ip
// this is fixed for all site
function max_ip_count()
{
	$this->db->limit(1);
	$query = $this->db->get('site');
	$row = $query->row();
    $maxip = $row->maxip;
	
	return $maxip;
}










}