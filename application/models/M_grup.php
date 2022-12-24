<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_grup extends CI_Model
{
    private $table = "grup";
    public $id;
    public $nama;

    public function rules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'nama',
                'rules' => 'required',
            ],
            [
                'field' => 'penerimas[]',
                'label' => 'penerimas',
                'rules' => 'required',
            ],
        ];
    }

    public function getAll()
	{
		$this->db->from($this->table);
        $this->db->order_by("nama", "asc");
		return $this->db->get()->result();		
	}

    public function getAllWithMember()
    {
        $data = array();
        $query = $this->db->query("SELECT * FROM $this->table");
        $result = $query->result();
        // return $result;
        foreach ($result as $row)
        {                        
            $tmp = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'anggota' => $this->getMemberById($row->id)
            );            
            array_push($data,$tmp);
        }
        return $data;
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table,["id" => $id])->row();
    }

    public function getMemberById($id)
    {
        $query = $this->db->query("SELECT p.nama FROM penerima AS p, detail_grup AS dg WHERE dg.id_grup = $id AND dg.id_penerima = p.id ORDER BY p.nama");
        $data = array();
        $result = $query->result();        
        foreach($result as $row)
        {
            array_push($data,$row->nama);            
        }
        return $data;        
    }

    public function tambah()
    {
        $post = $this->input->post();        
        $this->nama = $post['nama'];
        $penerimas = $post['penerimas'];
        if($this->sudah_ada($this->nama))
        {
            return "sudah ada";
        }
        $this->db->insert($this->table, $this);
        $inserted_id = $this->db->insert_id();
        foreach($penerimas as $item)
        {
            $this->db->insert("detail_grup",array('id_grup' => $inserted_id, 'id_penerima' => $item));
        }
        return $this->db->affected_rows();
    }

    public function ubah($id)
    {
        $post = $this->input->post();
        $this->id = $id;
        $this->nama = $post['nama'];
        $penerimas = $post['penerimas'];        
        $cek_udah_ada = $this->sudah_ada($this->nama,$this->id);
        if($cek_udah_ada)
        {            
            return "sudah ada";
        }
        $this->db->update($this->table,$this,['id' => $id]);
        $this->db->where('id_grup',$id);
        $this->db->delete("detail_grup");
        foreach($penerimas as $item)
        {
            $this->db->insert("detail_grup",array('id_grup' => $this->id, 'id_penerima' => $item));
        }
        return $this->db->affected_rows();
    }

    public function hapus($id)
    {
        return $this->db->delete($this->table, ["id" => $id]);
    }

    public function sudah_ada($nama, $id = null)
    {
        if($id != null)
        {
            $query = $this->db->query("SELECT nama from $this->table WHERE nama LIKE '$nama' AND id = $id");
            if($query->num_rows()>0) // berarti namanya sama dengan yang diinput
            {
                return false;
            }
            else // cek nama grup lain siapa tau ada yang sama
            {
                $query1 = $this->db->query("SELECT nama FROM $this->table WHERE nama LIKE '$nama' AND id != $id ");
                // kalo ada yang sama berarti namanya sudah terpakai return true
                return ($query1->num_rows()>0) ? true:false;
            }
        }
        else
        {
            $query = $this->db->query("SELECT nama FROM $this->table WHERE nama LIKE '$nama' ");
            return ($query->num_rows()>0) ? true : false;
        }
    }
}

 ?>