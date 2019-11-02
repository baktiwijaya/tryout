<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Coin extends CI_Controller {

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
        $data['title'] = 'Pembelian Coin';
        $data['content'] = 'user/coin/index';
        $this->load->view('user/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('transaksi_coin', '*',"id_user=".$this->session->userdata('id'));
        $this->load->view('user/coin/table', $data);
    }

    public function add() {
        $data['coin'] = $this->Crud_m->all_data('master_paketcoin', '*');
        $this->load->view('user/coin/add',$data);
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'transaksi_coin', 'id_transaksi', $id);
        $this->load->view('user/coin/edit', $data);
    }

    public function save() {
        extract($_POST);
        $data = array(
            'id_paketcoin' => $id_paketcoin,
            'tanggal_pembelian' => date('Y-m-d H:i:s'),
            'id_user' => $this->session->userdata('id'),
            'status' => 0
        );

        $add = $this->Crud_m->add('transaksi_coin', $data);
        if ($add) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

    public function update() {
        extract($_POST);

        $upload1 = $_FILES['gambar']['name'];
        $nmfile1 = time()."_".$upload1;
        $config['upload_path']          = './uploads/bukti_pembayaran';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024 * 1;
        $config['file_name']            = $nmfile1;

        $this->load->library('upload', $config);
        $data1 = $this->upload->data();
        $this->upload->do_upload('gambar');

        $image = $data1['file_name'];

        $data = array(
            'gambar' => $image,
            'note' => $note,
            'tanggal_upload' => date('Y-m-d H:i:s'),
            'status' => 1
        );
        $update = $this->Crud_m->edit('transaksi_coin', $data, 'id_transaksi', $id);
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
            'status' => 3
        );
        $update = $this->Crud_m->edit('transaksi_coin', $data, 'id_transaksi', $id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses pengubahan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses pengubahan data gagal !');
        }
        echo json_encode($message);
    }

}
