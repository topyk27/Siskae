<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
    </li>    
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url("surat"); ?>" class="nav-link">Surat</a>
    </li>    
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url("pesan"); ?>" class="nav-link">Pesan</a>
    </li>    
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url("grup"); ?>" class="nav-link">Grup</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url("penerima"); ?>" class="nav-link">Penerima</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url("kode"); ?>" class="nav-link">Kode Surat</a>
    </li>    
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block text-right">
      <a href="#" id="btn-logout">
        <i class="fas fa-power-off"></i>
        <?php print_r($this->session->userdata('nama')); echo "<br>"; print_r($this->session->userdata('role')) ?>
      </a>
    </li>
  </ul>
  <!-- Right navbar links End-->
</nav>

<div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false">
  <div class="modal-dialog modal-dialog-centered modal-confirm">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box">
          <i class="material-icons">exit_to_app</i>
        </div>
        <h4 class="modal-title w-100">Sign Out</h4>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin keluar?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <div class="row">
          <div class="col-6">
            <a href="<?php echo(base_url('user/logout')); ?>" class="btn btn-success btn-block" style="color:#FFF;">Keluar</a>
          </div>
          <div class="col-6">
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Batal
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    function modal_logout()
    {
      $("#modal-logout").modal('show');
    }
    document.getElementById('btn-logout').onclick=modal_logout; 
  </script>