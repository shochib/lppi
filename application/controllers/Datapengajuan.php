<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapengajuan extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        log_in();

        $this->db_lppi = $this->load->database('db_lppi', TRUE);
        $this->load->model('Model_menu');
        $this->load->model('Model_dashboard');
        $this->load->model('Model_user');
    }

    public function index()
    {
        $st_user = $this->session->userdata('status_user');
        $id_user = $this->session->userdata('id_user');
        $thn_sekarang = date("Y");

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();
        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Pengajuan';
        $data['page'] = 'Pengajuan Insenstif Publikasi';

        $this->load->model('Model_form');
        $data['penelitian'] = $this->Model_form->getpenelitian_user(0, $thn_sekarang);
        $jumlah_data = $this->Model_form->JumlahDataPenelitian_user(0, $thn_sekarang);
        $data['nama_publikasi'] = $this->Model_form->getpublikasi();

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('datapengajuan/rekap_pengaju.php', $data);
        $this->load->view('template/footer', $data);
    }

    public function detail()
    {
        $st_user = $this->session->userdata('status_user');
        $id_user = $this->uri->segment(6, 0); //id_user dari data
        $thn_sekarang = date("Y");

        $id_jenis = $this->uri->segment(3, 0); //sitasi, jurnal, prosiding dll.
        $id_kategori = $this->uri->segment(4, 0); //nasional, inertansional dll.
        $id_pengaju = $this->uri->segment(5, 0);

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();
        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Pengajuan';
        $data['page'] = 'Detail Pengajuan ';

        $this->load->model('Model_form');
        $data['penelitian'] = $this->Model_form->getpenelitian_user($id_pengaju, $thn_sekarang);
        $jumlah_data = $this->Model_form->JumlahDataPenelitian_user($id_pengaju, $thn_sekarang);
        $data['publikasi_form'] =  $this->Model_form->getform($id_jenis);
        $data['publikasi_colum'] =  $this->Model_form->getpublikasi_colum();
        $data['publikasi_user'] =  $this->Model_form->getpublikasi_user($id_user, $id_pengaju);
        $data['publikasisitasi_user'] =  $this->Model_form->getpublikasisitasi_user($id_user, $id_pengaju);
        $data['pensitasi_user'] =  $this->Model_form->getsitasi_user($id_pengaju);

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('datapengajuan/detail_pengajuan.php', $data);
        $this->load->view('template/footer', $data);
    }
}
