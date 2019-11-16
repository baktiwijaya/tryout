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
        $data['menu'] = 'Manage User';
        $data['smenu'] = 'Tambah Admin';
        $data['title'] = 'Tambah Admin';
        $data['user_role'] = $this->Crud_m->all_data('user_type', '*','id != 3');
       
        $data['content'] = 'admin/user/index';
        $this->load->view('admin/template/main', $data);
    }

    public function save() {
        extract($_POST);
        
        $upload1 = $_FILES['gambar']['name'];
        $nmfile1 = time()."_".$upload1;
        if($upload1 != '') {
            $config['upload_path']          = './uploads/foto_admin';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024 * 1;
            $config['file_name']            = $nmfile1;

            $this->load->library('upload', $config);
            $data1 = $this->upload->data();
            $this->upload->do_upload('gambar');

            $image = $data1['file_name'];
        } else {
            $image = '';
        }


        $check_status = $this->Global_m->isExists('email', $email, 'user_info');
        if ($check_status) {
            $message = array(false, 'Proses Gagal !', 'User telah terdaftar !');
        } else {
            if ($nama == '' || $email == '' || $password == '') {
                $message = array(false, 'Proses Gagal!', 'Informasi tidak boleh kosong !');
            } else {
                $key = md5(microtime() . rand());
               
                    $data = array(
                        'nama_lengkap' => $nama,
                        'email' => $email,
                        'nama_panggilan' => $nama_panggilan,
                        'password' => md5($password),
                        'no_hp' => $no_hp,
                        'user_type' => $type,
                        'status' => 0,
                        'photo' => $image
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
