<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php 
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');
	?>
	<title><?php echo $app; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view("_partials/css.php") ?>
	<style>
		b{
			color: rgb(0,98,204);
		}
	</style>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view("_partials/navbar.php") ?>
		<?php $this->load->view("_partials/sidebar_container.php") ?>
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-md-12">							
							<h1><b>S</b>istem <b>I</b>nformasi <b>S</b>urat <b>K</b>eputusan Tug<b>A</b>s <b>E</b>lektronik</h1>							
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
								<div class="card-header d-flex p-0">
									<h3 class="card-title p-3">Apa itu SISKAE?</h3>
								</div>
								<div class="card-body">
									<p>Sistem Informasi Surat Keputusan Tugas Elektronik (SISKAE) adalah sebuah aplikasi yang mengirimkan notifikasi berupa Surat Keputusan / Surat Tugas kepada pihak yang namanya tercantum dalam surat tersebut melalui media pesan WhatsApp.</p>
								</div>
							</div>							
							<div class="card card-secondary">
								<div class="card-header d-flex p-0">
									<h3 class="card-title p-3">Konfigurasi Awal</h3>
								</div>
								<div class="card-body">
									<ol class="list-group list-group-numbered">
										<li class="list-group-item">Sangat disarankan menggunakan browser <a href="https://www.google.com/chrome/" target="_blank">Google Chrome</a></li>
										<li class="list-group-item">Isi terlebih dahulu nomor whatsapp pegawai yang akan dikirimkan pesan pada menu <a href="<?php echo base_url('penerima'); ?>">Penerima</a></li>
										<li class="list-group-item">Install ekstensi <a href="https://chrome.google.com/webstore/detail/force-background-tab/gidlfommnbibbmegmgajdbikelkdcmcl" target="_blank">Force Background Tab</a> agar tidak menggangu pengguna pada saat menggunakan aplikasi ini.</li>
										<li class="list-group-item">Install ekstensi <a href="https://chrome.google.com/webstore/detail/tampermonkey/dhdgffkkebhmkfjojejmpbldmpobfkfo" target="_blank">Tampermonkey</a></li>
										<li class="list-group-item">Install script berikut <a href="https://gist.github.com/topyk27/284b8fc9a1fcbd7bab24cfb15cc40a17/raw/siskae-tgr.user.js" target="_blank">SISKAE</a></li>
										<li class="list-group-item"><img src="<?php echo base_url('asset/img/img-1.png'); ?>" class="img-fluid"></li>
										<li class="list-group-item">Setelah berhasil, silahkan dilihat cara penggunaan di bawah ini</li>
									</ol>
								</div>
							</div>	
							<div class="card card-success">
								<div class="card-header d-flex p-0">
									<h3 class="card-title p-3">Cara penggunaan</h3>
								</div>
								<div class="card-body">
									<ol class="list-group list-group-numbered">
										<li class="list-group-item">Buka ekstensi Tampermonkey dengan cara klik <a href="chrome-extension://dhdgffkkebhmkfjojejmpbldmpobfkfo/options.html#nav=dashboard" target="_blank">di sini</a></li>
										<li class="list-group-item">Apabila muncul error seperti ini, silahkan tekan tombol Ctrl+r atau F5</li>
										<li class="list-group-item"><img src="<?php echo base_url('asset/img/img-2.png'); ?>" class="img-fluid"></li>
										<li class="list-group-item">Disable terlebih dahulu script SISKAE dengan cara mengklik tombol pada kolom Enabled. Pastikan hasilnya seperti gambar di bawah ini</li>
										<li class="list-group-item"><img src="<?php echo base_url('asset/img/img-3.png'); ?>" class="img-fluid"></li>
										<li class="list-group-item">Buka <a href="https://web.whatsapp.com/" target="_blank">WhatsApp Web</a> dan silahkan scan QR Code untuk login. Pastikan login sampai selesai mengunduh pesan dan muncul daftar chat.</li>
										<li class="list-group-item"><img src="<?php echo base_url('asset/img/img-4.png'); ?>" class="img-fluid"></li>
										<li class="list-group-item">Setelah berhasil login, silahkan tutup tab WhatsApp Web</li>
										<li class="list-group-item">Buka kembali ekstensi <a href="chrome-extension://dhdgffkkebhmkfjojejmpbldmpobfkfo/options.html#nav=dashboard" target="_blank">Tampermonkey</a> dan enable script SISKAE</li>
										<li class="list-group-item"><img src="<?php echo base_url('asset/img/img-5.png'); ?>" class="img-fluid"></li>
										<li class="list-group-item">Tutup semua tab yang terbuka kecuali aplikasi ini. Kemudian pilih menu <a href="<?php echo base_url('pesan'); ?>">Pesan </a><i class="fas fa-arrow-right"></i> <a href="<?php echo base_url('pesan'); ?>">Kirim</a> untuk mengambil data pesan yang akan dikirimkan</li>
										<li class="list-group-item">Setelah selesai mengambil data pesan, aplikasi akan otomatis mengirimkan pesan ke nomor whatsapp yang sudah tersimpan di database</li>
										<li class="list-group-item">Mohon diperhatikan terlebih dahulu apakah aplikasi berhasil mengirimkan pesan atau tidak. Apabila gagal, silahkan hubungi administrator.</li>
										<li class="list-group-item">Apabila muncul pesan seperti di bawah ini, silahkan klik tombol always allow</li>
										<li class="list-group-item"><img src="<?php echo base_url('asset/img/img-6.png'); ?>" class="img-fluid"></li>
										<li class="list-group-item">Apabila berhasil mengirimkan pesan, silahkan dibiarkan saja. Aplikasi akan otomatis mengambil data pesan yang baru apabila semua data pesan sebelumnya sudah berhasil dikirim</li>
									</ol>
								</div>
							</div>
							<div class="card card-info">
								<div class="card-header d-flex p-0">
									<h3 class="card-title p-3">Update</h3>
								</div>
								<div class="card-body">
									<ol class="list-group list-group-numbered">
										<li class="list-group-item">Apabila pesan tidak terkirim, silahkan check userscript update</li>
										<li class="list-group-item">Buka ekstensi Tampermonkey dengan cara klik <a href="chrome-extension://dhdgffkkebhmkfjojejmpbldmpobfkfo/options.html#nav=dashboard" target="_blank">di sini</a></li>
										<li class="list-group-item">Apabila muncul error seperti ini, silahkan tekan tombol Ctrl+r atau F5</li>
										<li class="list-group-item"><img src="<?php echo base_url('asset/img/img-2.png'); ?>" class="img-fluid"></li>
										<li class="list-group-item">Klik cell pada kolom Last Updated untuk mengecek apakah tersedia update, apabila tidak tersedia update dan pesan whatsapp tidak terkirim silahkan hubungi administrator</li>
										<li class="list-group-item"><img src="<?php echo base_url('asset/img/img-7.png'); ?>" class="img-fluid"></li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->load->view("_partials/numpang.php") ?>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<?php $this->load->view("_partials/loader.php") ?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- ChartJS -->
	<script src="<?php echo base_url('asset/plugin/chart.js/Chart.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- Moment -->
	<script src="<?php echo base_url('asset/plugin/moment/moment-with-locales.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>

	<script type="text/javascript">		
		const tkn = "<?php echo $this->session->userdata('siskae_tkn'); ?>";
		const nama_pa = "<?php echo $this->session->userdata('nama_pa'); ?>";
		const nama_pa_pendek = "<?php echo $this->session->userdata('nama_pa_pendek'); ?>";
		function jumlah_hari(bulan, tahun) {
			return new Date(tahun,bulan,0).getDate();
		}

		$(document).ready(function(){
			
			$.ajax({
				url: "https://raw.githubusercontent.com/topyk27/siskae/main/asset/mine/token/token.json",
				method: 'GET',
				dataType: 'json',
				beforeSend: function(){
					$(".loader2").show();
				},
				success: function(data)
				{
					try{
						if(nama_pa==data[nama_pa_pendek][0].nama_pa && nama_pa_pendek==data[nama_pa_pendek][0].nama_pa_pendek && tkn==data[nama_pa_pendek][0].token)
						{
							
						}
						else
						{
							location.replace("<?php echo base_url('setting/awal'); ?>");
						}
					}
					catch(err)
					{
						location.replace("<?php echo base_url('setting/awal'); ?>");
					}
					$(".loader2").hide();
				},
				error: function()
				{
					$.ajax({
						url: "<?php echo base_url('asset/mine/token/token.json'); ?>",
						method: "GET",
						dataType: 'json',
						success: function(lokal)
						{
							if(nama_pa==lokal[nama_pa_pendek][0].nama_pa && nama_pa_pendek==lokal[nama_pa_pendek][0].nama_pa_pendek && tkn==lokal[nama_pa_pendek][0].token)
							{
								
							}
							else
							{
								location.replace("<?php echo base_url('setting/awal'); ?>");
							}
							$(".loader2").hide();
						},
						error: function(err)
						{
							$(".loader2").hide();
							alert('Gagal dapat data token, harap hubungi administrator');
						}
					});
				}
			});
			// $("#title_statistik").text("Statistik Pengunjung Bulan "+nama_bulan);
			$("#sidebar_home").addClass("active");			
		});
	</script>

</body>
</html>