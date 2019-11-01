<?PHP

/*
 * @author      : Ahmad Fauzi <info@ahmadfauzi.id>
 * Project Name : eviralo_be
 * Generated    : Oct 6, 2019 - 1:52:39 AM
 * Filename     : Tags_model.php
 * Encoding     : UTF-8
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags_model extends CI_Model {

    public function update($data, $id) {
        $this->db->trans_begin();
        $this->db->where('id_tags', $id);
        $this->db->update('tags', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function save($data) {
        $this->db->trans_begin();
        $this->db->insert('tags', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

}
