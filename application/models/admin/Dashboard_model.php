<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
#------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

    public function get_userkoin() {
        $query = "SELECT COUNT(DISTINCT(id_user)) AS TOTAL FROM transaksi_coin";
        $sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }
	public function get_userpoin() {
        $query = "SELECT COUNT(DISTINCT(id_user)) as TOTAL FROM transaksi_poin WHERE `status` = 2";
        $sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }
    public function get_userkoinpoin() {
        $query = "SELECT COUNT(DISTINCT(id_user)) as TOTAL FROM transaksi_koinpoin WHERE total_poin IS NOT NULL AND total_koin IS NOT NULL";
        $sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }
    public function get_usertotal() {
        $query = "SELECT COUNT(id) as TOTAL FROM user_info";
        $sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }

    public function get_totalpoin($id) {
    	$query = "SELECT
				  CASE WHEN SUM(b.jumlah_paketpoin) IS NULL THEN 0 ELSE SUM(b.jumlah_paketpoin) END AS TOTAL
				  FROM transaksi_poin a
				  LEFT JOIN master_paketpoin b on a.id_paketpoin = b.id_paketpoin
				  LEFT JOIN master_sosmed c ON b.id_sosmed = c.id_sosmed
				  WHERE a.`status` = 2 AND c.id_sosmed = $id";
		$sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }

    public function get_revenue() {
    	$query = "SELECT SUM(harga_paketcoin) AS TOTAL FROM master_paketcoin a
				  LEFT JOIN transaksi_coin b ON b.id_paketcoin = a.id_paketcoin
                  WHERE `status`=2";
        $sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }

    public function get_totalcoin() {
    	$query = "SELECT SUM(jumlah_paketcoin) as TOTAL FROM master_paketcoin a
					LEFT JOIN transaksi_coin b ON b.id_paketcoin = a.id_paketcoin
					WHERE `status`=2";
        $sql = $this->db->query($query)->row();
        return $sql->TOTAL;
    }

    // public function get_datauser() {
    // 	$query = "SELECT COUNT(id_user) AS TOTAL FROM user_info WHERE DATE_FORMAT(date_create,'%Y-%m-%d') = ('Y-m-d')";
    //     $sql = $this->db->query($query)->row();
    //     return $sql->TOTAL;
    // }

 }