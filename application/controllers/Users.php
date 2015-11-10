<?php
class Users extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('users_model');
    if($this->session->userdata('profile') == false ||
      $this->session->userdata('profile') != 1) { // 1: Admin
      redirect(site_url('login'));
    }
  }

  public function index() {
    $data['titulo'] = 'Lista de usuarios';
    $data['users'] = $this->users_model->get_users();
    
    $this->load->template('users/index', $data);
  }
  
  public function view() {
    $id = $this->uri->segment(3);
  
    if (empty($id)) {
      show_404();
    }
    
    $data['titulo'] = 'Ver un usuario';
    $data['users'] = $this->users_model->get_users($id);
  
    $this->load->template('users/view', $data);
  }
  
  public function create() {
    $data['titulo'] = 'Crear usuario';
    
    $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
    $this->form_validation->set_rules('password', 'Contraseña', 'required');
    $this->form_validation->set_rules('profile', 'Perfil', 'required');
    
    if (!$this->form_validation->run()) {
      $this->load->template('users/create', $data);
    } else {
      $this->users_model->set_users();
      redirect(base_url('users'));
    }
  }
  
  public function edit() {
    $id = $this->uri->segment(3);
  
    if (empty($id)) {
      show_404();
    }
    
    $data['titulo'] = 'Editar usuario';
    $data['users'] = $this->users_model->get_users($id);
    $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
    $this->form_validation->set_rules('profile', 'Perfil', 'required');
    
    if (!$this->form_validation->run()) {
      $this->load->template('users/edit', $data);
    } else {
      $this->users_model->set_users($id);
      redirect(base_url('users'));
    }    
  }
  
  public function delete() {
    $id = $this->uri->segment(3);

    if(empty($id)) {
      redirect(base_url('users'));
    }

    $this->users_model->delete_user($id);
    redirect(base_url('users'));
  }
  
}
