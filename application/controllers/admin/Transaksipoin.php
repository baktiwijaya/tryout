<?php

defined('BASEPATH') or exit('No direct script access allowed');

class transaksipoin extends CI_Controller {

    protected $user_type;

#------------------------------------    
# constructor function
#------------------------------------    

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if (($user_type == 3) OR ($user_type == 4) || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['title'] = 'Verifikasi Pendapatan Poin';
        $data['content'] = 'admin/transaksipoin/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('transaksi_poin', '*','status=1');
        $this->load->view('admin/transaksipoin/table', $data);
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
            $id_pembeli = $this->Global_m->getvalue('id_user','transaksi_poin','id_transaksi',$id);
            $exist = $this->Global_m->isExists('id_user',$id_pembeli,'transaksi_koinpoin');

            if($exist) {
                $total_poin    = $this->Global_m->getvalue('total_poin','transaksi_koinpoin','id_user',$id_pembeli);
                $id_paketpoin  = $this->Global_m->getvalue('id_paketpoin','transaksi_poin','id_transaksi',$id);
                $jumlah_koin   = $this->Global_m->getvalue('jumlah_paketpoin','master_paketpoin','id_paketpoin',$id_paketpoin);

                $data2 = array(
                    'total_poin' => ($total_poin + $jumlah_koin)
                );

                $update_jumlah = $this->Crud_m->edit('transaksi_koinpoin', $data2, 'id_user', $id_pembeli);
                if($update_jumlah) {
                    $message = array(TRUE, 'Proses Berhasil !', 'Proses pengubahan data berhasil !');
                } else {
                    $message = array(FALSE, 'Proses Gagal !', 'Proses pengubahan data gagal !');
                }
            } else {
                $id_paketpoin  = $this->Global_m->getvalue('id_paketpoin','transaksi_poin','id_transaksi',$id);
                $jumlah_poin   = $this->Global_m->getvalue('jumlah_paketpoin','master_paketpoin','id_paketpoin',$id_paketpoin);

                $data2 = array(
                    'total_poin' => $jumlah_poin,
                    'id_user' => $id_pembeli

                );
                $update_jumlah = $this->Crud_m->add('transaksi_koinpoin', $data2);
                if($update_jumlah) {
                    $message = array(TRUE, 'Proses Berhasil !', 'Proses pengubahan data berhasil !');
                } else {
                    $message = array(FALSE, 'Proses Gagal !', 'Proses pengubahan data gagal !');
                }
            }
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
