<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Pemasukan_model', 'pemasukan');
	}

	public function index()
	{
		$data = [
			'title' => 'Pemasukan',
			'url_tabel' => 'pemasukan/get_pemasukan'
		];

		$this->template->view('pemasukan/index', $data);
	}

	public function get_pemasukan()
	{
		$list =  $this->pemasukan->get_list(false, 'id');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			// $status = '<a href="' . base_url() . 'barang/status/' . $field->id . '" class="btn btn-sm btn-success"><i class="bi bi-check"></i></a>';
			// if ($field->status == 0) {
			// 	$status = '<a href="' . base_url() . 'barang/status/' . $field->id . '" class="btn btn-sm btn-danger"><i class="bi bi-x"></i></a>';
			// }

			$barangs = $this->pemasukan->get_barang($field->id, true);
			foreach ($barangs as $value) {
				$edit = '<a href="#" onClick="onEdit(' . $field->id . ')" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>';
				$detail = '<a href="' . base_url() . 'barang/detail/' . $field->id . '" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>';
	
				$row = array();
				$row[] = ++$no;
				$row[] = '<img src="' . base_url() . 'assets/images/barang/' . $value->image . '" class="img-thumbnail" width="200px">';
				$row[] = $value->barang;
				$row[] = $value->qty;
				$row[] = rupiah( $value->harga);
				$row[] = rupiah( $value->total);
				$row[] = $field->pelanggan;
				$row[] = tanggal($field->create_date);
				// $row[] = $status;
				// $row[] = $edit;
	
				$data[] = $row;
			}

		}

		$output = ["data" => $data];

		echo json_encode($output);
	}
}
