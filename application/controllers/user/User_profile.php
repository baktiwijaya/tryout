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
            'nama_soal' => $nama_soal,
            'kategori' => $this->_kategori,
            'topic' => $topic
        );

        $update = $this->Crud_m->edit('master_soal', $data,'id_soal',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

}
