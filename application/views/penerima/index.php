<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php 
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');
	?>
  <title><?php echo $app; ?> | Penerima</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view("_partials/css.php") ?>
  <!-- datatables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  
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
            <h1>Penerima</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item active">Penerima</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="penerima/tambah" class="btn btn-block bg-gradient-primary">
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
                    <table id="dt_penerima" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th>NO</th>                      
                          <th>Nama</th>
                          <th>Nomor HP</th>                      
                          <th>Ubah</th>
                          <th>Hapus</th>
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
<script>const base_url="<?php echo base_url(); ?>";</script>
<script type="text/javascript">
    var dt_penerima;
    const confirmDelete = (id,nama) =>
    {
      $("#hapusModal").modal('show');
      $("#hapusModal").find('.modal-body').html('<p>Apakah anda ingin menghapus '+nama+'? Data ini tidak bisa dipulihkan kembali.');
      $("#hapusModal").find('#deleteButton').attr("onclick","hapusData("+id+")");
    }
    const hapusData = (id) =>
    {
      $.ajax({
        url: base_url+'penerima/hapus/'+id,
        dataType: 'text',
        success: function(respon)
        {
          if(respon=="1")
          {
            dt_penerima.ajax.reload();
            $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Data berhasil dihapus</div>")
            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
          }
          else
          {
            $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'><strong>Maaf</strong> Data gagal dihapus. Silahkan coba lagi.</div>")
            $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
          }
        }
      });
    }
    $(document).ready(function(){
      $("#sidebar_penerima").addClass("active");
        dt_penerima = $("#dt_penerima").DataTable({
            ajax : {
                url : base_url + "penerima/getAll",
                type : "GET",
                dataSrc : "",
                dataType : "JSON",                
            },
            columns : [
                {data: 'id'},
                {data: null, sortable: false, render: function(data,type,row,meta){return meta.row + meta.settings._iDisplayStart + 1;}},
                {data: 'nama'},
                {data: 'no_hp'},                
                {data: null, sortable: false, render: function(data,type,row,meta){
                    let a = document.createElement('a');
                    a.setAttribute("href","<?php echo base_url('penerima/ubah/'); ?>"+row['id']);
                    a.className = "btn btn-warning";
                    let i = document.createElement('i');
                    i.className = "fas fa-edit";
                    a.innerText = " Ubah";
                    a.prepend(i);
                    return a.outerHTML;
                }},
                {data: null, sortable: false, render: function(data,type,row,meta){
                    let a = document.createElement('a');
                    a.setAttribute("href","#");
                    a.className = "btn btn-danger deleteButton";
                    let i = document.createElement('i');
                    i.className = "fas fa-trash";
                    a.innerText = " Hapus";
                    a.prepend(i);                    
                    return a.outerHTML;
                }},
            ],
            columnDefs : [
                {
                    targets: [0],
                    visible: false,
                },
                {
                    targets: [1,4,5],
                    className : "text-center"
                },
                {
                  targets: [3],
                  sortable: false,
                }
            ],
            order : [[2,'asc']],
            responsive : true,
            autoWidth : false
        });

        $("#dt_penerima tbody").on("click", "tr .deleteButton", function(e){
          e.preventDefault();
          let currentRow = $(this).parents("tr");
          if(currentRow.hasClass('child'))
          {
            currentRow = currentRow.prev();
          }
          let data = $("#dt_penerima").DataTable().row(currentRow).data();          
          confirmDelete(data['id'],data['nama']);
        });
    });
</script>
</body>
</html>
