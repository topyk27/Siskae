<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class M_setting extends CI_Model
{
	
	private $table = "setting";
	public $ketua;
	public $ketua_nip;
	public $panitera;
	public $panitera_nip;

	public function logo_rules()
	{
		return [
			['field' => 'logo',
			'label' => 'logo',
			'rules' => 'callback_validate_image'
			]
		];
	}

	public function getAll()
	{
		$this->db->from($this->table);
		return $this->db->get()->row();
	}

	public function list_hakim()
	{
		$db_sipp = $this->load->database('sipp', TRUE);
		$statement = "SELECT nama_gelar, nip FROM hakim_pn WHERE aktif='Y' ORDER BY nama_gelar ASC";
		$query = $db_sipp->query($statement);
		return $query->result();
	}

	public function list_panitera()
	{
		$db_sipp = $this->load->database('sipp', TRUE);
		$statement = "SELECT nama_gelar, nip FROM panitera_pn WHERE aktif='Y' ORDER BY nama_gelar ASC";
		$query = $db_sipp->query($statement);
		return $query->result();
	}

	public function ketua_save()
	{
		$post = $this->input->post();
		$split = explode("#", $post['ketua']);
		$nama_gelar = $split[0];
		$nip = $split[1];
		$statement = "UPDATE setting set ketua='$nama_gelar', ketua_nip='$nip' ";
		$this->db->query($statement);
		$data['respon'] = $this->db->affected_rows();
		$data['nama'] = $nama_gelar;
		return $data;
	}

	public function panitera_save()
	{
		$post = $this->input->post();
		$split = explode("#", $post['panitera']);
		$nama_gelar = $split[0];
		$nip = $split[1];
		$statement = "UPDATE setting set panitera='$nama_gelar', panitera_nip='$nip' ";
		$this->db->query($statement);
		$data['respon'] = $this->db->affected_rows();
		$data['nama'] = $nama_gelar;
		return $data;
	}

	public function kode_surat_satker_save()
	{
		$post = $this->input->post();
		$kode_surat_satker = $post['kode_surat_satker'];
		$this->db->query("UPDATE setting set kode_surat_satker='$kode_surat_satker'");
		$efek = $this->db->affected_rows();
		if($efek > 0)
		{
			$this->session->set_userdata("kode_surat_satker",$kode_surat_satker);
		}
		$data['respon'] = $efek;
		$data['kode_surat_satker'] = $kode_surat_satker;		
		return $data;
	}

	public function ttd()
	{
		$statement = "SELECT * FROM setting";
		$query = $this->db->query($statement);
		return $query->row();
	}

	public function savetoken()
	{
		$post = $this->input->post();
		$token = $post['token'];
		$nama_pa = $post['nama_pa'];
		$nama_pa_pendek = $post['nama_pa_pendek'];
		// $this->db->truncate("setting");
		$statement1 = "TRUNCATE setting";
		$this->db->query($statement1);
		$statement = "INSERT INTO setting (token, nama_pa, nama_pa_pendek) VALUES ('$token', '$nama_pa', '$nama_pa_pendek') ";
		$this->db->query($statement);
		return $this->db->affected_rows();
	}

	public function logo_upload()
	{
		// $post = $this->input->post();
		if(!empty($_FILES['logo']['name']))
		{
			return $this->_uploadImage();
		}
	}

	public function _uploadImage()
	{
		$config['upload_path'] = './asset/img/';
		$config['allowed_types'] = 'png';
		$config['file_name'] = 'logo';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('logo'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
 ?>