<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		log_in();

		$this->db_lppi = $this->load->database('db_lppi', TRUE);
		$this->load->model('Model_menu');
		$this->load->model('Model_dashboard');
	}

	public function index()
	{
		$st_user = $this->session->userdata('status_user');
		$data['datamenu'] = $this->Model_menu->getmenu($st_user);

		$data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jurnal'] = $this->db_lppi->query('select count(*) as jumlah from db_penelitian where id_kategori = 1 and hapus=0 ')->row_array();
		$data['buku'] = $this->db_lppi->query('select count(*) as jumlah from db_penelitian where id_kategori = 2 and hapus=0 ')->row_array();
		$data['sitasi'] = $this->db_lppi->query('select count(*) as jumlah from db_penelitian where id_kategori = 3 and hapus=0 ')->row_array();
		$data['penyertaan'] = $this->db_lppi->query('select count(*) as jumlah from db_penelitian where st_publikasi in (15,16) and hapus=0 ')->row_array();
		$data['quin'] = $this->db_lppi->query('select count(*) as jumlah from db_penelitian where id_kategori = 1 and st_publikasi in (1,2,3,4) and hapus=0 ')->row_array();

		$data['datajurnal'] = $this->Model_dashboard->pengajuan();

		$data['title'] = 'Home';
		$data['page'] = 'Cek halaman home';

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('template/main', $data);
		$this->load->view('template/footer', $data);
	}
}
