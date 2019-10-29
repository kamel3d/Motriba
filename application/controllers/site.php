<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller {

public function index()
{
  $this->load->model('admin_model');
  if (!$this->admin_model->is_site_active())
  {
  $this->load->view('maintenance_view');
  }
  else
  {
  $this->load->model('site_model');
  $data['list']= $this->site_model->get_all_countries();
  //$data['first'] = TRUE;
  //$data['selected'] = 0;
  $data['home'] = TRUE;
  $data['person_page'] = FALSE;
  $data['privacy'] = FALSE;	
 // print_r($data);
  $this->load->view('header_view',$data);
  $this->load->view('home_page_view',$data);
  $this->load->view('footer_view');
  }
}

function explore()
{
  echo "coming soon..";
}
	
}
?>