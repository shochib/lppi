<?php

function log_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('Auth');
    } else {
        $id_user = $ci->session->userdata('id');
        $user_name = $ci->session->userdata('username');
        $status_user = $ci->session->userdata('status_user');

        //ambil menu akses
        $menu = $ci->uri->segment(1);

        $query = $ci->db->get_where('tabel_menu', ['link' => $menu])->row_array();
        $menu_status = $query['status_user'];

        if ($menu_status != $status_user) {
            redirect('Auth/blocked');
        }
    }
}
