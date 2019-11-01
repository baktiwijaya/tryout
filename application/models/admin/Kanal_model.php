<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kanal_model extends CI_Model {
#------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

#------------------------------------

    public function get_data() {
        $this->db->select('*');
        $this->db->from('kanal');
        $this->db->order_by('column_order', 'ASC');
        $res = $this->db->get();
        return $res->result_array();
    }

    public function get_one($id) {
        $this->db->select('*');
        $this->db->from('kanal');
        $this->db->where('id_kanal', $id);
        $this->db->where('is_aktif', 1);
        $this->db->order_by('column_order', 'ASC');
        $res = $this->db->get();
        return $res->row();
    }

    public function get_data_sub() {
        $this->db->select('a.*,b.nama_kanal as parent_name');
        $this->db->from('kanal a');
        $this->db->join('kanal b', 'a.parent = b.id_kanal', 'left');
        $this->db->order_by('b.column_order', 'ASC');
        $this->db->order_by('a.column_order', 'ASC');
        $this->db->where('a.is_aktif', 1);
        $this->db->where('a.parent != 0');
        $res = $this->db->get();
        return $res->result_array();
    }

    public function get_parent() {
        $this->db->select('*');
        $this->db->from('kanal');
        $this->db->where('parent = 0');
        $res = $this->db->get();
        return $res->result_array();
    }

    public function save($data) {
        $this->db->trans_begin();
        $this->db->insert('kanal', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function update($data, $id) {
        $this->db->trans_begin();
        $this->db->where('id_kanal', $id);
        $this->db->update('kanal', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function delete($id) {
        $data = array('is_aktif' => 0);
        $this->db->trans_begin();
        $this->db->where('id_kanal', $id);
        $this->db->update('kanal', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
        return true;
    }

}
