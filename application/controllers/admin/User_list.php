<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_list extends CI_Controller {

    protected $user_type; 
    private $_kategori = 8;
    private $_kategori_soal = 'Biologi';

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 1 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['menu'] = 'Manage User';
        $data['smenu'] = 'List User';
        $data['title'] = 'Master Soal'." ".$this->_kategori_soal;
        $data['content'] = 'admin/user_list/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('user_info', '*','user_type=3');
        $this->load->view('admin/user_list/table', $data);
    }

    public function load_user() {
        extract($_POST);
        $data['detail'] = $this->Crud_m->get_one('*','user_info','id',$id);
        $this->load->view('admin/user_list/detail', $data);
    }

    function export_excel() {
        header('Content-Type: application/json');
        $data['list'] = $this->Crud_m->all_data('user_info', '*','user_type = 3');
        $this->load->view('admin/user_list/export_excel', $data);
    }

}
