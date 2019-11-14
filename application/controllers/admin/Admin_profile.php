<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_profile extends CI_Controller {

    protected $user_type; 
    private $_kategori = 8;
    private $_kategori_soal = 'Biologi';

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type == 3 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $id = $this->session->userdata('id');
        $data['menu'] = '';
        $data['smenu'] = '';
        $data['title'] = 'Admin Profile';
        $data['detail'] = $this->Crud_m->get_one('*', 'user_info','id',$id);
        $data['content'] = 'admin/admin_profile/index';
        $data['id'] = $id;
        $this->load->view('admin/template/main', $data);
    }

    public function save() {

        extract($_POST);
        $upload1 = $_FILES['gambar']['name'];
        $nmfile1 = time()."_".$upload1;
        if($upload1 != '') {
            $config['upload_path']          = './uploads/foto_admin';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 512 * 1;
            $config['file_name']            = $nmfile1;

            $this->load->library('upload', $config);
            $data1 = $this->upload->data();
            $this->upload->do_upload('gambar');

            $image = $data1['file_name'];
        } else {
            $image = '';
        }
        $data['email']              = $email;
        $data['no_hp']              = $no_hp;
        $data['password']           = md5($password);
        $data['nama_lengkap']       = $nama_lengkap;
        $data['nama_panggilan']     = $nama_panggilan;
        $data['jenis_kelamin']      = $jenis_kelamin;
        $data['kampus_impian']      = $kampus_impian;
        $data['verification_id_no'] = $verification_id_no;
        $data['verification_type']  = $verification_type;
        $data['tempat_lahir']       = $tempat_lahir;
        $data['tanggal_lahir']      = $tanggal_lahir;
        if($image != '') {
            $data['photo']          = $image; 
        }

        $update = $this->Crud_m->edit('user_info', $data,'id',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

}
