<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlm extends MY_Controller {
	
	function Mlm(){
		parent::__construct();
	}
	
	public function index(){
		
		$this->layout->view("index_view");
	}
}