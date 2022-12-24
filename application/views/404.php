<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php 
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');
	?>
	<title><?php echo $app; ?> | 404</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view("_partials/css.php") ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/404.css'); ?>">
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view("_partials/navbar.php") ?>
		<?php $this->load->view("_partials/sidebar_container.php") ?>
		<div class="content-wrapper">
			<section class="page_404">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-10 col-sm-offset-1  text-center">
								<div class="four_zero_four_bg">
									<h1 class="text-center">404</h1>
								</div>
								<div class="contant_box_404">
									<h3 class="h2">
										Tampaknya anda tersesat
									</h3>
									<p>halaman yang anda cari tidak ditemukan</p>
									<a href="<?php echo base_url(); ?>" class="link_404">Kembali</a>
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
</body>
</html>