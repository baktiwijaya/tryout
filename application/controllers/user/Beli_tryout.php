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

        $this->load->model('user/Beli_tryout_model','tbl_beli');
    }

    public function index() {
        $data['title'] = 'Pembelian Tryout';
        $data['content'] = 'user/beli_tryout/index';
        $this->load->view('user/template/main', $data);
    }

    public function load_table() {
        $data['list'] = $this->Crud_m->all_data('transaksi_tryout', '*',"id_user=".$this->session->userdata('id'));
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
        $array = array();
        $array2 = array();
        $array_value = array();

        $id_user = $this->session->userdata('id');

        $koin = $this->Global_m->getvalue('total_koin','transaksi_koinpoin','id_user',$id_user);
        $harga_koin = $this->Global_m->getvalue('harga_koin','master_tryout','id_tryout',$id_tryout);

        if( ( (float)$koin - (float)$harga_koin ) < 0) {
            $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal karena saldo tidak cukup !','warning');
        } else {
            // Masukkan data ke History Pembelian
            $data = array(
                'id_user' => $id_user,
                'id_tryout' => $id_tryout,
                'jumlah_pengurangan' => $harga_koin,
                'tanggal_beli' => date('Y-m-d H:i:s'),
                'tipe_beli' => 1 
            );

            $add = $this->Crud_m->add('transaksi_tryout',$data);

            if($add) {
                // Update jumlah koin 
                $data3 = array(
                    'total_koin' => ((float)$koin - (float)$harga_koin)
                );
                $update = $this->Crud_m->edit('transaksi_koinpoin',$data3,'id_user',$id_user);

                if($update) {
                    // Masukkan data ke tryout
                    $data2 = array(
                        'id_tryout' => $id_tryout,
                        'id_user' => $id_user,
                    );
                    $add_tryout = $this->Crud_m->add('library_tryout',$data2);

                    if($add_tryout) {
                        $id_library = $this->db->insert_id();

                        $paket = $this->Crud_m->all_data('master_isitryout','id_paket','id_tryout='.$id_tryout);
                        foreach($paket as $key => $value) {
                            $array3 = array(
                                'id_library' => $id_library,
                                'id_tryout' => $id_tryout,
                                'test_status' => 0,
                                'id_paket' => $value['id_paket']
                            );

                            array_push($array_value,$array3);
                            array_push($array,$value['id_paket']);
                        }

                        $add_paket = $this->Crud_m->add_batch('library_pakettryout',$array_value);

                        if($add_paket) {

                            $id_soal = $this->tbl_beli->get_soal($id_tryout,$id_user);
                            $no = 1;
                            foreach ($id_soal as $key) {
                                $no++;
                                $data4 = array(
                                    'id_librarypaket' => $key['id_librarytryout'],
                                    'id_soal' => $key['id_soal'],
                                    'id_paket' => $key['id_paket'],
                                    'nomor' => $key['nomor']
                                );

                                array_push($array2,$data4);
                            }

                            $add4 = $this->Crud_m->add_batch('library_isitryout',$array2);

                            if($add4) {
                                $message = array(TRUE, 'Proses Berhasil !', 'Pembelian Berhasil !','success');
                            } else {
                                $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal !','warning');
                            }
                        } else {
                            $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal !','warning');
                        }
                    } else {
                        $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal !','warning');
                    }
                } else {
                    $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal !','warning');
                }

            }            


        }
        

        

        echo json_encode($message);
    }

    public function save_poin() {
        
        extract($_POST);
        $array = array();
        $array2 = array();
        $array_value = array();

        $id_user = $this->session->userdata('id');

        $poin = $this->Global_m->getvalue('total_poin','transaksi_koinpoin','id_user',$id_user);
        $harga_poin = $this->Global_m->getvalue('harga_poin','master_tryout','id_tryout',$id_tryout);

        if( ( (float)$poin - (float)$harga_poin ) < 0) {
            $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal karena saldo tidak cukup !','warning');
        } else {
            // Masukkan data ke History Pembelian
            $data = array(
                'id_user' => $id_user,
                'id_tryout' => $id_tryout,
                'jumlah_pengurangan' => $harga_poin,
                'tanggal_beli' => date('Y-m-d H:i:s'),
                'tipe_beli' => 2
            );

            $add = $this->Crud_m->add('transaksi_tryout',$data);

            if($add) {
                // Update jumlah koin 
                $data3 = array(
                    'total_poin' => ((float)$poin - (float)$harga_poin)
                );
                $update = $this->Crud_m->edit('transaksi_koinpoin',$data3,'id_user',$id_user);

                if($update) {
                    // Masukkan data ke tryout
                    $data2 = array(
                        'id_tryout' => $id_tryout,
                        'id_user' => $id_user,
                    );
                    $add_tryout = $this->Crud_m->add('library_tryout',$data2);

                    if($add_tryout) {
                        $id_library = $this->db->insert_id();

                        $paket = $this->Crud_m->all_data('master_isitryout','id_paket','id_tryout='.$id_tryout);
                        foreach($paket as $key => $value) {
                            $array3 = array(
                                'id_library' => $id_library,
                                'id_tryout' => $id_tryout,
                                'test_status' => 0,
                                'id_paket' => $value['id_paket']
                            );

                            array_push($array_value,$array3);
                            array_push($array,$value['id_paket']);
                        }

                        $add_paket = $this->Crud_m->add_batch('library_pakettryout',$array_value);

                        if($add_paket) {

                            $id_soal = $this->tbl_beli->get_soal($id_tryout,$id_user);
                            $no = 1;
                            foreach ($id_soal as $key) {
                                $no++;
                                $data4 = array(
                                    'id_librarypaket' => $key['id_librarytryout'],
                                    'id_soal' => $key['id_soal'],
                                    'id_paket' => $key['id_paket'],
                                    'nomor' => $key['nomor']
                                );

                                array_push($array2,$data4);
                            }

                            $add4 = $this->Crud_m->add_batch('library_isitryout',$array2);

                            if($add4) {
                                $message = array(TRUE, 'Proses Berhasil !', 'Pembelian Berhasil !','success');
                            } else {
                                $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal !','warning');
                            }
                        } else {
                            $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal !','warning');
                        }
                    } else {
                        $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal !','warning');
                    }
                } else {
                    $message = array(FALSE, 'Proses Gagal !', 'Pembelian gagal !','warning');
                }

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
