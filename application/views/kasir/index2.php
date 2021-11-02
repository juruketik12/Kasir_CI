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

	.table-total td {
		font-size: 40px;
	}

	#add-img {
		height: 236px;
	}
</style>

<div class="row mb-4 justify-content-between">

	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<div class="mb-3">
					<label for="barang" class="form-label">Barang</label>
					<br>
					<select class="form-control" id="barang" name="barang_id"></select>
				</div>
				<div class="mb-3">
					<label class="form-label">Quantity</label>
					<input type="number" class="form-control" id="stok" name="stok" value="1">
				</div>
				<div class="mb-3">
					<button type="button" id="addCart" class="btn btn-sm btn-primary float-end">Add to Cart</button>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<img class="img-fluid img-thumbnail" id="add-img" src="" alt="">
	</div>

	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<table class="table">
					<tbody class="table-total">
						<tr>
							<td>Total</td>
							<td>:</td>
							<td id="total">Rp. 0</td>
						</tr>
					</tbody>
				</table>

				<form action="<?= base_url('kasir/store') ?>" id="kasir-store" method="post">
					<div class="mt-2 mb-2">
						<!-- <label for="pelanggan" class="form-label">Pelanggan</label> -->
						<select class="form-control" id="pelanggan" name="pelanggan_id"></select>
					</div>
					<span class="text-danger mt-2"><?= form_error('pelanggan_id') ?></span>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="position-sticky" style="top: 2rem;">
			<div class="p-4 pb-5 bg-light rounded mb-4">
				<h4>Keranjang <a href="#" class="btn btn-sm btn-success float-end" id="refresh-cart"><i class="bi bi-arrow-repeat"></i></a></h4>
				<div class="table-responsive">
					<table class="table">
						<thead class="text-center">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kode</th>
								<th scope="col">Barang</th>
								<th scope="col">Banyak</th>
								<th scope="col">Jumlah</th>
							</tr>
						</thead>
						<tbody class="text-center" id="cart-body">
							<!-- <tr>
							<td><a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a></td>
							<td>KD12</td>
							<td class="item-name">Oreo makanan ringan enak</td>
							<td>12</td>
							<td>Rp. 24.000</td>
						</tr>
						<tr>
							<td><a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a></td>
							<td>KD13</td>
							<td class="item-name"><span>Bakso Enak Bergizi sekali</span></td>
							<td>2</td>
							<td>Rp. 24.000</td>
						</tr>
						<tr>
							<td colspan="4" class="fw-bold">Total</td>
							<td>Rp. 48.000</td>
						</tr> -->
						</tbody>
					</table>
				</div>

				<a href="#" class="btn btn-success btn-sm float-end" id="proses-btn"><i class="bi bi-cash"></i> Proses</a>
			</div>
		</div>

	</div>
</div>


<script type="text/javascript">
	function dropdown() {
		$.get("<?= base_url('barang/get_barang_form') ?>", function(res, status) {
			var data = JSON.parse(res);
			$('#barang').find('option')
				.remove()
				.end()
				.append('<option value="0" selected>Pilih Barang</option>')
				.val('');
			data.forEach(e => {
				$('#barang').append('<option value="' + e.id + '">' + e.kode + ' | ' + e.nama + '</option>');
			});
			$('#barang').selectpicker({
				liveSearch: true
			});

			$('#barang').selectpicker('refresh')
		});
	}

	dropdown()

	function dropdown2() {
		$.get("<?= base_url('pelanggan/get_pelanggan_form') ?>", function(res, status) {
			var data = JSON.parse(res);
			$('#pelanggan').find('option')
				.remove()
				.end()
				.append('<option value="" selected>Pilih Pelanggan</option>')
				.val('');
			data.forEach(e => {
				$('#pelanggan').append('<option value="' + e.id + '">' + e.nama + ' | ' + e.alamat + '</option>');
			});
			$('#pelanggan').selectpicker({
				liveSearch: true
			});

			$('#pelanggan').selectpicker('refresh')
		});
	}

	dropdown2()

	$('#barang').on('change', function() {
		var id = $(this).val()
		$.get("<?= base_url('barang/get_id/') ?>" + id, function(res, status) {
			var data = JSON.parse(res);
			$('#add-img').attr('src', '<?= base_url('assets/images/barang/') ?>' + data.image)
		});
	})

	$('#addCart').on('click', function() {
		var barang_id = $('#barang').val();
		var qty = $('#stok').val();

		if (barang_id != '0' || qty >= 0) {
			addCart(barang_id, qty)
			$('#barang').removeAttr('selected')
			dropdown()

			$('#stok').val(1)
			$('#add-img').attr('src', '')
		}
	})

	function getCart() {
		$.get("<?= base_url('kasir/get_cart') ?>", function(res, status) {
			$('#cart-body').empty()
			$('#cart-body').append(res)
			var total = $('#cart-total').text()
			if (total) {
				$('#total').text(total)
			} else {
				$('#total').text('Rp. 0')
			}
		});
	}

	function addCart(id, qty) {
		$.post("<?= base_url('kasir/add_cart') ?>", {
			id,
			qty
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

	$('#proses-btn').click(function() {
		$('#kasir-store').submit()
	})

	getCart()
</script>
