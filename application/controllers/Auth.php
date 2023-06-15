<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_menu');
        $this->load->model('Model_user');
        $this->load->model('Model_unit');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('m_user', ['username' => $username])->row_array();
        if ($user) {
            //user ada
            if ($user['hapus'] == 0) {
                //user ada
                if (password_verify($password, $user['password'])) {
                    //password sesuai

                    $data = [
                        'id_user' => $user['id'],
                        'username' => $user['username'],
                        'status_user' => $user['status_user'],
                        'id_unit' => $user['unit']
                    ];

                    if ($user['status_user'] == 1) {
                        $this->session->set_userdata($data);
                        redirect('Home');
                    } elseif ($user['status_user'] == 10) {
                        $this->session->set_userdata($data);
                        redirect('User');
                    } elseif ($user['status_user'] == 3) {
                        $this->session->set_userdata($data);
                        redirect('Naskahpublikasi');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username terhapus</div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak ada</div>');
            redirect('Auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('status_user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Telah logout</div>');
        redirect('Auth');
    }

    public function blocked()
    {
        $st_user = $this->session->userdata('status_user');
        $data['datamenu'] = $this->Model_menu->getmenu($st_user);

        $data['user'] = $this->Model_user->getuser();
        $data['user_in'] = array("username" => "User");

        $data['title'] = 'Data';
        $data['page'] = 'Cek halaman Data';

        $this->load->view('template/header');
        $this->load->view('template/menu', $data);
        $this->load->view('template/block');
        $this->load->view('template/footer');
    }
}
