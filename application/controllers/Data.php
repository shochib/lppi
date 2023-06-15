<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		log_in();

		$this->load->model('Model_menu');
		$this->load->model('Model_user');
		$this->load->model('Model_unit');
	}

	public function index()
	{
		$st_user = $this->session->userdata('status_user');
		$data['datamenu'] = $this->Model_menu->getmenu($st_user);

		$data['user'] = $this->Model_user->getuser();

		$data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

		$data['title'] = 'Data';
		$data['page'] = 'Data User';

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('tabel/index', $data);
		$this->load->view('template/footer');
	}

	public function detail($id_user)
	{
		$st_user = $this->session->userdata('status_user');
		$data['datamenu'] = $this->Model_menu->getmenu($st_user);

		$data['user'] = $this->Model_user->getdetail_user($id_user);
		$data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

		$data['title'] = 'Detail';
		$data['page'] = 'Cek halaman Data';

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('tabel/detail', $data);
		$this->load->view('template/footer');
	}

	public function form()
	{
		$user = new stdClass();
		$user->username = null;
		$user->password1 = null;
		$user->password2 = null;
		$user->email = null;
		$user->unit = null;
		$user->id = null;

		$data = array(
			'page' => 'Simpan',
			'row' => $user
		);

		$st_user = $this->session->userdata('status_user');
		$data['datamenu'] = $this->Model_menu->getmenu($st_user);

		$data['dataunit'] = $this->Model_unit->get_unit();

		$data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->library('form_validation');

		$this->load->view('template/header', $data);
		$this->load->view('template/menu', $data);
		$this->load->view('tabel/form', $data);
		$this->load->view('template/footer');
	}

	public function edit($id)
	{
		$query = $this->Model_user->getdetail_user($id);
		if ($query->num_rows() > 0) {

			$user = $query->row();

			$data = array(
				'page' => 'Edit',
				'row' => $user
			);

			$st_user = $this->session->userdata('status_user');
			$data['datamenu'] = $this->Model_menu->getmenu($st_user);

			$data['dataunit'] = $this->Model_unit->get_unit();

			$data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

			$this->load->library('form_validation');

			$this->load->view('template/header', $data);
			$this->load->view('template/menu', $data);
			$this->load->view('tabel/form', $data);
			$this->load->view('template/footer');
		} else {
			echo "<script>alert('Data tidak ada');";
			echo "window.location='" . base_url('Data') . "'; </script> ";
		}
	}

	public function hapus($id)
	{
		$query = $this->Model_user->hapus_user($id);
		if ($query == true) {
			echo "<script>alert('Data telah dihapus');";
			echo "window.location='" . base_url('Data') . "'; </script> ";
		} else {
			echo "<script>alert('Error');";
			echo "window.location='" . base_url('Data') . "'; </script> ";
		}
	}

	public function add()
	{

		$st_user = $this->session->userdata('status_user');
		$data['datamenu'] = $this->Model_menu->getmenu($st_user);

		$data['dataunit'] = $this->Model_unit->get_unit();

		$data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('unit', 'unit', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('template/menu', $data);
			$this->load->view('tabel/form', $data);
			$this->load->view('template/footer');
		} else {
			$username = $this->input->post('username');
			$password1 = $this->input->post('password1');
			$password2 = $this->input->post('password2');
			$email = $this->input->post('email');
			$unit = $this->input->post('unit');
			$user_id = $this->input->post('user_id');
			$status = $this->input->post('status');

			if ($password1 == $password2) {

				$data = array(
					'username' => $username,
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'email' => $email,
					'unit' => $unit,
					'status_user' => $status
				);

				if (isset($_POST['Simpan'])) {

					$query = $this->Model_user->input_user($data, 'm_user');
					if ($query == true) {
						echo "<script>alert('Data telah disimpan');";
						echo "window.location='" . base_url('Data') . "'; </script> ";
					}
				} elseif (isset($_POST['Edit'])) {
					if (strlen($password1) > 0) {

						$pass = md5($password1);
						$data = array(
							'username' => $username,
							'password' => $pass,
							'email' => $email,
							'unit' => $unit
						);
					} else {
						$data = array(
							'username' => $username,
							'email' => $email,
							'unit' => $unit
						);
					}

					$query = $this->Model_user->update_user($data, 'm_user', $user_id);
					if ($query == true) {
						echo "<script>alert('Data telah diupdate');";
						echo "window.location='" . base_url('Data') . "'; </script> ";
					} else {
						echo "<script>alert('Tidak ada perubahan');";
						echo "window.location='" . base_url('Data') . "'; </script> ";
					}
				}
			} else {
				echo "<script>alert('Password tidak sama');";
				echo "window.location='" . base_url('Data') . "'; </script> ";
			}
		}
	}
}
