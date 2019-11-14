<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    protected $user_type;

#------------------------------------    
# constructor function
#------------------------------------    

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if ($user_type == 3 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['menu'] = '';
        $data['smenu'] = '';
        $data['content'] = 'admin/dashboard/index';
        $data['koin']      = $this->dashboard_model->get_userkoin();
        $data['poin']      = $this->dashboard_model->get_userpoin();
        $data['user']      = $this->dashboard_model->get_usertotal();
        $data['instagram'] = $this->dashboard_model->get_totalpoin(1);
        $data['facebook']  = $this->dashboard_model->get_totalpoin(2);
        $data['line']      = $this->dashboard_model->get_totalpoin(3);
        $data['twitter']   = $this->dashboard_model->get_totalpoin(4);
        $data['whatsapp']  = $this->dashboard_model->get_totalpoin(5);
        $data['other']     = $this->dashboard_model->get_totalpoin(6);
        $data['revenue']   = $this->dashboard_model->get_revenue();
        $data['coin']      = $this->dashboard_model->get_totalcoin();
        $data['koinpoin']  = $this->dashboard_model->get_userkoinpoin();
        $this->load->view('admin/template/main', $data);
    }
}
