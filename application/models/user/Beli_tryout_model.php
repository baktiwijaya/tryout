<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Beli_tryout_model extends CI_Model {
#------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

#------------------------------------

    public function get_soal($id_tryout) {
        $this->db->select('a.id_librarytryout,b.id_soal,a.id_paket,b.nomor');
        $this->db->from('library_pakettryout a');
        $this->db->join('master_isipaket b','a.id_paket = b.id_paket');
        $this->db->where('a.id_tryout',$id_tryout);
        $res = $this->db->get();
        return $res->result_array();
    }

}




