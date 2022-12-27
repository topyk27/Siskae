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
		return $this->db->query("SELECT psn.id, s.jenis, s.judul, p.nama, psn.no_hp, psn.status, psn.updated_at FROM surat AS s, penerima AS p, pesan AS psn
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
        return $this->db->query("SELECT nama_pa, no_testing FROM setting")->result();
    }

    public function insertTesting()
    {
        $tanggal = date('Y-m-d');
        $respon = [];
        $udah = $this->db->query("SELECT id, status FROM testing WHERE tanggal ='$tanggal' ");
        if($udah->num_rows() > 0)
        {
            foreach($udah->result() as $row)
            {
                if($row->status=="ok")
                {
                    $respon['status'] = "ok";
                    $respon['success'] = 1;
                }
                else if($row->status=="error")
                {
                    $respon['status'] = "error";
                    $respon['success'] = 0;
                }
                else if($row->status=="menunggu")
                {
                    $respon['status'] = "menunggu";
                    $respon['success'] = 2;
                }
                $respon['id'] = $row->id;

            }
        }
        else
        {
            $this->db->query("INSERT INTO testing(status,tanggal) VALUES ('menunggu','$tanggal')");
            $respon['success'] = ($this->db->affected_rows() != 1) ? 0 : 1;
            $respon['status'] = "menunggu";
            $respon['id'] = $this->db->insert_id();            
        }
        return $respon;
    }

    public function testingLagi()
    {
        $tanggal = date("Y-m-d");
        return $this->db->delete("testing",['tanggal' => $tanggal]);
    }

    public function cekTesting()
    {
        $post = $this->input->post();
        $id = $post['id'];
        $statement = "SELECT status FROM testing WHERE id='$id'";
        $row = $this->db->query($statement)->row();
        return $row->status;
    }

    public function updateStatusKirim()
    {
        $post = $this->input->post();
        $pesanId = $post['id'];
        $this->session->set_userdata("pesanId",$pesanId);
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
        $isTesting = $this->isTesting();
        $tanggal = date('Y-m-d');
        if($isTesting=="ok")
        {
            $timestamp = date('Y-m-d H:i:s');
            // $row = $this->db->query("SELECT id FROM $this->table WHERE status = 'proses' ORDER BY updated_at DESC LIMIT 1")->row();
            // $pesanId = $row->id;
            $pesanId = $this->session->userdata('pesanId');
            $this->db->query("UPDATE pesan set status = 'gagal', updated_at = '$timestamp' WHERE id=$pesanId");
            return $this->db->affected_rows();
        }
        else
        {
            $this->db->query("UPDATE testing SET status = 'error' WHERE tanggal = '$tanggal'");
            return $this->db->affected_rows();
        }
    
    }
    public function setStatusTerkirim()
    {        
        $isTesting = $this->isTesting();
        $tanggal = date('Y-m-d');
        if($isTesting=="ok")
        {
            // $row = $this->db->query("SELECT id FROM $this->table WHERE status = 'proses' ORDER BY updated_at DESC LIMIT 1")->row();
            // $pesanId = $row->id;
            $pesanId = $this->session->userdata('pesanId');
            $timestamp = date('Y-m-d H:i:s');
            $this->db->query("UPDATE pesan set status = 'terkirim', updated_at = '$timestamp' WHERE id=$pesanId");
            return $this->db->affected_rows();
        }       
        else
        {
            $this->db->query("UPDATE testing SET status = 'ok' WHERE tanggal = '$tanggal'");
            return $this->db->affected_rows();
        }
    }

    public function isTesting()
    {
        $tanggal = date('Y-m-d');
        $row = $this->db->query("SELECT status FROM testing WHERE tanggal = '$tanggal'")->row();
        return $row->status;
    }

    public function kirimUlang()
    {
        $post = $this->input->post();
        $id = $post['id'];
        $timestamp = date('Y-m-d H:i:s');
        $this->db->query("UPDATE pesan SET status = 'pending', updated_at = '$timestamp' WHERE id=$id");
        return $this->db->affected_rows();
    }

    public function filter($status,$surat,$mulai,$akhir)
    {
        if($surat != 'false')
        {
            $surat = str_replace('%20', ' ', $surat);
        }
        $qStatus = ($status == 'false') ? false : "AND psn.status = '$status' ";
        $qSurat = ($surat == 'false') ? false : "AND s.jenis = '$surat' ";
        $mulai .= ' 00.00.00.000';
        $akhir .= ' 23:59:59.999';
        $qTanggal = "AND psn.updated_at BETWEEN '$mulai' AND '$akhir' ";
        $tambahan = "";
        if($qStatus != false)
        {
            $tambahan .= $qStatus;
        }
        if($qSurat != false)
        {
            $tambahan .= $qSurat;
        }        
        $tambahan .= $qTanggal;        
        $query = $this->db->query("SELECT psn.id, s.jenis, s.judul, p.nama, psn.no_hp, psn.status, psn.updated_at FROM surat AS s, penerima AS p, pesan AS psn WHERE s.id = psn.surat_id AND p.id = psn.penerima_id $tambahan ORDER BY psn.updated_at DESC");
        // return $this->db->last_query();
        return $query->result();
        
    }
}

 ?>