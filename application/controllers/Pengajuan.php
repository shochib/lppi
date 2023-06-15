<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
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
        $id_user = $this->session->userdata('id_user');
        $thn_sekarang = date("Y");

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['title'] = 'Pengajuan';
        $data['page'] = 'Pengajuan Insenstif Publikasi';

        $this->load->model('Model_form');
        $data['penelitian'] = $this->Model_form->getpenelitian_user($id_user, $thn_sekarang);
        $jumlah_data = $this->Model_form->JumlahDataPenelitian_user($id_user, $thn_sekarang);
        $data['nama_publikasi'] = $this->Model_form->getpublikasi();

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('user/pengajuan', $data);
        $this->load->view('template/footer', $data);
    }

    public function add()
    {
        $st_user = $this->session->userdata('status_user');

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->model('Model_form');
        $data['publikasi'] = $this->Model_form->getpublikasi();
        $data['masterpublikasi'] =  $this->Model_form->getmasterpublikasi();

        $data['title'] = 'Pengajuan';
        $data['page'] = 'Pengajuan Insenstif Publikasi';

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('user/pilihan_tambah', $data);
        $this->load->view('template/footer', $data);
    }

    public function cekdata($id1, $id2)
    {
        $st_user = $this->session->userdata('status_user');
        $id_user = $this->session->userdata('id_user');

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();
        $data['id_user'] = $id_user;

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->model('Model_form');
        $data['publikasi'] = $this->Model_form->getpublikasi();
        $data['masterpublikasi'] =  $this->Model_form->getmasterpublikasi();

        $id_jenis = $this->uri->segment(3, 0);
        $id_publis = $this->uri->segment(4, 0);

        if ($id_jenis == 3) {
            //echo "123";
            $tgl_sekarang = date("Y-m-d");
            $thn_sekarang = date("Y");
            //$data['periode'] = $this->Model_form->getperiode($tgl_sekarang);
            //echo $this->Model_form->getperiode($tgl_sekarang);
            $arr = $this->Model_form->getperiode($tgl_sekarang);
            $periode = $arr[0]->periode;
            $tgl_awal = $arr[0]->tgl_awal;
            $tgl_akhir = $arr[0]->tgl_akhir;

            $arr2 = $this->Model_form->ceksitasi($thn_sekarang, $tgl_awal, $tgl_akhir, $id_user);
            //$id_pengajuan = $arr2[0]->id;
            if (count($arr2) > 0) {
                $id_pengajuan = $arr2[0]->id;
            } else {
                $data3['id_user'] = $id_user;
                $data3['tanggal'] = $tgl_sekarang;
                $id_pengajuan = $this->Model_form->simpan_pengaju($data3);
            }

            //ceking syarat sitasi [satu tahun] -> [satu periode]
            $data_tahun =  $this->Model_form->max_tahun($id2);
            $limit_tahun = $data_tahun->max_pertahun;

            $data_tahun_aju =  $this->Model_form->jumlah_pengajuan_tahun($id_user, $id_jenis, $thn_sekarang);
            $jml_aju = $data_tahun_aju->jumlah;

            if ($jml_aju <= $limit_tahun) {
                //lolos satu tahun
                $data_periode_aju =  $this->Model_form->jumlah_pengajuan_periode($id_user, $id2, $tgl_awal, $tgl_akhir);
                $jml_aju_periode = $data_periode_aju->jumlah;

                $data_periode =  $this->Model_form->max_periode($id2);
                $limit_periode = $data_periode->max_perperiode;

                if ($jml_aju_periode <= $limit_periode) {

                    $data['status'] = 1;
                    $data['ket'] = "Silahkan klik lanjut untuk mengisi data penelitian";

                    $data['id_user'] = $id_user;
                    $data['id_pengajuan'] = $id_pengajuan;
                    $data['id_jenis'] = $id_jenis;
                    $data['id_publis'] = $id_publis;
                } else {
                    $data['status'] = 0;
                    $data['ket'] = "Pengajuan Periode $periode tahun $tahun_sekarang sudah melebihi kuota";
                }
            } else {
                $data['status'] = 0;
                $data['ket'] = "Pengajuan tahun $tahun_sekarang sudah melebihi kuota";
            }
        } else {
            //ceking syarat non sitasi
            $tgl_sekarang = date("Y-m-d");
            $thn_sekarang = date("Y");
            //$data['periode'] = $this->Model_form->getperiode($tgl_sekarang);
            //echo $this->Model_form->getperiode($tgl_sekarang);
            $arr = $this->Model_form->getperiode($tgl_sekarang);
            $periode = $arr[0]->periode;
            $tgl_awal = $arr[0]->tgl_awal;
            $tgl_akhir = $arr[0]->tgl_akhir;

            /*
            $arr2 = $this->Model_form->ceksitasi($thn_sekarang, $tgl_awal, $tgl_akhir, $id_user);
            //$id_pengajuan = $arr2[0]->id;
            if (count($arr2) > 0) {
                $id_pengajuan = $arr2[0]->id;
            } else {
                $data3['id_user'] = $id_user;
                $data3['tanggal'] = $tgl_sekarang;
                $id_pengajuan = $this->Model_form->simpan_pengaju($data3);
            }
            */

            //insertt pengaju
            $data3['id_user'] = $id_user;
            $data3['tanggal'] = $tgl_sekarang;
            $id_pengajuan = $this->Model_form->simpan_pengaju($data3);

            $data_tahun =  $this->Model_form->max_tahun($id2);
            $limit_tahun = $data_tahun->max_pertahun;

            $data_tahun_aju =  $this->Model_form->jumlah_pengajuan_tahun_nonsi($id_user, $id2, $thn_sekarang);
            $jml_aju = $data_tahun_aju->jumlah;

            if ($jml_aju <= $limit_tahun) {
                //lolos satu tahun
                //cek satu periode
                $data_periode_aju =  $this->Model_form->jumlah_pengajuan_periode_nonsi($id_user, $id2, $tgl_awal, $tgl_akhir);
                $jml_aju_periode = $data_periode_aju->jumlah;

                $data_periode =  $this->Model_form->max_periode($id2);
                $limit_periode = $data_periode->max_perperiode;

                if ($jml_aju_periode <= $limit_periode) {

                    $data['status'] = 1;
                    $data['ket'] = "Silahkan klik lanjut untuk mengisi data penelitian";

                    $data['id_user'] = $id_user;
                    $data['id_pengajuan'] = $id_pengajuan;
                    $data['id_jenis'] = $id_jenis;
                    $data['id_publis'] = $id_publis;
                } else {
                    $data['status'] = 0;
                    $data['ket'] = "Pengajuan Periode $periode tahun $thn_sekarang sudah melebihi kuota";
                }
            } else {
                $data['status'] = 0;
                $data['ket'] = "Pengajuan tahun $thn_sekarang sudah melebihi kuota";
            }
        }

        $data['title'] = 'Pengajuan';
        $data['page'] = 'Pengajuan Insenstif Publikasi';

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('user/cek', $data);
        $this->load->view('template/footer', $data);
    }

    public function form($id1, $id2)
    {
        $st_user = $this->session->userdata('status_user');
        $id_user = $this->session->userdata('id_user');

        $id_jenis = $this->uri->segment(3, 0);
        $id_publis = $this->uri->segment(4, 0);
        $id_pengaju = $this->uri->segment(5, 0);

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();

        $this->load->model('Model_form');
        $data['field'] = $this->Model_form->getform($id1);
        $data['jurnal'] = $this->db->get_where('tbl_m_jenis_publikasi', ['id' => $id1])->row_array();
        $data['jurnal_detail'] = $this->db->get_where('tbl_m_publikasi', ['id' => $id2])->row_array();
        $data['sitasi'] = $this->Model_form->getsitasi();

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->model('Model_form');
        $data['publikasi'] = $this->Model_form->getpublikasi();
        $data['masterpublikasi'] =  $this->Model_form->getmasterpublikasi();
        $data['penelitian'] =  $this->Model_form->getpenelitian($id_pengaju, $id1);
        $data['publikasi_user'] =  $this->Model_form->getpublikasi_user($id_user, $id_pengaju);
        $data['publikasi_colum'] =  $this->Model_form->getpublikasi_colum();

        $data['title'] = 'Pengajuan';
        $data['page'] = 'Pengajuan Insenstif Publikasi';

        $this->load->view('template/header', $data);
        $this->load->view('template/menu', $data);
        $this->load->view('user/form', $data);
        $this->load->view('template/footer', $data);
    }

    public function simpan()
    {
        $st_user = $this->session->userdata('status_user');
        $id_user = $this->session->userdata('id_user');

        $data['datamenu'] = $this->Model_menu->getmenu($st_user);
        $data['user'] = $this->Model_user->getuser();

        $id_jenis = $this->input->post('id_jenis');
        $id_publis = $this->input->post('id_publis');
        $id_pengaju = $this->input->post('id_pengaju');
        $sub_form_input = $this->input->post('sub_form_input');

        $this->load->model('Model_form');

        $data['field'] = $this->Model_form->getform($id_jenis);
        $data['jurnal'] = $this->db->get_where('tbl_m_jenis_publikasi', ['id' => $id_jenis])->row_array();
        $data['jurnal_detail'] = $this->db->get_where('tbl_m_publikasi', ['id' => $id_publis])->row_array();

        $data['user_in'] = $this->db->get_where('m_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['publikasi'] = $this->Model_form->getpublikasi();
        $data['masterpublikasi'] =  $this->Model_form->getmasterpublikasi();

        $data['title'] = 'Pengajuan';
        $data['page'] = 'Pengajuan Insenstif Publikasi';

        $this->load->library('form_validation');
        $data_form = $this->Model_form->getform($id_jenis);
        foreach ($data_form as $key => $obj) {

            $id_field = $obj->id_field;
            $nama_input = $obj->nama_field;
            $sub_form = $obj->sub_form;

            //echo "<br>";

            if ($sub_form_input == 3) {
                if ($id_field != 5 and $sub_form > 0) {
                    //isian sitasi dan tidak ada file dokumen
                    echo $nama_input;
                    $this->form_validation->set_rules($nama_input, $nama_input, 'required');
                } elseif ($id_field == 5 and $sub_form > 0) {
                    //isian sitasi dan ada file dokumen
                    $this->form_validation->set_rules($nama_input, $nama_input, 'trim');
                }
            } else {
                if ($id_field != 5 and $sub_form == 0) {
                    //isian biasa bukan sitasi dan tidak ada file dokumen
                    //echo $nama_input;
                    $this->form_validation->set_rules($nama_input, $nama_input, 'required');
                } elseif ($id_field == 5 and $sub_form == 0) {
                    //isian biasa bukan sitasi dan ada file dokumen
                    $this->form_validation->set_rules($nama_input, $nama_input, 'trim');
                }
            }


            //echo "<br>";
        }

        if ($this->form_validation->run() == FALSE) {
            //echo "out";
            echo "<script>alert('Semua field harus diisi');";
            echo "window.location='" . base_url('Pengajuan/form') . "/" . $id_jenis . "/" . $id_publis . "'; </script> ";
        } else {
            //echo "in";
            $in_data = "";
            $in_img = array();

            foreach ($data_form as $key => $obj) {

                $id_field = $obj->id_field;
                $nama_input = $obj->nama_field;
                $sub_form = $obj->sub_form;

                $post_input = $this->input->post($nama_input);

                if ($sub_form_input == 3) {
                    if ($id_field != 5 and $sub_form >= 1) {
                        //isian sitasi dan tidak ada file dokumen
                        $data2[$nama_input] = $post_input;
                    } elseif ($id_field == 5 and $sub_form >= 1) {
                        //isian sitasi dan ada file dokumen
                        $config['upload_path']          = './dok/';
                        $config['allowed_types']        = 'pdf';

                        $new_name = time() . $_FILES[$nama_input]['name'];
                        $config['file_name'] = $new_name;

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload($nama_input)) {
                            $error = array('error' => $this->upload->display_errors());
                            echo "<script>alert('Dokumen pdf harus diupload');";
                            echo "window.location='" . base_url('Pengajuan/form') . "/" . $id_jenis . "/" . $id_publis . "'; </script> ";
                        } else {
                            $data = array('upload_data' => $this->upload->data());

                            $data2[$nama_input] = $new_name;
                        }
                    }
                } else {
                    if ($id_field == 5 and $sub_form == 0) {
                        //isian biasa bukan sitasi dan tidak ada file dokumen
                        $config['upload_path']          = './dok/';
                        $config['allowed_types']        = 'pdf';

                        $new_name = time() . $_FILES[$nama_input]['name'];
                        $config['file_name'] = $new_name;

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload($nama_input)) {
                            $error = array('error' => $this->upload->display_errors());
                            echo "<script>alert('Dokumen pdf harus diupload');";
                            echo "window.location='" . base_url('Pengajuan/form') . "/" . $id_jenis . "/" . $id_publis . "'; </script> ";
                        } else {
                            $data = array('upload_data' => $this->upload->data());

                            $data2[$nama_input] = $new_name;
                        }
                    } elseif ($id_field != 5 and $sub_form == 0) {
                        //isian biasa bukan sitasi dan ada file dokumen
                        $data2[$nama_input] = $post_input;
                    }
                }
            }

            //input db
            if ($id_pengaju > 0) {
                $response2 = $id_pengaju;
            } else {
                $data3['id_user'] = $id_user;
                $data3['tanggal'] = date('Y-m-d');
                $response2 = $this->Model_form->simpan_pengaju($data3);
            }

            if ($response2 > 0) {

                if ($sub_form_input == 3) {
                    $id_penelitian = $this->input->post('id_penelitian');
                    $data2['id_penelitian'] = $id_penelitian;
                    $response = $this->Model_form->simpan_sitasi($data2);
                } else {
                    $data2['id_pengaju'] = $response2;
                    $data2['id_kategori'] = $id_jenis;
                    $data2['st_publikasi'] = $id_publis;
                    $response = $this->Model_form->simpan_penelitan($data2);
                }

                if ($response == true) {
                    //echo "Records Saved Successfully";
                    echo "<script>alert('Success');";
                    echo "window.location='" . base_url('Pengajuan/form') . "/" . $id_jenis . "/" . $id_publis . "/" . $response2 .  "'; </script> ";
                } else {
                    //echo "Insert error !";
                    echo "<script>alert('Error');";
                    echo "window.location='" . base_url('Pengajuan/form') . "/" . $id_jenis . "/" . $id_publis . "/" . $response2 .  "'; </script> ";
                }
            }
        }
    }
}
