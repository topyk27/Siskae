<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php 
		$this->config->load('siskae_config',TRUE);
		$app = $this->config->item('app_name','siskae_config');
	?>
  <title><?php echo $app; ?> | Pesan | Kirim</title>
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
              <li class="breadcrumb-item"><a href="<?php echo base_url('pesan'); ?>">Pesan</a></li>
              <li class="breadcrumb-item active">Kirim</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="timeline">
                <div class="time-label">
                    <span class="bg-red"></span>
                </div>
                <div class="clock">
                    <i class="fas fa-clock bg-gray"></i>
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
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
<script>const base_url = "<?php echo base_url(); ?>";</script>
<script>
    $(document).ready(function(){
        $("#sidebar_pesan").addClass("active");
        let pesanId;
        let init = 0;
        const skrg = () =>
        {
            let d = new Date();
            let tahun = d.getFullYear();
            let bulan = d.getMonth() + 1;
            let hari = d.getDate();
            return [tahun,bulan,hari].join('-');
        }
        const getPesan = () =>
        {
            let sukses;
            let current = new Date();
            let nmr;
            $.ajax({
                url: base_url+"pesan/getPesan",
                dataType: "JSON",
                success: function(datas)
                {
                    if(datas.length > 0)
                    {
                        let data = datas[0];
                        let timeline = $("div.timeline");
                        $("div.clock").remove();
                        timeline.append("<div><i class='fas fa-comments bg-yellow'></i><div class='timeline-item'><span class='time'><i class='fas fa-clock'></i></span><h3 class='timeline-header'><a href='#'>Mengirim pesan kepada </a></h3><div class='timeline-body'></div><div class='timeline-footer'><a class='btn btn-primary btn-sm'>Mohon jangan ditutup tab yang baru terbuka</a></div></div></div><div class='clock'><i class='fas fa-clock bg-gray'></i></div>");                        
                        const url = "https://web.whatsapp.com/send?phone=";
                        const nomor = data.no_hp
                        const isi_pesan = data.pesan.replace(/ /g,"+");
                        pesanId = data.id;
                        sukses = true;
                        nmr = nomor;                        
                        if(!isNaN(nomor))
                        {
                            $("span.time").last().append(current.toLocaleTimeString());
                            $("h3.timeline-header").last().append(nomor);
                            $("div.timeline-body").last().append(data.pesan);
                            setTimeout(function(){
                                updateStatusKirim(pesanId);
                                window.open(url+nomor+"&text="+isi_pesan);
                            },5000);
                        }
                        else
                        {
                            $("span.time").last().append(current.toLocaleTimeString());
                            $("h3.timeline-header").last().append(nomor);
                            $("div.timeline-body").last().append("Tidak bisa mengirim pesan kepada "+nomor+" karena tidak sesuai dengan prosedur. Mohon diisi nomor pihak dengan baik dan benar.");
                        }
                    }
                    else
                    {
                        $("span.time").last().append(current.toLocaleTimeString());
                        $("h3.timeline-header").last().append("Tidak ada pesan lagi");
                        $(document).Toasts('create', {
                            class: 'bg-info',
                            title: 'Ambil data pesan ',
                            subtitle: 'Info',
                            body: 'Tidak ada pesan lagi'
                        });
                    }
                },
                error: function(err)
                {
                    sukses = false;
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Gagal ambil data pesan',
                        subtitle: 'Error',
                        body: 'Mencoba mengambil data pesan lagi.'
                    });
                    console.log(err.responseText);
                    setTimeout(function(){
                        getPesan();
                    },15000);
                },
                complete: function()
                {
                    if(sukses)
                    {
                        setTimeout(function(){
                            cekTerkirim(pesanId,nmr);
                        },10000);
                    }
                }
            });
        }

        const updateStatusKirim = (id) =>
        {
            $.ajax({
                type: "POST",
                url: base_url+"pesan/updateStatusKirim",
                data: {id:id},
                dataType: "JSON",
                success: function(respon)
                {                    
                    if(respon == 1)
                    {
                        // setTimeout(function(){
                        //     cekTerkirim(pesanId,nmr);
                        // },10000);
                    }
                    else
                    {
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Gagal update status pesan',
                            subtitle: 'Error',
                            body: 'Mencoba mengupdate data pesan lagi.'
                        });
                        setTimeout(function(){
                            updateStatusKirim(id);
                        },5000);
                    }
                },
                error: function(err)
                {
                    console.log(err.responseText);
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Gagal update status pesan',
                        subtitle: 'Error',
                        body: 'Mencoba mengupdate data pesan lagi.'
                    });
                    setTimeout(function(){
                        updateStatusKirim(id);                        
                    },5000);
                }
            });
        }

        const cekTerkirim = (id, nmr) =>
        {
            $.ajax({
                type: "POST",
                url: base_url+"pesan/cekTerkirim",
                data: {id: id},
                dataType: "JSON",
                success: function(datas)
                {
                    let data = datas[0];                    
                    if(data.status=="terkirim")
                    {
                        setTimeout(function(){
                            getPesan();
                        },7000);
                    }
                    else if(data.status=="gagal")
                    {
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Gagal kirim pesan '+nmr,
                            subtitle: 'Error',
                            body: 'Pastikan nomor terdaftar di whatsapp, apabila pesan ke nomor lain mengalami error juga, silahkan hubungi administrator'
                        });                        
                    }
                    else
                    {
                        setTimeout(function(){
                            if(init>12)
                            {
                                setStatusGagal(id);
                            }
                            else
                            {
                                cekTerkirim(id,nmr);
                                init++;
                            }
                        },5000);
                    }
                },
                error: function(err)
                {
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Gagal ambil status pesan',
                        subtitle: 'Error',
                        body: 'Pastikan tab whatsapp terbuka dan pesan berhasil dikirim.'
                    });
                    console.log(err.responseText);                    
                }
            });
        }

        const setStatusGagal = (id) =>
        {
            $.ajax({
                type: "POST",
                url: base_url+"pesan/setStatusGagal",
                data: {id:id},
                dataType: "JSON",
                success: function(data)
                {                    
                    if(data != 1)
                    {
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Gagal set status gagal',
                            subtitle: 'Error',
                            body: 'Pastikan anda terhubung dengan server'
                        });
                    }
                    else
                    {
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Set Status Gagal',
                            subtitle: 'Error',
                            body: 'Pastikan tab whatsapp terbuka dan pesan berhasil dikirim.'
                        });
                    }
                },
                error: function(err)
                {
                    console.log(err.responseText);
                }
            });
        }
        
        getPesan();
    });
</script>
</body>
</html>
