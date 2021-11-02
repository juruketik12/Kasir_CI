<style>
	#dt.dataTable.no-footer {
		border-bottom: unset;
	}

	#dt tbody td {
		display: block;
		border: unset;
	}

	#dt>tbody>tr>td {
		border-top: unset;
	}

	.dataTables_paginate {
		display: flex;
		align-items: center;
	}

	.dataTables_paginate a {
		padding: 0 10px;
	}

	img {
		height: 180px;
	}
	
</style>

<div class="row g-5 mb-4">
	<div class="col-md-8">
		<div class="row pt-2 mb-4 mt-3">
			<div class="input-group">
				<input class="form-control" id="search" type="search" placeholder="Cari Barang" aria-label="Search">
				<span class="input-group-text" id="icon"><i class="bi bi-search"></i></span>
			</div>
		</div>

		<div id="produk" class="row">

			<table id="dt" class="table w-100">
				<thead>
					<tr>
						<th>nama</th>
						<th>gender</th>
						<th>email</th>
						<th>address</th>
					</tr>
				</thead>
			</table>
		</div>

	</div>

	<div class="col-md-4">
		<div class="position-sticky" style="top: 2rem;">
			<div class="p-4 pb-5 bg-light rounded">
				<h4>Keranjang <a href="#" class="btn btn-sm btn-success" id="refresh-cart"><i class="bi bi-arrow-repeat"></i></a></h4>

				<table class="table">
					<thead class="text-center">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Barang</th>
							<th scope="col">Banyak</th>
							<th scope="col">Jumlah</th>
						</tr>
					</thead>
					<tbody class="text-center" id="cart-body">
						<!-- <tr>
							<td><a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a></td>
							<td class="item-name">Oreo makanan ringan enak</td>
							<td><input type="number" data-id="321" class="form-control input-qty" value="12"></td>
							<td>Rp. 24.000</td>
						</tr>
						<tr>
							<td><a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a></td>
							<td class="item-name"><span>Bakso Enak Bergizi sekali</span></td>
							<td><input type="number" data-id="123" class="form-control input-qty" value="2"></td>
							<td>Rp. 24.000</td>
						</tr>
						<tr>
							<td colspan="3" class="fw-bold">Total</td>
							<td>Rp. 48.000</td>
						</tr> -->
					</tbody>
				</table>

				<a href="#" class="btn btn-success btn-sm float-end"><i class="bi bi-cash"></i> Proses</a>
			</div>
		</div>

	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		var dt = $('#dt').DataTable({
			ajax: "<?= base_url($tabel) ?>",
			bInfo: false,
			pageLength: 12,
			lengthChange: false,
			deferRender: true,
			processing: true,
			columns: [{
					render: function(data, type, row, meta) {
						var html =
							'<div class="card shadow">' +
							'  <img src="' + row.image + '" class="card-img-top">' +
							'  <div class="card-body">' +
							'    <div class="card-text">' + row.kode + '</div>' +
							'    <div class="card-text">' + row.nama + '</div>' +
							'    <div class="d-flex justify-content-between">' +
							'      <span class="card-text">' + row.harga + '</span>' +
							'      <a href="#" onClick="addCart(' + row.id + ')" class="btn btn-primary btn-sm float-end"><i class="bi bi-cart-plus"></i></a>' +
							'    </div>' +
							'  </div>' +
							'</div>';
						return html;
					}
				},
				{
					data: "nama",
					visible: false
				}
			],
		});

		dt.on('draw', function(data) {
			$('#dt tbody').addClass('row');
			$('#dt tbody tr').addClass('col-md-3 col-sm-12');
		});

		$("#dt thead").hide();
		$('#dt_filter').hide();

		$('#search').keyup(function() {
			dt.search($(this).val()).draw();
		});

	});

	function getCart() {
		$.get("<?= base_url('kasir/get_cart') ?>", function(res, status) {
			$('#cart-body').empty()
			$('#cart-body').append(res)
		});
	}

	function addCart(id) {
		$.post("<?= base_url('kasir/add_cart') ?>", {
			id
		}, function(data) {
			getCart()
			// console.log(JSON.parse(data))
		});
	}

	function removeCart(no) {
		var rowId = $('input[name=rowId-' + no + ']').val()
		$.post("<?= base_url('kasir/remove_cart') ?>", {
			id: rowId
		}, function(data) {
			getCart()
			// console.log(JSON.parse(data))
		});
	}

	$('#refresh-cart').click(function() {
		$.get("<?= base_url('kasir/refresh_cart') ?>", function(res, status) {
			getCart()
		});
	})

	$('.input-qty').on('change', function() {
		console.log($(this).val());
		console.log($(this).data('id'));
	})

	getCart()
</script>
