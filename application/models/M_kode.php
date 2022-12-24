<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_kode extends CI_Model
{
    private $table = "kode_surat";
    public $id;
    public $kode;
    public $nama;

    public function rules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'nama',
                'rules' => 'required'
            ],
            [
                'field' => 'kode',
                'label' => 'kode',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("kode","asc");
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id" => $id])->row();
    }

    public function tambah()
    {
        $post = $this->input->post();
        $this->nama = $post['nama'];
        $this->kode = $post['kode'];
        if($this->sudah_ada($this->kode))
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
        $this->kode = $post['kode'];
        if($this->sudah_ada($this->kode,$this->id))
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

    public function sudah_ada($kode, $id = null)
    {
        if($id != null)
        {
            $query = $this->db->query("SELECT kode from $this->table WHERE kode LIKE '$kode' AND id = $id");
            if($query->num_rows()>0) // berarti namanya sama dengan yang diinput
            {
                return false;
            }
            else // cek nama penerima lain siapa tau ada yang sama
            {
                $query1 = $this->db->query("SELECT kode FROM $this->table WHERE kode LIKE '$kode' AND id != $id ");
                // kalo ada yang sama berarti namanya sudah terpakai return true
                return ($query1->num_rows()>0) ? true:false;
            }
        }
        else
        {
            $query = $this->db->query("SELECT kode FROM $this->table WHERE nama LIKE '$kode' ");
            return ($query->num_rows()>0) ? true : false;
        }
    }
}

?>