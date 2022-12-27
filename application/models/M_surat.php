<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
class M_surat extends CI_Model
{
    private $table = "surat";
    public $id;
    public $no_urut;
    public $no_surat;
    public $kode;
    public $judul;
    public $jenis;
    public $nama_penerima;    
    public $tanggal;
    public $link;
    public $diinput;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [
                'field' => 'jenis',
                'label' => 'jenis',
                'rules' => 'required',
            ],
            [
                'field' => 'judul',
                'label' => 'judul',
                'rules' => 'required',
            ],
            [
                'field' => 'no_urut',
                'label' => 'no_urut',
                'rules' => 'required',
            ],
            [
                'field' => 'kode',
                'label' => 'kode',
                'rules' => 'required',
            ],
            [
                'field' => 'tanggal',
                'label' => 'tanggal',
                'rules' => 'required',
            ],
            [
                'field' => 'no_surat',
                'label' => 'no_surat',
                'rules' => 'required',
            ],
            [
                'field' => 'link',
                'label' => 'link',
                'rules' => 'required',
            ],
            [
                'field' => 'nama_penerimas[]',
                'label' => 'nama_penerimas',
                'rules' => 'required',
            ],
            [
                'field' => 'penerimas[]',
                'label' => 'nama_penerimas',
                'rules' => 'required',
            ],
        ];
    }

    public function getAll()
	{
		$this->db->from($this->table);
        $this->db->order_by("tanggal", "DESC");
		return $this->db->get()->result();		
	}

    public function getById($id)
    {
        return $this->db->get_where($this->table,["id" => $id])->row();
    }

    public function tambah()
    {
        $post = $this->input->post();
        $this->no_urut = $post['no_urut'];
        $this->no_surat = $post['no_surat'];
        $this->kode = $post['kode'];
        $this->judul = $post['judul'];
        $this->jenis = $post['jenis'];
        // $this->nama_penerima = $post['nama_penerimas'];
        $tmp_nama_penerimas = "<ol>";
        foreach($post['nama_penerimas'] as $item)
        {
            $tmp_nama_penerimas .= "<li>".$item."</li>";
        }
        $tmp_nama_penerimas .= "</ol>";
        $this->nama_penerima = $tmp_nama_penerimas;
        $penerimas = $post['penerimas'];
        $this->tanggal = $post['tanggal'];
        $this->link = $post['link'];
        $this->diinput = $this->session->userdata('nama');
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = $this->created_at;
        $this->db->insert($this->table, $this);
        $inserted_id = $this->db->insert_id();
        $affected = 0;
        foreach($penerimas as $item)
        {
            $affected = $this->pesanTambah($inserted_id,$item,$this->jenis,$this->judul,$this->link);
        }
        return $affected;
    }

    public function ubah($id)
    {
        $post = $this->input->post();        
        $no_urut = $post['no_urut'];
        $cek_sudah_ada = $this->sudah_ada($post['no_surat'],$id);
        if($cek_sudah_ada)
        {
            return "sudah ada";
        }
        $no_surat = $post['no_surat'];
        $kode = $post['kode'];
        $judul = $post['judul'];
        $jenis = $post['jenis'];
        $tmp_nama_penerimas = "<ol>";
        foreach($post['nama_penerimas'] as $item)
        {
            $tmp_nama_penerimas .= "<li>".$item."</li>";
        }
        $tmp_nama_penerimas .= "</ol>";
        $nama_penerima = $tmp_nama_penerimas;
        $penerimas = $post['penerimas'];
        $tanggal = $post['tanggal'];
        $link = $post['link'];
        $diinput = $this->session->userdata('nama');
        $updated_at = date('Y-m-d H:i:s');
        $data = array(
            'no_urut' => $no_urut,
            'no_surat' => $no_surat,
            'kode' => $kode,
            'judul' => $judul,
            'nama_penerima' => $nama_penerima,
            'tanggal' => $tanggal,
            'link' => $link,
            'diinput' => $diinput,
            'updated_at' => $updated_at,
        );
        $affected = $this->db->update($this->table,$data,["id" => $id]);
        $kirim_ulang = $post['kirim_ulang'];        
        if($kirim_ulang == "ya")
        {
            $this->pesanHapus($id);
            foreach($penerimas as $item)
            {
                $affected = $this->pesanTambah($id,$item,$jenis,$judul,$link);
            }            
        }        
        return $affected;
    }

    public function sudah_ada($no_surat,$id = null)
    {
        if($id != null)
        {
            $query = $this->db->query("SELECT no_surat from $this->table WHERE no_surat LIKE '$no_surat' AND id = $id");
            if($query->num_rows()>0) // berarti no surat sama dengan yang diinput
            {
                return false;
            }
            else // cek no surat lain siapa tau ada yang sama
            {
                $query1 = $this->db->query("SELECT no_surat FROM $this->table WHERE no_surat LIKE '$no_surat' AND id != $id ");
                // kalo ada yang sama berarti namanya sudah terpakai return true
                return ($query1->num_rows()>0) ? true:false;
            }
        }
        else
        {
            $query = $this->db->query("SELECT no_surat FROM $this->table WHERE no_surat LIKE '$no_surat' ");
            return ($query->num_rows()>0) ? true : false;
        }
    }

    public function hapus($id)
    {
        $this->db->delete($this->table, ["id" => $id]);
        $affected = $this->db->affected_rows();
        if($affected > 0)
        {
            $this->pesanHapus($id);
        }
        return $affected;
    }

    public function pesanTambah($suratId, $penerimaId, $jenis, $judul, $link)
    {
        $query = $this->db->query("SELECT no_hp FROM penerima WHERE id=$penerimaId")->row();
        $no_hp = $this->_nomor_hp_indo($query->no_hp);
        $surat = ($jenis=="Surat Lainnya") ? "Surat" : $jenis;
        $pesan = "Anda mendapatkan ".$surat."%0a".$judul."%0a"."Untuk melihat isi surat silahkan buka melalui tautan berikut:%0a".$link;
        $data = array(
            'penerima_id' => $penerimaId,
            'surat_id' => $suratId,
            'pesan' => $pesan,
            'no_hp' => $no_hp,
            'status' => "pending",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('pesan',$data);
        return $this->db->affected_rows();
    }

    public function pesanHapus($suratId)
    {
        return $this->db->delete("pesan", ["surat_id" => $suratId]);
    }

    function _nomor_hp_indo($nomor_hp)
    {
        $nomor_hp = str_replace(["-","+"],"",$nomor_hp);
        $ptn = "/^0/";
        $rpltxt = "62";
        return preg_replace($ptn, $rpltxt, $nomor_hp);
    }

    public function filter($kode,$surat,$mulai,$akhir)
    {
        $qKode = ($kode == 'false') ? false : "kode = '$kode' ";
        if($surat != 'false')
        {
            $surat = str_replace('%20', ' ', $surat);
        }
        $qSurat = ($surat == 'false') ? false : "AND jenis = '$surat' ";
        // $mulai .= ' 00.00.00.000';
        // $akhir .= ' 23:59:59.999';
        $qTanggal = "AND tanggal BETWEEN '$mulai' AND '$akhir' ";
        $tambahan = "";
        if($qKode != false)
        {
            $tambahan .= $qKode;
        }
        if($qSurat != false)
        {
            $tambahan .= $qSurat;
        }
        if(!$qKode && !$qSurat)
        {
            $tambahan .= "tanggal BETWEEN '$mulai' AND '$akhir'";
        }
        else
        {
            $tambahan .= $qTanggal;
        }
        $query = $this->db->query("SELECT * FROM surat WHERE $tambahan");
        return $query->result();
    }

}

?>