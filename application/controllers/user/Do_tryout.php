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
        $data['menu'] = 'Kerjakan Tryout';
        $data['smenu'] = '';
        $data['title'] = 'Kerjakan Tryout';
        $data['content'] = $this->_module.'/index';
        $this->load->view('user/template/main', $data);
    }

    public function load_table() {
        $id_user = $this->session->userdata('id');
        $data['list'] = $this->Crud_m->all_data('library_tryout', '*',"id_user=$id_user");
        $this->load->view($this->_module.'/table', $data);
    }

    public function take_test() {
        extract($_POST);
        $data['list'] = $this->Crud_m->all_data('library_pakettryout','*','id_library='.$id);
        $this->load->view($this->_module.'/table_test',$data);
    }

    public function petunjuk() {
        extract($_POST);
        $data['detail'] = $this->Crud_m->get_one('*','master_paket','id_paket',$id);
        $this->load->view($this->_module.'/petunjuk',$data);
    }

    public function rapot() {
        extract($_POST);
        $data['list'] = $this->Crud_m->all_data('library_pakettryout','*','id_library='.$id);
        $this->load->view($this->_module.'/table_rapot',$data);
    }

    public function do_test() {
        extract($_POST);
        $this->session->set_userdata('id_librarypaket',$id_librarytryout);
        $data['waktu_pengerjaan'] = $this->Global_m->getvalue('waktu_pengerjaan','master_paket','id_paket',$id_paket);
        $data['list'] = $this->tbl_tryout->all_data($id_paket,$id_librarytryout);
        $this->load->view($this->_module.'/table_do',$data);
    }

    public function save() {
        extract($_POST);
        $array = array();
        $benar = array();
        $salah = array();
        $nilai_benar = array();
        $nilai_salah = array();
        foreach ($id_jawaban as $key => $value) {
            $is_true = $this->Global_m->getvalue('is_true','master_jawaban','id_jawaban',$value);
            $poin = $this->Global_m->getvalue('marks','master_jawaban','id_jawaban',$value);
            $data['id_librarytrout'] = $id_librarytrout[$key];
            $data['id_jawaban'] = $value;
            $data['is_done'] = 1;

            if($is_true == 1) {
                array_push($benar,$is_true);
                array_push($nilai_benar,$poin);
            } else {
                array_push($salah,$is_true);
                array_push($nilai_salah,$poin);
            }

            array_push($array,$data);
        }



        $total_benar = array_sum($nilai_benar);
        $total_salah = array_sum($nilai_salah);
        $marks = (float)$total_benar + (float)$total_salah;

        $this->session->set_userdata('marks',$marks);
        $this->session->set_userdata('benar',count($benar));
        $this->session->set_userdata('salah',count($salah));
        $update = $this->Crud_m->edit_batch('library_isitryout',$array,'id_librarytrout');
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }
        echo json_encode($message);

    }

    public function done() {
        extract($_POST);
        
        $data = array(
            'test_status' => 1,
            'nilai' => $this->session->userdata('marks'),
            'jawaban_benar' => $this->session->userdata('benar'),
            'jawaban_salah' => $this->session->userdata('salah')
        );       

        $id_librarypaket = $this->session->userdata('id_librarypaket');

        $update = $this->Crud_m->edit('library_pakettryout',$data,'id_librarytryout',$id_librarypaket);
        if ($update) {
            $this->session->unset_userdata('marks');
            $this->session->unset_userdata('benar');
            $this->session->unset_userdata('salah');
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }
        echo json_encode($message);

    }

}
