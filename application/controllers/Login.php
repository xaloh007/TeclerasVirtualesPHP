<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
    //$this->load->library('session');
    $this->load->model('login_model');
    $this->load->database('default');
  }
  
  public function index() {
    global $config;
    switch ($this->session->userdata('profile')) {
      case '':
        $data['token'] = $this->token();
        $data['titulo'] = 'Login con roles de usuario en codeigniter';
        $this->load->template('login_view', $data);
        break;
      case 1: // Administrador
        redirect($config['base_url'] . 'admin');
        break;
      case 2: //Editor
        redirect($config['base_url'] . 'editor');
        break;  
      case 3: // Suscriptor
        redirect($config['base_url'] . 'suscriptor');
        break;
      default:    
        $data['titulo'] = 'Login con roles de usuario en codeigniter';
        $this->load->template('login_view', $data);
        break;    
    }
  }

  public function new_user() {
    if($this->input->post('token')
      && $this->input->post('token') == $this->session->userdata('token')) {
      $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
      $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]|max_length[150]|xss_clean');

      /*
       * Lanzar mensaje de error si es que hay
       */
            
      if($this->form_validation->run() == false) {
        $this->index();
      } else {
        $username = $this->input->post('username');
        $password = sha1($this->input->post('password'));
        $check_user = $this->login_model->login_user($username, $password);
        if($check_user == true) {
          $data = array(
            'is_logued_in'  =>  true,
            'id_user'       =>  $check_user->id,
            'profile'       =>  $check_user->profile,
            'username'      =>  $check_user->username
          );    
          $this->session->set_userdata($data);
          $this->index();
        }
      }
    } else {
      redirect(site_url('login'));
    }
  }
  
  public function token() {
    $token = md5(uniqid(rand(), true));
    $this->session->set_userdata('token', $token);
    return $token;
  }
  
  public function logout_ci() {
    $this->session->sess_destroy();
    $this->index();
  }
}
?>
