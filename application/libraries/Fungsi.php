<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Fungsi {
    /* function fungsi()
      {
      $this->CI =& get_instance();
      $this->CI->load->library(array('session','pagination'));
      @$kbase="8aHe3nUv9Wo4";
      } */

    function __construct() {
        //parent::__construct();
        $this->CI = & get_instance();
        $this->CI->load->library(array('session', 'pagination'));
        @$kbase = "8aHe3nUv9Wo4";
    }

    function get_menu() {
        $user = $this->CI->session->userdata('id_user');
        $menu = $this->CI->model_menu->get_menu_utama($user);
        return $menu;
    }

    function Encode($data) {
        $a = '';
        $j = '';
        $Zcrypt = '';
        $pwd = 'abdurrasyidihsanhidayat';
        $pwd_length = strlen($pwd);
        for ($i = 0; $i < 255; $i++) {
            $key[$i] = ord(substr($pwd, ($i % $pwd_length) + 1, 1));
            $counter[$i] = $i;
        }
        /* for ($i = 0; $i < 255; $i++) {
          $x = ($x + $counter[$i] + $key[$i]) % 256;
          $temp_swap = $counter[$i];
          $counter[$i] = $counter[$x];
          $counter[$x] = $temp_swap;
          } */
        for ($i = 0; $i < strlen($data); $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $counter[$a]) % 256;
            $temp = $counter[$a];
            $counter[$a] = $counter[$j];
            $counter[$j] = $temp;
            $k = $counter[(($counter[$a] + $counter[$j]) % 256)];
            $Zcipher = ord(substr($data, $i, 1)) ^ $k;
            $Zcrypt .= chr($Zcipher);
        }
        return $Zcrypt;
    }

    function hex2bin($hexdata) {
        $bindata = '';
        for ($i = 0; $i < strlen($hexdata); $i += 2) {
            $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }
        return $bindata;
    }

    function MySqlDateFormat($date) {
        if (!empty($date) && $date != '-') {
            list($d, $m, $y) = explode('-', $date);
            return "$y-$m-$d";
        } else {
            return "0000-00-00";
        }
    }

    function MySqlDateFormat2($date) {
        if (!empty($date) && $date != '-' && $date != '0') {
            list($m, $d, $y) = explode('/', $date);
            return "$y-$m-$d";
        } else {
            return "0000-00-00";
        }
    }

    function MySqlDateFormatImport($tanggal) {
        list($hari, $bulan, $tahun) = explode("/", $tanggal, 0);
        return "$tahun-$bulan-$hari";
    }

    function RegularDateFormat($date) {
        if (!empty($date) && $date != '-' && $date != '0') {
            list($y, $m, $d) = explode('-', $date);
            return "$d-$m-$y";
        } else {
            return "00-00-0000";
        }
    }

    function RegularDateFormatLong($date) {
        if (!empty($date) && $date != '-' && $date != '0') {
            list($y, $m, $d) = explode('-', $date);
            $tanggal = $d . " " . $this->bulanV($date) . " " . $y;
            return $tanggal;
        } else {
            return "-";
        }
    }

    function RegularDateTime($datetime) {
        if (!empty($datetime) && $datetime != '-' && $datetime != '0') {
            list($d, $t) = explode(' ', $datetime);
            $tgl = $this->RegularDateFormat($d);
            return "$tgl $t";
        } else {
            return "00-00-0000 00:00:00";
        }
    }

    function hari2($in) {
        $tgl = substr($in, 8, 2);
        $bln = substr($in, 5, 2);
        $thn = substr($in, 0, 4);
        $stamp = mktime(0, 0, 0, $bln, $tgl, $thn);
        $input = date('D', $stamp);
        if ($input == 'Sun') {
            $output = 'Minggu';
        }
        if ($input == 'Mon') {
            $output = 'Senin';
        }
        if ($input == 'Tue') {
            $output = 'Selasa';
        }
        if ($input == 'Wed') {
            $output = 'Rabu';
        }
        if ($input == 'Thu') {
            $output = 'Kamis';
        }
        if ($input == 'Fri') {
            $output = 'Jumat';
        }
        if ($input == 'Sat') {
            $output = 'Sabtu';
        }
        return $output;
    }

    function bulanV($bulan) {
        $bulan = date("m", strtotime($bulan));
        if ($bulan == '1' || $bulan == '01') {
            $output = 'Januari';
        }
        if ($bulan == '2' || $bulan == '02') {
            $output = 'Februari';
        }
        if ($bulan == '3' || $bulan == '03') {
            $output = 'Maret';
        }
        if ($bulan == '4' || $bulan == '04') {
            $output = 'April';
        }
        if ($bulan == '5' || $bulan == '05') {
            $output = 'Mei';
        }
        if ($bulan == '6' || $bulan == '06') {
            $output = 'Juni';
        }
        if ($bulan == '7' || $bulan == '07') {
            $output = 'Juli';
        }
        if ($bulan == '8' || $bulan == '08') {
            $output = 'Agustus';
        }
        if ($bulan == '9' || $bulan == '09') {
            $output = 'September';
        }
        if ($bulan == '10') {
            $output = 'Oktober';
        }
        if ($bulan == '11') {
            $output = 'Nopember';
        }
        if ($bulan == '12') {
            $output = 'Desember';
        }
        return $output;
    }

    function romawibulan($bulan) {
        $bulan = date("m", strtotime($bulan));
        if ($bulan == '1' || $bulan == '01') {
            $output = 'I';
        }
        if ($bulan == '2' || $bulan == '02') {
            $output = 'II';
        }
        if ($bulan == '3' || $bulan == '03') {
            $output = 'III';
        }
        if ($bulan == '4' || $bulan == '04') {
            $output = 'IV';
        }
        if ($bulan == '5' || $bulan == '05') {
            $output = 'V';
        }
        if ($bulan == '6' || $bulan == '06') {
            $output = 'VI';
        }
        if ($bulan == '7' || $bulan == '07') {
            $output = 'VII';
        }
        if ($bulan == '8' || $bulan == '08') {
            $output = 'VII';
        }
        if ($bulan == '9' || $bulan == '09') {
            $output = 'IX';
        }
        if ($bulan == '10') {
            $output = 'X';
        }
        if ($bulan == '11') {
            $output = 'XI';
        }
        if ($bulan == '12') {
            $output = 'XII';
        }
        return $output;
    }

    function hari() {
        $input = date('D');
        if ($input == 'Sun') {
            $output = 'Minggu';
        }
        if ($input == 'Mon') {
            $output = 'Senin';
        }
        if ($input == 'Tue') {
            $output = 'Selasa';
        }
        if ($input == 'Wed') {
            $output = 'Rabu';
        }
        if ($input == 'Thu') {
            $output = 'Kamis';
        }
        if ($input == 'Fri') {
            $output = 'Jumat';
        }
        if ($input == 'Sat') {
            $output = 'Sabtu';
        }
        return $output;
    }

    function hari4($input) {
        if ($input == 'Sun') {
            $output = 'Minggu';
        }
        if ($input == 'Mon') {
            $output = 'Senin';
        }
        if ($input == 'Tue') {
            $output = 'Selasa';
        }
        if ($input == 'Wed') {
            $output = 'Rabu';
        }
        if ($input == 'Thu') {
            $output = 'Kamis';
        }
        if ($input == 'Fri') {
            $output = 'Jumat';
        }
        if ($input == 'Sat') {
            $output = 'Sabtu';
        }
        return $output;
    }

    function hari3($i) {
        if ($i == 7) {
            $output = 'Minggu';
        }
        if ($i == 1) {
            $output = 'Senin';
        }
        if ($i == 2) {
            $output = 'Selasa';
        }
        if ($i == 3) {
            $output = 'Rabu';
        }
        if ($i == 4) {
            $output = 'Kamis';
        }
        if ($i == 5) {
            $output = 'Jumat';
        }
        if ($i == 6) {
            $output = 'Sabtu';
        }
        return $output;
    }

    function bulan() {
        $input = date('n');
        if ($input == '1') {
            $output = 'Januari';
        }
        if ($input == '2') {
            $output = 'Februari';
        }
        if ($input == '3') {
            $output = 'Maret';
        }
        if ($input == '4') {
            $output = 'April';
        }
        if ($input == '5') {
            $output = 'Mei';
        }
        if ($input == '6') {
            $output = 'Juni';
        }
        if ($input == '7') {
            $output = 'Juli';
        }
        if ($input == '8') {
            $output = 'Agustus';
        }
        if ($input == '9') {
            $output = 'September';
        }
        if ($input == '10') {
            $output = 'Oktober';
        }
        if ($input == '11') {
            $output = 'November';
        }
        if ($input == '12') {
            $output = 'Desember';
        }
        return $output;
    }

    function bulan2($rrr) {
        if ($rrr == '1' || $rrr == '01') {
            $ttt = 'Januari';
        }
        if ($rrr == '2' || $rrr == '02') {
            $ttt = 'Februari';
        }
        if ($rrr == '3' || $rrr == '03') {
            $ttt = 'Maret';
        }
        if ($rrr == '4' || $rrr == '04') {
            $ttt = 'April';
        }
        if ($rrr == '5' || $rrr == '05') {
            $ttt = 'Mei';
        }
        if ($rrr == '6' || $rrr == '06') {
            $ttt = 'Juni';
        }
        if ($rrr == '7' || $rrr == '07') {
            $ttt = 'Juli';
        }
        if ($rrr == '8' || $rrr == '08') {
            $ttt = 'Agustus';
        }
        if ($rrr == '9' || $rrr == '09') {
            $ttt = 'September';
        }
        if ($rrr == '10') {
            $ttt = 'Oktober';
        }
        if ($rrr == '11') {
            $ttt = 'November';
        }
        if ($rrr == '12') {
            $ttt = 'Desember';
        }
        return $ttt;
    }

    function bulan3($rrr) {
        if ($rrr == '1' || $rrr == '01') {
            $ttt = 'Jan';
        }
        if ($rrr == '2' || $rrr == '02') {
            $ttt = 'Feb';
        }
        if ($rrr == '3' || $rrr == '03') {
            $ttt = 'Mar';
        }
        if ($rrr == '4' || $rrr == '04') {
            $ttt = 'Apr';
        }
        if ($rrr == '5' || $rrr == '05') {
            $ttt = 'Mei';
        }
        if ($rrr == '6' || $rrr == '06') {
            $ttt = 'Jun';
        }
        if ($rrr == '7' || $rrr == '07') {
            $ttt = 'Jul';
        }
        if ($rrr == '8' || $rrr == '08') {
            $ttt = 'Ags';
        }
        if ($rrr == '9' || $rrr == '09') {
            $ttt = 'Sep';
        }
        if ($rrr == '10') {
            $ttt = 'Okt';
        }
        if ($rrr == '11') {
            $ttt = 'Nop';
        }
        if ($rrr == '12') {
            $ttt = 'Des';
        }
        return $ttt;
    }

    function bulan4($eng) {
        $input = $eng;
        if ($input == 'January') {
            $output = 'Januari';
        }
        if ($input == 'February') {
            $output = 'Februari';
        }
        if ($input == 'March') {
            $output = 'Maret';
        }
        if ($input == 'April') {
            $output = 'April';
        }
        if ($input == 'May') {
            $output = 'Mei';
        }
        if ($input == 'June') {
            $output = 'Juni';
        }
        if ($input == 'July') {
            $output = 'Juli';
        }
        if ($input == 'August') {
            $output = 'Agustus';
        }
        if ($input == 'September') {
            $output = 'September';
        }
        if ($input == 'October') {
            $output = 'Oktober';
        }
        if ($input == 'November') {
            $output = 'November';
        }
        if ($input == 'December') {
            $output = 'Desember';
        }
        return $output;
    }

    function optTahun($r, $v = null) {
        $now_ = date('Y');
        $opt_tahun = '';
        for ($i = ($now_ - $r); $i <= ($now_ + $r); $i++) {
            if ($i == $v)
                $opt_tahun .= '<option value="' . $i . '" selected>' . $i . '</option>';
            else
                $opt_tahun .= '<option value="' . $i . '">' . $i . '</option>';
        }
        return $opt_tahun;
    }

    function optBulan($v = null) {
        $opt_bulan = '';
        for ($i = 1; $i <= 12; $i++) {
            if ($i == $v)
                $opt_bulan .= '<option value="' . $i . '" selected>' . $this->bulan2($i) . '</option>';
            else
                $opt_bulan .= '<option value="' . $i . '">' . $this->bulan2($i) . '</option>';
        }
        return $opt_bulan;
    }

    function optHari($v = null) {
        $opt_hari = '';
        for ($i = 1; $i <= 7; $i++) {
            if ($i == $v)
                $opt_hari .= '<option value="' . $i . '" selected>' . $this->hari3($i) . '</option>';
            else
                $opt_hari .= '<option value="' . $i . '">' . $this->hari3($i) . '</option>';
        }
        return $opt_hari;
    }

    function lastDate($bulan) {
        $lastdate = strftime("%d", mktime(0, 0, 0, ($bulan + 1), 0, date('Y')));
        return $lastdate;
    }

    function pecah($uang, $delimiter = '.') {
        if ($uang == '' || $uang == 0) {
            $rupiah = '0';
            return $rupiah;
        }
        $neg = false;
        if ($uang < 0) {
            $neg = true;
            $uang = abs($uang);
        }
        $rupiah = number_format($uang, 0, ',', $delimiter);
        if ($neg) {
            $rupiah = '(' . $rupiah . ')';
        }
        return $rupiah;
    }

    function hurufDepanKapital($nama) {
        $namana = ucwords(strtolower($nama));
        return $namana;
    }

    function hurufkapital($teks) {
        $namana = strtoupper($teks);
        return $namana;
    }

    function catat($kegiatan, $awal = '', $isData = false) {
        $this->CI->load->database('default', true);
        if ($isData) {
            $gab = '';
            foreach ($kegiatan as $key => $val):
                if ($val == '') {
                    $val = 'kosong';
                }
                $keg = '<li><b>' . $key . '</b> dengan value <b>' . $val . '</b></li>';
                $gab = $gab . $keg;
            endforeach;
            $str = $awal . '<br />
    			<ul>' . $gab . '</ul>';
        } else {
            $str = $kegiatan;
        }
        $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        //$ip_name = gethostbyaddr ( $ip );//masuk ke server
        //$ip = $this->CI->session->userdata('ipaddress');    
        //$ip_name = $ip;//masuk ke server
        $waktu = date('Y-m-d H:i:s');
        $creator = $this->CI->session->userdata('username');
        if ($creator == '') {
            $creator = 'Guest';
        }
        //catat ke log
        $this->CI->db->insert('catatan', array('ip' => $ip,
            'user' => $creator,
            'kegiatan' => $str,
            'waktu' => $waktu));
    }

    function getPagination($total_page, $per_page, $url, $uri = 3) {
        $config['base_url'] = base_url() . '/' . $url;
        $config['full_tag_open'] = '<div class=paging>';
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<span class=pag_link_cur>';
        $config['cur_tag_close'] = '</span>';
        $config['num_tag_open'] = '<span class=pag_link>';
        $config['num_tag_close'] = '</span>';
        $config['uri_segment'] = $uri;
        $config['next_link'] = 'next &rsaquo;';
        $config['prev_link'] = '&lsaquo; prev';
        $config['num_links'] = 3;
        $config['total_rows'] = $total_page;
        $config['per_page'] = $per_page;
        $this->CI->pagination->initialize($config);
        $data['paging'] = $this->CI->pagination->create_links();
        return $data;
    }

    public function getMaxId($iduser, $date, $kode = '') {
        $this->CI->load->database('default', true);
        $sql = "SELECT MAX(CONVERT(nourut,SIGNED)) AS id FROM (`transaksi`) WHERE ucreate = '$iduser' and tanggal ='$date'";
        $last = $this->CI->db->query($sql)->result();
        $idlast = $last[0]->id + 1;
        for ($i = strlen($idlast); $i < 4; $i++)
            $kode .= '0';
        return $kode . $idlast;
        //return $last[0]->id+1;
    }

    function noTransaksi($iduser, $maxid, $tgl) {
        $date = date_create($tgl);
        $tglna = date_format($date, "dmY");
        return $iduser . "." . $maxid . "." . $tglna;
    }

    public function diffInMonths($date1, $date2) {
        $timeStart = strtotime($date1);
        $timeEnd = strtotime($date2);
        // Adding current month + all months in each passed year
        $numMonths = 1 + (date("Y", $timeEnd) - date("Y", $timeStart)) * 12;
        // Add/subtract month difference
        $numMonths += date("m", $timeEnd) - date("m", $timeStart);
        return (int) round($numMonths);
    }

    function terbilang($x, $style = 4) {
        if ($x < 0) {
            $hasil = "minus " . trim($this->kekata($x)) . " rupiah";
        } else {
            $hasil = trim($this->kekata($x)) . " rupiah";
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
        return $hasil;
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

    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    function CreateTextFile($var, $File) {
        if (file_exists($File)) {
            unlink($File);
        }
        $fCreate = fopen($File, "w");
        $fWrite = fputs($fCreate, $var);
        $fClose = fclose($fCreate);
    }

    function WriteText($Parameter, $Panjang, $Align) {
        $Jarak = "";
        $Karakter = strlen($Parameter);
        $Result = ($Panjang - $Karakter);
        if ($Align == 'L') {
            for ($i = 0; $i < $Result; $i++) {
                $Jarak .= ' ';
            }
            return $Parameter . $Jarak;
        }
        if ($Align == 'C') {
            $Hasil = ceil($Panjang / 2);
            $HasilAkhir = ceil($Hasil - ($Karakter / 2));
            for ($i = 0; $i < $Panjang; $i++) {
                if ($i == ($HasilAkhir - 1)) {
                    $Jarak .= $Parameter;
                    $i = $i + ($Karakter);
                }
                $Jarak .= ' ';
            }
            return $Jarak;
        }
        if ($Align == 'R') {
            for ($i = 0; $i < $Panjang; $i++) {
                if ($i == $Result) {
                    return substr($Jarak . $Parameter . '', 0, strlen($Jarak . $Parameter . ' '));
                    exit();
                }
                $Jarak .= ' ';
            }
            return $Jarak . ' ';
        }
    }

    function usia($date1, $date2) {
        $date1 = date_create($date1);
        $date2 = date_create($date2);
        $diff = date_diff($date1, $date2);
        return $diff->format("%Y Tahun %m bulan");
    }

    function usiatahun($date1, $date2) {
        $date1 = date_create($date1);
        $date2 = date_create($date2);
        $diff = date_diff($date1, $date2);
        return $diff->format("%Y");
    }

    function selisih($jam_masuk, $jam_keluar) {
        list($h, $m, $s) = explode(":", $jam_masuk);
        $dtAwal = mktime($h, $m, $s, "1", "1", "1");
        list($h, $m, $s) = explode(":", $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode(".", $totalmenit / 60);
        $sisamenit = ($totalmenit / 60) - $jam[0];
        $sisamenit2 = round($sisamenit * 60, 0);
        $jml_jam = round($jam[0], 0);
        return $jml_jam . " jam " . $sisamenit2 . " menit";
    }

}
