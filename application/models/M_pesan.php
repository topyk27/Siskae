<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
class M_pesan extends CI_Model
{
    private $table = "pesan";
    public $id;
    public $penerima_id;
    public $surat_id;
    public $pesan;
    public $no_hp;
    public $status;
    public $created_at;
    public $updated_at;

    public function getAll()
	{
		return $this->db->query("SELECT s.jenis, s.judul, p.nama, psn.no_hp, psn.status, psn.updated_at FROM surat AS s, penerima AS p, pesan AS psn
        WHERE s.id = psn.surat_id AND p.id = psn.penerima_id ORDER BY psn.updated_at DESC")->result();
	}

    public function getPesan()
    {
        return $this->db->query("SELECT * FROM $this->table WHERE status = 'pending' ORDER BY updated_at ASC LIMIT 1")->result();
    }

    public function getPenerimaBySurat($id)
    {
        return $this->db->query("SELECT penerima_id FROM $this->table WHERE surat_id = $id")->result();
    }

    public function getSetting()
    {
        return $this->db->query("SELECT * FROM setting LIMIT 1")->result();
    }

    public function testing()
    {
        $tanggal = date('Y-m-d');
        return $this->db->query("SELECT * FROM testing WHERE tanggal = $tanggal ")->result();
    }

    public function insertTesting()
    {
        $tanggal = date('Y-m-d');
        $this->db->query("INSERT INTO testing (tanggal,status) VALUES ($tanggal,'proses')");
        return $this->db->affected_rows();
    }

    public function cekStatusTesting()
    {
        $tanggal = date('Y-m-d');
        return $this->db->query("SELECT status FROM testing WHERE tanggal = $tanggal")->result();
    }

    public function updateStatusKirim()
    {
        $post = $this->input->post();
        $pesanId = $post['id'];
        $timestamp = date('Y-m-d H:i:s');
        $this->db->query("UPDATE pesan set status = 'pending' WHERE status = 'proses'"); //set semua pesan menjadi pending
        // pesan yang mau dikirim dijadikan proses
        $this->db->query("UPDATE pesan set status = 'proses', updated_at = '$timestamp' WHERE id=$pesanId");
        return $this->db->affected_rows();
    }

    public function cekTerkirim()
    {
        $post = $this->input->post();
        $pesanId = $post['id'];
        return $this->db->query("SELECT status FROM pesan WHERE id=$pesanId")->result();
    }

    public function setStatusGagal()
    {
        $post = $this->input->post();
        $pesanId = $post['id'];
        $timestamp = date('Y-m-d H:i:s');
        $this->db->query("UPDATE pesan set status = 'gagal', updated_at = '$timestamp' WHERE id=$pesanId");
        return $this->db->affected_rows();
    
    }

    public function setStatusGagalByWarik()
    {        
        $timestamp = date('Y-m-d H:i:s');
        $row = $this->db->query("SELECT id FROM $this->table WHERE status = 'proses' ORDER BY updated_at DESC LIMIT 1")->row();
        $pesanId = $row->id;
        $this->db->query("UPDATE pesan set status = 'gagal', updated_at = '$timestamp' WHERE id=$pesanId");
        return $this->db->affected_rows();
    
    }
    public function setStatusTerkirim()
    {        
        $row = $this->db->query("SELECT id FROM $this->table WHERE status = 'proses' ORDER BY updated_at DESC LIMIT 1")->row();
        $pesanId = $row->id;
        $timestamp = date('Y-m-d H:i:s');
        $this->db->query("UPDATE pesan set status = 'terkirim', updated_at = '$timestamp' WHERE id=$pesanId");
        return $this->db->affected_rows();
    }
}

 ?>