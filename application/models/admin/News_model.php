<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {
#------------------------------------------------

    // Constructor
    public function __construct() {
        parent::__construct();
    }

    public function get_data() {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->order_by('date_published', 'DESC');
        $ret = $this->db->get();
        return $ret->result_array();
    }

    public function get_category() {
        $this->db->select("*");
        $this->db->from('categories');
        $this->db->order_by('position', 'ASC');
        $ret = $this->db->get();
        return $ret->result();
    }

    public function get_reporter() {
        $this->db->select('*');
        $this->db->from('user_info');
        $ret = $this->db->get();
        return $ret->result();
    }

    public function get_kanal() {
        $this->db->select('*');
        $this->db->from('kanal');
        $this->db->where('parent', 0);
        $ret = $this->db->get();
        return $ret->result();
    }

    public function get_sub_kanal($id) {
        $this->db->select('*');
        $this->db->from('kanal');
        $this->db->where('parent', $id);
        $ret = $this->db->get();
        return $ret->result();
    }

    public function get_placing() {
        $ret = $this->db->query('SELECT * FROM POSITIONING')->result_array();
        return $ret;
    }

    public function get_placing_order() {
        $this->db->select('*');
        $this->db->from('data_setting');
        $this->db->where('KEY_SETTING', 'PLACING_ORDER');
        $ret = $this->db->get();
        return $ret->result();
    }

    public function get_kategori() {
        $this->db->select('*');
        $this->db->from('data_setting');
        $this->db->where('KEY_SETTING', 'KATEGORI');
        $ret = $this->db->get();
        return $ret->result();
    }

    public function save($data) {
        $this->db->trans_begin();
        $this->db->insert('news', $data);
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
        $this->db->where('id', $id);
        $this->db->update('news', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function do_upload($FILES, $sizes) {
        $max_file_size = 1024 * 1024;
        $valid_exts = array('jpeg', 'jpg', 'png', 'gif');
        $diractory = array('uploads/berita', 'uploads');
        if ($FILES['size'] < $max_file_size) {
            // get file extension
            $ext = strtolower(pathinfo($FILES['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $valid_exts)) {
                /* resize image */
                $k = 0;
                foreach ($sizes as $w => $h) {
                    $files[] = $this->resize($w, $h, $FILES, $diractory[$k]);
                    $k++;
                }
            } else {
                $files['msg'] = $msg = 'Unsupported file';
            }
        } else {
            $files['msg'] = $msg = 'Please upload image smaller than 200KB';
        }
        sleep(1);
        return $files;
    }

    function resize($width, $height, $FILES, $diractory) {
        $sssss = $FILES['size'] / 1024;
        list($w, $h) = getimagesize($FILES['tmp_name']);
        // print_r($w);
        // print_r($h);
        $ratio = max($width / $w, $height / $h);
        $h = ceil($height / $ratio);
        $x = ($w - $width / $ratio) / 2;
        $w = ceil($width / $ratio);
        $ext = explode(".", $FILES['name']);
        $path = $diractory . '/' . time() . '.' . end($ext);
        if ($sssss < 100 && ($diractory == 'uploads')) {
            copy($FILES['tmp_name'], $path);
        }
        /* read binary data from image file */
        $imgString = file_get_contents($FILES['tmp_name']);
        /* create image from string */
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
        /* Save image */
        switch ($FILES['type']) {
            case 'image/jpeg':
                imagejpeg($tmp, $path, 100);
                break;
            case 'image/png':
                imagepng($tmp, $path, 0);
                break;
            case 'image/gif':
                imagegif($tmp, $path);
                break;
            default:
                exit;
                break;
        }
        return $path;
        /* cleanup memory */
        imagedestroy($image);
        imagedestroy($tmp);
    }

    function get_tags() {
        $arr = [];
        $query = $this->db->query("SELECT tags_name FROM tags")->result_array();
        foreach ($query as $key) {
            $array = array('value' => $key['tags_name']);
            array_push($arr, $array);
        }
        return $arr;
    }

}
