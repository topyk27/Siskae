<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_penerima extends CI_Model
{
    private $table = "penerima";
    public $id;
    public $nama;
    public $no_hp;

    public function rules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'nama',
                'rules' => 'required'
            ],
            [
                'field' => 'no_hp',
                'label' => 'no_hp',
                'rules' => 'required|numeric',
                'errors' => array('required' => 'Mohon diisi nomor WA','numeric' => 'Masukkan hanya angka saja.'),
            ]
        ];
    }

    public function tambah()
    {
        $post = $this->input->post();
        $this->nama = $post['nama'];
        $this->no_hp = $post['no_hp'];
        if($this->sudah_ada($this->nama))
        {
            return "sudah ada";
        }        
        $this->db->insert($this->table,$this);
        return $this->db->affected_rows();
    }

    public function ubah($id)
    {
        $post = $this->input->post();
        $this->id = $id;
        $this->nama = $post['nama'];
        $this->no_hp = $post['no_hp'];
        if($this->sudah_ada($this->nama,$this->id))
        {
            return "sudah ada";
        }
        $this->db->update($this->table, $this, ['id' => $id]);
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
            else // cek nama penerima lain siapa tau ada yang sama
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

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("nama","asc");
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id" => $id])->row();
    }
    
    public function getByGrup($id)
    {
        $statement = "SELECT g.id_grup, p.id, p.nama, p.no_hp FROM detail_grup g INNER JOIN penerima p ON g.id_penerima = p.id WHERE g.id_grup=$id";
        return $this->db->query($statement)->result();
    }

    public function getAllWithSelected($id)
    {
        $result = $this->db->query("SELECT p.id, p.nama, dg.id_grup, (CASE WHEN dg.id_grup = $id THEN TRUE ELSE FALSE END) AS terpilih FROM penerima AS p LEFT JOIN detail_grup AS dg ON dg.id_penerima = p.id ORDER BY p.nama")->result();
        return $result;
    }
}

 ?>