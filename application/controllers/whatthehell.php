<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Whatthehell extends CI_Controller {

//main function
public function index()
	{ if($this->session->userdata('logged_in'))
      { 
	  //print_r($this->session->userdata('logged_in'));
	   //show_error('Sorry this page dont exist!');
	     $this->load->model('admin_model');
		 $data['list'] = $this->admin_model->get_all_countries();
		 $data['first'] = TRUE;
		 $data['selected']=0;
		 $data['site']=$this->admin_model->is_site_active();
		// loading views 
		 $this->load->view('admin/admin_header_view');   
		 $this->load->view('admin/country_list_view',$data);
    	 $this->load->view('admin/admin_home_view');
		 $this->load->view('admin/admin_footer_view');
	   // redirect('admin/home', 'refresh');
	  }
	  else
	 {
		$this->load->view('admin/admin_header_view');
		$this->load->view('admin/login_view');//login form
		$this->load->view('admin/admin_footer_view');	
	  }
	}
//----------------------------------------
// admin login verification function
function VerifyLogin()
 {
	$this->load->model('admin_model'); 
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_admin');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.&nbsp; User redirected to login page
        $this->load->view('admin/admin_header_view');
        $this->load->view('admin/login_view');
		$this->load->view('admin/admin_footer_view');
   }
   else
   {
     //Go to private area
     redirect('whatthehell');
   }

 }
// cheking the DB if the password is correct
 function check_admin($password)
 {
   //Field validation succeeded.&nbsp; Validate against database
   $username = $this->input->post('username');

   //query the database
   $result = $this->admin_model->login($username, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
         'username' => $row->username
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_admin', 'Invalid username or password');
     return false;
   }
 }
 
 //logout function
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   //$this->session->sess_destroy();
   session_destroy();
   redirect('whatthehell');
 }

//this function to get the list of people in a given country  
function people(){
			   
	// if trying to acce here directly redirect to main admin login 
	if(!$this->session->userdata('logged_in')){show_404();}

	$selected_country = $this->input->post('country');
	//the 'country' is the name of the drop list in admin vewer
	//echo $selected_country; 
	
	if ($selected_country!=="0")//a country was selected                                
	
	{
        
		
		


		$this->load->model('admin_model');
		
		if ($this->admin_model->get_people($selected_country))
		{
		$data['people']= $this->admin_model->get_people($selected_country);
		$data['empty']= FALSE;
		}		
		else// if country is empty 
		{
	     $data['empty']= TRUE; 
		}
		
		$data['country_data']= $this->admin_model->get_country_data($selected_country);
		
		//preparing to make drop down list wwith selected coutnry	
	    $data['list'] = $this->admin_model->get_all_countries();
        $data['selected']=$selected_country; //a country was selected 
		

	    $this->load->view('admin/admin_header_view');
		$this->load->view('admin/country_list_view',$data);
		$this->load->view('admin/people_list_view',$data);
		$this->load->view('admin/admin_footer_view');
	

	}
	
	else
	  
	  { 
	    
		//this is just temporarry verification it should be done with form validation later 
	   	$this->load->model('admin_model');
	    $data['country_data']= $this->admin_model->get_country_data($selected_country);
		$data['list'] = $this->admin_model->get_all_countries();
		$data['first'] = FALSE;
	    $data['selected']=0;
	    $this->load->view('admin/admin_header_view');
	    $this->load->view('admin/country_list_view',$data);
	    $this->load->view('admin/admin_footer_view');
	   
	   }
	}


function add_people(){
	   // if trying to acce here directly redirect to main admin login 
	   if(!$this->session->userdata('logged_in')){show_404();}
	
		// image upload config ---------------------------
		$config['upload_path'] = './images/big/';
		$config['allowed_types'] = 'jpg';		
		$config['max_width']  = '200';
		$config['max_height']  = '200';
		$config['file_name'] = 'temp';
		
		$this->load->library('upload', $config);// loading the upload file librarry
	    $this->load->library('form_validation');// load for validation
		$this->form_validation->set_rules('fullname','Name','required|alpha_dash_space|max_length[100]');//name validation rools 
		$this->form_validation->set_rules('description','Description','required|slpha_dash_space|max_lenght[500]');//description validation rools 
		$this->form_validation->set_rules('wlink','Wekipidia link','required|valid_url|prep_url|max_lenght[500]|xss_clean');//url validation not working very propperly and i should change it later	
		if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload()))
		 {// preparing error messages for uploading images
	      $data['error'] = $this->upload->display_errors(); 
	      $data['country']= $this->input->post('country');//getting the country name form the form
	      $countryid = $this->input->post('countryid');//geting country id from the form
	      $data['countryid'] = $countryid;// this is not sure if i need it 
	      $this->load->model('admin_model');//loading model
	      $data['query'] = $this->admin_model->detect_main($countryid);//detecting main person in the                                                                         selected country
	
	      //bulding droplist of countries 
	
	      $data['list'] = $this->admin_model->get_all_countries();
	      $data['selected']=$countryid;
          // calling views
	      $this->load->view('admin/admin_header_view');//header
	      $this->load->view('admin/country_list_view',$data);//contry drop list
	      $this->load->view('admin/add_view',$data);//adding new person form data 
	      $this->load->view('admin/admin_footer_view');//footer empty for the moment 
	   
	    }
		else
		{
			
			//echo'new person was added to database';
			$datafull['countryid']=$this->input->post('countryid');
			$datafull['country']=$this->input->post('country');
			$datafull['name']=$this->input->post('fullname');
			$datafull['description']=$this->input->post('description');
			$datafull['imagelink']=$this->input->post('country');
			$datafull['wlink']=$this->input->post('wlink');
			$datafull['sex']=$this->input->post('sex');
			$datafull['defult']=$this->input->post('defult');
			$datafull['active']=$this->input->post('active');
			$idmain=$this->input->post('idmain');
			$this->load->model('admin_model');// loading the admin model
			
			if ($datafull['defult']){ 
				
				if ($idmain) { 	
						$this->admin_model->not_main( $idmain);//changing the old main person 
						
					 }
				}
			
			   
			
			$datafull['id']=$this->admin_model->add_person($datafull);//adding person to database and uploading image
			
			$this->load->model('admin_model');
	        $data['list'] = $this->admin_model->get_all_countries();
	        $data['selected']=0;
	        $data['first'] = TRUE;
			
			$this->load->view('admin/admin_header_view');
	        $this->load->view('admin/country_list_view',$data);
	        $this->load->view('admin/addsuccess_view',$datafull);
	        $this->load->view('admin/admin_footer_view');
			
			
		}
		
	}
	
	

function edit_people(){
	// if trying to acce here directly redirect to main admin login 
	if(!$this->session->userdata('logged_in')){show_404();}
	
	// image upload config ---------------------------
	$config['upload_path'] = './images/big/';
	$config['allowed_types'] = 'jpg';		
	$config['max_width']  = '200';
	$config['max_height']  = '200';
	$config['file_name'] = 'temp';
	$config['required'] = FALSE;
	$this->load->library('upload', $config);// loading the upload file librarry
	$data['error'] = $this->upload->display_errors();
	 
	$id = $this->input->post('person');
	$country = $this->input->post('country');	
	$data['first_time']=$this->input->post('first_time');// first time loading the form
	//get the country id back from edit_view.php...I MEAN IT!
	$data['country']=$this->input->post('country');
	$this->load->model('admin_model');
	$data['country_data']=$this->admin_model->get_country_data($country);
	$data['main_person']=$this->admin_model->detect_main($country);
	$data['query']=$this->admin_model->get_person($id);
	
	
	
	$this->load->library('form_validation');// load for validation
	$this->form_validation->set_rules('fullname','Name','required|alpha_dash_space|max_length[100]');
	$this->form_validation->set_rules('description','Description',
	'required|slpha_dash_space|max_lenght[500]');
	$this->form_validation->set_rules('wlink','Wekipidia link',
	'required|valid_url|prep_url|max_lenght[500]|xss_clean');
   
   
   
   if (
        ($this->form_validation->run() == FALSE)||(!$this->upload->do_upload()) 
        
      )
   
	{
	//print_r($data); 
	
	$data['list'] = $this->admin_model->get_all_countries();
	$data['first'] = TRUE;
	$data['selected']=0;	
	$this->load->view('admin/admin_header_view');
	$this->load->view('admin/country_list_view',$data);	
	$this->load->view('admin/edit_view',$data);
	$this->load->view('admin/admin_footer_view');
	//echo $selected_person.'<br>';
	//echo 'in the country '.$country;
	
	}
	else 
	{ 
	        $datafull['countryid']=$country;
			$datafull['country']=$country['name'];
			$datafull['id']=$this->input->post('person');
			$datafull['name']=$this->input->post('fullname');
			$datafull['description']=$this->input->post('description');
			$datafull['wlink']=$this->input->post('wlink');
			$datafull['sex']=$this->input->post('sex');
			$datafull['defult']=$this->input->post('defult');
			$datafull['active']=$this->input->post('active');
								    
			if ($this->input->post('defult'))// if this new defult the remove old deult
				{
				  $main=$this->admin_model->detect_main($country);			
				  if ($main and ($main->id != $id) ) { $this->admin_model->not_main($main->id); }
				  //else{ echo 'no main in this country or it is the same one beeing edited';}
				}
			
				$this->admin_model->edit_person($datafull);// submit new data to database
			
			
				$image_data = array('upload_data' => $this->upload->data());
	       if ($image_data['upload_data']['orig_name'])//upload image if exists
	          {$this->admin_model->replace_image($id);}// replacing the old mage with the new one
			
			
				//preparing to make drop down list wwith selected coutnry	
			$data['people']= $this->admin_model->get_people($country);
			$data['list'] = $this->admin_model->get_all_countries();
			$data['selected']=$country; //a country was selected 
			$data['empty']= FALSE;// country is not empty
			$this->load->view('admin/admin_header_view');
			$this->load->view('admin/country_list_view',$data);
			$this->load->view('admin/people_list_view',$data);
			$this->load->view('admin/admin_footer_view');
			
	
	
    
	}
	
	
	
  }//end of function edit_people()

// this function will be to active and desactivate countries 
function active_country()
{
	$id_country=$this->input->post('countryid');
	$this->load->model('admin_model');
	$this->admin_model->toggle_active_country($id_country);
	//$redirect_param="admin/people/".$id_country;
	redirect("admin");	
}

// this function will be to activate the site and desactivate it if i want to hide it from stupid public!..god
function active_site()
{

	$this->load->model('admin_model');
	$this->admin_model->toggle_active_site();
	redirect("admin");
}


}
?>