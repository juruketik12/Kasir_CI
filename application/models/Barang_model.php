<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Barang_model extends CI_Model
{

	public function get_list($status = false, $order = null){
		if($status)	$this->db->where('status', 1);
		
		if($order != null) $this->db->order_by($order, 'DESC');
		return $this->db->from('tb_barang')
		->join('tb_satuan', 'tb_barang.satuan = tb_satuan.id')
		->select('tb_barang.*, tb_satuan.nama as satuan')
		->get()->result();
	}
	
	public function get_new_kode(){
		$kode = $this->db->select('kode')
		->order_by('id',"DESC")
		->get('tb_barang')
		->row()->kode;
		
		$kode = substr($kode, 2);
		$kode = (int)$kode + 1;
		$kode = 'KD' . $kode;

		return $kode;
	}
}
