<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller {
#----------------------------
#   constructor function                            
#---------------------------- 

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $session_id = $this->session->userdata('session_id');
        if ($session_id == NULL) {
            redirect('authentication/keluar');
        }
        $user_type = $this->session->userdata('user_type');
        if ($user_type !=1 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
        $this->load->model('admin/User_model');
    }

    public function index() {
        $data['title'] = 'Daftar User';
        $data['user_role'] = $this->Crud_m->all_data('user_type', '*','id != 3');
       
        $data['content'] = 'admin/user/index';
        $this->load->view('admin/template/main', $data);
    }

    public function save() {
        extract($_POST);
        $photo = $_FILES['photo']['name'];
        $check_status = $this->Global_m->isExists('email', $email, 'user_info');
        if ($check_status) {
            $message = array(false, 'Proses Gagal !', 'User telah terdaftar !');
        } else {
            if ($name == '' || $email == '' || $password == '' || $pen_name == '') {
                $message = array(false, 'Proses Gagal!', 'Informasi tidak boleh kosong !');
            } else {
                $key = md5(microtime() . rand());
               
                    $data = array(
                        'nama_lengkap' => $nama,
                        'email' => $email,
                        'nama_panggilan' => $nama_panggilan,
                        'password' => md5($password),
                        'no_hp' => $mobile,
                        'user_type' => $type,
                        'status' => 0
                    );
                $add = $this->Crud_m->add('user_info', $data);
                if ($add) {
                    $message = array(true, 'Proses Berhasil!', 'Proses penambahan pengguna berhasil!');
                } else {
                    $message = array(false, 'Proses Gagal!', 'Proses penambahan pengguna gagal!');
                }
            }
        }
        echo json_encode($message);
    }

}
