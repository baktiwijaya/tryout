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
        $data['tryout'] = $this->Crud_m->all_data('master_tryout', '*','status=1');
        $this->load->view('user/beli_tryout/add',$data);
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['detail'] = $this->Crud_m->get_one('*', 'id_transaksi', 'transaksi_tryout', $id);
        $this->load->view('user/beli_tryout/edit', $data);
    }

    public function save_koin() {
        extract($_POST);
        
        $id_user = $this->session->userdata('id');
        $koin = $this->Global_m->getvalue('total_koin','transaksi_koinpoin','id_user',$id_user);
        $harga_koin = $this->Global_m->getvalue('harga_koin','master_tryout','id_tryout',$id_tryout);


        if( (float)$koin - (float)$harga_koin < 0) {
            $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal karena saldo tidak cukup !');
        } else {
            $data = array(
                'id_user' => $id_user,
                'id_tryout' => $id_tryout,
                'jumlah_pengurangan' => $harga_koin,
                'tanggal_beli' => date('Y-m-d H:i:s'),
                'tipe_beli' => 1 
            );
            $add = $this->Crud_m->add('transaksi_tryout',$data);
            if($add) {
                $data2 = array(
                    'id_tryout' => $id_tryout,
                    'id_user' => $id_user,
                    'test_status' => 0 // Belum dikerjakan
                );
                $add2 = $this->Crud_m->add('library_tryout',$data2);
                if($add2) {
                    $data3 = array(
                        'total_koin' => ((float)$koin - (float)$harga_koin)
                    );
                    $update = $this->Crud_m->edit('transaksi_koinpoin',$data3,'id_user',$id_user);
                    if($update) {
                        $message = array(TRUE, 'Proses Berhasil !', 'Pembelian berhasil !');
                    } else {
                        $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal dilakukan !');
                    }
                }

            } else {
                $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal dilakukan !');
            }
        }

        echo json_encode($message);
    }

    public function save_poin() {
        extract($_POST);
        
        $id_user = $this->session->userdata('id');
        $poin = $this->Global_m->getvalue('total_poin','transaksi_koinpoin','id_user',$id_user);
        $harga_poin = $this->Global_m->getvalue('harga_poin','master_tryout','id_tryout',$id_tryout);


        if( (float)$poin - (float)$harga_poin < 0) {
            $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal karena saldo tidak cukup !');
        } else {
            $data = array(
                'id_user' => $id_user,
                'id_tryout' => $id_tryout,
                'jumlah_pengurangan' => $harga_poin,
                'tanggal_beli' => date('Y-m-d H:i:s'),
                'tipe_beli' => 2
            );
            $add = $this->Crud_m->add('transaksi_tryout',$data);
            if($add) {
                $data2 = array(
                    'id_tryout' => $id_tryout,
                    'id_user' => $id_user,
                    'test_status' => 0 // Belum dikerjakan
                );
                $add2 = $this->Crud_m->add('library_tryout',$data2);
                if($add2) {
                    $data3 = array(
                        'total_poin' => ((float)$poin - (float)$harga_poin)
                    );
                    $update = $this->Crud_m->edit('transaksi_koinpoin',$data3,'id_user',$id_user);
                    if($update) {
                        $message = array(TRUE, 'Proses Berhasil !', 'Pembelian berhasil !');
                    } else {
                        $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal dilakukan !');
                    }
                }

            } else {
                $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal dilakukan !');
            }
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
