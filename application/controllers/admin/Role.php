<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller {

    protected $user_type;

#------------------------------------    
# constructor function
#------------------------------------    

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if (($user_type!=1) || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['menu'] = 'Manage User';
        $data['smenu'] = 'Manage Role';
        $data['title'] = 'User Role';
        $data['content'] = 'admin/role/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('user_type', '*','','user_type ASC');
        $this->load->view('admin/role/role_list', $data);
    }

    public function add() {
        $this->load->view('admin/role/role_add');
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'user_type', 'id', $id);
        $this->load->view('admin/role/role_edit', $data);
    }

    public function save() {
        extract($_POST);
        $data = array('user_type' => $user_type,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
        );
        $exist = $this->Global_m->isExists('user_type', trim($user_type), 'user_type');
        if ($exist) {
            $message = array(FALSE, 'Proses Gagal !', 'Data telah tersedia !');
        } else {
            $add = $this->Crud_m->add('user_type', $data);
            if ($add) {
                $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
            } else {
                $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
            }
        }

        echo json_encode($message);
    }

    public function update() {
        extract($_POST);
        $data = array('user_type' => $user_type,
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id'),
        );
        $update = $this->Crud_m->edit('user_type', $data, 'id', $id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses pengubahan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses pengubahan data gagal !');
        }
        echo json_encode($message);
    }

}
