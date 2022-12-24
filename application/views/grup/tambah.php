<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php 
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');
	?>
  <title><?php echo $app; ?> | Grup | Tambah</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view("_partials/css.php"); ?>  
  
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
            <h1>Grup</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('grup'); ?>">Grup</a></li>
              <li class="breadcrumb-item active">Tambah</li>
            </ol>
          </div>
        </div>
        <div class="row-mb-2">
          <div class="col-sm-12" id="respon">
            
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
              <div class="card-header">
                <h3 class="card-title">Tambah</h3>
              </div>
              <form role="form" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control <?php echo form_error('nama') ? 'is-invalid' : ''; ?>" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Nama Grup" required>
                        <div class="invalid-feedback">
                            <?php echo form_error('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penerimas">Penerima <?php echo form_error('penerimas[]'); ?></label>
                        <select id="penerima" class="form-control">
                          <option value="00">Pilih Penerima</option>
                        </select>
                        <div class="invalid-feedback">
                          <?php echo form_error('penerimas[]'); ?>
                        </div>
                        <div class="row" id="penerimaList"></div>
                    </div>
                </div>                            
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="<?php echo base_url("grup"); ?>" class="btn btn-danger">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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

<!-- jQuery -->
<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
<script>const base_url = "<?php echo base_url(); ?>";</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#sidebar_grup").addClass("active");    
    const penerimas = [];
    const RENDER_PENERIMA = "renderPenerima";
    const RENDER_PENERIMA_LIST = "renderPenerimaList";
    const selectElement = document.getElementById("penerima");
    const penerimaListElement = document.getElementById("penerimaList");

    const getPenerima = () =>
    {
      $.ajax({
        type: "GET",
        url: base_url+"/penerima/getAll",
        dataType: "JSON",
        success: function(data)
        {
          if(data !== null)
          {
            for(const penerima of data)
            {
              penerima.terpilih = false;              
              penerimas.push(penerima);
            }            
            document.dispatchEvent(new Event(RENDER_PENERIMA));
          }
        },
        error: function(err)
        {
          console.log(err.responseText);
          alert("ada yang salah");
        }
      });
    }
    
    document.addEventListener(RENDER_PENERIMA, function(){      
      selectElement.innerHTML = "";      
      const opt = document.createElement('option');
      opt.setAttribute('value','00');
      opt.innerText = "Pilih Penerima";
      selectElement.append(opt);
      for(const penerimaItem of penerimas)
      {
        const penerimaEl = makePenerima(penerimaItem);
      }
    });

    document.addEventListener(RENDER_PENERIMA_LIST, function(){
      penerimaListElement.innerHTML = "";
      let i = 0;
      for(const penerimaItem of penerimas)
      {
        if(penerimaItem.terpilih)
        {
          const div = document.createElement("div");
          div.className = "input-group col-md-4 mt-3";
          const input = document.createElement('input');
          input.type = "text";
          // input.className = "col-lg-4 col-md-4 mt-3 mr-3";
          input.className = "form-control";
          // input.name = "penerimas["+i+"]";
          input.value = penerimaItem.nama;
          input.setAttribute("readonly","");
          const span = document.createElement("span");
          span.className = "input-group-append";
          const divSpan = document.createElement("div");
          divSpan.className = "input-group-text bg-transparent";
          const iEl = document.createElement('i');
          iEl.className = "fas fa-times";
          iEl.addEventListener("click", function(){
            removePenerimaToList(penerimaItem.id);
          });
          const iHidden = document.createElement('input');
          iHidden.type = 'hidden';
          iHidden.name = 'penerimas['+i+']';
          iHidden.value = penerimaItem.id;
          divSpan.append(iEl);
          span.append(divSpan);
          div.append(input,iHidden,span);
          penerimaListElement.append(div);
          i++;
        }
      }
    });

    const makePenerima = (objPenerima) =>
    {      
      if(objPenerima.terpilih)
      {
        return;
      }
      const selectEl = document.getElementById("penerima");
      const opt = document.createElement('option');
      opt.setAttribute('value',objPenerima.id);
      opt.innerText = objPenerima.nama;
      selectEl.append(opt);
    }

    const addPenerimaToList = (penerimaId) =>
    {
      const penerimaTarget = findPenerima(penerimaId);
      if(penerimaTarget == null)
      {
        return;
      }
      penerimaTarget.terpilih = true;
      document.dispatchEvent(new Event(RENDER_PENERIMA));
      document.dispatchEvent(new Event(RENDER_PENERIMA_LIST));
    }

    const removePenerimaToList = (penerimaId) =>
    {
      const penerimaTarget = findPenerima(penerimaId);
      if(penerimaTarget == null)
      {
        return;
      }
      penerimaTarget.terpilih = false;
      document.dispatchEvent(new Event(RENDER_PENERIMA));
      document.dispatchEvent(new Event(RENDER_PENERIMA_LIST));
    }

    const findPenerima = (penerimaId) =>
    {
      for(const penerimaItem of penerimas)
      {
        if(penerimaItem.id === penerimaId)
        {
          return penerimaItem;
        }
      }
      return null;
    }

    const isSelected = (penerimaId) =>
    {
      const penerima = findPenerima(penerimaId);
      return penerima.terpilih;
    }


    getPenerima();
    
    selectElement.addEventListener('change', function(){
      const penerimaId = this.value;      
      if(penerimaId != 00)
      {
        addPenerimaToList(penerimaId);      
      }
    },false);

      <?php
        if($this->session->userdata('error')) :
          $respon = $this->session->userdata('error');
      ?>
        $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><?php echo $respon; ?></div>")
        $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
      <?php endif; ?>
  });
</script>
</body>
</html>
