<div class="row g-5 mb-4">
	<div class="col-md-12">

		<div class="row justify-content-end">
			<div class="col-md-6">
				<a href="#" class="btn btn-primary float-end" id="addBarangBtn"><i class="bi bi-plus-lg"></i> Tambah
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
								<th scope="col" style="width: 100px;">Gambar</th>
								<th scope="col">Kode</th>
								<th scope="col">Barang</th>
								<th scope="col">Satuan</th>
								<th scope="col">Stok</th>
								<th scope="col">Harga Beli</th>
								<th scope="col">Harga Jual</th>
								<th scope="col">Status</th>
								<th scope="col">Aksi</th>
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
<div class="modal fade" id="addBarang" tabindex="-1" aria-labelledby="addBarangLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addBarangLabel">Tambah Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url() ?>barang/insert" id="formPost" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="mb-3">
						<label for="formFile" class="form-label">Foto Barang</label>
						<input class="form-control" type="file" id="imgInp" name="image">
						<img id='img-upload' class="mt-4" src="" />
						<span class="text-danger"><?= isset($image_error) ? $image_error : '' ?></span>
					</div>
					<div class="mb-3">
						<label class="form-label">Nama Barang</label>
						<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Barang" value="<?= isset($post['nama']) ? $post['nama'] : '' ?>">
						<span class="text-danger"><?= form_error('nama') ?></span>
					</div>
					<div class="mb-3">
						<label class="form-label">Satuan</label>
						<select class="form-select" id="satuan" name="satuan">
							<option selected>Pilih Satuan</option>
						</select>
						<span class="text-danger"><?= form_error('satuan') ?></span>
					</div>
					<div class="mb-3">
						<label class="form-label">Harga Beli</label>
						<input type="number" class="form-control" name="harga_beli" placeholder="Masukkan Harga Beli" value="<?= isset($post['harga_beli']) ? $post['harga_beli'] : '' ?>">
						<span class="text-danger"><?= form_error('harga_beli') ?></span>
					</div>
					<div class="mb-3">
						<label class="form-label">Harga Jual</label>
						<input type="number" class="form-control" name="harga_jual" placeholder="Masukkan Harga Jual" value="<?= isset($post['harga_jual']) ? $post['harga_jual'] : '' ?>">
						<span class="text-danger"><?= form_error('harga_jual') ?></span>
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

<script type="text/javascript">
	function dropdown(id) {
		$.get("<?= base_url('satuan/get_satuan_form') ?>", function(res, status) {
			var data = JSON.parse(res);
			$('#satuan').find('option')
				.remove()
				.end()
				.append('<option value="" selected>Pilih Satuan</option>')
				.val('whatever');
			data.forEach(e => {
				if (e.id == id) {
					$('#satuan').append('<option value="' + e.id + '" selected>' + e.nama + '</option>');
				} else {
					$('#satuan').append('<option value="' + e.id + '">' + e.nama + '</option>');
				}
			});
		});
	}

	function readURL(input, pic) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				if (pic == 1) {
					$('#img-upload').attr('src', e.target.result);
				}
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp").change(function() {
		readURL(this, 1);
		var filename = $('#imgInp').val().replace(/C:\\fakepath\\/i, '')
		$('#text-img').val(filename);
	});

	$('#addBarangBtn').click(function() {
		$('#addBarang').modal('show');
		$("input[name=nama]").val('');
		$("input[name=harga_beli]").val('');
		$("input[name=harga_jual]").val('');
		$('#img-upload').attr('src', '');
		dropdown()
		$('#submit').html('Simpan').attr('class', 'btn btn-primary');
		$('#formPost').attr('action', '<?= base_url() ?>barang/insert');
	})

	function onEdit(id) {
		$.get("<?= base_url('barang/get_id/') ?>" + id, function(res, status) {
			var data = JSON.parse(res);
			$('#addBarang').modal('show');
			$("input[name=nama]").val(data.nama);
			$("input[name=harga_beli]").val(data.harga_beli);
			$("input[name=harga_jual]").val(data.harga_jual);
			$('#img-upload').attr('src', '<?= base_url('assets/images/barang/') ?>' + data.image);
			$("input[name=id]").val(data.id);
			dropdown(data.satuan.toString())
			$('#submit').html('Update').attr('class', 'btn btn-warning');
			$('#formPost').attr('action', '<?= base_url() ?>barang/update');
		});
	}
</script>

<?php if (isset($post)) : ?>
	<script>
		$(document).ready(function() {
			$('#addBarang').modal('show');
			dropdown('<?= isset($post['satuan']) ? $post['satuan'] : '' ?>')
		});
	</script>
<?php endif ?>

<?php if (isset($update)) : ?>
	<script>
		$(document).ready(function() {
			$('#submit').html('Update').attr('class', 'btn btn-warning');
			$('#formPost').attr('action', '<?= base_url() ?>barang/update');
			$("input[name=id]").val('<?= isset($post['id']) ? $post['id'] : '' ?>');
			$('#img-upload').attr('src', '<?= base_url('assets/images/barang/') . $update ?>');
		});
	</script>
<?php endif ?>
