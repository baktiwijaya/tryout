<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Historipoin extends CI_Controller {

    protected $user_type;

#------------------------------------    
# constructor function
#------------------------------------    

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if (($user_type == 3) OR ($user_type == 4)|| $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['title'] = 'Histori Pembelian Poin';
        $data['content'] = 'admin/historipoin/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('transaksi_poin', '*','status=2');
        $this->load->view('admin/historipoin/table', $data);
    }

    public function update() {
        extract($_POST);

        $data = array(
            'verified_by' => $this->session->userdata('id'),
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'status' => 2
        );
        $update = $this->Crud_m->edit('transaksi_poin', $data, 'id_transaksi', $id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses pengubahan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses pengubahan data gagal !');
        }
        echo json_encode($message);
    }

    public function delete() {
        extract($_POST);

        $data = array(
            'status' => 4
        );
        $update = $this->Crud_m->edit('transaksi_poin', $data, 'id_transaksi', $id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses pengubahan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses pengubahan data gagal !');
        }
        echo json_encode($message);
    }

}
