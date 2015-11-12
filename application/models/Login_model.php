<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
  
  public function __construct() {
    parent::__construct();
  }
  
  public function login_user($username, $password, $profile) {
    if($username == $this->config->item('adm_username') && $password == $this->config->item('adm_passwd')) {
      return (object) array(
            'ADM_ID' => 1
          , 'ADM_CORREO' => $this->config->item('adm_email')
          , 'ADM_NOMBRE' => $this->config->item('adm_username')
        );;
    } else {
      $this->db->where(($profile == 1) ? 'DOC_CORREO' : 'EST_CORREO', $username);
      $this->db->where(($profile == 1) ? 'DOC_PWD' : 'EST_PWD', $password);
      $query = $this->db->get(($profile == 1) ? 'tv_docente' : 'tv_estudiante');
      if($query->num_rows() == 1) {
        return $query->row();
      } else {
        $this->session->set_flashdata('usuario_incorrecto', 'Los datos introducidos son incorrectos');
        redirect(site_url('login'), 'refresh');
      } 
    }
  }
}
?>
