<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Country extends CI_Controller {

function _remap($country_name = NULL,$person_name = NULL)
{
	date_default_timezone_set("GMT");// making gmt time as defult because vote ends at midnight gmt 

	if (! $person_name )// if in the url the country name only
	{
    $no_dash_country_name= str_replace ("-"," ",$country_name);
	  
	$this->load->model('site_model');
	
	if (!$data['country'] = $this->site_model->get_country_perid($no_dash_country_name))
	{// show error if country dont exist
	//show_404(); 	
	redirect('error/error_404');	
	}
    
	if (!$this->site_model->is_country_active($data['country']->id))
	{// show error if country no active 
	//show_404(); 	
	redirect('error/error_404');
	}
	
	$data['person']  = $this->site_model->detect_main($data['country']->id);
	
	$person_name= url_title($data['person']->name);//replacing space with dashes
	  	
	redirect(strtolower ('country/'.$country_name.'/'.$person_name));// redirecting to this same method but if will gove throw cos person ma existes 
	
	}
	
    else //if in the URI containe the country name and persons name
	{
	    $this->load->helper('stats_helper');// helper contain percentage calculator
		$this->load->model('site_model');	
		$no_dash_country_name= str_replace ("-"," ",$this->uri->segment(2));
	    $data['country_uri']=$this->uri->segment(2);
		$no_dash_person_name= str_replace ("-"," ",$this->uri->segment(3));
		
		if (!$data['country'] = $this->site_model->get_country_perid($no_dash_country_name))
		{// show error if country dont exist
		show_404(); 	
		}
		
		if (!$this->site_model->is_country_active($data['country']->id))
		{// show error if country not active 
		show_404(); 	
		}
		
		if (!$data['person'] = $this->site_model->get_person_id($no_dash_person_name))
		{// show error if person dont exist
		show_404(); 
		}
		
		if (!$this->site_model->is_person_active($data['person']->id))
		{// show error if person not active 
		show_404(); 	
		}
		
		$id_person=$data['person']->id;
		
		$ip=$this->input->ip_address();// geting ip adress
		$maxcount = $this->site_model->max_ip_count();// get the max ip alowed number of times to vote, get it from DB
		if ($this->site_model->is_ip_allowed($ip,$id_person,$maxcount))// verify if this ip is allowed to vote or not 
		{$data['ip_allowed'] = TRUE;
		}
		else
		{$data['ip_allowed'] = FALSE;
		}
		
	    $data['other_people'] = $this->site_model->people_from_same_country($data['country']->id,$id_person);
		$data['stats'] = $this->site_model->get_today_stats($id_person);// get stats for today number	
        $data['list']= $this->site_model->get_all_countries();
		$data['home'] = FALSE;
		$data['person_page'] = TRUE;
		$data['privacy'] = FALSE;	
	    $data['graph_data'] = $this->site_model->graph_data($id_person);//geting data to buld the graph
        
		// loading views
		$this->load->view('header_view',$data);
		$this->load->view('main_person_view',$data);
		$this->load->view('footer_view');
	}
	
}
	

	
	
// function to show live stats	
function live($id_person)
{
	
	



}	
	
	
	
/*	
	function index()
{		 
	//$foo=$this->input->post('number');
	//$data['idcountry'] = $this->input->post('countrylist');
	
	$no_dash_country_name= str_replace ("-"," ",$country_name);
	
    $this->load->model('site_model');
	$data['country']      = $this->site_model->get_country_perid($no_dash_country_name);   
	$data['person']       = $this->site_model->detect_main($data['country']['id']);
	$data['other_people'] = $this->site_model->people_from_same_country($idcountry);
	
	//loading view
  
	$this->load->view('header_view');
	$this->load->view('main_person_view',$data);
	$this->load->view('footer_view');
	
}
*/
  
}
?>