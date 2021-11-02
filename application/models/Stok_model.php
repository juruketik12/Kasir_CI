<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stok_model extends CI_Model
{

	public function get_list($status = false, $order = null){
		if($status)	$this->db->where('status', 1);
		if($order != null) $this->db->order_by($order, 'DESC');

		return $this->db->from('tb_stok')
		->join('tb_barang', 'tb_stok.barang_id = tb_barang.id')
		->select('tb_barang.kode, tb_barang.nama, tb_stok.*')
		->get()->result();
	}
}
