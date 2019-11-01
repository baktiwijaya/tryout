<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
#------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

#------------------------------------


    public function get_data($start, $end) {
        $kanal = $this->session->userdata('kanal_management');
        $query = "
            SELECT a.nama_kanal, a.id_kanal, a.icon,
            SUM(CASE WHEN flag_status = 0 and DATE_FORMAT(c.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end' THEN 1 ELSE 0 END) as belum_tayang,
            SUM(CASE WHEN flag_status = 1 and DATE_FORMAT(c.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end'THEN 1 ELSE 0 END) as sudah_tayang,
            SUM(CASE WHEN flag_status in (0,1,2) and DATE_FORMAT(c.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end' THEN 1 ELSE 0 END) as total
            FROM kanal a
            LEFT JOIN kanal b ON a.id_kanal = b.parent
            LEFT JOIN news c ON b.id_kanal = c.sub_kanal 
            WHERE a.parent = '0' and a.is_aktif = '1'";
        if($this->session->userdata('user_type') != 4) {
            $query.= " and a.id_kanal = '$kanal'";
        }
        $query.=" GROUP BY a.id_kanal ORDER BY a.column_order ASC";
                
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function get_data_($start, $end, $id_kanal) {
        $kanal = $this->session->userdata('kanal_management');
        $query = "
            SELECT b.nama_kanal, b.column_order,
            SUM(CASE WHEN flag_status = 0 and DATE_FORMAT(a.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end' THEN 1 ELSE 0 END) as belum_tayang,
            SUM(CASE WHEN flag_status = 1 and DATE_FORMAT(a.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end'THEN 1 ELSE 0 END) as sudah_tayang,
            SUM(CASE WHEN flag_status in (0,1,2) and DATE_FORMAT(a.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end' THEN 1 ELSE 0 END) as total
            FROM news a
            RIGHT JOIN kanal b on a.sub_kanal=b.id_kanal
            where b.parent = '$id_kanal' and b.is_aktif = '1'
            GROUP BY b.nama_kanal, b.column_order
            ORDER BY b.column_order ASC";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function get_latest() {
        $kanal = $this->session->userdata('kanal_management');
        $query = "SELECT * FROM news where kanal_id = '$kanal' ORDER BY date_published desc LIMIT 4";
        $res = $this->db->query($query);
        return $res->result_array();
    }

    public function get_berita($start, $end) {
        $kanal = $this->session->userdata('kanal_management');
        $query = "
            SELECT 
            SUM(CASE WHEN flag_status = 0 and DATE_FORMAT(c.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end' THEN 1 ELSE 0 END) as belum_tayang,
            SUM(CASE WHEN flag_status = 1 and DATE_FORMAT(c.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end'THEN 1 ELSE 0 END) as sudah_tayang,
            SUM(CASE WHEN flag_status in (0,1,2) and DATE_FORMAT(c.date_published,'%Y-%m-%d') BETWEEN '$start' AND '$end' THEN 1 ELSE 0 END) as total
            FROM kanal a
            LEFT JOIN kanal b ON a.id_kanal = b.parent
            LEFT JOIN news c ON b.id_kanal = c.sub_kanal 
            WHERE a.parent = '0' and a.is_aktif = '1' and a.id_kanal = '$kanal'";
        $res = $this->db->query($query);
        return $res->row_array();
    }

    public function get_kanal($id) {
        $this->db->select('*');
        $this->db->from('kanal');
        $this->db->where('parent', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

}
