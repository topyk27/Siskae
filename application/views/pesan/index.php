<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php 
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');
	?>
  <title><?php echo $app; ?> | Surat</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view("_partials/css.php") ?>
  <!-- datatables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <!-- lightbox -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/lightbox2/dist/css/lightbox.min.css'); ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php $this->load->view("_partials/navbar.php") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view("_partials/sidebar_container.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item active">Pesan</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="pesan/kirim" class="btn btn-block bg-gradient-primary">
              <i class="fas fa-paper-plane"></i> Kirim
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
                  <table id="dt_pesan" class="table table-bordered table-hover">
                    <thead>
                      <tr>                        
                        <th>NO</th>
                        <th>Jenis</th>
                        <th>Judul</th>
                        <th>Penerima</th>
                        <th>Nomor WA</th>
                        <th>Status</th>                        
                        <th>Diperbarui</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            <!-- </div> -->
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
<!-- ./wrapper -->

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
        <p>Apakah anda ingin menghapus data ini? Data ini tidak bisa dipulihkan kembali.</p>
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
<!-- Moment -->
<script src="<?php echo base_url('asset/plugin/moment/moment-with-locales.min.js') ?>"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
<script>const base_url = "<?php echo base_url(); ?>";</script>
<script type="text/javascript">    
  $(document).ready(function(){
    $("#sidebar_pesan").addClass("active");
    let dt_pesan;
    moment.locale('id');
    $.fn.dataTable.moment('LL');
    dt_pesan = $("#dt_pesan").DataTable({
      order : [[2, "desc"]],
      ajax : {
        url : base_url + "pesan/getAll",
        type : "GET",
        dataSrc : "",
        dataType : "JSON",
      },
      columns : [      
      {data : null, sortable : false, render: function(data,type,row,meta){
        return meta.row + meta.settings._iDisplayStart + 1;
      }},      
      {data : "jenis"},
      {data : "judul"},        
      {data : "nama"},        
      {data : "no_hp"},        
      {data : "status"},              
      {data : "updated_at"},              
      ],
      columnDefs : [      
      {
        responsivePriority: 1,
        targets: [2,3],
      },
      {
        targets : [0,1,2,3,4],
        orderable : false,
      },
      {
        targets: 6,
        data: "updated_at",
        render: function(data,type,row,meta)
        {
            var dateObj = new Date(data);
            var momentObj = moment(dateObj);
            return momentObj.format('lll');
        }
      },
      {
        targets: [0],
        searchable: false,
      }
      ],
      responsive : true,
      autoWidth: false,
    });
    
    $("#dt_pesan tbody").on('click', 'tr .deleteButton', function(e){
      e.preventDefault();
      // var currentRow = $(this).closest("tr");
      var currentRow = $(this).parents("tr");
      if(currentRow.hasClass('child'))
      {
        currentRow = currentRow.prev();
      }
      var data = $("#dt_pesan").DataTable().row(currentRow).data();
      confirmDelete(data['id'],data['judul']);      
    });    

    const confirmDelete = (id,judul) =>
    {
      $("#hapusModal").modal('show');
      $("#hapusModal").find('.modal-body').html('<p>Apakah anda ingin menghapus surat '+judul+'? Data ini tidak bisa dipulihkan kembali.');
      $("#hapusModal").find('#deleteButton').attr("onclick","hapusData("+id+")");
    }    
    <?php
      if($this->session->userdata('success')) :
        $respon = $this->session->userdata('success');
    ?>
      $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><?php echo $respon; ?></div>")
      $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
    <?php endif; ?>
  });
</script>
</body>
</html>
