<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller {
#---------------------------------------    
# construction function
#---------------------------------------    

    public function __construct() {
        parent::__construct();
        // Load library and url helper
        $this->load->helper('url');
        $this->load->model('Auth_model', 'auth');
        // loading model
    }

#-----------------------------------

    public function keluar() {
        $id = $this->session->userdata('id');
        $active = $this->Global_m->getvalue('is_login','user_info','id',$id);
        $data['is_login'] = 0;
        if($active == 1) {
            $update = $this->Crud_m->edit('user_info',$data,'id',$id);
            if($update) {
                $this->session->sess_destroy();
                redirect();
            }
        }
        
    }

    public function login() {
        $data = array(
            'email' => ($this->input->post('email', TRUE)),
            'password' => ($this->input->post('password', TRUE))
        );
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            // $this->session->set_flashdata('exception', display('log_error_msg'));
            redirect('Registration/index');
        } else {
            $query = $this->db->select('*')
                    ->from('user_info')
                    ->where('email', trim($data['email']))
                    ->where('password', md5($data['password']))
                    ->where('user_type', 5)
                    ->where('status', 1)
                    ->get();
            if ($query->num_rows() > 0) {
                $data = $query->row_array();
                $session_data = array(
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'pen_name' => $data['pen_name'],
                    'user_type' => $data['user_type'],
                    'email' => $data['email'],
                    'session_id' => session_id(),
                    'logged_in' => TRUE,

                );
                $this->session->set_userdata($session_data);
                redirect(base_url());
            } else {
                $this->session->set_flashdata('exception', 'Email atau Password Salah !');
                redirect('Registration/index');
            }
        }
    }

    public function check_user() {
        $data = array(
            'email' => ($this->input->post('email', TRUE)),
            'password' => ($this->input->post('password', TRUE))
        );
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            // $sdata['exception'] = display('log_error_msg');
            $this->session->set_flashdata('exception', 'Email atau Password Salah !');
            // $this->session->set_userdata($sdata);
            redirect('Registration/index');
        } else {


            $data = $this->auth->user_login($data);
            if ($data) {

                $active = $this->Global_m->getvalue('is_login','user_info','id',$data['id']);
                if($active == 1) {
                    $this->session->set_flashdata('exception', 'User sedang login di tempat lain !');
                    redirect('Registration/index');
                } else {
                    $session_data = array(
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'user_type' => $data['user_type'],
                        'email' => $data['email'],
                        'session_id' => session_id(),
                        'logged_in' => TRUE,
                    );

                    $data2['is_login'] = 1;

                    $update = $this->Crud_m->edit('user_info',$data2,'id',$data['id']);
                    if($update) {
                        $this->session->set_userdata($session_data);
                        if ($data['user_type'] == 1) {
                            redirect("admin/dashboard");
                        } else if ($data['user_type'] == 4) {
                            redirect("admin/penalaran");
                        } else if ($data['user_type'] == 5) {
                            redirect("admin/transaksicoin");
                        } else if ($data['user_type'] == 3) {
                            redirect("user/dashboard");
                        } else {
                            redirect('Registration/index');
                        }
                    }
                }
                
            } else {
                // $sdata['exception'] = display('log_error_msg');
                $this->session->set_flashdata('exception', 'Email atau Password Salah !');
                // $this->session->set_userdata($sdata);
                redirect('Registration/index');
            }
        }
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

    public function facebook_login() {
        $data['user'] = array();
        // Check if user is logged in
        if ($this->facebook->is_authenticated()) {
            // User logged in, get user details
            $user = $this->facebook->request('get', '/me?fields=id, name, email, about, age_range, birthday, cover, education, gender, hometown, languages, relationship_status, religion, photos, picture');
            if (!isset($user['error'])) {
                $data['user'] = $user;
            }
        }

        $check_status = $this->db->select('*')->from('user_info')->where('email', $user['email'])->get()->row();
        if ($check_status) {
            $session_data = array(
                'id' => $check_status->id,
                'name' => $check_status->name,
                'pen_name' => $check_status->pen_name,
                'user_type' => $check_status->user_type,
                'email' => $check_status->email,
                'session_id' => session_id(),
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            if ($check_status->user_type == 1) {
                redirect("admin/News_post/user_interface");
            } else if ($check_status->user_type == 2) {
                redirect("admin/News_post/user_interface");
            } else if ($check_status->user_type == 3) {
                redirect("admin/News_post");
            } else if ($check_status->user_type == 4) {
                redirect("admin/News_post");
            } else {
                redirect(base_url());
            }
        } else {
            $password = $this->randstrGen();
            $user_data = array(
                'name' => $user['name'],
                'pen_name' => $user['name'],
                'email' => $user['email'],
                'password' => md5($password),
                'user_type' => 5
            );
            $this->db->insert('user_info', $user_data);
            #----------------------------
            $sdata = $this->db->select('*')->from('user_info')->where('email', $user['email'])->get()->row();
            $session_data = array(
                'id' => $sdata->id,
                'name' => $sdata->name,
                'pen_name' => $sdata->pen_name,
                'user_type' => $sdata->user_type,
                'email' => $sdata->email,
                'session_id' => session_id(),
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            #------------------------------
            $data = array(
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $password
            );
        }
#-------------------------------------
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
#--------------------------------------
        $data['ln'] = $this->cm->latest_news();
        $data['bn'] = $this->cm->breaking_news();
        $data['social_link'] = $this->settings->get_previous_settings('settings', 111);
        $data['ads'] = $this->ads->SelectAds();
        $data['contact_page_setup'] = $this->settings->get_previous_settings('settings', 113);
        $data['Editor'] = $this->hm->home_data('Editor-Choice');
        $data['main_menu'] = $this->settings->main_menu();
        $data['menus'] = $this->settings->menu_position_3();
        $data['footer_menu'] = $this->settings->footer_menu();

        $this->load->view('themes/' . $default_theme . '/header', $data);
        $this->load->view("themes/" . $default_theme . "/breaking");
        $this->load->view('themes/' . $default_theme . '/menu');
        $this->load->view('themes/' . $default_theme . '/view_fb_registration');
        $this->load->view('themes/' . $default_theme . '/footer');
    }

#----------------------------------------
#       google registration and login
#----------------------------------------    

    public function googl_login() {
        // Check if user is logged in
        if ($this->googleplus->getAuthenticate()) {
            $data = $this->googleplus->getUserInfo();
        }
        $check_status = $this->db->select('*')->from('user_info')->where('email', $data['email'])->get()->row();
        if ($check_status) {
            $session_data = array(
                'id' => $check_status->id,
                'name' => $check_status->name,
                'pen_name' => $check_status->pen_name,
                'user_type' => $check_status->user_type,
                'email' => $check_status->email,
                'session_id' => session_id(),
                'logged_in' => TRUE
            );

            $this->session->set_userdata($session_data);
            if ($check_status->user_type == 1) {
                redirect("admin/News_post/user_interface");
            } else if ($check_status->user_type == 2) {
                redirect("admin/News_post/user_interface");
            } else if ($check_status->user_type == 3) {
                redirect("admin/News_post");
            } else if ($check_status->user_type == 4) {
                redirect("admin/News_post");
            } else {
                redirect(base_url());
            }
        } else {
            $password = $this->randstrGen();
            $register_data = array(
                'name' => $data['name'],
                'email' => $data['email'],
                'pen_name' => $data['given_name'],
                'user_type' => 5,
                'password' => md5($password)
            );
            $this->db->insert('user_info', $register_data);
            @$sdata = $this->db->select('*')->from('user_info')->where('email', $data['email'])->get()->row();
            $session_data = array(
                'id' => $sdata->id,
                'name' => $sdata->name,
                'pen_name' => $sdata->pen_name,
                'user_type' => $sdata->user_type,
                'email' => $sdata->email,
                'session_id' => session_id(),
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            $data = array(
                'name' => $data['name'],
                'email' => $data['email'],
                'pen_name' => $data['given_name'],
                'user_type' => 5,
                'password' => $password
            );
#-------------------------------------
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
#--------------------------------------
            $data['ln'] = $this->cm->latest_news();
            $data['bn'] = $this->cm->breaking_news();
            $data['social_link'] = $this->settings->get_previous_settings('settings', 111);
            $data['ads'] = $this->ads->SelectAds();
            $data['contact_page_setup'] = $this->settings->get_previous_settings('settings', 113);
            $data['Editor'] = $this->hm->home_data('Editor-Choice');
            $data['main_menu'] = $this->settings->main_menu();
            $data['menus'] = $this->settings->menu_position_3();
            $data['footer_menu'] = $this->settings->footer_menu();
            $this->load->view('themes/' . $default_theme . '/header', $data);
            $this->load->view("themes/" . $default_theme . "/breaking");
            $this->load->view('themes/' . $default_theme . '/menu');
            $this->load->view('themes/' . $default_theme . '/view_fb_registration');
            $this->load->view('themes/' . $default_theme . '/footer');
        }
    }

#------------------------------
# ContactUs
#-------------------------------

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
                    'user_type' => 5
                );
                $this->db->insert('user_info', $user_data);
                $this->session->set_flashdata('message', "Registration successfully.");
            }
            redirect('registration');
        }
    }

    function signup() {
        $this->load->view('registration/signup');
    }

    public function save() {
        extract($_POST);
        $check_status = $this->Global_m->isExists('email', $email, 'user_info');
        if ($check_status) {
            $this->session->set_flashdata('exception', "Username telah terdaftar !.");
            redirect('Authentication/signup');
        } else {
            if ($email == '' || $password == '') {
                $message = array(false, 'Proses Gagal!', 'Informasi tidak boleh kosong !');
            } else {
                    $data = array(
                        'nama_lengkap' => $nama_lengkap,
                        'email' => $email,
                        'password' => md5($password),
                        'user_type' => 3,
                        'status' => 1
                    );
                $add = $this->Crud_m->add('user_info', $data);
                if ($add) {
                    $this->session->set_flashdata('message', "Proses Daftar Berhasil. Silahkan login.");
                    redirect('Registration/index');
                } else {
                    $this->session->set_flashdata('message', "Proses daftar gagal.");
                    redirect('signup');
                }
            }
        }
    }


}
