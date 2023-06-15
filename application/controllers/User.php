<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        log_in();

        $this->db_lppi = $this->load->database('db_lppi', TRUE);
        $this->load->model('Model_menu');
        $this->load->model('Model_user');
        $this->load->helper(array('url'));
    }
    function test($id)
    {

        // print_r('test');
    }

    public function index()
    {
        //print_r($this->uri->segment(3));
        //die;
        // die;
        $st_user = $this->session->userdata('status_user');
        $id_user = $this->session->userdata('id_user');
        $thn_sekarang = date("Y");

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['title'] = 'Home';
        $data['page'] = 'Cek halaman home';

        $this->load->model('Model_form');
        $data['penelitian'] = $this->Model_form->getpenelitian_user($id_user, $thn_sekarang);
        $jumlah_data = $this->Model_form->JumlahDataPenelitian_user($id_user, $thn_sekarang);
        $data['nama_publikasi'] = $this->Model_form->getpublikasi();

        //pagin
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'User/index';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 5;
        $from = $this->uri->segment(3);

        $config['full_tag_open'] = '<ul class="pagination  pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '<button>&laquo;</button>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '<button>&raquo;</button>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item"><button>';
        $config['cur_tag_close'] = '</button></li>';
        $config['num_tag_open'] = '<li class="page-item"><button>';
        $config['num_tag_close'] = '</button></li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = '<i class="fa fa-chevron-left"></i> <i class="fa fa-chevron-left"></i>';
        $config['last_link'] = '<i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>';

        $this->pagination->initialize($config);

        $data['penelitian2'] = $this->Model_form->dataPenelitian_user($config['per_page'], $from, $id_user, $thn_sekarang);

        //rekap
        $jumlah_jurnal = $this->Model_form->jurnal_user($id_user, 1, $thn_sekarang);
        $data['jml_jurnal'] = $jumlah_jurnal->jumlah;

        $jumlah_buku = $this->Model_form->jurnal_user($id_user, 2, $thn_sekarang);
        $data['jml_buku'] = $jumlah_buku->jumlah;

        $jumlah_sitasi = $this->Model_form->jurnal_user($id_user, 3, $thn_sekarang);
        $data['jml_sitasi'] = $jumlah_sitasi->jumlah;

        $jumlah_prosiding = $this->Model_form->jurnal_user($id_user, 6, $thn_sekarang);
        $data['jml_prosiding'] = $jumlah_prosiding->jumlah;

        $jumlah_bookchapter = $this->Model_form->jurnal_user($id_user, 7, $thn_sekarang);
        $data['jml_bookchapter'] = $jumlah_bookchapter->jumlah;

        $jumlah_q = $this->Model_form->jurnal_user_st($id_user, 0, $thn_sekarang, "15,16");
        $data['jml_penseminar'] = $jumlah_q->jumlah;

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer', $data);
    }
}
