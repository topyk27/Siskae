<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kode extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model("M_kode");
        $this->load->model("M_user");
        if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
    }

    public function index()
    {
        $this->load->view('kode/index');
    }

    public function getAll()
    {
        echo json_encode($this->M_kode->getAll());
    }

    public function tambah()
    {
        $this->load->library('form_validation');
        $validation = $this->form_validation;
        $kode = $this->M_kode;
        $validation->set_rules($kode->rules());
        if($validation->run())
        {
            $respon = $kode->tambah();
            if($respon == 1)
            {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect("kode");
            }
            else if($respon == "sudah ada")
            {
                $this->session->set_flashdata('error', 'Gagal menyimpan. Nama tersebut sudah ada di dalam database');
                redirect("kode/tambah");
            }
            else
            {
                $this->session->set_flashdata('success', 'Gagal menyimpan data');
                redirect("kode/tambah");
            }
        }
        $this->load->view('kode/tambah');
    }

    public function ubah($id)
    {
        if(!isset($id))
        {
            redirect("kode");
        }
        else
        {
            $kode = $this->M_kode;
            $this->load->library('form_validation');
            $validation = $this->form_validation;
            $validation->set_rules($kode->rules());
            if($validation->run())
            {
                $respon = $kode->ubah($id);
                if($respon == 1)
                {
                    $this->session->set_flashdata('success', 'Data berhasil diubah');
                    redirect("kode");
                }
                else if($respon == "sudah ada")
                {
                    $this->session->set_flashdata('error', 'Gagal menyimpan. Nama tersebut sudah ada di dalam database');
                    redirect("kode/ubah/".$id);
                }
                else
                {
                    $this->session->set_flashdata('success', 'Data gagal diubah');
                    redirect("kode");
                }
            }
            $data['kode'] = $kode->getById($id);
            if(!$data['kode'])
            {
                $this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
                redirect("kode");
            }
            else
            {
                $this->load->view("kode/ubah",$data);
            }
        }
    }

    public function hapus($id)
	{
		if($this->M_kode->hapus($id))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
}

?>