<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengetahuan extends CI_Controller {

    protected $user_type; 
    private $_kategori = 3;
    private $_kategori_soal = 'Pengetahuan dan Pemahaman Umum';

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if (($user_type == 3) OR ($user_type == 5) || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['menu'] = 'Soal';
        $data['smenu'] = $this->_kategori_soal;
        $data['title'] = 'Master Soal'." ".$this->_kategori_soal;
        $data['content'] = 'admin/master_soal/index';
        $data['load_table'] = 'admin/pengetahuan/load_table';
        $data['add'] = 'admin/pengetahuan/add';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['edit'] = 'admin/pengetahuan/edit';
        $data['index_jawaban'] = 'admin/pengetahuan/index_jawaban';
        $data['list'] = $this->Crud_m->all_data('master_soal', '*','kategori='.$this->_kategori);
        $this->load->view('admin/master_soal/table', $data);
    }

    public function add() {
        $data['form_action'] = 'admin/pengetahuan/save';
        $this->load->view('admin/master_soal/add',$data);
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['form_action'] = 'admin/pengetahuan/update';
        $data['detail'] = $this->Crud_m->get_one('*', 'master_soal', 'id_soal', $id);
        $this->load->view('admin/master_soal/edit', $data);
    }

    public function save() {
        extract($_POST);
        
        $data = array(
            'nama_soal' => $nama_soal,
            'kategori' => $this->_kategori,
            'pembahasan' => $pembahasan,
            'topic' => $topic
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
            'kategori' => $this->_kategori,
            'pembahasan' => $pembahasan,
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
        $data['load_jawaban'] = 'admin/pengetahuan/load_jawaban';
        $data['add_jawaban'] = 'admin/pengetahuan/add_jawaban';
        $data['title'] = 'Master Jawaban'." ".$this->_kategori_soal;
        $this->load->view('admin/master_soal/index_jawaban', $data);
    }

    public function load_jawaban() {
        extract($_POST);
        $data['edit_jawaban'] = 'admin/pengetahuan/edit_jawaban';
        $data['list'] = $this->Crud_m->all_data('master_jawaban','*',"id_soal=$id");
        $this->load->view('admin/master_soal/table_jawaban', $data);
    }

    public function add_jawaban() {
        extract($_POST);
        $data['form_action'] = 'admin/pengetahuan/save_jawaban';
        $data['id_soal'] = $this->session->userdata('id_soal');
        $this->load->view('admin/master_soal/add_jawaban',$data);
    }

    public function edit_jawaban() {
        extract($_POST);
        $data['id'] = $id;
        $data['form_action'] = 'admin/pengetahuan/update_jawaban';
        $data['detail'] = $this->Crud_m->get_one('*', 'master_jawaban', 'id_jawaban', $id);
        $this->load->view('admin/master_soal/edit_jawaban', $data);
    }

    public function save_jawaban() {
        extract($_POST);

        $upload1 = $_FILES['gambar']['name'];
        $nmfile1 = time()."_".$upload1;
        if($upload1 != '') {
            $config['upload_path']          = './uploads/master_jawaban';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 512 * 1;
            $config['file_name']            = $nmfile1;

            $this->load->library('upload', $config);
            $data1 = $this->upload->data();

            $image = $data1['file_name'];
        } else {
            $image = '';
        }
        if($this->upload->do_upload('gambar')) {
            $data = array(
                'nama_jawaban' => $nama_jawaban,
                'label' => $label,
                'gambar' => $image,
                'marks' => $poin,
                'id_soal' => $id_soal,
                'is_true' => $is_true
            );
           
            $add = $this->Crud_m->add('master_jawaban', $data);
            if ($add) {
                $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
            } else {
                $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
            }
        } else {
            $error = $this->upload->display_errors();
            $message = array(FALSE, 'Proses Gagal !', $error);
        }  
        
        echo json_encode($message);
    }

    public function update_jawaban() {

        extract($_POST);
        if($_FILES['gambar']['name'] != "") {
            $upload1 = $_FILES['gambar']['name'];
            $nmfile1 = time()."_".$upload1;
            $config['upload_path']          = './uploads/master_jawaban';
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 512 * 1;
            $config['file_name']            = $nmfile1;

            $this->load->library('upload', $config);            
            $data1 = $this->upload->data();
            $image_name = $data1['file_name'];
            $data = array(
                'nama_jawaban' => $nama_jawaban,
                'label' => $label,
                'marks' => $poin,
                'gambar' => $image_name,
                'is_true' => $is_true
            );


        } else {
            $data = array(
                'nama_jawaban' => $nama_jawaban,
                'label' => $label,
                'marks' => $poin,
                'is_true' => $is_true
            );
        }

        if($this->upload->do_upload('gambar')) {
            $update = $this->Crud_m->edit('master_jawaban', $data,'id_jawaban',$id);
            if ($update) {
                $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
            } else {
                $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
            }
        } else {
            $error = $this->upload->display_errors();
            $message = array(FALSE, 'Proses Gagal !', $error);
        }
        echo json_encode($message);
    }

}
