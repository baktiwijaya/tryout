<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Beli_tryout extends CI_Controller {

    protected $user_type;

#------------------------------------    
# constructor function
#------------------------------------    

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 3 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['title'] = 'beli_tryout';
        $data['content'] = 'user/beli_tryout/index';
        $this->load->view('user/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('transaksi_tryout', '*');
        $this->load->view('user/beli_tryout/table', $data);
    }

    public function add() {
        $data['tryout'] = $this->Crud_m->all_data('master_tryout', '*');
        $this->load->view('user/beli_tryout/add',$data);
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'id_transaksi', 'transaksi_tryout', $id);
        $this->load->view('user/beli_tryout/edit', $data);
    }

    public function save() {
        extract($_POST);
        $data = array(
            'id_tryout' => $id_tryout,
            'created_date' => date('Y-m-d H:i:s')
        );

        $add = $this->Crud_m->add('transaksi_tryout', $data);
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
            'id_tryout' => $id_tryout,
            'created_date' => date('Y-m-d H:i:s')
        );
        $update = $this->Crud_m->edit('transaksi_tryout', $data, 'id_transaksi', $id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses pengubahan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses pengubahan data gagal !');
        }
        echo json_encode($message);
    }

}
