<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
#------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

#------------------------------------

    public function get_data($id_tryout,$id_user) {
        
        $query = "SELECT a.nilai,c.nama_paket,d.nama_tryout FROM library_pakettryout a
                  LEFT JOIN library_tryout b on a.id_library = b.id_library
                  LEFT JOIN master_paket c on a.id_paket = c.id_paket
                  LEFT JOIN master_tryout d on b.id_tryout = d.id_tryout
                  WHERE b.id_tryout = $id_tryout AND b.id_user = $id_user";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

}




