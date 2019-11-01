<?PHP

/*
 * @author      : Ahmad Fauzi <info@ahmadfauzi.id>
 * Project Name : eviralo_be
 * Generated    : Oct 17, 2019 - 10:51:16 PM
 * Filename     : Email.php
 * Encoding     : UTF-8
 */

class Email extends CI_Model {

    function kirim($ke, $sub, $mes, $prod = FALSE) {
        if ($this->Global_m->getKonfig('smtp_port') == '465') {
            $kripto = 'ssl';
            $auth = TRUE;
        } elseif ($this->Global_m->getKonfig('smtp_port') == '587') {
            $kripto = 'tls';
            $auth = TRUE;
        } else {
            $kripto = '';
            $auth = FALSE;
        }

        $this->load->library("phpmailer_library");
        $this->objMail = $this->phpmailer_library->load();

        try {
            if ($prod == TRUE) {
                $this->objMail->SMTPDebug = 0;
            } else {
                $this->objMail->SMTPDebug = $this->Global_m->getKonfig('smtp_debug');
            }
            $this->objMail->isSMTP();
            $this->objMail->Host = $this->Global_m->getKonfig('smtp_host');
            $this->objMail->SMTPAuth = $auth;
            $this->objMail->Username = $this->Global_m->getKonfig('smtp_user');
            $this->objMail->Password = $this->Global_m->getKonfig('smtp_pass');
            $this->objMail->SMTPSecure = $kripto;
            $this->objMail->Port = $this->Global_m->getKonfig('smtp_port');
            //Recipients
            $this->objMail->setFrom($this->Global_m->getKonfig('smtp_user'), $this->Global_m->getKonfig('smtp_sender'));
            $this->objMail->addAddress($ke);
            $this->objMail->isHTML(TRUE);
            $this->objMail->Subject = $sub;
            $this->objMail->Body = $mes;
            $this->objMail->AltBody = $mes;

            $this->objMail->send();

            if ($this->input->post('apaan') == 'tes') {
                redirect('pengaturan?tipe=1&pesan=Berhasil kirim test email!');
            } else {
                p_code("SEND_OK => $sub TO => $ke");
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->objMail->ErrorInfo;
        }
    }

}