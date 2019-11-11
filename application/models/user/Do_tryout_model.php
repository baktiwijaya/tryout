<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Do_tryout_model extends CI_Model {
#------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

#------------------------------------

    public function all_data($id_paket,$id_librarypaket) {
        $this->db->select('*');
        $this->db->from('library_isitryout a');
        $this->db->where('a.id_librarypaket',$id_librarypaket);
        $this->db->where('a.id_paket',$id_paket);
        $res = $this->db->get();
        return $res->result_array();
    }

}
