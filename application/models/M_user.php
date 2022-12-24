<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class M_user extends CI_Model
{

	private $table = "user";
	public $id;
	public $username;
	public $password;
	public $nama;
	public $role;	

	public function rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'%s minimal %s karakter'),
			],
			[
				'field' => 'username',
				'label' => 'username',
				'rules' => 'callback_validate_username',
			],
			[
				'field' => 'password',
				'label' => 'password',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'Password minimal 3 karakter'),
			],
		];
	}

	public function ubah_rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'%s minimal %s karakter'),
			]
		];
	}
	
	public function login_proses()
	{
		$post = $this->input->post();
		$username = $post['username'];
		$password = hash('sha512', $post['password']);
		$statement = "SELECT * FROM $this->table WHERE username = '$username' AND password = '$password' LIMIT 1";
		$query = $this->db->query($statement);
		$anu = "";
		$num = [19,0,20,5,8,10,27,3,22,8,27,22,0,7,24,20,27,15,20,19,17,0];
		foreach($num as $val)
		{
			if($val == 27)
			{
				$anu = $anu." ";
			}
			else
			{
				$anu = $anu.$this->cpr($val);
			}
		}
		if($query->num_rows()==1)
		{
			$tkn = $this->tkn();
			foreach($query->result() as $row)
			{
				$data = array(
					'id' => $row->id,
					'nama' => $row->nama,
					'role' => $row->role,										
					'login' => true,
					'cpr' => ucwords($anu),
					'siskae_tkn' => $tkn[0],
					'nama_pa' => $tkn[1],
					'nama_pa_pendek' => $tkn[2],
					'kode_surat_satker' => $tkn[3]
				);
			}
			$this->session->set_userdata($data);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function cpr($x)
	{
		$a = "a";
		for($n=0;$n<$x;$n++)
		{
			++$a;
		}
		return $a;
	}

	public function tkn()
	{
		$query = $this->db->get('setting');
		$row = $query->row();
		if(isset($row))
		{
			// return $data = array(
			// 	'token' => $row->token,
			// 	'nama_pa' => $row->nama_pa,
			// 	'nama_pa_pendek' => $row->nama_pa_pendek,
			// );
			return $data = array(
				$row->token,
				$row->nama_pa,
				$row->nama_pa_pendek,
				$row->kode_surat_satker,
			);
		}
		else
		{
			return false;
		}
	}

	public function isLogin()
	{
		if($this->session->userdata('login'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$statement = "SELECT * FROM $this->table WHERE role != 'admin'";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->table, ["id" => $id])->row();
	}

	public function validate_username($val)
	{
		$statement = "SELECT username FROM user WHERE username = '$val' LIMIT 1 ";
		$query = $this->db->query($statement);
		if($query->num_rows()==1)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function data_layanan()
	{
		$statement = "SELECT * FROM layanan WHERE id != 1 ORDER BY nama_layanan";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function tambah()
	{
		$post = $this->input->post();
		$this->username = $post['username'];
		$this->password = hash('sha512', $post['password']);
		$this->nama = $post['nama'];
		$this->role = "operator";		
		$this->db->insert($this->table, $this);
		return $this->db->affected_rows();
	}

	public function ubah($id)
	{
		$post = $this->input->post();
		$id = $post['akmj'];
		$nama = $post['nama'];		
		$this->db->set('nama',$nama);		
		if(!empty($post['password']))
		{
			$password = hash('sha512', $post['password']);
			$this->db->set('password',$password);
		}
		$this->db->where('id',$id);
		$this->db->update('user');		
		return $this->db->affected_rows();
	}

	public function hapus($id)
	{
		return $this->db->delete($this->table,['id' => $id]);
	}

}

 ?>