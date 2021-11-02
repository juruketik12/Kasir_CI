<div class="row g-5 mb-4">
	<div class="col-md-12">

		<div class="row justify-content-end">
			<div class="col-md-6">
				<!-- <a href="#" class="btn btn-primary float-end" id="addPelangganBtn"><i class="bi bi-plus-lg"></i> Tambah
					Data</a> -->
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
								<th scope="col">Produk</th>
								<th scope="col">Qty</th>
								<th scope="col">Harga</th>
								<th scope="col">Total</th>
								<th scope="col">Pelanggan</th>
								<th scope="col">Tanggal</th>
								<!-- <th scope="col">Aksi</th> -->
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
<div class="modal fade" id="addPelanggan" tabindex="-1" aria-labelledby="addPelangganLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addPelangganLabel">Tambah Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url() ?>pelanggan/insert" id="formPost" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<!-- <div class="mb-3">
						<label for="formFile" class="form-label">Foto Barang</label>
						<input class="form-control" type="file" id="imgInp" name="image">
						<img id='img-upload' class="mt-4" src="" />
						<span class="text-danger"><?= isset($image_error) ? $image_error : '' ?></span>
					</div> -->
					<div class="mb-3">
						<label class="form-label">Nama Pelanggan</label>
						<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Pelanggan" value="<?= isset($post['nama']) ? $post['nama'] : '' ?>">
						<span class="text-danger"><?= form_error('nama') ?></span>
					</div>
					<div class="mb-3">
						<label class="form-label">Nomor Hp</label>
						<input type="number" class="form-control" name="nomor" placeholder="Masukkan Nomor Hp" value="<?= isset($post['nomor']) ? $post['nomor'] : '' ?>">
						<span class="text-danger"><?= form_error('nomor') ?></span>
					</div>
					<div class="mb-3">
						<label class="form-label">Alamat</label>
						<textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat" rows="3"><?= isset($post['alamat']) ? $post['alamat'] : '' ?></textarea>
						<span class="text-danger"><?= form_error('alamat') ?></span>
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

	$('#addPelangganBtn').click(function() {
		$('#addPelanggan').modal('show');
		$("input[name=nama]").val('');
		$("input[name=nomor]").val('');
		$("input[name=alamat]").text('');
		$('#submit').html('Simpan').attr('class', 'btn btn-primary');
		$('#formPost').attr('action', '<?= base_url() ?>pelanggan/insert');
	})

	function onEdit(id) {
		$.get("<?= base_url('pelanggan/get_id/') ?>" + id, function(res, status) {
			var data = JSON.parse(res);
			$('#addPelanggan').modal('show');
			$("input[name=nama]").val(data.nama);
			$("input[name=nomor]").val(data.nomor);
			$("#alamat").text(data.alamat);
			$("input[name=id]").val(data.id);
			$('#submit').html('Update').attr('class', 'btn btn-warning');
			$('#formPost').attr('action', '<?= base_url() ?>pelanggan/update');
		});
	}
</script>

<?php if (isset($post)) : ?>
	<script>
		$(document).ready(function() {
			$('#addPelanggan').modal('show');
		});
	</script>
<?php endif ?>

<?php if (isset($update)) : ?>
	<script>
		$(document).ready(function() {
			$('#submit').html('Update').attr('class', 'btn btn-warning');
			$('#formPost').attr('action', '<?= base_url() ?>pelanggan/update');
			$("input[name=id]").val('<?= isset($post['id']) ? $post['id'] : '' ?>');
		});
	</script>
<?php endif ?>
