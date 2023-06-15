<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_unit extends CI_Model {

    function get_unit(){

    	$this->db->select('*');
        $this->db->from('ref_unit_kerja');
        $this->db->where('hapus',1);
        return $this->db->get()->result();

    }

    
}
?>