<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
	}

	public function index()
	{
		$data = [
			'title' => 'Pelanggan',
			'url_tabel' => 'pelanggan/get_pelanggan'
		];

		$this->template->view('pelanggan/index', $data);
	}

	public function get_pelanggan()
	{
		$list =  $this->global->get_data_all('tb_pelanggan');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			// $status = '<a href="' . base_url() . 'pelanggan/status/' . $field->id . '" class="btn btn-sm btn-success"><i class="bi bi-check"></i></a>';
			// if ($field->status == 0) {
			// 	$status = '<a href="' . base_url() . 'pelanggan/status/' . $field->id . '" class="btn btn-sm btn-danger"><i class="bi bi-x"></i></a>';
			// }

			$edit = '<a href="#" onClick="onEdit(' . $field->id . ')" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>';
			$detail = '<a href="' . base_url() . 'pelanggan/detail/' . $field->id . '" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>';

			$row = array();
			$row[] = ++$no;
			// $row[] = '<img src="' . base_url() . 'assets/images/pelanggan/' . $field->image . '" class="img-thumbnail" width="200px">';
			$row[] = $field->nama;
			$row[] = $field->nomor;
			$row[] = $field->alamat;
			// $row[] = $status;
			$row[] = $edit;

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function insert()
	{
		$post = $this->input->post();

		$config = array(
			array(
				'field' => 'nama',
				'label' => 'Nama Pelanggan',
				'rules' => 'required',
			),
			array(
				'field' => 'nomor',
				'label' => 'Nomor',
				'rules' => 'required',
			),
			array(
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'required',
			),
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == false) {
			$data = [
				'title' => 'Pelanggan',
				'url_tabel' => 'pelanggan/get_pelanggan',
				'post' => $post,
			];

			$this->template->view('pelanggan/index', $data);
		} else {

			$data = array(
				'nama' => $post['nama'],
				'nomor' => $post['nomor'],
				'alamat' => $post['alamat'],
			);

			if ($this->global->post_data('tb_pelanggan', $data) != null) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('pelanggan');
		}
	}

	public function get_id()
	{
		$id = $this->uri->segment(3);
		$pelanggan = $this->global->get_by_id('tb_pelanggan', array('id' => $id));

		echo json_encode($pelanggan);
	}

	public function update()
	{
		$post = $this->input->post();

		$config = array(
			array(
				'field' => 'nama',
				'label' => 'Nama Pelanggan',
				'rules' => 'required',
			),
			array(
				'field' => 'nomor',
				'label' => 'Nomor',
				'rules' => 'required',
			),
			array(
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'required',
			),
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == false) {
			$data = [
				'title' => 'Pelanggan',
				'url_tabel' => 'pelanggan/get_pelanggan',
				'post' => $post,
			];

			$this->template->view('pelanggan/index', $data);
		} else {

			$data = array(
				'nama' => $post['nama'],
				'nomor' => $post['nomor'],
				'alamat' => $post['alamat'],
			);

			if ($this->global->put_data('tb_pelanggan', $data, array('id' => $post['id']))) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('pelanggan');
		}
	}

	public function get_pelanggan_form()
	{
		$list =  $this->global->get_data_all('tb_pelanggan', false, 'id');

		echo json_encode($list);
	}
}
