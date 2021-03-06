<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model('golongan_model');
		$this->load->model('stock_model');
		// $this->output->enable_profiler(TRUE);
    }


	public function index()
	{
		// $this->load->view('public/home', $this->data);
		$this->data['golongan'] = $this->golongan_model->get_all();

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
		}
		
		// $this->data['rnd_products'] = $this->stock_model->get_random_products();
		$this->data['rnd_products'] = $this->stock_model->get_limit_data(6,0);
		$this->data['rnd_products2'] = $this->stock_model->get_limit_data(6,7);
		$this->data['rnd_products3'] = $this->stock_model->get_limit_data(6,13);

		$this->load->view('layout/header', $this->data);
		$this->load->view('dashboard/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}
