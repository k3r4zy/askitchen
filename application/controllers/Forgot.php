<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends Public_Controller {

    public function __construct()
    {
		parent::__construct();
    }


	public function index()
	{
		// $this->load->view('public/home', $this->data);
		$this->load->view('layout/header', $this->data);
		$this->load->view('forgot/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}
