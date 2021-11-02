<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pemasukan_model extends CI_Model
{

	public function get_list($status = false, $order = null){
		if($status)	$this->db->where('status', 1);
		
		if($order != null) $this->db->order_by($order, 'DESC');
		return $this->db->from('tb_kasir')
		->join('tb_pelanggan', 'tb_kasir.pelanggan_id = tb_pelanggan.id')
		->select('tb_kasir.*, tb_pelanggan.nama as pelanggan')
		->get()->result();
	}
	
	public function get_barang($id, $order = null){
		if($order != null) $this->db->order_by($order, 'DESC');

		return $this->db->from('tb_kasir_detail')
		->join('tb_barang', 'tb_kasir_detail.barang_id = tb_barang.id')
		->select('tb_kasir_detail.*, tb_barang.nama as barang, tb_barang.image')
		->where('tb_kasir_detail.kasir_id', $id)
		->get()->result();
	}
}
