<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller {

    protected $user_type; 

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if (($user_type == 3) OR ($user_type == 5) || $session_id == NULL) {
            redirect('authentication/keluar');
        }

    }

    public function index() {
        $data['menu'] = 'Paket Soal';
        $data['smenu'] = '';
        $data['title'] = 'Master Paket Soal';
        $data['content'] = 'admin/paket/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('master_paket', '*');
        $this->load->view('admin/paket/table', $data);
    }

    public function add() {
        $data['kategori'] = $this->Crud_m->all_data('master_kategori', '*');
        $this->load->view('admin/paket/add',$data);
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['kategori'] = $this->Crud_m->all_data('master_kategori', '*');
        $data['detail'] = $this->Crud_m->get_one('*', 'master_paket', 'id_paket', $id);
        $this->load->view('admin/paket/edit', $data);
    }

    public function save() {
        extract($_POST);
        
        $data = array(
            'nama_paket' => $nama_paket,
            'id_kategori' => $id_kategori,
            'waktu_pengerjaan' => $waktu_pengerjaan,
            'petunjuk_pengerjaan' => $petunjuk_pengerjaan
        );
       
        $add = $this->Crud_m->add('master_paket', $data);
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
            'nama_paket' => $nama_paket,
            'id_kategori' => $id_kategori,
            'waktu_pengerjaan' => $waktu_pengerjaan,
            'petunjuk_pengerjaan' => $petunjuk_pengerjaan
        );

        $update = $this->Crud_m->edit('master_paket', $data,'id_paket',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

     public function delete() {
        extract($_POST);

        $delete = $this->Crud_m->delete('master_paket','id_paket',$id);
        if ($delete) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses hapus data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses hapus data gagal !');
        }
        echo json_encode($message);
    }

    // Jawaban

    public function index_soal() {
        extract($_POST);
        $this->session->set_userdata('id_paket',$id);
        $data['title'] = 'Master Paket';
        $this->load->view('admin/paket/index_soal', $data);
    }

    public function load_soal() {
        extract($_POST);
        $id = $this->session->userdata('id_paket');
        $data['list'] = $this->Crud_m->all_data('master_isipaket','*',"id_paket=$id");
        $this->load->view('admin/paket/table_soal', $data);
    }

    public function add_soal() {
        extract($_POST);
        $data['id_soal'] = $this->session->userdata('id_paket');
        $id_kategori = $this->Global_m->getvalue('id_kategori','master_paket','id_paket',$this->session->userdata('id_paket'));
        $data['soal'] = $this->Crud_m->all_data('master_soal','*',"kategori=$id_kategori");
        $this->load->view('admin/paket/add_soal',$data);
    }

    public function edit_soal() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'master_paket', 'id_paket', $id);
        $this->load->view('admin/paket/edit_soal', $data);
    }

    public function save_soal() {
        extract($_POST);
        $array = [];
        $no = 1;
        foreach ($id_soal as $key => $value) {
           $data['id_paket'] = $this->session->userdata('id_paket');
           $data['id_soal'] = $value;
           $data['nomor'] = $no++;
           $exist = $this->Global_m->isExists2Key('id_paket',$this->session->userdata('id_paket'),'id_soal',$value,'master_isipaket');

            if(!$exist) {
                $array[] = $data;
            }
           
        }
        
        if(count($array) >= 1) {

            $add = $this->Crud_m->add_batch('master_isipaket', $array);
            if ($add) {
                $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
            } else {
                $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
            }
        } else {
            $message = array(TRUE, 'Proses Gagal !', 'Tidak ada data yang ditambah karena data sudah tersedia!');
        }
        
        echo json_encode($message);
    }

    public function update_jawaban() {

        extract($_POST);
        $data = array(
            'id_soal' => $id_soal,
            'id_paket' => $id_paket
        );

        $update = $this->Crud_m->edit('master_isipaket', $data,'id_paket',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

    public function delete_soal() {
        extract($_POST);

        $delete = $this->Crud_m->delete('master_isipaket','id_isipaket',$id);
        if ($delete) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses hapus data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses hapus data gagal !');
        }
        echo json_encode($message);
    }

}
