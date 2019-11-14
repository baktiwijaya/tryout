<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Paketpoin extends CI_Controller {

    protected $user_type; 

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 1 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['menu'] = 'Transaksi Poin';
        $data['smenu'] = 'Manage Poin';
        $data['title'] = 'Paket poin';
        $data['content'] = 'admin/paketpoin/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('master_paketpoin', '*');
        $this->load->view('admin/paketpoin/table', $data);
    }

    public function add() {
        $data['sosmed'] = $this->Crud_m->all_data('master_sosmed', '*');
        $this->load->view('admin/paketpoin/add',$data);
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['sosmed'] = $this->Crud_m->all_data('master_sosmed', '*');
        $data['detail'] = $this->Crud_m->get_one('*', 'master_paketpoin', 'id_paketpoin', $id);
        $this->load->view('admin/paketpoin/edit', $data);
    }

    public function save() {
        extract($_POST);
        $upload1 = $_FILES['gambar']['name'];
        $nmfile1 = time()."_".$upload1;
        $config['upload_path']          = './uploads/sosmed';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024 * 1;
        $config['file_name']            = $nmfile1;

        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');               
        $data1 = $this->upload->data();
        $image_name = $data1['file_name'];

        $data = array(
            'id_sosmed' => $id_sosmed,
            'nama_paketpoin' => $nama_paketpoin,
            'jumlah_paketpoin' => $jumlah_paketpoin,
            'instruksi_paketpoin' => $instruksi_paketpoin,
            'end_date' => $end_date,
            'gambar' => $image_name,
            'status' => 0,
        );
        
        $add = $this->Crud_m->add('master_paketpoin', $data);
        if ($add) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
            
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }
        echo json_encode($message);
    }

    public function update() {

        extract($_POST);
        
        if($_FILES['gambar']['name'] != '') {
            $upload1 = $_FILES['gambar']['name'];
            $nmfile1 = time()."_".$upload1;
            $config['upload_path']          = './uploads/sosmed';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024 * 1;
            $config['file_name']            = $nmfile1;

            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');               
            $data1 = $this->upload->data();
            $image_name = $data1['file_name'];

            $data = array(
                'id_sosmed' => $id_sosmed,
                'nama_paketpoin' => $nama_paketpoin,
                'jumlah_paketpoin' => $jumlah_paketpoin,
                'instruksi_paketpoin' => $instruksi_paketpoin,
                'end_date' => $end_date,
                'status' => 0,
                'gambar' => $image_name
            );
        } else {
            $data = array(
                'id_sosmed' => $id_sosmed,
                'nama_paketpoin' => $nama_paketpoin,
                'jumlah_paketpoin' => $jumlah_paketpoin,
                'instruksi_paketpoin' => $instruksi_paketpoin,
                'end_date' => $end_date,
                'status' => 0,
            );
        }
        

        $update = $this->Crud_m->edit('master_paketpoin', $data,'id_paketpoin',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

    public function delete() {
        extract($_POST);

        $delete = $this->Crud_m->delete('master_paketpoin','id_paketpoin',$id);
        if ($delete) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses hapus data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses hapus data gagal !');
        }
        echo json_encode($message);
    }

}
