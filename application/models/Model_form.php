<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_form extends CI_Model
{
    function getpublikasi()
    {

        // $query = $this->db->query("SELECT * FROM tabel_menu WHERE hapus=0 ");
        $this->db->select('*');
        $this->db->from('tbl_m_jenis_publikasi');
        $this->db->where('hapus', 0);
        return $this->db->get()->result();
    }

    function getmasterpublikasi()
    {

        // $query = $this->db->query("SELECT * FROM tabel_menu WHERE hapus=0 ");
        $this->db->select('*');
        $this->db->from('tbl_m_publikasi');
        $this->db->where('hapus', 0);
        return $this->db->get()->result();
    }

    function getform($id)
    {

        // $query = $this->db->query("SELECT * FROM tabel_menu WHERE hapus=0 ");
        $array = array('hapus' => 0, 'id_publikasi' => $id);

        $this->db->select('*');
        $this->db->from('tbl_reff_form');
        $this->db->where($array);
        return $this->db->get()->result();
    }

    function getpenelitian($id_pengaju, $id_kategori)
    {

        // $query = $this->db->query("SELECT * FROM tabel_menu WHERE hapus=0 ");

        $array = array('hapus' => 0, 'id_kategori' => $id_kategori, 'id_pengaju' => $id_pengaju);

        $this->db->select('*');
        $this->db->from('db_penelitian');
        $this->db->where($array);

        return $this->db->get()->result();
    }

    function getpenelitian_user($id_user, $tahun)
    {
        if ($id_user > 0) {
            $cl = " a.id_user = $id_user and";
        } else {
            $cl = "";
        }

        $query = $this->db->query("SELECT a.id, a.tanggal as tanggal_pengaju,a.level_verifikasi,a.id_user,a.kode,b.* FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE $cl a.tanggal like '$tahun-%' and a.hapus=0 group by b.id_pengaju ");
        return $query->result();
    }

    function dataPenelitian_user($number, $offset, $id_user, $tahun)
    {
        if (strlen($offset) > 0) {
            $nd = ", $offset";
        } else {
            $nd = "";
        }

        $query = $this->db->query("SELECT a.id, a.tanggal as tanggal_pengaju,a.level_verifikasi,a.id_user,a.kode,b.* FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE a.id_user = $id_user and a.tanggal like '$tahun-%' and a.hapus=0 group by b.id_pengaju LIMIT $number $nd ");

        return $query->result();
    }

    function JumlahDataPenelitian_user($id_user, $tahun)
    {
        if ($id_user > 0) {
            $cl = " a.id_user = $id_user and";
        } else {
            $cl = "";
        }

        $query = $this->db->query("SELECT a.id, a.tanggal as tanggal_pengaju,a.level_verifikasi,a.id_user,a.kode,b.* FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE $cl a.tanggal like '$tahun-%' and a.hapus=0 group by b.id_pengaju ");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    function getpublikasi_user($id_user, $id_penelitian)
    {
        $query = $this->db->query("SELECT b.* FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE a.id_user = $id_user and b.id = $id_penelitian and a.hapus=0 ");
        return $query->result();
    }

    function getpublikasisitasi_user($id_user, $id_penelitian)
    {
        $query = $this->db->query("SELECT b.* FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE a.id_user = $id_user and b.id_pengaju = $id_penelitian and a.hapus=0 ");
        return $query->result();
    }

    function getpublikasi_colum()
    {
        $query = $this->db->query("SHOW COLUMNS FROM db_penelitian   ");
        return $query->result();
    }

    function getsitasi()
    {
        $array = array('hapus' => 0);

        $this->db->select('*');
        $this->db->from('db_jurnal_pensitasi');
        $this->db->where($array);
        return $this->db->get()->result();
    }

    function getsitasi_user($id_pengaju)
    {
        $query = $this->db->query("SELECT b.* FROM db_penelitian a
        INNER JOIN db_jurnal_pensitasi b ON a.id = b.id_penelitian
        WHERE a.id_pengaju = $id_pengaju and a.hapus = 0 and b.hapus = 0");
        return $query->result();
    }

    function getperiode($tanggal)
    {
        $tahun_now = date("Y");
        $pch2 = explode("-", $tanggal);
        $tg = $pch2[2];
        $bln = $pch2[1];
        $tgl_hariini = "$tahun_now-$bln-$tg";
        $tg_in = "$bln-$tg";


        $query = $this->db->query("SELECT * FROM db_batas_upload WHERE  \"$tg_in\" >= SUBSTR(tgl_awal,6,5) and \"$tg_in\" <= SUBSTR(tgl_akhir,6,5) ");
        return $query->result();
    }

    function ceksitasi($tahun, $tgl_awal, $tgl_akhir, $id_user)
    {
        $t1 = SUBSTR($tgl_awal, 5, 5);
        $t2 = SUBSTR($tgl_akhir, 5, 5);

        $tg1 = "$tahun-$t1";
        $tg2 = "$tahun-$t2";

        $query = $this->db->query("SELECT * FROM db_pengaju WHERE  id_user = $id_user and tanggal >= \"$tg1\" and tanggal <= \"$tg2\" and hapus=0 ");
        return $query->result();
    }

    function max_tahun($id_kategori)
    {

        $query = $this->db->query("SELECT * FROM db_limit_publikasi WHERE  reff_kategori_publikasi=\"$id_kategori\" and hapus=0 ");
        return $query->row();
    }

    function jumlah_pengajuan_tahun($id_user, $id_kategori, $tahun)
    {

        $query = $this->db->query("SELECT count(*) as jumlah FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        INNER JOIN db_jurnal_pensitasi c ON b.id = c.id_penelitian  
        WHERE a.id_user = $id_user and b.id_kategori = $id_kategori and a.tanggal like '$tahun-%' ");
        return $query->row();
    }

    function jumlah_pengajuan_tahun_nonsi($id_user, $id_kategori, $tahun)
    {

        $query = $this->db->query("SELECT count(*) as jumlah FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE a.id_user = $id_user and b.id_kategori = $id_kategori and a.tanggal like '$tahun-%' ");
        return $query->row();
    }

    function max_periode($id_kategori)
    {

        $query = $this->db->query("SELECT * FROM db_limit_publikasi WHERE  reff_kategori_publikasi=\"$id_kategori\" and hapus=0 ");
        return $query->row();
    }

    function jumlah_pengajuan_periode($id_user, $id_kategori, $tgl_awal, $tgl_akhir)
    {
        $tahun = date("Y");
        $t1 = SUBSTR($tgl_awal, 5, 5);
        $t2 = SUBSTR($tgl_akhir, 5, 5);

        $tg1 = "$tahun-$t1";
        $tg2 = "$tahun-$t2";

        $query = $this->db->query("SELECT count(*) as jumlah FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        INNER JOIN db_jurnal_pensitasi c ON b.id = c.id_penelitian  
        WHERE a.id_user = $id_user and b.id_kategori = $id_kategori and a.tanggal >= \"$tg1\" and a.tanggal <= \"$tg2\" ");
        return $query->row();
    }

    function jumlah_pengajuan_periode_nonsi($id_user, $id_kategori, $tgl_awal, $tgl_akhir)
    {
        $tahun = date("Y");
        $t1 = SUBSTR($tgl_awal, 5, 5);
        $t2 = SUBSTR($tgl_akhir, 5, 5);

        $tg1 = "$tahun-$t1";
        $tg2 = "$tahun-$t2";

        $query = $this->db->query("SELECT count(*) as jumlah FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE a.id_user = $id_user and b.id_kategori = $id_kategori and a.tanggal >= \"$tg1\" and a.tanggal <= \"$tg2\" ");
        return $query->row();
    }

    function get_publikasi()
    {
        $query = $this->db->query("SELECT * FROM tbl_m_publikasi WHERE hapus=0 ");
        return $query->result();
    }

    function input_field($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function simpan_penelitan($data)
    {
        $this->db->insert('db_penelitian', $data);
        return true;
    }

    function simpan_pengaju($data)
    {
        $this->db->insert('db_pengaju', $data);
        return $this->db->insert_id();
    }

    function simpan_sitasi($data)
    {
        $this->db->insert('db_jurnal_pensitasi', $data);
        return true;
    }

    //rekap pengajuan user
    function jurnal_user($id_user, $id_kategori, $tahun)
    {
        $query = $this->db->query("SELECT count(*) as jumlah FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE a.id_user = $id_user and b.id_kategori = $id_kategori and a.tanggal like '$tahun-%' and a.hapus=0 and b.hapus=0 ");

        return $query->row();
    }

    function jurnal_user_st($id_user, $id_kategori, $tahun, $st_piblikasi)
    {
        if ($id_kategori == 0) {
            $cl = "";
        } else {
            $cl = "and b.id_kategori = $id_kategori";
        }
        $query = $this->db->query("SELECT count(*) as jumlah FROM db_pengaju a 
        INNER JOIN db_penelitian b ON a.id = b.id_pengaju
        WHERE a.id_user = $id_user $cl and st_publikasi in ($st_piblikasi) and a.tanggal like '$tahun-%' and a.hapus=0 and b.hapus=0 ");

        return $query->row();
    }
}
