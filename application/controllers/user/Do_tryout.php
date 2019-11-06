<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Do_tryout extends CI_Controller {

    protected $user_type;
    private $_module = 'user/do_tryout';

#------------------------------------    
# constructor function
#------------------------------------    

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        $this->load->model('user/Do_tryout_model','tbl_tryout');
        if ($user_type != 3 || $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['title'] = 'Kerjakan Tryout';
        $data['content'] = $this->_module.'/index';
        $this->load->view('user/template/main', $data);
    }

    public function load_table() {
        $id_user = $this->session->userdata('id');
        $data['list'] = $this->Crud_m->all_data('library_tryout', '*',"id_user=$id_user AND test_status = 0");
        $this->load->view($this->_module.'/table', $data);
    }

    public function take_test() {
        extract($_POST);

        $id_tryout = $this->Global_m->getvalue('id_tryout','library_tryout','id_library',$id);
        $data['list'] = $this->Crud_m->all_data('master_isitryout','*',"id_tryout=$id_tryout");
        $this->load->view($this->_module.'/table_test',$data);
    }

    public function do_test() {
        extract($_POST);
        
        $data['list'] = $this->Crud_m->all_data('master_isipaket','*',"id_paket=$id");
        $this->load->view($this->_module.'/table_do',$data);
    }

    public function ganti_soal() {
        extract($_POST);

        $data['list'] = $this->tbl_tryout->get_data($id_soal);
        $this->load->view($this->_module.'/table_soal',$data);

    }

}
