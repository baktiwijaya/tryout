<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Paketcoin extends CI_Controller {

    protected $user_type; 

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 1|| $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['menu'] = 'Transaksi Coin';
        $data['smenu'] = 'Manage Coin';
        $data['title'] = 'Paket Coin';
        $data['content'] = 'admin/paketcoin/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('master_paketcoin', '*');
        $this->load->view('admin/paketcoin/table', $data);
    }

    public function add() {
        $data['paket'] = $this->Crud_m->all_data('master_paketcoin', '*');
        $this->load->view('admin/paketcoin/add',$data);
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'master_paketcoin', 'id_paketcoin', $id);
        $this->load->view('admin/paketcoin/edit', $data);
    }

    public function save() {
        extract($_POST);
        
        $data1 = array(
            'nama_paketcoin' => $nama_paketcoin,
            'jumlah_paketcoin' => $jumlah_koin,
            'harga_paketcoin' => $harga_koin,
        );
        
        $add = $this->Crud_m->add('master_paketcoin', $data1);
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
             'nama_paketcoin' => $nama_paketcoin,
            'jumlah_paketcoin' => $jumlah_koin,
            'harga_paketcoin' => $harga_koin,
        );

        $update = $this->Crud_m->edit('master_paketcoin', $data,'id_paketcoin',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

    public function delete() {
        extract($_POST);

        $delete = $this->Crud_m->delete('master_paketcoin','id_paketcoin',$id);
        if ($delete) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses hapus data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses hapus data gagal !');
        }
        echo json_encode($message);
    }

}
