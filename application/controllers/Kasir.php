<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
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
			'title' => 'Kasir',
			// 'tabel' => 'kasir/get_barang'
		];

		// $this->template->view('kasir/index', $data);
		$this->template->view('kasir/index2', $data);
	}

	public function get_barang()
	{
		$list = $this->barang->get_list(true, 'id');
		$data = array();

		$no = 0;
		foreach ($list as $field) {

			// $stoks = $this->global->get_data_where_in('tb_stok', 'barang_id', $field->id, true);
			// $stok = 0;
			// foreach ($stoks as $value) {
			// 	$stok += $value->stok_tambah;
			// 	$stok -= $value->stok_kurang;
			// }

			$row = array();
			$row['id'] = $field->id;
			$row['image'] = base_url() . 'assets/images/barang/' . $field->image;
			$row['kode'] = $field->kode;
			$row['nama'] = $field->nama;
			// $row[] = $stok;
			$row['harga'] = rupiah($field->harga_jual);

			$data[] = $row;
		}

		$output = ["data" => $data];

		echo json_encode($output);
	}

	public function get_cart()
	{
		$data = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$rowId = $items['rowid'];
			$name = $items['name'];
			$qty = $items['qty'];
			$kode = $items['kode'];
			$price = rupiah($items['subtotal']);
			$data .= '<tr>
						<td><a href="#" onClick="removeCart(' . ++$no . ')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a></td>
						<input type="hidden" name="rowId-' . $no . '" value="' . $rowId . '">
						<td>' . $kode . '</td>
						<td class="item-name">' . $name . '</td>
						<td>' . $qty . '</td>
						<td>' . $price . '</td>
					</tr>';
		}

		$data .= '<tr>
					<td colspan=4" class="fw-bold">Total</td>
					<td id="cart-total">' . rupiah($this->cart->total()) . '</td>
				</tr>';

		if (!$this->cart->contents()) {
			$data = '<tr>
						<td colspan="4" class="fw-bold">Cart Kosong</td>
					</tr>';
		}

		echo ($data);
	}

	public function add_cart()
	{
		$id = $this->input->post()['id'];
		$qty = (int)$this->input->post()['qty'];

		$barang = $this->global->get_by_id('tb_barang', ['id' => $id]);

		$data = array(
			'id'      => $barang['id'],
			'qty'     => $qty,
			'price'   => $barang['harga_jual'],
			'name'    => $barang['nama'],
			'kode'	  => $barang['kode'],
		);

		$this->cart->insert($data);
	}

	public function remove_cart()
	{
		$id = $this->input->post()['id'];

		$this->cart->remove($id);
	}

	public function refresh_cart()
	{
		$this->cart->destroy();
	}

	public function store()
	{
		$post = $this->input->post();

		$config = array(
			array(
				'field' => 'pelanggan_id',
				'label' => 'Pelanggan',
				'rules' => 'required',
			),
		);

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == false) {
			$data = [
				'title' => 'Kasir',
				'post' => $post
			];

			$this->template->view('kasir/index2', $data);
		} else {

			$data = array(
				'pelanggan_id' => $post['pelanggan_id'],
			);

			$kasir_id = $this->global->post_data('tb_kasir', $data);

			$detail = array();
			foreach ($this->cart->contents() as $items) {
				$row['kasir_id'] = $kasir_id;
				$row['barang_id'] = $items['id'];
				$row['qty'] = $items['qty'];
				$row['harga'] = $items['price'];
				$row['total'] = $items['subtotal'];

				$detail[] = $row;
			}

			$this->cart->destroy();

			if ($this->global->insert_batch('tb_kasir_detail', $detail)) {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Berhasil disimpan!", "success", "fa fa-check") </script>');
			} else {
				$this->session->set_flashdata('notifikasi', '<script>notifikasi( "Data Gagal disimpan!", "danger", "fa fa-check") </script>');
			}
			redirect('kasir');
		}
	}
}
