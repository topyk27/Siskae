<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Setting extends CI_Controller
{
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->model("M_setting");
		$this->load->model("M_user");
		$this->load->library('form_validation');
	}	

	public function validate_username($str)
	{
		if(!$this->M_user->validate_username($str))
		{
			$this->form_validation->set_message('validate_username', 'Username telah digunakan');
			return false;
		}
		else
		{
			return true;
		}
	}

	public function user()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if($this->session->userdata('role') != "admin")
		{
			redirect('error_cuy');
		}
		else
		{
			$this->load->view('user/index');
		}
	}

	public function user_tambah()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if($this->session->userdata('role') != "admin")
		{
			redirect('error_cuy');
		}
		else
		{
			$user = $this->M_user;
			$validation = $this->form_validation;
			$validation->set_rules($user->rules());
			if($validation->run())
			{
				$respon = $user->tambah();
				if($respon==1)
				{
					redirect("setting/user");
				}
			}		
			$this->load->view('user/tambah');
		}
	}

	public function user_ubah($id)
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if($this->session->userdata('role') != "admin")
		{
			redirect('error_cuy');
		}
		else
		{
			if(!isset($id))
			{
				redirect('setting/user');
			}
			else
			{
				$user = $this->M_user;
				$validation = $this->form_validation;
				$validation->set_rules($user->ubah_rules());
				if($validation->run())
				{
					$respon = $user->ubah($id);
					if($respon==1)
					{
						$this->session->set_flashdata('success', 'Data berhasil diubah');
					}
					else
					{
						$this->session->set_flashdata('success', 'Data gagal diubah');
					}
					redirect("setting/user");
				}
				$data['user'] = $user->getById($id);			
				if(!$data['user'])
				{
					$this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
					redirect("setting/user");
				}
				else
				{
					$this->load->view("user/ubah", $data);
				}
			}
		}
	}

	public function user_hapus($id)
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if($this->session->userdata('role') != "admin")
		{
			redirect('error_cuy');
		}
		else
		{
			if($this->M_user->hapus($id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
	}

	public function awal()
	{
		$this->session->sess_destroy();
		$this->load->view("setting/awal");
	}

	public function savetoken()
	{
		echo $this->M_setting->savetoken();
	}

	public function sistem()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if($this->session->userdata('role') != "admin")
		{
			redirect('error_cuy');
		}
		else
		{
			$setting = $this->M_setting;
			$validation = $this->form_validation;
			$validation->set_rules($setting->logo_rules());
			if($validation->run())
			{
				$respon = $setting->logo_upload();
				if($respon)
				{
					redirect('setting/sistem');
				}
			}
	
			$data['ttd'] = $this->M_setting->getAll();
			// $data['hakim'] = $this->M_setting->list_hakim();
			// $data['panitera'] = $this->M_setting->list_panitera();		
			$this->load->view("setting/sistem",$data);
		}
	}

	public function ketua_save()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if($this->session->userdata('role') != "admin")
		{
			redirect('error_cuy');
		}
		else
		{
			echo json_encode($this->M_setting->ketua_save());
		}

	}

	public function panitera_save()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if($this->session->userdata('role') != "admin")
		{
			redirect('error_cuy');
		}
		else
		{
			echo json_encode($this->M_setting->panitera_save());
		}
	}
	
	public function kode_surat_satker_save()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if($this->session->userdata('role') != "admin")
		{
			redirect('error_cuy');
		}
		else
		{
			echo json_encode($this->M_setting->kode_surat_satker_save());
		}
	}

	public function validate_image()
	{
		$check = TRUE;
		    if ((!isset($_FILES['logo'])) || $_FILES['logo']['size'] == 0) {
		        $this->form_validation->set_message('validate_image', 'Silahkan pilih logo');
		        $check = FALSE;
		    }
		    else if (isset($_FILES['logo']) && $_FILES['logo']['size'] != 0) {
		        $allowedExts = array("png","PNG");
		        $allowedTypes = array(IMAGETYPE_PNG,);
		        $extension = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
		        $detectedType = exif_imagetype($_FILES['logo']['tmp_name']);
		        $type = $_FILES['logo']['type'];
		        if (!in_array($detectedType, $allowedTypes)) {
		            $this->form_validation->set_message('validate_image', 'Format logo dalam bentuk png');
		            $check = FALSE;
		        }
		        if(filesize($_FILES['logo']['tmp_name']) > 2000000) {
		            $this->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 20MB!');
		            $check = FALSE;
		        }
		        if(!in_array($extension, $allowedExts)) {
		            $this->form_validation->set_message('validate_image', "Ekstensi {$extension} tidak dapat diunggah, gunakan png.");
		            $check = FALSE;
		        }
		    }
		    return $check;
	}

}

 ?>