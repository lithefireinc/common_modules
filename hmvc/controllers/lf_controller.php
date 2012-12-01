<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function Admin(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('commonmodel', '', TRUE);
		$this->load->model('lithefire_model','lithefire',TRUE);
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('main/login', 'refresh');
		}
	}
	
	function loadActiveSemester(){
         $this->load->model('lithefire_model','lithefire',TRUE);
        $db = "fr";


		$filter = "IS_ACTIVE = 1";
		
		$fr_db = $this->config->item("fr_db");
        $table = "FILESEME";
        $fields = array("SEMEIDNO", "SEMESTER as semester", "DESCRIPTIO");

       

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);

        foreach($records as $row):
            
            $data["data"] = $row;


        endforeach;
        $data['success'] = true;

        die(json_encode($data));
    }
	
	
}