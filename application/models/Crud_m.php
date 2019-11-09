<?php

if (!defined('BASEPATH'))
    exit('Maaf tidak punya akses');

Class Crud_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array') {

        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = !$one ? $query->result($array) : $query->row();
            return $result;
        } else {
            return '';
        }
    }

    function get_parent() {
        $this->db->select('*');
        $this->db->from('kanal');
        $this->db->where(array('parent' => 0));
        $res = $this->db->get();
        return $res->result();
    }

    function get_one($field, $table, $where, $params) {
        $this->db->select($field);
        $this->db->from($table);
        $this->db->where($where, $params);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row;
        } else {
            return '';
        }
    }

    function all_data($table, $fields, $where = '', $sort = '', $tipe = '', $sort2 = '', $tipe2 = '', $sort3 = '', $tipe3 = '',$limit = '') {
        $one = false;
        $array = 'array';
        $this->db->select($fields);
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($sort) {
            $this->db->order_by($sort, $tipe);
        }

        if ($sort2) {
            $this->db->order_by($sort2, $tipe2);
        }

        if ($sort3) {
            $this->db->order_by($sort3, $tipe3);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();

        $result = !$one ? $query->result($array) : $query->row();
        return $result;
    }

    function add($table, $data) {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    function add_batch($table, $data) {
        $this->db->insert_batch($table, $data);
        if ($this->db->affected_rows() >= '1') {
            return TRUE;
        }

        return FALSE;
    }

    function edit($table, $data, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }

        return FALSE;
    }

    function edit_2key($table, $data, $fieldID1, $ID1, $fieldID2, $ID2) {
        $this->db->where($fieldID1, $ID1);
        $this->db->where($fieldID2, $ID2);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    function edit_3key($table, $data, $fieldID1, $ID1, $fieldID2, $ID2,$fieldID3, $ID3) {
        $this->db->where($fieldID1, $ID1);
        $this->db->where($fieldID2, $ID2);
        $this->db->where($fieldID3, $ID3);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        return FALSE;
    }

    function delete($table, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() >= '1') {
            return TRUE;
        }

        return FALSE;
    }

    function count($table) {
        return $this->db->count_all($table);
    }

    function countWhere($table, $where) {
        $this->db->where($where);
        return $this->db->count_all_results($table);
    }

    //Merubah Password User login sendiri
    function update_profil($user_name, $nama_user, $pass_word, $foto) {
        if (empty($foto)) {
            $gambarna = "";
        } else {
            $gambarna = ",foto = '$foto'";
        }

        if (empty($pass_word)) {
            $sql = "update tbl_user set nama_user ='$nama_user' $gambarna where user_name='$user_name'";
        } else {
            $sql = "update tbl_user set pass_word ='$pass_word',nama_user='$nama_user' $gambarna where user_name='$user_name'";
        }

        $this->db->query($sql);
    }

    //menahbah user pengguna
    function user_add($user_name, $nama_user, $pass_word, $level) {
        $sql = "insert into tbl_user (user_name,nama_user,pass_word,level) values('$user_name','$nama_user',password('$pass_word'),'$level')";
        $this->db->query($sql);
    }

    //RUbah user pengguna
    function user_edit($user_name, $nama_user, $pass_word, $level) {
        if (empty($pass_word)) {
            $sql = "update tbl_user set nama_user ='$nama_user',level='$level' where user_name='$user_name'";
        } else {
            $sql = "update tbl_user set pass_word='$pass_word',nama_user='$nama_user',nama_user ='$nama_user',level='$level'where user_name='$user_name'";
        }
        $this->db->query($sql);
    }

    function data_groupby($table, $fields, $where = '', $groupby, $order = '', $one = false, $array = 'array') {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->group_by($groupby);
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            $this->db->order_by('id', 'asc');
        }
        $query = $this->db->get();

        $result = !$one ? $query->result($array) : $query->row();
        return $result;
    }

    function get_group($table, $fields, $where = '', $groupby, $perpage = 0, $start = 0, $one = false, $array = 'array', $sort1, $tipe, $sort2, $tipe2) {

        $this->db->select($fields);
        $this->db->from($table);
        $this->db->group_by($groupby);
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        if ($sort1) {
            $this->db->order_by($sort1, $tipe);
        }

        if ($sort2) {
            $this->db->order_by($sort2, $tipe2);
        }

        $query = $this->db->get();

        $result = !$one ? $query->result($array) : $query->row();
        return $result;
    }

    function get_num_rows($table, $where = '', $groupby = '') {
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($groupby) {
            $this->db->group_by($groupby);
        }
        $query = $this->db->get();
        return $query;
    }

    //crud dengan sql
    function getSql($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array') {

        $sql = $this->load->database('sqlserver', TRUE);
        $sql->select($fields);
        $sql->from($table);
        $sql->limit($perpage, $start);
        if ($where) {
            $sql->where($where);
        }

        $query = $sql->get();

        $result = !$one ? $query->result($array) : $query->row();
        return $result;
    }

    function all_dataSql($table, $fields, $where = '', $sort = '', $tipe = '') {
        $sql = $this->load->database('sqlserver', TRUE);
        $one = false;
        $array = 'array';
        $sql->select($fields);
        $sql->from($table);
        if ($where) {
            $sql->where($where);
        }
        if ($sort) {
            $sql->order_by($sort, $tipe);
        }

        $query = $sql->get();

        $result = !$one ? $query->result($array) : $query->row();
        return $result;
    }

    function data_groupbySql($table, $fields, $where = '', $groupby, $order = '', $one = false, $array = 'array') {
        $sql = $this->load->database('sqlserver', TRUE);
        $sql->select($fields);
        $sql->from($table);
        $sql->group_by($groupby);
        if ($where) {
            $sql->where($where);
        }
        if ($order) {
            $sql->order_by('id', 'asc');
        }
        $query = $sql->get();

        $result = !$one ? $query->result($array) : $query->row();
        return $result;
    }

    public function isExistsSql($key, $valkey, $tabel) {
        $sql = $this->load->database('sqlserver', TRUE);
        $sql->from($tabel);
        $sql->where($key, $valkey);
        $num = $sql->count_all_results();
        if ($num == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isExists2keySql($key1, $valkey1, $key2, $valkey2, $tabel) {
        $sql = $this->load->database('sqlserver', TRUE);
        $sql->from($tabel);
        $sql->where($key1, $valkey1);
        $sql->where($key2, $valkey2);
        $num = $sql->count_all_results();
        if ($num == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isExists3keySql($key1, $valkey1, $key2, $valkey2, $key3, $valkey3, $tabel) {
        $sql = $this->load->database('sqlserver', TRUE);
        $sql->from($tabel);
        $sql->where($key1, $valkey1);
        $sql->where($key2, $valkey2);
        $sql->where($key3, $valkey3);
        $num = $sql->count_all_results();
        if ($num == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function find_list($table, $id, $name, $field, $sort) {
        $this->db->order_by($field, $sort);
        $this->db->where('id <>', 1);
        $query = $this->db->get($table);
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row[$id]] = $row[$name];
            }
        }
        return $data;
    }

    function where_in($select,$table,$valkey,$value) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where_in($valkey,$value);
        $res = $this->db->get();

        return $res->result_array();
    }

}
