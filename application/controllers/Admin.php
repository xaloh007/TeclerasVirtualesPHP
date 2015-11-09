<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Admin extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
  }
  
  public function index() {
    if($this->session->userdata('profile') == false ||
      $this->session->userdata('profile') != 1) { // 1: Admin
      redirect(site_url('login'));
    }
    $data['titulo'] = 'Bienvenido Administrador';
    $this->load->template('admin_view', $data);
  }
}
