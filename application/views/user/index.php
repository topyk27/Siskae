<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php 
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');		
	?>
	<title><?php echo $app; ?> | Pengguna</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view("_partials/css.php") ?>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
	<!-- untuk hapus modal -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/modal.css') ?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- end hapus modal -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php $this->load->view("_partials/navbar.php") ?>
	<?php $this->load->view("_partials/sidebar_container.php") ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <div class="container-fluid">
	      <div class="row mb-2">
	        <div class="col-sm-6">
	          <h1>Pengguna</h1>
	        </div>
	        <div class="col-sm-6">
	          <ol class="breadcrumb float-sm-right">
	            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
	            <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
	            <li class="breadcrumb-item active">Pengguna</li>
	          </ol>
	        </div>
	      </div>
	      <div class="row mb-2">
	        <div class="col-sm-2">
	          <a href="user_tambah" class="btn btn-block bg-gradient-primary">
	            <i class="fas fa-plus"></i>Tambah
	          </a>
	        </div>
	      </div>
	      <div class="row-mb-2">
	        <div class="col-sm-12" id="respon">
	          <!-- <div class="alert alert-success" role="alert" id="responMsg" style="display: none;"> -->
	            
	          </div>
	        </div>
	      
	    </div><!-- /.container-fluid -->
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="container-fluid">
	      <div class="row">
	        <div class="col-md-12">	          
	            <div class="card card-primary">
					<div class="card-body">
						<table id="dt_user" class="table table-bordered table-hover">
						  <thead>
							<tr>
							  <th></th>
							  <th>NO</th>
							  <th>Username</th>
							  <th>Nama</th>	                    
							  <th>Ubah</th>
							  <th>Hapus</th>
							</tr>
						  </thead>
						  <tbody>
							
						  </tbody>
						</table>
					</div>
	            </div>	          
	        </div>
	      </div>
	      <!-- /.row -->
	    </div><!-- /.container-fluid -->
	    <?php $this->load->view("_partials/numpang.php") ?>
	  </section>
	  <!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php $this->load->view("_partials/footer.php") ?>
	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
	  <!-- Control sidebar content goes here -->
	</aside>
	<!-- /.control-sidebar -->
</div>
<!-- hapus modal -->
<div id="hapusModal" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box">
          <i class="material-icons">&#xE5CD;</i>
        </div>
        <h4 class="modal-title w-100">Apakah anda yakin?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteButton">Hapus</button>
      </div>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
<!-- datatables -->
<script src="<?php echo base_url('asset/plugin/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('asset/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('asset/plugin/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?php echo base_url('asset/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script type="text/javascript">
	var dt_user;
	function hapusData(id)
	  {
	    $.ajax({
	      url: "<?php echo base_url('setting/user_hapus/') ?>"+id,
	      dataType: "text",
	      success: function(respon)
	      {
	        if(respon==1)
	        {
	          console.log("berhasil");
	          dt_user.ajax.reload();
	           $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Data berhasil dihapus</div>")
	           $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
	        }
	        else
	        {
	          console.log("gagal hapus data");
	          $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'><strong>Maaf</strong> Data gagal dihapus. Silahkan coba lagi.</div>")
	          $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
	        }
	      }
	    });
	  }
	$(document).ready(function(){
		$("#sidebar_setting").addClass("active");
		$("#sidebar_setting_user").addClass("active");		
		dt_user = $("#dt_user").DataTable({
			"dom" : 'Bfrtip',	        
			"order" : [[1, "asc"]],
			"ajax" : {
				"url" : "<?php echo base_url('user/data_user'); ?>",
				"dataSrc" : "",
			},
			"columns" : [
			{"data" : "id"},
			{"data" : null, "sortable" : false, render: function(data,type,row, meta){
				return meta.row + meta.settings._iDisplayStart + 1;
			}},
			{"data" : "username"},
			{"data" : "nama"},			
			{"data" : null, "sortable" : false, render: function(data,type,row,meta){
				return "<a href='<?php echo base_url('setting/user_ubah/') ?>"+row['id']+"' class='btn btn-warning'><i class='fas fa-edit'></i>Ubah</a>";
			}},
			{"data" : null, "sortable" : false, render: function(data,type,row,meta){
				return "<a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
			}}
			],
			"columnDefs" : [
			{
				"targets" : [0],
				"visible" : false,
			},
			],
			responsive : true,
			autoWidth: false,
		});

		$("#dt_user tbody").on('click', 'tr .deleteButton', function(e){
		  e.preventDefault();
		  // var currentRow = $(this).closest("tr");
		  var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
		  var data = $("#dt_user").DataTable().row(currentRow).data();
		  $('#hapusModal').modal('show');
		  $('#hapusModal').find('.modal-body').html("<p>Apakah anda ingin menghapus data "+data['nama']+"? Data ini tidak bisa dipulihkan kembali.");
		  $('#hapusModal').find('#deleteButton').attr("onclick", "hapusData("+data['id']+")");
		});
	});
</script>
</body>
</html>