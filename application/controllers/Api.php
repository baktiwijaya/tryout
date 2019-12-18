<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function get_dashboard() {

        $data['response'] = 200;
        $data['data'] = array('return' => 'OK');
        echo json_encode($data);
    }

    public function register() {

        $data['token'] = $this->input->post('token');
        $data['nama'] = $this->input->post('nama');
        $data['whatsapp'] = $this->input->post('whatsapp');
        $data['email'] = $this->input->post('email');
        $data['username'] = $this->input->post('username');
    }

}
