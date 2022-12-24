<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Grup extends CI_Controller
{
    public function __construct()
	{
		parent:: __construct();		
		$this->load->model("M_grup");
		$this->load->model("M_user");
        if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
	}

	public function index()
	{
		$this->load->view('grup/index');
	}

	public function tambah()
	{
		$this->load->library('form_validation');
		$validation = $this->form_validation;
		$grup = $this->M_grup;
		$validation->set_rules($grup->rules());
		if($validation->run())
		{			
			$respon = $grup->tambah();
			if($respon == 1)
			{
				$this->session->set_flashdata('success', 'Data berhasil disimpan');
				redirect("grup");
			}
			else if($respon == "sudah ada")
			{
				$this->session->set_flashdata('error', 'Gagal menyimpan. Nama tersebut sudah ada di dalam database');
				redirect("grup/tambah");
			}
			else
			{
				$this->session->set_flashdata('success', 'Gagal menyimpan data');
				redirect("grup/tambah");
			}
		}
		$this->load->view('grup/tambah');
	}

	public function ubah($id)
	{
		if(!isset($id))
		{
			redirect("grup");
		}
		else
		{
			$grup = $this->M_grup;
			$this->load->library('form_validation');
			$validation = $this->form_validation;
			$validation->set_rules($grup->rules());
			if($validation->run())
			{
				// $post = $this->input->post();
				// print_r($post);
				// return;
				$respon = $grup->ubah($id);
				// redirect("aw/".$respon);
				if($respon == 1)
				{
					$this->session->set_flashdata('success', 'Data berhasil diubah');
                    redirect("grup");
				}
				else if($respon == "sudah ada")
				{
					$this->session->set_flashdata('error', 'Gagal menyimpan. Nama grup tersebut sudah ada di dalam database');
					redirect("grup/ubah/".$id);
				}
				else
				{
					$this->session->set_flashdata('success', 'Data gagal diubah');
					redirect("grup");
				}
			}
			$data["grup"] = $grup->getById($id);
			if(!$data['grup'])
			{
				$this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
				redirect("grup");
			}
			else
			{
				$this->load->view("grup/ubah",$data);
			}
		}
	}

	public function hapus($id)
	{
		if($this->M_grup->hapus($id))
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
		$data = $this->M_grup->getAll();
		echo json_encode($data);
	}

	public function getAllWithMember()
	{
		$data = $this->M_grup->getAllWithMember();
		// $data = $this->M_grup->getMemberById(1);
		echo json_encode($data);
		// print_r($data);
	}
}
// query anggota grup 
// select g.id, g.nama, GROUP_CONCAT(p.nama SEPARATOR ', ') AS anggota
// FROM (
//    (grup AS g LEFT JOIN  detail_grup AS dg  ON g.id = dg.id_grup)
//    LEFT JOIN penerima AS p ON p.id = dg.id_penerima)
//    GROUP BY g.id
 ?>
