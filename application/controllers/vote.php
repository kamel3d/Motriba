<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vote extends CI_Controller {
// im accesing this controler with jquery no out put is going from here	
function index()
{
	$inside = FALSE; //by defult the vote is considired from outside	
	$vote=$this->input->post('vote');// vote will be 'like' or 'hate' 
	$id=$this->input->post('id'); 
	$ip=$this->input->post('ip'); 
	//$ip=$this->input->ip_address();// ip is generated in server side ....this is not working
	$country_code=$this->input->post('code');
	$this->load->model('site_model');
	
	if ($this->input->valid_ip($ip))
	{
	//$hostcode = $this->site_model->get_hostip_code($ip);
	$hostcode = $this->site_model->get_country_code($ip);
	
	   if ($hostcode == $country_code)
	   {
		$inside = TRUE; //if vote from inside and ouside is fales
	   } 
	
	}
	
	// will pass to model the persons id and the kind of the vote 
	// and if it is inside or outside the country 
	
	$maxcount = $this->site_model->max_ip_count();// get the max ip alowed number of times to vote, get it from DB
	
	if ($this->site_model->add_ip($ip,$id,$maxcount)) //if ip allowed then do vote
	{
	$this->site_model->add_vote($id,$vote,$inside);	   
	}
	//---------------------------------------------------------------
	// this is important should be activated once every thing is okay
	// seting cookie
	
	$cookname ='mtba_'.$id; 
    $current_time = time();
    $exp = $current_time + 86400 - ($current_time % 86400); //midnight time 
	setcookie($cookname,$id,$exp);
   
    //----------------------------------------------------------------
}

function test ($ip=0 )// just in case no value
{
	$this->load->model('site_model');
	$code=$this->site_model->get_hostip_code($ip);
	date_default_timezone_set("GMT");
	//echo $code;	
	$datestring = "Year: %Y Month: %m Day:%d time %h:%i %a";
	$time = time();
	echo mdate($datestring, $time);		
    echo '<br>';
	
	$tomorrow = date('Y,m,d',mktime()+86400);	
	echo $tomorrow;
//	echo date("j, n, Y");
    echo '<br>';
	echo date("j-n-Y");
    echo base_url();

}


}
// end of file