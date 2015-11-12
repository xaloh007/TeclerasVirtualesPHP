<?php
class Docentes_model extends CI_Model {

  public function get_users($id = 0) {
    if ($id === 0) {
      $query = $this->db->get('tv_docente');
      return $query->result_array();
    }
    
    $query = $this->db->get_where('tv_docente', array('DOC_ID' => $id));
    return $query->row_array();
  }
  
  public function set_users($id = 0) {
    
    $data = array(
      'DOC_ID' => $this->input->post('id'),
      'DOC_NOMBRE' => $this->input->post('name'),
      'DOC_CORREO' => $this->input->post('email'),
      'DOC_PWD' => sha1($this->input->post('password')),
    );
    
    if ($id === 0) {
      return $this->db->insert('tv_docente', $data);
    } else {
      $this->db->where('DOC_ID', $id);
      return $this->db->update('tv_docente', $data);
    }
  }

  public function delete_user($id = 0) {
    if($id == 0) {
      redirect(base_url('docentes'));
    }

    $this->db->where('DOC_ID', $id);
    $this->db->delete('tv_docente');
    redirect(base_url('docentes'));
  }
}
