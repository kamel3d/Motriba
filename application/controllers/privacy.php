<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Privacy extends CI_Controller {

public function index()
{
  $this->load->model('site_model');
  $data['list']= $this->site_model->get_all_countries();
  $data['home'] = FALSE;
  $data['person_page'] = FALSE;
  $data['privacy'] = TRUE;	
  $this->load->view('header_view',$data);
  $this->load->view('privacy_view');
  $this->load->view('footer_view');
}


	
}