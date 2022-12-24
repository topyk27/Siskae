<?php 
/**
 * 
 */
class Error_cuy extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('404');
	}
}
 ?>