<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');
	 ?>
	<title><?php echo $app; ?> | Setting</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
						<h1>Sistem</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
							<li class="breadcrumb-item active">Sistem</li>
						</ol>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-sm-12" id="respon"></div>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Setting</h3>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label for="ketua">Ketua</label>
									<div class="row">
										<div class="col-md-4">
											<input type="text" id="ketua" class="form-control" value="<?php echo $ttd->ketua; ?>" readonly>
										</div>
										<div class="col-md-6">
											<a href="#" id="ketua_ubah" class="btn btn-warning">Ubah</a>
											<div id="vKetuaUbah" style="display: none;">
												<div class="input-group mb-3">
													<span class="input-group-text">Nama</span>
													<input type="text" name="ketua" class="form-control">
												</div>
												<div class="input-group mb-3">
													<span class="input-group-text">NIP</span>
													<input type="text" name="nip_ketua" class="form-contro">
												</div>
											</div>
										</div>
										<div class="col-md-2">
											<a href="#" id="ketua_simpan" class="btn btn-primary" style="display: none;">Simpan</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="panitera">Sekretaris</label>
									<div class="row">
										<div class="col-md-4">
											<input type="text" id="panitera" class="form-control" value="<?php echo $ttd->panitera; ?>" readonly>
										</div>
										<div class="col-md-6">
											<a href="#" id="panitera_ubah" class="btn btn-warning">Ubah</a>
											<div id="vPaniteraUbah" style="display: none;">
												<div class="input-group mb-3">
													<span class="input-group-text">Nama</span>
													<input type="text" name="panitera" class="form-control">
												</div>
												<div class="input-group mb-3">
													<span class="input-group-text">NIP</span>
													<input type="text" name="nip_panitera" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-md-2">
											<a href="#" id="panitera_simpan" class="btn btn-primary" style="display: none;">Simpan</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="kode_surat_satker">Kode Surat Satker</label>
									<div class="row">
										<div class="col-md-4">
											<input type="text" id="kode_surat_satker" class="form-control" value="<?php echo $ttd->kode_surat_satker; ?>" readonly>
										</div>
										<div class="col-md-6">
											<a href="#" id="kode_surat_satker_ubah" class="btn btn-warning">Ubah</a>
											<input type="text" name="kode_surat_satker" class="form-control" style="display: none;" placeholder="Contohnya W17-A3">
										</div>
										<div class="col-md-2">
											<a href="#" id="kode_surat_satker_simpan" class="btn btn-primary" style="display: none;">Simpan</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="logo">Logo</label>
									<div class="row">
										<form class="form-inline" method="post" enctype="multipart/form-data">
											<div class="col-sm-4">
												<img src="<?php echo base_url('asset/img/logo.png').'?'.time(); ?>" class="img-fluid mb-3">
											</div>
											<div class="col-sm-4">
												<input type="file" accept=".png" name="logo" class="form-control-file mb-3 <?php echo form_error('logo') ? 'is-invalid' : '' ?>">
												<div class="invalid-feedback">
													<?php echo form_error('logo'); ?>
												</div>
											</div>
											<div class="col-sm-4">
												<button type="submit" class="btn btn-warning btn-submit">Simpan</button>
											</div>
										</form>
									</div>
								</div>
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
<script>const base_url = "<?php echo base_url(); ?>";</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sidebar_setting").addClass("active");
		$("#sidebar_setting_sistem").addClass("active");
		$("#ketua_ubah").click(function(){
			$("#vKetuaUbah").show();
			$("#ketua_simpan").show();
			$(this).hide();
		});
		$("#ketua_simpan").click(function(){
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('setting/ketua_save'); ?>",
				data: {ketua: $("input[name='ketua']").val() + "#" + $("input[name='nip_ketua']").val() },
				dataType: 'json',
				success: function(data)
				{
					if(data.respon)
					{
						$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
						$("#vKetuaUbah").hide();
						$("#ketua_simpan").hide();
						$("#ketua_ubah").show();
						$("#ketua").val(data.nama);
					}
					else
					{
						$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
				},
				error: function(err)
				{
					console.log(err);
					$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
					$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
				},

			});
		});

		$("#panitera_ubah").click(function(){
			$("#vPaniteraUbah").show();
			$("#panitera_simpan").show();
			$(this).hide();
		});
		$("#panitera_simpan").click(function(){
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('setting/panitera_save'); ?>",
				data: {panitera: $("input[name='panitera']").val() + "#" + $("input[name='nip_panitera']").val()},
				dataType: 'json',
				success: function(data)
				{
					if(data.respon)
					{
						$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
						$("#vPaniteraUbah").hide();
						$("#panitera_simpan").hide();
						$("#panitera_ubah").show();
						$("#panitera").val(data.nama);
					}
					else
					{
						$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
				},
				error: function(err)
				{
					console.log(err);
					$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
					$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
				},

			});
		});

		$("#kode_surat_satker_ubah").click(function(){
			$("input[name='kode_surat_satker']").show();
			$("#kode_surat_satker_simpan").show();
			$(this).hide();
		});

		$("#kode_surat_satker_simpan").click(function(){
			$.ajax({
				type: "POST",
				url: base_url+"setting/kode_surat_satker_save",
				data: {kode_surat_satker : $("input[name='kode_surat_satker']").val()},
				dataType: "JSON",
				success: function(data)
				{
					if(data.respon)
					{
						$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
						$("input[name='kode_surat_satker']").hide();
						$("#kode_surat_satker_simpan").hide();
						$("#kode_surat_satker_ubah").show();
						$("#kode_surat_satker").val(data.kode_surat_satker);
					}
					else
					{
						$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
				},
				error: function(err)
				{
					console.log(err);
					$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
					$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
				}
			});
		});

	});
</script>
</body>
</html>