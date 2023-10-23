<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','download')); 
	  }

	public function index()
	{
		$this->load->model('M_Repositori');
    	$this->load->model('M_Category');

		$data['repositori'] = $this->M_Repositori->getAll();

		$this->load->view('user/index', $data);
	}

	public function get_download($file){ 
		force_download('uploads/file/'.$file,NULL);
	  }
}
