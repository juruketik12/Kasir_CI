<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gudang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Stok_model', 'stok');
	}

	public function index()
	{
		$data = [
			'title' => 'Gudang',
			'url_tabel' => 'gudang/get_stok'
		];

		$this->template->view('gudang/index', $data);
	}

	public function get_stok()
	{
		$list =  $this->stok->get_list(false, 'id');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="' . base_url() . 'gudang/status/' . $field->id . '" class="btn btn-sm btn-success"><i class="bi bi-check"></i></a>';
			if ($field->status == 0) {
				$status = '<a href="' . base_url() . 'gudang/status/' . $field->id . '" class="btn btn-sm btn-danger"><i class="bi bi-x"></i></a>';
			}

			$edit = '<a href="#" onClick="onEdit(' . $field->id . ')" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>';
			$detail = '<a href="' . base_url() . 'barang/detail/' . $field->id . '" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>';

			$stok = '+' . $field->stok_tambah;;
			if ($field->stok_tambah == '0') {
				$stok = '-' . $field->stok_kurang;
			}

			$row = array();
			$row[] = ++$no;
			$row[] = $field->kode;
			$row[] = $field->nama;
			$row[] = $stok;
			$row[] = $field->keterangan != '' ? $field->keterangan : 'Tidak ada keterangan';
			$row[] = $status;
			$row[] = tanggal($field->tanggal);
			// $row[] = $edit;

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
				'field' => 'stok',
				'label' => 'Stok',
				'rules' => 'required|greater_than[10]',
			),
			array(
				'field' => 'barang_id',
				'label' => 'Barang',
				'rules' => 'required',
			),
		);

		if ($post['check'] == '0') {
			array_push(
				$config,
				array(
					'field' => 'keterangan',
					'label' => 'Keterangan',
					'rules' => 'required|min_length[10]',
				),
			);
		}

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == false) {
			$data = [
				'title' => 'Gudang',
				'url_tabel' => 'gudang/get_stok',
				'post' => $post,
			];

			$this->template->view('gudang/index', $data);
		} else {
			$data = array(
				'barang_id' => $post['barang_id'],
				$post['check'] == '1' ? 'stok_tambah' : 'stok_kurang' => $post['stok'],
				'keterangan' => $post['keterangan'],
			);

			if ($this->global->post_data('tb_stok', $data) != null) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('gudang');
		}
	}

	public function status()
	{
		$id = $this->uri->segment(3);
		$barang = $this->global->get_by_id('tb_stok', array('id' => $id));

		$status = 0;
		if ($barang['status'] == 0) $status = 1;

		$data = array('status' => $status);

		if ($this->global->put_data('tb_stok', $data, array('id' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('gudang');
	}
}
