<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pemahaman extends CI_Controller {

    protected $user_type; 
    private $_kategori = 2;
    private $_kategori_soal = 'Pemahaman Baca dan Menulis';

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 1 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['title'] = 'Master Soal'." ".$this->_kategori_soal;
        $data['content'] = 'admin/pemahaman/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('master_soal', '*','kategori='.$this->_kategori);
        $this->load->view('admin/pemahaman/table', $data);
    }

    public function add() {
        $this->load->view('admin/pemahaman/add');
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'master_soal', 'id_soal', $id);
        $this->load->view('admin/pemahaman/edit', $data);
    }

    public function save() {
        extract($_POST);
        
        $data = array(
            'nama_soal' => $nama_soal,
            'kategori' => $this->_kategori
        );
       
        $add = $this->Crud_m->add('master_soal', $data);
        if ($add) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }
        echo json_encode($message);
    }

    public function update() {

        extract($_POST);
        
      
        $data = array(
            'nama_soal' => $nama_soal,
            'kategori' => $this->_kategori
        );

        $update = $this->Crud_m->edit('master_soal', $data,'id_soal',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

     public function delete() {
        extract($_POST);

        $delete = $this->Crud_m->delete('master_soal','id_soal',$id);
        if ($delete) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses hapus data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses hapus data gagal !');
        }
        echo json_decode($messsage);
    }

    // Jawaban

    public function index_jawaban() {
        extract($_POST);
        $this->session->set_userdata('id_soal',$id);
        $data['title'] = 'Master Jawaban'." ".$this->_kategori_soal;
        $this->load->view('admin/pemahaman/index_jawaban', $data);
    }

    public function load_jawaban() {
        extract($_POST);
        $data['list'] = $this->Crud_m->all_data('master_jawaban','*',"id_soal=$id");
        $this->load->view('admin/pemahaman/table_jawaban', $data);
    }

    public function add_jawaban() {
        extract($_POST);
        $data['id_soal'] = $this->session->userdata('id_soal');
        $this->load->view('admin/pemahaman/add_jawaban',$data);
    }

    public function edit_jawaban() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'master_jawaban', 'id_jawaban', $id);
        $this->load->view('admin/pemahaman/edit_jawaban', $data);
    }

    public function save_jawaban() {
        extract($_POST);

        $upload1 = $_FILES['gambar']['name'];
        $nmfile1 = time()."_".$upload1;
        if($upload1 != '') {
            $config['upload_path']          = './uploads/master_jawaban';
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
       
        
        $data = array(
            'nama_jawaban' => $nama_jawaban,
            'label' => $label,
            'gambar' => $image,
            'id_soal' => $id_soal,
            'is_true' => $is_true
        );
       
        $add = $this->Crud_m->add('master_jawaban', $data);
        if ($add) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }
        echo json_encode($message);
    }

    public function update_jawaban() {

        extract($_POST);
        if($_FILES['gambar']['name'] != "") {
            $upload1 = $_FILES['gambar']['name'];
            $nmfile1 = time()."_".$upload1;
            $config['upload_path']          = './uploads/master_jawaban';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024 * 1;
            $config['file_name']            = $nmfile1;

            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');               
            $data1 = $this->upload->data();
            $image_name = $data1['file_name'];
            $data = array(
                'nama_jawaban' => $nama_jawaban,
                'label' => $label,
                'gambar' => $data1['file_name'],
                'is_true' => $is_true
            );
        } else {
            $data = array(
            'nama_jawaban' => $nama_jawaban,
            'label' => $label,
            'is_true' => $is_true
        );
        }

        $update = $this->Crud_m->edit('master_jawaban', $data,'id_jawaban',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

}
