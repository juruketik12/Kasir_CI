<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.84.0">
	<title><?= $title ?> | Kasirku</title>


	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
	<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/picker/picker.min.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

	<!-- Custom styles for this template -->

	<link href="<?= base_url('assets/css/blog.css') ?>" rel="stylesheet">

	<!-- Custom javascript for this template -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
	<!-- <script type="text/javascript" src="<?= base_url() ?>assets/picker/picker.min.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/i18n/defaults-id_ID.min.js"></script>

</head>

<body>

	<?php $this->load->view('layouts/header') ?>

	<main class="container">

		<?php $this->load->view($content) ?>

	</main>

	<?php $this->load->view('layouts/footer') ?>

	<?php if (isset($url_tabel)) : ?>
		<script>
			$(document).ready(function() {
				var table = $('#table').DataTable({
					deferRender: true,
					processing: true,
					"language": {
						"lengthMenu": "Tampil _MENU_ data",
						"zeroRecords": "Data tidak ditemukan",
						"info": "Halaman _PAGE_ dari _PAGES_",
						"infoEmpty": "Data tidak tersedia",
						"infoFiltered": "(filtered from _MAX_ total records)",
					},
					"ajax": '<?= base_url($url_tabel) ?>'
				});
			});
		</script>
	<?php endif ?>

	<!-- <script>
		$.fn.selectpicker.Constructor.BootstrapVersion = '5';
	</script> -->

</body>

</html>
