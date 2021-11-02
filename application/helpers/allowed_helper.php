<?php

if (!function_exists('allowed')) {
	function allowed($param, $param2 = null, $param3 = null)
	{
		$CI = &get_instance();
		$role = $CI->session->userdata('role');
		if ($role == null) {
			$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda harus login terlebih dahulu", "danger", "fa fa-exclamation")</script>');
			redirect(base_url('admin/login'));
		} elseif ($role != $param2 && $role != $param && $role != $param3) {
			if ($param == 'super admin') {
				$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Super Admin", "danger", "fa fa-exclamation")</script>');
				redirect(base_url('admin/login'));
			} elseif ($param == 'admin') {
				$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Admin", "danger", "fa fa-exclamation")</script>');
				redirect(base_url('admin/login'));
			} elseif ($param == 'guru') {
				$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Guru", "danger", "fa fa-exclamation")</script>');
				redirect(base_url('admin/login'));
			}
		}
	}
}
