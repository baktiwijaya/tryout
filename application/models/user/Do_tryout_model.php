<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Do_tryout_model extends CI_Model {
#------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

#------------------------------------

    public function get_data($id = '') {
        $this->db->select('*');
        $this->db->from('master_soal');
        if($id != '') {
            $this->db->where('id_soal',$id);
        }
        $this->db->limit(1);
        $res = $this->db->get();
        return $res->row();
    }

}
