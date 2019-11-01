<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller {
#---------------------------------------    
# construction function
#---------------------------------------    

    public function __construct() {
        parent::__construct();
        // Load library and url helper
        $this->load->helper('url');
        // loading model
    }

#-----------------------------------

    public function index() {
        if ($this->session->userdata('session_id')) {
            redirect('admin/Dashboard');
        }
        $this->load->view('registration/index');
    }

    public function redirect() {
        $user_type = $this->session->userdata('user_type');
        if ($user_type == 1) {
            redirect("admin/News_post/user_interface");
        } else if ($user_type == 2) {
            redirect("admin/News_post/user_interface");
        } else if ($user_type == 3) {
            redirect("admin/News_post");
        } else {
            redirect('registration');
        }
    }

#-----------------------
    # pssword genaretor
#----------------------

    function randstrGen() {
        $result = "";
        $chars = "0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < 5; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

#------------------------------------
#   facebook login and registration
#------------------------------------    

    public function registration() {
        $this->form_validation->set_rules('name', 'Name ', 'required');
        $this->form_validation->set_rules('email', 'Email ', 'trim|required');
        $this->form_validation->set_rules('password', 'Password ', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
#---------------------
# website setting data   
            $data['home_page_positions'] = $this->wsm->home_category_position();
            $data['website_logo'] = $this->wsm->website_logo();
            $data['footer_logo'] = $this->wsm->footer_logo();
            $data['website_favicon'] = $this->wsm->website_favicon();
            $data['website_footer'] = $this->wsm->website_footer();
            $data['website_title'] = $this->wsm->website_title();
            $data['website_timezone'] = $this->wsm->website_timezone();
            $data['default_theme'] = $this->wsm->theme_data();
            $data['lan'] = $this->wsm->lan_data();
            $default_theme = $data['default_theme'];
#--------------------------
            $data['ln'] = $this->cm->latest_news();
            $data['bn'] = $this->cm->breaking_news();
            $data['social_link'] = $this->settings->get_previous_settings('settings', 111);
            $data['ads'] = $this->ads->SelectAds();
            $data['contact_page_setup'] = $this->settings->get_previous_settings('settings', 113);
            $data['Editor'] = $this->hm->home_data('Editor-Choice');
            $data['login_url'] = $this->googleplus->loginURL();
            $data['main_menu'] = $this->settings->main_menu();
            $data['menus'] = $this->settings->menu_position_3();
            $data['footer_menu'] = $this->settings->footer_menu();
            $this->load->view('themes/' . $default_theme . '/header', $data);
            $this->load->view("themes/" . $default_theme . "/breaking");
            $this->load->view('themes/' . $default_theme . '/menu');
            $this->load->view('themes/' . $default_theme . '/view_registration');
            $this->load->view('themes/' . $default_theme . '/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $check_status = $this->db->select('*')->from('user_info')->where('email', $email)->get()->row();
            if ($check_status) {
                $this->session->set_flashdata('exception', "You already registerd.");
            } else {
                $user_data = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'user_type' => 5,
                    'status' => 1,
                );
                $this->db->insert('user_info', $user_data);
                $this->session->set_flashdata('message', "Registration successfully.");
            }
            #-------------------------------
            #   email send to user email
            #-------------------------------
            $send_data = array(
                'to' => $email,
                'subject' => 'Registration',
                'message' => '<p>Hi! ' . $name . '</p> <p> Your Registration is Successfully <p> <p> Your Login email : ' . $email . '</p><p> Your Password : ' . $password . '</p>',
            );
            $send_email = $this->cm->send($send_data);
            #-------------------------------
            redirect('registration');
        }
    }

}
