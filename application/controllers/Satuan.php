<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
	}

	public function get_satuan_form()
	{
		$list =  $this->global->get_data_all('tb_satuan');

		echo json_encode($list);
	}
}
