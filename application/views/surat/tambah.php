<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php 
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');
	?>
  <title><?php echo $app; ?> | Surat | Tambah</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->load->view("_partials/css.php") ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datepicker/datepicker3.css'); ?>">  
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
            <h1>Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('surat') ?>">Surat</a></li>
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
                        <label for="jenis">Jenis Surat</label>
                        <select name="jenis" id="jenis" class="form-control <?php echo form_error('jenis') ? 'is-invalid' : ''; ?>" required>                        
                            <option value="Surat Keputusan" <?php echo set_select('jenis', 'Surat Keputusan', TRUE); ?>>Surat Keputusan</option>
                            <option value="Surat Tugas" <?php echo set_select('jenis', 'Surat Tugas'); ?>>Surat Tugas</option>
                            <!-- <option value="Surat Lainnya" <?php echo set_select('jenis', 'Surat Lainnya'); ?>>Surat Lainnya</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control <?php echo form_error('judul') ? 'is-invalid': ''; ?>" name="judul" value="<?php echo set_value('judul'); ?>" required>
                        <div class="invalid-feedback">
                            <?php echo form_error('judul'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="no_urut">Nomor Urut</label>
                      <input type="text" class="form-control <?php echo form_error('no_urut') ? 'is-invalid' : ''; ?>" name="no_urut" required placeholder="123abc">
                      <div class="invalid-feedback">
                        <?php echo form_error('no_urut'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode Surat</label>
                        <select name="kode" id="kode" class="form-control <?php echo form_error('kode') ? 'is-invalid' : ''; ?>" required>
                        <option value="">Pilih Kode Surat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control <?php echo form_error('tanggal') ? 'is-invalid':'' ?>" name="tanggal" value="<?php echo set_value('tanggal', date('Y-m-d')); ?>" required>
                        <div class="invalid-feedback">
                            <?php echo form_error('tanggal'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="no_surat">Nomor Surat</label>
                      <input type="text" class="form-control <?php echo form_error('no_surat') ? 'is-invalid' : ''; ?>" name="no_surat" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="link">Link Google Drive</label>
                        <input type="text" class="form-control <?php echo form_error('link') ? 'is-invalid':''; ?>" required name="link">
                        <div class="invalid-feedback">
                            <?php echo form_error('link'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_penerimas">Penerima <?php echo form_error('nama_penerimas[]'); ?></label>
                        <select id="grup_penerima" class="form-control mb-3" required></select>
                        <div class="invalid-feedback">
                          <?php echo form_error('nama_penerimas[]'); ?>
                        </div>
                        <div id="vPenerima" style="display: none;">
                          <label for="penerima">Pilih Penerima</label>
                          <select id="penerima" class="form-control mb-3"></select>
                        </div>
                        <div class="row" id="penerimaList"></div>                        
                    </div>
                  
                  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="<?php echo base_url("surat"); ?>" class="btn btn-danger">Batal</a>
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
<!-- datepicker -->
<script src="<?php echo base_url('asset/plugin/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script>const base_url = "<?php echo base_url(); ?>";const kodeSatker = "<?php echo $this->session->userdata('kode_surat_satker'); ?>";const namaSatker = "<?php echo $this->session->userdata('nama_pa_pendek'); ?>";</script>
<script type="text/javascript">  

$(document).ready(function(){
  $("#sidebar_surat").addClass("active");  
  // datepicker
  var date_input=$('input[name="tanggal"]'); //our date input has the name "date"
  var container=$('.content form').length>0 ? $('.content form').parent() : "body";
  var options={
    format: 'yyyy-mm-dd',
    container: container,
    todayHighlight: true,
        autoclose: true,
      };
  date_input.datepicker(options);
  // end datepicker
      
      let penerimas = [];
      const grups = [];
      const RENDER_PENERIMA = "renderPenerima";
      const RENDER_PENERIMA_LIST = "renderPenerimaList";
      const RENDER_GRUP = "renderGrup";
      const selectGrup = document.getElementById("grup_penerima");
      const selectPenerima = document.getElementById("penerima");
      const penerimaListElement = document.getElementById("penerimaList");
      const vPenerima = document.getElementById("vPenerima");
      let renderByGrup = false;
      let kodes = [];
      const RENDER_KODE = "renderKode";
      const selectKode = document.getElementById("kode");
      let iNoSurat = $("input[name='no_surat']");
      let iNoUrut = $("input[name='no_urut']");
      let iTanggal = $("input[name='tanggal']");
      
      const getGrup = () =>
      {
        $.ajax({
          url: base_url+"grup/getAll",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            if(data !== null)
            {
              for(const grup of data)
              {
                grups.push(grup);
              }
              document.dispatchEvent(new Event(RENDER_GRUP));
            }
          },
          error: function(err)
          {
            alert("gagal mengambil data grup");
            console.log(err.responseText);
          }
        });
      }
      
      document.addEventListener(RENDER_GRUP, function(){
        selectGrup.innerHTML = "";
        const opt = document.createElement('option');
        opt.setAttribute('value','00');
        opt.innerText = "Pilih Penerima";
        selectGrup.append(opt);
        for(const grupItem of grups)
        {
          const grupEl = makeGrup(grupItem);
        }
        const lainnya = document.createElement('option');
        lainnya.setAttribute('value','lainnya');
        lainnya.innerText = "Pilih Manual";
        selectGrup.append(lainnya);
      });
      
      const makeGrup = (objGrup) =>
      {
        const opt = document.createElement('option');
        opt.setAttribute('value',objGrup.id);
        opt.innerText = objGrup.nama;
        selectGrup.append(opt);
      }
      
      selectGrup.addEventListener('change', function(){
        const grupId = this.value;
        if(grupId == "lainnya")
        {
          getPenerima();
        }
        else if (grupId != 00)
        {
          vPenerima.style.display = "none";
          makePenerimaByGrup(grupId);
        }
        else
        {
          vPenerima.style.display = "none";
          penerimaListElement.innerHTML = "";
        }
      });  
      
      const getPenerima = () =>
      {
        penerimaListElement.innerHTML = "";
        $.ajax({
          url: base_url+"penerima/getAll",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            if(data !== null)
            {
              penerimas = [];
              for(const penerima of data)
              {
                penerima.terpilih = false;
                penerimas.push(penerima);
              }
              document.dispatchEvent(new Event(RENDER_PENERIMA));
            }
          }
        });
      }
      
      document.addEventListener(RENDER_PENERIMA, function(){    
        vPenerima.style.display = "block";
        selectPenerima.innerHTML = "";
        const opt = document.createElement('option');
        opt.setAttribute('value','00');
        opt.innerText = "Pilih Penerima";
        selectPenerima.append(opt);
        for(const penerimaItem of penerimas)
        {
          const penerimaEl = makePenerima(penerimaItem);
        }
      });
      
      const makePenerima = (objPenerima) =>
      {
        if(objPenerima.terpilih)
        {
          return;
        }
        const opt = document.createElement('option');
        opt.setAttribute('value',objPenerima.id);
        opt.innerText = objPenerima.nama;
        selectPenerima.append(opt);
      }
      
      const makePenerimaByGrup = (grupId) =>
      {
        $.ajax({
          url: base_url+"penerima/getByGrup/"+grupId,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            if(data != null)
            {
              penerimas = [];
              for(const penerima of data)
              {
                penerima.terpilih = true;
                penerimas.push(penerima);
              }
              renderByGrup = true;
              document.dispatchEvent(new Event(RENDER_PENERIMA_LIST));
            }
          }
        });
      }
      
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
            input.className = "form-control";
            input.value = penerimaItem.nama;
            input.setAttribute("readonly","");
            input.name = "nama_penerimas["+i+"]";
            const iHidden = document.createElement('input');
            iHidden.type = 'hidden';
            iHidden.name = 'penerimas['+i+']';
            iHidden.value = penerimaItem.id;            
            if(!renderByGrup)
            {              
              const span = document.createElement("span");
              span.className = "input-group-append";
              const divSpan = document.createElement("div");
              divSpan.className = "input-group-text bg-transparent";
              const iEl = document.createElement('i');
              iEl.className = "fas fa-times";
              iEl.addEventListener("click", function(){
                removePenerimaToList(penerimaItem.id);
              });
              divSpan.append(iEl);
              span.append(divSpan);
              div.append(input,iHidden,span);
            }
            else
            {
              div.append(input,iHidden);
            }
            penerimaListElement.append(div);
            i++;
          }
        }
      });
      
      const addPenerimaToList = (penerimaId) =>
      {
        renderByGrup = false;        
        const penerimaTarget = findPenerima(penerimaId);
        if(penerimaTarget == null)
        {
          return;
        }penerimaTarget.terpilih = true;
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
      
      selectPenerima.addEventListener('change', function(){
        const penerimaId = this.value;
        if(penerimaId != 00)
        {
          addPenerimaToList(penerimaId);
        }
      },false);
      
      const getKode = () =>
      {
        $.ajax({
          url: base_url+"kode/getAll",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
            if(data !== null)
            {
              for(const kode of data)
              {
                kodes.push(kode);
              }
            }
            document.dispatchEvent(new Event(RENDER_KODE));
          }
        });
      }
      
      document.addEventListener(RENDER_KODE, function(){
        selectKode.innerHTML = "";
        const opt = document.createElement('option');
        // opt.setAttribute('value','00');
        opt.innerText = "Pilih Kode Surat";
        selectKode.append(opt);
        for(const kodeItem of kodes)
        {
          const opt = document.createElement('option');
          opt.setAttribute('value',kodeItem.kode);
          opt.innerText = kodeItem.kode;
          selectKode.append(opt);
        }
      });
      getKode();
      getGrup();

      iNoUrut.on('input', function(){
        renderNoSurat();
      });

      iTanggal.on('change', function(){
        renderNoSurat();
      });

      selectKode.addEventListener('change', function(){
        renderNoSurat();
      });

      const getTanggal = (tanggal) =>
      {
        const data = [];
        const date = new Date(tanggal);
        data.hari = date.getDate();
        data.bulan = date.getMonth() + 1;
        data.tahun = date.getFullYear();        
        return data;
      }

      const renderNoSurat = () =>
      {
        const noUrut = iNoUrut.val();
        const kodeSurat = selectKode.value;
        const tanggal = getTanggal(iTanggal.val());
        const bulan = tanggal.bulan;
        const tahun = tanggal.tahun;
        iNoSurat.val(kodeSatker+"/"+noUrut+"/"+kodeSurat+"/"+bulan+"/"+tahun+"/"+namaSatker);
      }      

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
