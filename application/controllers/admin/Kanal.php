<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kanal extends CI_Controller {

    protected $user_type;

#------------------------------------    
# constructor function
#------------------------------------    

    public function __construct() {
        parent::__construct();
        $this->load->model("admin/Kanal_model", 'tbl_get');
        $this->load->model("admin/News_model");
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ((($user_type != 3) AND ( $user_type != 4) AND ( $user_type != 2)) || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['title'] = 'Kanal';
        $data['content'] = 'admin/kanal/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('kanal', '*', 'parent = 0', 'column_order ASC');
        $data['total_row'] = count($data['list']);
        $this->load->view('admin/kanal/kanal_list', $data);
    }

    public function add() {
        $this->load->view('admin/kanal/kanal_add');
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'kanal', 'id_kanal', $id);
        $this->load->view('admin/kanal/kanal_edit', $data);
    }

    public function save() {
        extract($_POST);
        $config['upload_path'] = './uploads/cat-ico/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = true;
        $config['max_size'] = 4024; // 4MB
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_select_machin')) {
            $image = $this->upload->data("file_name");
        }
        $data = array('nama_kanal' => trim($nama_kanal),
            'parent' => $parent,
            'meta_description' => $meta_description,
            'meta_keyword' => $meta_keyword,
            'meta_title' => $meta_title,
            'created_by' => $this->session->userdata('id'),
            'created_date' => date('Y-m-d H:i:s'),
            'icon' => $image
        );
        $add = $this->Crud_m->add('kanal', $data);
        if ($add) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }
        echo json_encode($message);
    }

    public function update() {
        $slug = str_replace(' ', '-', strtolower($this->input->post('nama_kanal')));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        $config['upload_path'] = './uploads/cat-ico/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = true;
        $config['max_size'] = 4024; // 4MB
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_select_machin')) {
            $image = $this->upload->data("file_name");
        }
        $foto = "";
        if ($image == "") {
            $foto = $this->input->post("gambar");
        } else {
            $foto = $image;
        }
        $data = array(
            'nama_kanal' => trim($this->input->post('nama_kanal')),
            'meta_description' => trim($this->input->post('meta_description')),
            'meta_keyword' => trim($this->input->post('meta_keyword')),
            'meta_title' => trim($this->input->post('meta_title')),
            'updated_by' => $this->session->userdata('id'),
            'updated_date' => date('Y-m-d H:i:s'),
            'slug' => $slug,
            'icon' => $foto
        );
        $update = $this->Crud_m->edit('kanal', $data, 'id_kanal', $this->input->post('id'));
        if ($update) {
            $message = array(TRUE, 'Berhasil!', 'Data berhasil diubah!');
        } else {
            $message = array(FALSE, 'Gagal!', 'Data gagal diubah!');
        }
        echo json_encode($message);
    }

    public function matiin() {
        extract($_POST);
        $update = $this->tbl_get->update(array('is_aktif' => NULL), $id);
        if ($update) {
            $message = array(TRUE, 'Berhasil!', 'Kanal berhasil dinonaktifkan!');
        } else {
            $message = array(FALSE, 'Gagal!', 'Kanal gagal dinonaktifkan, gak tau kenapa!');
        }
        echo json_encode($message);
    }

    public function idupin() {
        extract($_POST);
        $update = $this->tbl_get->update(array('is_aktif' => TRUE), $id);
        if ($update) {
            $message = array(TRUE, 'Berhasil!', 'Kanal berhasil diaktifkan!');
        } else {
            $message = array(FALSE, 'Gagal!', 'Kanal gagal diaktifkan, gak tau kenapa!');
        }
        echo json_encode($message);
    }

    public function simpan_order() {
        extract($_POST);
        $i = 0;
        foreach ($no as $row) {
            $data1 = array(
                'column_order' => $row,
            );
            $update = $this->Crud_m->edit('kanal', $data1, 'id_kanal', $id[$i]);
            $i++;
        }
        if ($update) {
            $message = array(TRUE, 'Berhasil!', 'Posisi kanal berhasil diubah!');
        } else {
            $message = array(FALSE, 'Gagal!', 'Posisi kanal gagal diubah!');
        }
        echo json_encode($message);
    }

}
