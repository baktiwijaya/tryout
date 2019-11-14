<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tryout extends CI_Controller {

    protected $user_type; 

    public function __construct() {
        parent::__construct();
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        if (($user_type == 3) OR ($user_type == 5)|| $session_id == NULL) {
            redirect('authentication/keluar');
        }
    }

    public function index() {
        $data['menu'] = 'Tryout';
        $data['smenu'] = '';
        $data['title'] = 'Master Tryout';
        $data['content'] = 'admin/tryout/index';
        $this->load->view('admin/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('master_tryout', '*');
        $this->load->view('admin/tryout/table', $data);
    }

    public function add() {
        $data['paket'] = $this->Crud_m->all_data('master_paket', '*');
        $this->load->view('admin/tryout/add',$data);
    }

    public function edit() {
        extract($_POST);
        $data['id'] = $id;
        $data['paket'] = $this->Crud_m->all_data('master_paket', '*');
        $data['detail'] = $this->Crud_m->get_one('*', 'master_tryout', 'id_tryout', $id);
        $this->load->view('admin/tryout/edit', $data);
    }

    public function save() {
        extract($_POST);
        
        $array = [];
        $data1 = array(
            'nama_tryout' => $nama_tryout,
            'harga_koin' => $harga_koin,
            'harga_poin' => $harga_poin,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => 2
        );
        
        $add = $this->Crud_m->add('master_tryout', $data1);
        if ($add) {
            $id_tryout = $this->db->insert_id();
            foreach($id_paket as $key => $value) {
                $data2 = array(
                    'id_paket' => $value,
                    'id_tryout' => $id_tryout
                );
                array_push($array, $data2);
                
            }
            
            $insert_batch = $this->Crud_m->add_batch('master_isitryout',$array);
            if($insert_batch) {
                $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
            } else {
                $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
            }
            
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }
        echo json_encode($message);
    }

    public function update() {

        extract($_POST);
        
        $data = array(
            'nama_tryout' => $nama_tryout,
            'harga_koin' => $harga_koin,
            'harga_poin' => $harga_poin,
            'start_date' => $start_date,
            'end_date' => $end_date
        );

        $update = $this->Crud_m->edit('master_tryout', $data,'id_tryout',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

    public function delete() {
        extract($_POST);

        $delete = $this->Crud_m->delete('master_tryout','id_tryout',$id);
        if ($delete) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses hapus data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses hapus data gagal !');
        }
        echo json_encode($message);
    }

    public function index_paket() {
        extract($_POST);
        $data['title'] = 'Master Paket Tryout';
        $this->session->set_userdata('id_tryout',$id);
        $this->load->view('admin/tryout/index_paket',$data);
    }

    public function load_paket() {
        extract($_POST);
        $data['list'] = $this->Crud_m->all_data('master_isitryout', '*',"id_tryout=$id");
        $this->load->view('admin/tryout/table_paket', $data);
    }

    public function add_paket() {
        $data['paket'] = $this->Crud_m->all_data('master_paket', '*');
        $this->load->view('admin/tryout/add_paket',$data);
    }

    public function save_paket() {
        extract($_POST);
        
        $array = [];
        $id_tryout = $this->session->userdata('id_tryout');
        foreach($id_paket as $key => $value) {
            $data2 = array(
                'id_paket' => $value,
                'id_tryout' => $id_tryout
            );

            $exists = $this->Global_m->isExists2Key('id_tryout',$id_tryout,'id_paket',$value,'master_isitryout');

            if(!$exists) {
                array_push($array, $data2);
            }
        }
        if(count($array) >= 1) {
            $insert_batch = $this->Crud_m->add_batch('master_isitryout',$array);
            if($insert_batch) {
                $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
            } else {
                $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
            }
        }  else {
            $message = array(TRUE, 'Proses Berhasil !', 'Tidak ada data yang ditambah !');
        }
        
        echo json_encode($message);
    }

    public function delete_paket() {
        extract($_POST);

        $delete = $this->Crud_m->delete('master_isitryout','id_isitryout',$id);
        if ($delete) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses hapus data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses hapus data gagal !');
        }
        echo json_encode($message);
    }

    public function aktif() {

        extract($_POST);
        
        $data = array(
            'status' => 1,
        );

        $update = $this->Crud_m->edit('master_tryout', $data,'id_tryout',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }

    public function nonaktif() {

        extract($_POST);
        
        $data = array(
            'status' => 2,
        );

        $update = $this->Crud_m->edit('master_tryout', $data,'id_tryout',$id);
        if ($update) {
            $message = array(TRUE, 'Proses Berhasil !', 'Proses penyimpanan data berhasil !');
        } else {
            $message = array(FALSE, 'Proses Gagal !', 'Proses penyimpanan data gagal !');
        }

        echo json_encode($message);
    }


}
