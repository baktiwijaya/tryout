<?PHP

/*
 * @author      : Ahmad Fauzi <info@ahmadfauzi.id>
 * Project Name : eviralo_be
 * Generated    : Oct 17, 2019 - 10:50:12 PM
 * Filename     : Phpmailer_library.php
 * Encoding     : UTF-8
 */

class Phpmailer_library {

    public function __construct() {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load() {
        require_once(APPPATH . "third_party/phpmailer/src/PHPMailer.php");
        require_once(APPPATH . "third_party/phpmailer/src/SMTP.php");

        $this->objMail = new PHPMailer\PHPMailer\PHPMailer();
        return $this->objMail;
    }

}
