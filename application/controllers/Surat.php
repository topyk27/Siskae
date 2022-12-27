<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_surat");
        $this->load->model("M_user");
        if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
    }

    public function index()
    {
        $this->load->view('surat/index');
    }

    public function getAll()
    {
        $data = $this->M_surat->getAll();
        echo json_encode($data);
    }

    public function tambah()
    {
        $surat = $this->M_surat;
        $this->load->library('form_validation');
        $validation = $this->form_validation;
        $validation->set_rules($surat->rules());
        if($validation->run())
        {
            $respon = $surat->tambah();
            if($respon == 1)
            {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect("surat");
            }
            else
            {
                $this->session->set_flashdata('success', 'Gagal menyimpan data');
                redirect("surat/tambah");
            }
        }
        $this->load->view("surat/tambah");
    }

    public function ubah($id)
    {
        if(!isset($id))
		{
			redirect("surat");
		}
        else
        {
            $surat = $this->M_surat;
            $this->load->library('form_validation');
			$validation = $this->form_validation;
			$validation->set_rules($surat->rules());
            if($validation->run())
            {
                $respon = $surat->ubah($id);
                if($respon == 1)
                {
                    $this->session->set_flashdata('success', 'Data berhasil diubah');
                    redirect("surat");
                }
                else if($respon == "sudah ada")
                {
                    $this->session->set_flashdata('error', 'Gagal menyimpan. Nama grup tersebut sudah ada di dalam database');
                    redirect("surat/ubah/".$id);
                }
                else
                {
                    $this->session->set_flashdata('success', 'Data gagal diubah');
                    redirect("surat");
                }
            }
            $data["surat"] = $surat->getById($id);
            if(!$data["surat"])
            {
                $this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
                redirect("surat");
            }
            else
            {
                $this->load->view("surat/ubah",$data);
            }
        }
    }

    public function hapus($id)
	{
		if($this->M_surat->hapus($id))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

    public function filter($kode,$surat,$mulai,$akhir)
    {
        echo json_encode($this->M_surat->filter($kode,$surat,$mulai,$akhir));
    }
}
 ?>