<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasbuprekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        log_in();

        $this->db_lppi = $this->load->database('db_lppi', TRUE);
        $this->load->model('Model_menu');
        $this->load->model('Model_user');
    }

    public function index()
    {
        $st_user = $this->session->userdata('status_user');
        $id_unit = $this->session->userdata('id_unit');

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->model('Model_naspub');
        $data['kriteria'] = $this->Model_naspub->getkriteria();
        $data['naskah'] = $this->Model_naspub->getnaskahpublikasi_prodi($id_unit);

        $data['title'] = 'Input Data';
        $data['page'] = 'Naskah Publikasi';

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('naspu/rekap', $data);
        $this->load->view('template/footer', $data);
    }
}
