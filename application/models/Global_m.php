<?php

class Global_m extends CI_Model {
    
    function getKonfig($param) {
        $res = $this->db->get('konfig')->row_array();

        return $res[$param];
    }

    function getUserStatus($param) {
        $stat = array(
            '0' => '<span class="badge" style="background-color: orange; color: white;">Pending Aktivasi Email</span>',
            '1' => '<span class="badge bg-green">Aktif</span>',
            '-1' => '<span class="badge" style="background-color: gray; color: white;">Tidak Aktif</span>',
        );
        return $stat[$param];
    }

    function getLongReadableDate($timestamp) {
        return date("d-m-Y H:i:s", $timestamp);
    }

    function getUserRole($param) {
        $this->db->where(array('id' => $param));
        $res = $this->db->get('user_type')->row_array();
        return $res['user_type'];
    }

    function getPlacing($param) {
        $this->db->where(array('id_position' => $param));
        $res = $this->db->get('positioning')->row_array();
        return $res['position_name'];
    }

    function urlen($param) {
        return strtolower(str_replace(array(" ", ",", "?"), "-", $param));
    }

    function getKanalName($param) {
        $res = $this->db->get('kanal', array('id_kanal' => $param))->row_array();
        return $res['nama_kanal'];
    }

    function inisialisasi_($table, $where, $params) {
        $this->db->select('count(*) as total');
        $this->db->from($table);
        $this->db->where($where, $params);
        $res = $this->db->get();
        $row = $res->row();
        if ($row->total == 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert_validation($table, $where, $params) {
        $this->db->select('count(*) as total');
        $this->db->from($table);
        $this->db->where(trim($where, " "), trim($params, " "));
        $res = $this->db->get();
        $row = $res->row();
        if ($row->total != 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
      function fungsiCurl($url){
      $data = curl_init();
      curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($data, CURLOPT_URL, $url);
      curl_setopt($data, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
      $hasil = curl_exec($data);
      curl_close($data);
      return $hasil;
      }
     */
    function currencyConverter($from_Currency, $to_Currency, $amount) {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $encode_amount = 1;
        $get = file_get_contents("https://www.google.com/finance/converter?a=$encode_amount&from=$from_Currency&to=$to_Currency", false, stream_context_create($arrContextOptions));
        $get = explode("<span class=bld>", $get);
        $get = explode("</span>", $get[1]);
        $converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
        return $converted_currency;
    }

    function inisialisasis_($table, $where, $params, $where2, $params2) {
        $this->db->select('count(*) as total');
        $this->db->from($table);
        $this->db->where($where, $params);
        $this->db->where($where2, $params2);
        $res = $this->db->get();
        $row = $res->row()->total;
        return $row;
    }

    function counts($table) {
        $this->db->select('count(*) as total');
        $this->db->from($table);
        //$this->db->group_by(' ');
        $res = $this->db->get();
        $row = $res->row()->total;
        return $row;
    }

    function count_where($id,$table) {
        $this->db->select('count(*) as total');
        $this->db->from($table);
        $this->db->where('id_paket',$id);
        //$this->db->group_by(' ');
        $res = $this->db->get();
        $row = $res->row()->total;
        return $row;
    }

    function getvalue($name, $table, $id, $idValue) {
        $this->db->select($name);
        $this->db->from($table);
        $this->db->where($id, $idValue);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row->$name;
        } else {
            return '';
        }
    }

    function getvalwhere($name, $table, $where = '') {
        $this->db->select($name);
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row->$name;
        } else {
            return '';
        }
    }

    function getonerow($table, $id, $idValue) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($id, $idValue);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row;
        } else {
            return array();
        }
    }

    function getvalue2id($name, $table, $id1, $id2, $vkey1, $vkey2) {
        $this->db->select($name);
        $this->db->from($table);
        $this->db->where($id1, $vkey1);
        $this->db->where($id2, $vkey2);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row->$name;
        } else {
            return '';
        }
    }

    function getvalue3id($name, $table, $id1, $id2, $id3, $vkey1, $vkey2, $vkey3) {
        $this->db->select($name);
        $this->db->from($table);
        $this->db->where($id1, $vkey1);
        $this->db->where($id2, $vkey2);
        $this->db->where($id3, $vkey3);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row->$name;
        } else {
            return '';
        }
    }

    function getvalueWhere($name, $table, $where) {
        $this->db->select($name);
        $this->db->from($table);
        $this->db->where($where);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row->$name;
        } else {
            return '';
        }
    }

    public function isExists($key, $valkey, $tabel) {
        $this->db->from($tabel);
        $this->db->where($key, $valkey);
        $num = $this->db->count_all_results();
        if ($num == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isExists2Key($key1, $valkey1, $key2, $valkey2, $tabel) {
        $this->db->from($tabel);
        $this->db->where($key1, $valkey1);
        $this->db->where($key2, $valkey2);
        $num = $this->db->count_all_results();
        if ($num == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isExists3Key($key1, $valkey1, $key2, $valkey2, $key3, $valkey3, $tabel) {
        $this->db->from($tabel);
        $this->db->where($key1, $valkey1);
        $this->db->where($key2, $valkey2);
        $this->db->where($key3, $valkey3);
        $num = $this->db->count_all_results();
        if ($num == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function isExists4Key($key1, $valkey1, $key2, $valkey2, $key3, $valkey3, $key4, $valkey4, $tabel) {
        $this->db->from($tabel);
        $this->db->where($key1, $valkey1);
        $this->db->where($key2, $valkey2);
        $this->db->where($key3, $valkey3);
        $this->db->where($key4, $valkey4);
        $num = $this->db->count_all_results();
        if ($num == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function validate() {
        $usermail = $this->input->post('usermail');
        $userpass = md5($this->input->post('userpass'));

        $cek['username'] = $usermail;
        $cek['password'] = $userpass;
        $cek['status_user'] = 1;
        $q_cek_login = $this->db->get_where('tbl_user', $cek);
        if ($q_cek_login->num_rows() > 0) {
            foreach ($q_cek_login->result() as $qad) {
                $sess_data['login_web'] = True;
                $sess_data['username'] = $qad->username;
                $sess_data['nama'] = $qad->namauser;
                $sess_data['user_id'] = $qad->id;
                $sess_data['email'] = $qad->email;
                $sess_data['level'] = $qad->level;
                $sess_data['sebagai'] = $this->global_m->getvalue('level', 'tbl_level', 'id', $qad->level);
                $sess_data['nocq'] = $qad->nocq;
                $sess_data['lokasi'] = $qad->lokasi;
                $sess_data['module'] = $qad->module;
                $sess_data['avatar'] = $qad->foto;
                $sess_data['userkode'] = $qad->kode_user;
                $sess_data['nip'] = $qad->nip;
                $this->session->set_userdata($sess_data);

                if (!$this->session->userdata("random_filemanager_key")) {
                    $karakter = 'abcdefghijklmnopqrstuvwxyz0123456789';
                    $hasil = '';
                    for ($i = 0; $i < 10; $i++) {
                        $hasil .= $karakter[rand(0, strlen($karakter) - 1)];
                    }
                    $this->session->set_userdata(array("random_filemanager_key" => $hasil));
                };
            }
            $this->crud_m->edit('tbl_user', array('online' => '1'), 'username', $qad->username);
            $d['status'] = 1;
            $d['pesan'] = 'Berhasil Login';
            $d['url'] = 'booking';
            $kegiatan = 'Login system ' . $username;
            $this->fungsi->catat($kegiatan);
            return true;
        } else {
            //$this->session->set_flashdata("result","Gagal Login!");
            //redirect("home");
            $d['status'] = 0;
            $d['pesan'] = 'Login GAGAL, Cek Kembali Kombinasi Username dan Password';
            return false;
        }
        /* if ($this->agent->is_browser())
          {
          $agent = $this->agent->browser().' '.$this->agent->version();
          }
          elseif ($this->agent->is_robot())
          {
          $agent = $this->agent->robot();
          }
          elseif ($this->agent->is_mobile())
          {
          $agent = $this->agent->mobile();
          }
          else
          {
          $agent = 'Unidentified User Agent';
          }
          $data = array(
          'idpengguna' => '',
          'idgrup' => '',
          'namapengguna' => $usermail,
          'platform' => $this->agent->platform(),
          'browser' => $agent,
          'logged_in' => true,
          );
          $this->session->set_userdata($data);
          return true; */
    }

    function kekata($x) {
        $x = abs($x);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima",
            "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($x < 12) {
            $temp = " " . $angka[$x];
        } else if ($x < 20) {
            $temp = $this->kekata($x - 10) . " belas";
        } else if ($x < 100) {
            $temp = $this->kekata($x / 10) . " puluh" . $this->kekata($x % 10);
        } else if ($x < 200) {
            $temp = " seratus" . $this->kekata($x - 100);
        } else if ($x < 1000) {
            $temp = $this->kekata($x / 100) . " ratus" . $this->kekata($x % 100);
        } else if ($x < 2000) {
            $temp = " seribu" . $this->kekata($x - 1000);
        } else if ($x < 1000000) {
            $temp = $this->kekata($x / 1000) . " ribu" . $this->kekata($x % 1000);
        } else if ($x < 1000000000) {
            $temp = $this->kekata($x / 1000000) . " juta" . $this->kekata($x % 1000000);
        } else if ($x < 1000000000000) {
            $temp = $this->kekata($x / 1000000000) . " milyar" . $this->kekata(fmod($x, 1000000000));
        } else if ($x < 1000000000000000) {
            $temp = $this->kekata($x / 1000000000000) . " trilyun" . $this->kekata(fmod($x, 1000000000000));
        }
        return $temp;
    }

    function terbilang($x, $style = 4) {
        if ($x < 0) {
            $hasil = "minus " . trim($this->kekata($x));
        } else {
            $hasil = trim($this->kekata($x));
        }
        switch ($style) {
            case 1:
                $hasil = strtoupper($hasil);
                break;
            case 2:
                $hasil = strtolower($hasil);
                break;
            case 3:
                $hasil = ucwords($hasil);
                break;
            default:
                $hasil = ucfirst($hasil);
                break;
        }
        return $hasil . " " . "Rupiah";
    }

    function terbilang_dolar($x, $style = 4) {
        if ($x < 0) {
            $hasil = "minus " . trim($this->kekata($x));
        } else {
            $hasil = trim($this->kekata($x));
        }
        switch ($style) {
            case 1:
                $hasil = strtoupper($hasil);
                break;
            case 2:
                $hasil = strtolower($hasil);
                break;
            case 3:
                $hasil = ucwords($hasil);
                break;
            default:
                $hasil = ucfirst($hasil);
                break;
        }
        return $hasil . " " . "Dolar";
    }

    function get_update_currency() {
        $this->db->select("nilai_tukar");
        $this->db->from("tbl_matauang");
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row->nilai_tukar;
        } else {
            return '';
        }
    }

    function date_convert($date) {
        if ($date != "") {
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $day = substr($date, 8, 2);
            $hour = substr($date, 11);
            $desc_month = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            );
            $result = $day . ' ' . $desc_month[$month] . ' ' . $year . ' ' . $hour . ' WIB';
            return $result;
        } else {
            return $date;
        }
    }

    public function status_tayang($date) {
        $status = "";
        if ($date != "") {
            $now = date('Y-m-d H:i:s');
            if ($now > $date) {
                $status = "Sudah Tayang";
            } else {
                $status = "Belum Tayang";
            }
            return $status;
        } else {
            return "Date not found";
        }
    }

    public function news_status($status) {
        $stat = array(
            '0' => '<span class="badge" style="background-color: gray; color: white;">Masuk Keranjang Berita</span>',
            '1' => '<span class="badge bg-blue">Masuk Daftar Berita</span>',
            '2' => '<span class="badge bg-green">Sudah Tayang</span>',
            '3' => '<span class="badge" style="background-color: gray; color: white;">Arsip</span>',
        );
        return $stat[$status];
    }

    function getFirstPara($string) {
        $string = substr($string, strpos($string, "<p"), strpos($string, "</p>") + 4);
        return $string;
    }

}
