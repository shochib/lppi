<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{

    function getuser()
    {

        // $query = $this->db->query("SELECT * FROM tabel_menu WHERE hapus=0 ");
        $this->db->select('*');
        $this->db->from('m_user');
        $this->db->where('hapus', 0);
        return $this->db->get()->result();
    }

    function getdetail_user($id_user)
    {

        $this->db->select('*');
        $this->db->from('m_user');
        $this->db->where('id', $id_user);
        return $this->db->get();
    }

    function input_user($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function update_user($data, $table, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    function hapus_user($id)
    {
        $this->db->set('hapus', 1);
        $this->db->where('id', $id);
        $this->db->update('m_user');
        return $this->db->affected_rows();
    }
}
