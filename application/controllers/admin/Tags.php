<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tags extends CI_Controller {

    protected $user_type;

#------------------------------------    
# constructor function
#------------------------------------    

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ((($user_type != 3) AND ( $user_type != 4) AND ( $user_type != 2)) || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['title'] = 'Tags';
        $data['content'] = 'admin/tags/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('tags', '*');
        $this->load->view('admin/tags/tags_list', $data);
    }

    public function add() {
        $this->load->view('admin/tags/tags_add');
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'tags', 'id_tags', $id);
        $this->load->view('admin/tags/tags_edit', $data);
    }

    public function save() {
        extract($_POST);
        $data = array('tags_name' => trim($tags_name),
            'created_date' => date('Y-m-d H:i:s')
        );
        $exist = $this->Global_m->isExists('tags_name', trim($tags_name), 'tags');
        if ($exist) {
            $message = array(FALSE, 'Proses Gagal !', 'Data telah tersedia !');
        } else {
            $add = $this->Crud_m->add('tags', $data);
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
        $data = array('tags_name' => trim($tags_name),
        );
        $update = $this->Crud_m->edit('tags', $data, 'id_tags', $id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses pengubahan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses pengubahan data gagal !');
        }
        echo json_encode($message);
    }

}
