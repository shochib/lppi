<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        log_in();

        $this->load->model('Model_menu');
        $this->load->model('Model_form');
    }

    public function index()
    {
        $st_user = $this->session->userdata('status_user');
        $data['datamenu'] = $this->Model_menu->getmenu($st_user);

        $data['data_publikasi'] = $this->Model_form->getpublikasi();
        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();


        $data['title'] = 'Form';
        $data['page'] = 'Form Isian Publikasi';

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('form/index', $data);
        $this->load->view('template/footer');
    }

    public function view($id)
    {
        $st_user = $this->session->userdata('status_user');
        $data['datamenu'] = $this->Model_menu->getmenu($st_user);

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['field'] = $this->Model_form->getform($id);
        $data['jurnal'] = $this->db->get_where('tbl_m_jenis_publikasi', ['id' => $id])->row_array();

        $data['title'] = 'Detail';
        $data['page'] = 'Cek halaman Data';

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('form/view', $data);
        $this->load->view('template/footer');
    }

    public function detail($id)
    {
        $st_user = $this->session->userdata('status_user');
        $data['datamenu'] = $this->Model_menu->getmenu($st_user);

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['field'] = $this->Model_form->getform($id);
        $data['jurnal'] = $this->db->get_where('tbl_m_jenis_publikasi', ['id' => $id])->row_array();

        $data['title'] = 'Detail';
        $data['page'] = 'Cek halaman Data';

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('form/detail', $data);
        $this->load->view('template/footer');
    }

    public function add()
    {
        $st_user = $this->session->userdata('status_user');
        $data['datamenu'] = $this->Model_menu->getmenu($st_user);

        $data['data_publikasi'] = $this->Model_form->getpublikasi();
        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['title'] = 'Detail';
        $data['page'] = 'Cek halaman Data';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('judul', 'judul', 'required');
        $this->form_validation->set_rules('nama_input', 'nama_input', 'trim|required');
        $this->form_validation->set_rules('jenis_input', 'jenis_input', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/menu', $data);
            $this->load->view('form/index', $data);
            $this->load->view('template/footer');
        } else {
            $judul = $this->input->post('judul');
            $nama_input = $this->input->post('nama_input');
            $jenis_input = $this->input->post('jenis_input');
            $pilih_data = $this->input->post('pilih_data');
            $id_jenis = $this->input->post('id_jenis');

            $data = array(
                'nama_judul' => $judul,
                'id_publikasi' => $id_jenis,
                'id_field' => $jenis_input,
                'nama_field' => $nama_input,
                'reff_pilihdata' => $pilih_data,
                'hapus' => 0
            );

            if (isset($_POST['simpan'])) {

                $query = $this->Model_form->input_field($data, 'tbl_reff_form');
                if ($query == true) {
                    echo "<script>alert('Data telah disimpan');";
                    echo "window.location='" . base_url('Form/detail') . "/" . $id_jenis . "'; </script> ";
                }
            }
        }
    }
}
