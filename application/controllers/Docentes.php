<?php
class Docentes extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('docentes_model');
    if($this->session->userdata('is_admin') == false) { // 1: Admin
      redirect(site_url('login'));
    }
  }

  public function index() {
    $data['titulo'] = 'Lista de docentes';
    $data['docentes'] = $this->docentes_model->get_users();
    
    $this->load->template('docentes/index', $data);
  }
  
  public function view() {
    $id = $this->uri->segment(3);
  
    if (empty($id)) {
      show_404();
    }
    
    $data['titulo'] = 'Ver docente';
    $data['docentes'] = $this->docentes_model->get_users($id);
  
    $this->load->template('docentes/view', $data);
  }
  
  public function create() {
    $data['titulo'] = 'Crear docente';

    $this->form_validation->set_rules('id', 'Identificador', 'required|is_unique[tv_docente.DOC_ID]');
    $this->form_validation->set_rules('name', 'Nombre', 'required');
    $this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email|is_unique[tv_docente.DOC_CORREO]');
    $this->form_validation->set_rules('password', 'Contraseña', 'required');
    
    if (!$this->form_validation->run()) {
      $this->load->template('docentes/create', $data);
    } else {
      $this->docentes_model->set_users();
      redirect(base_url('docentes'));
    }
  }
  
  public function edit() {
    $id = $this->uri->segment(3);
  
    if (empty($id)) {
      show_404();
    }
    
    $data['titulo'] = 'Editar docente';
    $data['docentes'] = $this->docentes_model->get_users($id);
    $this->form_validation->set_rules('id', 'Identificador', 'required');
    $this->form_validation->set_rules('name', 'Nombre', 'required');
    $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
    
    if (!$this->form_validation->run()) {
      $this->load->template('docentes/edit', $data);
    } else {
      $this->docentes_model->set_users($id);
      redirect(base_url('docentes'));
    }    
  }
  
  public function delete() {
    $id = $this->uri->segment(3);

    if(empty($id)) {
      redirect(base_url('docentes'));
    }

    $this->docentes_model->delete_user($id);
    redirect(base_url('docentes'));
  }
  
}
