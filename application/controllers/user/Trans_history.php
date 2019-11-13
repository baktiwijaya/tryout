<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Trans_history extends CI_Controller {

    protected $user_type; 

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 3 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $id = $this->session->userdata('id');
        $data['title'] = 'History';
        $data['content'] = 'user/trans_history/index';
        $data['id'] = $id;
        $this->load->view('user/template/main', $data);
    }

    public function get_koin() {
        $id_user = $this->session->userdata('id');
        $data['list'] = $this->Crud_m->all_data('transaksi_coin','*','id_user='.$id_user);
        $this->load->view('user/trans_history/table_koin',$data);
    }

    public function get_poin() {
        $id_user = $this->session->userdata('id');
        $data['list'] = $this->Crud_m->all_data('transaksi_poin','*','id_user='.$id_user);
        $this->load->view('user/trans_history/table_poin',$data);
    }

    public function get_tryout() {
        $id_user = $this->session->userdata('id');
        $data['list'] = $this->Crud_m->all_data('transaksi_tryout','*','id_user='.$id_user);
        $this->load->view('user/trans_history/table_tryout',$data);
    }

}
