<div class="row g-5 mb-4">
	<div class="col-md-12">

		<div class="row justify-content-end">
			<div class="col-md-6">
				<a href="#" class="btn btn-primary float-end" id="addGudangBtn"><i class="bi bi-plus-lg"></i> Tambah
					Data</a>
			</div>
		</div>

		<div class="card mt-2">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="table">
						<thead class="text-center">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kode</th>
								<th scope="col">Barang</th>
								<th scope="col">Stok</th>
								<th scope="col">Keterangan</th>
								<th scope="col">Status</th>
								<th scope="col">Tanggal</th>
							</tr>
						</thead>
						<tbody class="text-center">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Add -->
<div class="modal fade" id="addGudang" tabindex="-1" aria-labelledby="addGudangLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addGudangLabel">Tambah Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url() ?>gudang/insert" id="formPost" method="POST">
				<div class="modal-body">
					<div class="mb-3">
						<label for="barang" class="form-label">Barang</label>
						<br>
						<select class="form-control" id="barang" name="barang_id"></select>
						<span class="text-danger"><?= form_error('barang_id') ?></span>
					</div>
					<div class="mb-3">
						<div class="row">
							<label class="form-label">Stok</label>
							<div class="col-6 text-center">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="check" id="tambah_stok" value="1" <?= isset($post['check']) ? ($post['check'] != '1' ? '' : 'checked') : 'checked' ?>>
									<label class="form-check-label" for="tambah_stok">Tambah</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="check" id="kurang_stok" value="0" <?= isset($post['check']) ? ($post['check'] != '0' ? '' : 'checked') : '' ?>>
									<label class="form-check-label" for="kurang_stok">Kurang</label>
								</div>
							</div>
							<div class="col-6">
								<input type="number" class="form-control" name="stok" value="<?= isset($post['stok']) ? $post['stok'] : '0' ?>">
							</div>
							<span class="text-danger"><?= form_error('stok') ?></span>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Keterangan</label>
						<input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" value="<?= isset($post['keterangan']) ? $post['keterangan'] : '' ?>">
						<span class="text-danger"><?= form_error('keterangan') ?></span>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="">
					<button type="submit" id="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('input[name=stok_kurang]').hide();

	function dropdown(id) {
		$.get("<?= base_url('barang/get_barang_form') ?>", function(res, status) {
			var data = JSON.parse(res);
			$('#barang').find('option')
				.remove()
				.end()
				.append('<option value="" selected>Pilih Barang</option>')
				.val('');
			data.forEach(e => {
				if (e.id == id) {
					$('#barang').append('<option value="' + e.id + '" selected>' + e.kode + ' | ' + e.nama + '</option>');
				} else {
					$('#barang').append('<option value="' + e.id + '">' + e.kode + ' | ' + e.nama + '</option>');
				}
			});
			$('#barang').selectpicker({
				liveSearch: true
			});
		});
	}

	$('#addGudangBtn').click(function() {
		$('#addGudang').modal('show');
		dropdown()
	})
</script>

<?php if (isset($post)) : ?>
	<script>
		$(document).ready(function() {
			$('#addGudang').modal('show');
			dropdown('<?= isset($post['barang_id']) ? $post['barang_id'] : '' ?>')
		});
	</script>
<?php endif ?>
