<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Naskahpublikasi extends CI_Controller
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
        $this->load->view('naspu/input_data', $data);
        $this->load->view('template/footer', $data);
    }

    public function simpan()
    {
        $st_user = $this->session->userdata('status_user');
        $id_user = $this->session->userdata('id_user');
        $id_unit = $this->session->userdata('id_unit');

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->model('Model_naspub');
        $data['kriteria'] = $this->Model_naspub->getkriteria();

        $data['title'] = 'Input Data';
        $data['page'] = 'Naskah Publikasi';

        $this->load->library('form_validation');

        //proses
        $judul = $this->input->post('judul');
        $mhs = $this->input->post('nama');
        $dosen1 = $this->input->post('nama_pembimbing1');
        $dosen2 = $this->input->post('nama_pembimbing2');
        $kriteria = $this->input->post('kriteria');
        $nama_jurnal = $this->input->post('nama_jurnal');
        $url = $this->input->post('url');
        $publikasi = $this->input->post('publikasi');
        $id = $this->input->post('id');

        $this->form_validation->set_rules('judul', 'judul', 'required');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('nama_pembimbing1', 'nama_pembimbing1', 'required');
        $this->form_validation->set_rules('nama_pembimbing2', 'nama_pembimbing2', 'required');
        $this->form_validation->set_rules('kriteria', 'kriteria', 'required|min_length[1]');


        if ($this->form_validation->run() == FALSE) {
            echo "<script>alert('Semua field harus diisi');";
            echo "window.location='" . base_url('Naskahpublikasi') . "'; </script> ";
        } else {

            $ndate = date("Y-m-d H:i:s");

            $data_in = array(
                'judul' => $judul,
                'nama_mahasiswa' => $mhs,
                'nama_dosen1' => $dosen1,
                'nama_dosen2' => $dosen2,
                'kriteria_publikasi' => $kriteria,
                'tgl_update' => $ndate,
                'user' => "$id_user,",
                'nama_jurnal' => $nama_jurnal,
                'url' => $url,
                'publikasi' => $publikasi
            );

            if ($id < 1) {
                $response = $this->Model_naspub->simpan_naskah($data_in);
            } elseif ($id > 0) {
                $response = $this->Model_naspub->update_naskah($data_in, $id);
            }

            if ($response == true) {
                //echo "Records Saved Successfully";
                echo "<script>";
                echo "window.location='" . base_url('Naskahpublikasi') .  "'; </script> ";
            } else {
                //echo "Insert error !";
                echo "<script>alert('Error');";
                echo "window.location='" . base_url('Naskahpublikasi') . "'; </script> ";
            }
        }
    }
}
