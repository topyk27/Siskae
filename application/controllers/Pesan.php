<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pesan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_pesan");
        $this->load->model("M_user");
        if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
    }

    public function index()
    {
        $this->load->view('pesan/index');
    }

    public function kirim()
    {
        $data['setting'] = $this->M_pesan->getSetting();
        $this->load->view('pesan/kirim',$data);
    }

    public function updateStatusKirim()
    {
        echo json_encode($this->M_pesan->updateStatusKirim());
    }

    public function cekTerkirim()
    {
        echo json_encode($this->M_pesan->cekTerkirim());
    }

    public function setStatusGagal()
    {
        echo json_encode($this->M_pesan->setStatusGagal());
    }

    public function setStatusGagalByWarik()
    {
        echo json_encode($this->M_pesan->setStatusGagalByWarik());
    }

    public function setStatusTerkirim()
    {
        echo json_encode($this->M_pesan->setStatusTerkirim());
    }

    public function testing()
    {
        $data = $this->M_pesan->testing();
        echo json_encode($data);
    }

    public function insertTesting()
    {
        echo json_encode($this->M_pesan->insertTesting());
    }

    public function cekStatusTesting()
    {
        echo json_encode($this->M_pesan->cekStatusTesting());
    }

    public function getAll()
    {
        $data = $this->M_pesan->getAll();
        echo json_encode($data);
    }

    public function getPesan()
    {
        $data = $this->M_pesan->getPesan();
        echo json_encode($data);
    }

    public function getPenerimaBySurat($id)
    {
        $data = $this->M_pesan->getPenerimaBySurat($id);
        echo json_encode($data);
    }
}

?>