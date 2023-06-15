<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_naspub extends CI_Model
{
    function getkriteria()
    {

        // $query = $this->db->query("SELECT * FROM tabel_menu WHERE hapus=0 ");
        $this->db->select('*');
        $this->db->from('tbl_kriteria_publikasi');
        $this->db->where('hapus', 0);
        return $this->db->get()->result();
    }

    function simpan_naskah($data)
    {
        $this->db->insert('tbl_tr_naskahpublikasi', $data);
        return true;
    }

    function update_naskah($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_tr_naskahpublikasi', $data);
        return $this->db->affected_rows();
    }

    function getnaskahpublikasi_prodi($id_unit)
    {

        // $query = $this->db->query("SELECT * FROM tabel_menu WHERE hapus=0 ");
        $array = array('hapus' => 0, 'id_prodi' => $id_unit);

        $this->db->select('*');
        $this->db->from('tbl_tr_naskahpublikasi');
        $this->db->where($array);
        return $this->db->get()->result();
    }
}
