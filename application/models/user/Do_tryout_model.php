<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Do_tryout_model extends CI_Model {
#------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

#------------------------------------

    public function all_data($id_user,$id_paket) {
        $this->db->select('*');
        $this->db->from('library_isitryout');
        $this->db->where('id_paket',$id_paket);
        $this->db->where('id_user',$id_user);
        $res = $this->db->get();
        return $res->result_array();
    }

    public function get_data($id_paket,$id_user,$nomor) {
        $this->db->select('*');
        $this->db->from('library_isitryout');
        $this->db->where('id_paket',$id_paket);
        $this->db->where('id_user',$id_user);
        $this->db->where('nomor',$nomor);
        $res = $this->db->get();
        return $res->row();
    }

    public function get_datasoal($id_paket,$id_user) {
        $this->db->select('*');
        $this->db->from('library_isitryout');
        $this->db->where('id_paket',$id_paket);
        $this->db->where('id_user',$id_user);
        $res = $this->db->get();
        return $res->result_array();
    }



}
