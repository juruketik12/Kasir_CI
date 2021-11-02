<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Global_model', 'global');
		$this->load->model('Barang_model', 'barang');
	}

	public function index()
	{
		$data = [
			'title' => 'Barang',
			'url_tabel' => 'barang/get_barang'
		];

		// echo json_encode($data);
		$this->template->view('barang/index', $data);
	}

	public function get_barang()
	{
		$list =  $this->barang->get_list(false, 'id');
		$data = array();

		$no = 0;
		foreach ($list as $field) {
			$status = '<a href="' . base_url() . 'barang/status/' . $field->id . '" class="btn btn-sm btn-success"><i class="bi bi-check"></i></a>';
			if ($field->status == 0) {
				$status = '<a href="' . base_url() . 'barang/status/' . $field->id . '" class="btn btn-sm btn-danger"><i class="bi bi-x"></i></a>';
			}

			$stoks = $this->global->get_data_where_in('tb_stok', 'barang_id', $field->id, true);
			$stok = 0;
			foreach ($stoks as $value) {
				$stok += $value->stok_tambah;
				$stok -= $value->stok_kurang;
			}

			$edit = '<a href="#" onClick="onEdit(' . $field->id . ')" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>';
			$detail = '<a href="' . base_url() . 'barang/detail/' . $field->id . '" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>';

			$row = array();
			$row[] = ++$no;
			$row[] = '<img src="' . base_url() . 'assets/images/barang/' . $field->image . '" class="img-thumbnail" width="200px">';
			$row[] = $field->kode;
			$row[] = $field->nama;
			$row[] = $field->satuan;
			$row[] = $stok;
			$row[] = rupiah($field->harga_beli);
			$row[] = rupiah($field->harga_jual);
			$row[] = $status;
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
				'label' => 'Nama barang',
				'rules' => 'required',
			),
			array(
				'field' => 'satuan',
				'label' => 'Satuan',
				'rules' => 'required',
			),
			array(
				'field' => 'harga_beli',
				'label' => 'Harga Beli',
				'rules' => 'required',
			),
			array(
				'field' => 'harga_jual',
				'label' => 'Harga Jual',
				'rules' => 'required',
			),
		);

		$images['upload_path']          = './assets/images/barang/';
		$images['allowed_types']        = 'gif|jpg|png|jpeg';
		$images['max_size']             = 1000;

		$this->load->library('upload', $images);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == false || !$this->upload->do_upload('image')) {
			$error = $this->upload->display_errors();
			$data = [
				'title' => 'Barang',
				'url_tabel' => 'barang/get_barang',
				'post' => $post,
				'image_error' => $error
			];

			$this->template->view('barang/index', $data);
		} else {

			$kode = $this->barang->get_new_kode();

			$data = array(
				'kode' => $kode,
				'nama' => $post['nama'],
				'satuan' => $post['satuan'],
				'harga_beli' => $post['harga_beli'],
				'harga_jual' => $post['harga_jual'],
				'image' => $this->upload->data() != null ? $this->upload->data()['file_name'] : 'images.png',
			);

			if ($this->global->post_data('tb_barang', $data) != null) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('barang');
		}
	}

	public function get_id()
	{
		$id = $this->uri->segment(3);
		$barang = $this->global->get_by_id('tb_barang', array('id' => $id));

		echo json_encode($barang);
	}

	public function update()
	{
		$post = $this->input->post();

		$config = array(
			array(
				'field' => 'nama',
				'label' => 'Nama barang',
				'rules' => 'required',
			),
			array(
				'field' => 'satuan',
				'label' => 'Satuan',
				'rules' => 'required',
			),
			array(
				'field' => 'harga_beli',
				'label' => 'Harga Beli',
				'rules' => 'required',
			),
			array(
				'field' => 'harga_jual',
				'label' => 'Harga Jual',
				'rules' => 'required',
			),
		);

		$images['upload_path']          = './assets/images/barang/';
		$images['allowed_types']        = 'gif|jpg|png|jpeg';
		$images['max_size']             = 1000;

		$this->load->library('upload', $images);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == false) {
			$error = $this->upload->display_errors();
			$data = [
				'title' => 'Barang',
				'url_tabel' => 'barang/get_barang',
				'post' => $post,
				'update' => $this->global->get_by_id('tb_barang', array('id' => $post['id']))['image'],
				'image_error' => $error
			];

			$this->template->view('barang/index', $data);
		} else {

			$data = array(
				'nama' => $post['nama'],
				'satuan' => $post['satuan'],
				'harga_beli' => $post['harga_beli'],
				'harga_jual' => $post['harga_jual'],
			);

			if ($this->upload->data()['file_name'] != null) $data += array('image' => $this->upload->data()['file_name']);

			if ($this->global->put_data('tb_barang', $data, array('id' => $post['id']))) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('barang');
		}
	}

	public function status()
	{
		$id = $this->uri->segment(3);
		$barang = $this->global->get_by_id('tb_barang', array('id' => $id));

		$status = 0;
		if ($barang['status'] == 0) $status = 1;

		$data = array('status' => $status);

		if ($this->global->put_data('tb_barang', $data, array('id' => $id))) {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil diupdate!", "success", "fa fa-check") </script>');
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal diupdate!", "danger", "fa fa-check") </script>');
		}
		redirect('barang');
	}

	public function get_barang_form()
	{
		$list =  $this->global->get_data_all('tb_barang', true, 'id');

		echo json_encode($list);
	}
}
