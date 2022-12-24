<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About</title>
	<?php $this->load->view("_partials/css.php") ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view("_partials/navbar.php") ?>
		<?php $this->load->view("_partials/sidebar_container.php") ?>
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>About</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item active">About</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">PTSP itu apa?</h3>
								</div>
								<div class="card-body">
									<blockquote class="blockquote">
										<p class="mb-0">
											Pelayanan Terpadu Satu Pintu, yang disingkat PTSP adalah pelayanan secara terintegrasi dalam satu kesatuan proses dimulai dari tahap awal sampai dengan tahap penyelesaian produk pelayanan pengadilan melalui satu pintu.
											<footer class="blockquote-footer">Berdasarkan pada <cite title="SK Dirjen Badilag nomor 1403.b/DJA/SK/OT.01.3/8/2018.">SK Dirjen Badilag nomor 1403.b/DJA/SK/OT.01.3/8/2018.</cite></footer>
										</p>
									</blockquote>
								</div>
							</div>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Aplikasi PTSP Tamu</h3>
								</div>
								<div class="card-body">
									<p class="lead">
										Aplikasi ini digunakan untuk mencatat pengunjung yang datang. Yang nantinya akan mempermudah dalam pembuatan laporan.
									</p>
								</div>
							</div>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Layanan apa saja?</h3>
								</div>
								<div class="card-body">
									<dl class="row">
										<dt class="col-sm-4">Pengaduan & Informasi</dt>
										<dd class="col-sm-8">Mencatat pengaduan apa yang disampaikan atau informasi apa yang ingin diketahui</dd>

										<dt class="col-sm-4">Pendaftaran</dt>
										<dd class="col-sm-8">Ambil foto pihak yang mendaftar agar bisa melihat apakah yang mengambil produk sama dengan yang bersangkutan.</dd>

										<dt class="col-sm-4">Pengambilan Produk</dt>
										<dd class="col-sm-8">Masih zaman ambil produk dimintai KTP? Langsung difotokan saja pihak yang mengambil beserta produknya.</dd>
									</dl>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->load->view("_partials/numpang.php") ?>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#sidebar_about").addClass("active");
		});
	</script>
</body>
</html>