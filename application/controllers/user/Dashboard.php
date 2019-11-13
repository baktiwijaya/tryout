<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    protected $user_type;

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 3 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
        $this->load->model('user/Dashboard_model','dashboard_model');
    }

    public function index() {
        $id_user = $this->session->userdata('id');
        $data['title'] = 'Dashboard';
        $data['tryout'] = $this->Crud_m->all_data('library_tryout','*','id_user='.$id_user);
        $data['content'] = 'user/dashboard/index';
        $this->load->view('user/template/main', $data);
    }

    public function get_data(){
        extract($_POST);

        $id_user = $this->session->userdata('id');
        $data = $this->dashboard_model->get_data($id,$id_user);

        echo json_encode($data);
    }
}
