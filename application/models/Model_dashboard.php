<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dashboard extends CI_Model
{
    function pengajuan()
    {
        $this->db_lppi->select('substr(db_pengaju.tanggal,1,4) as tahun, count(*) as jumlah');
        $this->db_lppi->from(' db_pengaju');
        $this->db_lppi->where('hapus', 0);
        $this->db_lppi->group_by('substr(db_pengaju.tanggal,1,4)');
        return $this->db_lppi->get()->result();
    }
}
