<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_menu extends CI_Model
{

    function getmenu($st_user)
    {

        // $query = $this->db->query("SELECT * FROM tabel_menu WHERE hapus=0 ");
        $this->db->select('*');
        $this->db->from('tabel_menu');
        $this->db->where('status_user', $st_user);
        $this->db->order_by('urutan', 'asc');
        return $this->db->get()->result();
    }
}
