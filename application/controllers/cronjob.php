<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob extends CI_Controller {
	
// cron jobs functions
// copy dta from stats_temp table to stats table and clean stats_temp table
// this should be run every hour
function temp_to_stats()
{	
	$this->load->model('admin_model');
	$this->admin_model->copy_temp();
	echo 'job done!';
}

// function to creat new entries for all people in stats table
// this should be run every day after midnight
function new_stats()
{	
	$this->load->model('admin_model');
	$today=$this->admin_model->get_today();
	$this->admin_model->copy_temp($today);//copying last stats if there are any
	echo 'votes copied to stats table and stats_tem was waped out'."<br>";
	$this->admin_model->empty_ip_table();
	echo 'ip adress table was waped out'."<br>";
	$this->admin_model->nex_day_stats();
	echo 'new states row was added for all people';
}

}
//end of file
