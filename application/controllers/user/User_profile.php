<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_profile extends CI_Controller {

    protected $user_type; 
    private $_kategori = 8;
    private $_kategori_soal = 'Biologi';

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 3 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $id = $this->session->userdata('id');
        $data['title'] = 'User Profile';
        $data['detail'] = $this->Crud_m->get_one('*', 'user_info','id',$id);
        $data['content'] = 'user/user_profile/index';
        $data['id'] = $id;
        $this->load->view('user/template/main', $data);
    }

    public function save() {

        extract($_POST);
        
        $data = array(
            'email' => $email,
            'no_hp' => $no_hp,
            'password' => md5($password),
            'nama_lengkap' => $nama_lengkap,
            'nama_panggilan' => $nama_panggilan,
            'jenis_kelamin' => $jenis_kelamin,
            'kampus_impian' => $kampus_impian,
            'verification_id_no' => $verification_id_no,
            'verification_type' => $verification_type,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir
        );

        $update = $this->Crud_m->edit('user_info', $data,'id',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

}
