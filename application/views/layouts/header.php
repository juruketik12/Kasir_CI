<div class="container">
	<header class="blog-header py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<!-- <div class="col-4 pt-1">
        <a class="link-secondary" href="#">Subscribe</a>
      </div> -->
			<div class="col-8">
				<a class="blog-header-logo text-dark" href="#">Kasirku</a>
				<p>Jl. Purwosari Pasuruan</p>
			</div>
			<div class="col-4 d-flex justify-content-end align-items-center">
				<!-- <a class="link-secondary" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a> -->
				<a class="btn btn-sm btn-outline-secondary" href="#"><i class="bi bi-person-circle"></i> Masuk</a>
			</div>
		</div>
	</header>

	<div class="py-1 mb-4 border-bottom">
		<nav class="navbar navbar-expand navbar-light bg-default">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="p-2 nav-link active" href="<?= base_url('/') ?>"><i class="bi bi-house"></i> Home</a>
						<a class="p-2 nav-link" href="<?= base_url('gudang') ?>"><i class="bi bi-building"></i> Gudang</a>
						<a class="p-2 nav-link" href="<?= base_url('barang') ?>"><i class="bi bi-basket"></i> Barang</a>
						<a class="p-2 nav-link" href="<?= base_url('kasir') ?>"><i class="bi bi-cart"></i> Kasir</a>
						<div class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-person-fill"></i> Admin Menu
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<li><a class="dropdown-item" href="#">User</a></li>
								<li><a class="dropdown-item" href="<?= base_url('pelanggan') ?>">Pelanggan</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="<?= base_url('pemasukan') ?>">Pemasukan</a></li>
								<li><a class="dropdown-item" href="#">Stok Masuk</a></li>
								<li><a class="dropdown-item" href="#">Stok Keluar</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="#">Master Data</a></li>
								<li><a class="dropdown-item" href="#">Pengaturan Toko</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</div>
</div>
