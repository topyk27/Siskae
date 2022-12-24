<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penerima extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_penerima");
        $this->load->model("M_user");
        if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
    }

    public function index()
    {
        $this->load->view('penerima/index');
    }

    public function tambah()
    {
        $this->load->library('form_validation');
        $validation = $this->form_validation;
        $penerima = $this->M_penerima;
        $validation->set_rules($penerima->rules());
        if($validation->run())
        {
            $respon = $penerima->tambah();
            if($respon == 1)
            {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
				redirect("penerima");
            }
            else if($respon == "sudah ada")
            {
                $this->session->set_flashdata('error', 'Gagal menyimpan. Nama tersebut sudah ada di dalam database');
				redirect("penerima/tambah");
            }
            else
            {
                $this->session->set_flashdata('success', 'Gagal menyimpan data');
				redirect("penerima/tambah");
            }
        }
        $this->load->view('penerima/tambah');
    }

    public function ubah($id)
    {        
        if(!isset($id))
        {
            redirect("penerima");
        }
        else
        {            
            $penerima = $this->M_penerima;
            $this->load->library('form_validation');
            $validation = $this->form_validation;
            $validation->set_rules($penerima->rules());
            if($validation->run())
            {
                $respon = $penerima->ubah($id);
                if($respon == 1)
                {
                    $this->session->set_flashdata('success', 'Data berhasil diubah');
                    redirect("penerima");
                }
                else if($respon == "sudah ada")
                {
                    $this->session->set_flashdata('error', 'Gagal menyimpan. Nama tersebut sudah ada di dalam database');
                    redirect("penerima/ubah/".$id);
                }
                else
                {
                    $this->session->set_flashdata('success', 'Data gagal diubah');
                    redirect("penerima");
                }
            }
            $data['penerima'] = $penerima->getById($id);
            if(!$data['penerima'])
            {
                $this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
                redirect("penerima");
            }
            else
            {
                $this->load->view("penerima/ubah",$data);
            }
        }
    }

    public function hapus($id)
	{
		if($this->M_penerima->hapus($id))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

    public function getAll()
    {
        $data = $this->M_penerima->getAll();
        echo json_encode($data);
    }

    public function getByGrup($id)
    {
        $data = $this->M_penerima->getByGrup($id);
        echo json_encode($data);
    }

    public function getAllWithSelected($id)
    {
        $data = $this->M_penerima->getAllWithSelected($id);
        echo json_encode($data);
    }
}

 ?>