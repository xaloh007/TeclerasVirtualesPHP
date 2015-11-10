<?php
class Users_model extends CI_Model {

  public function get_users($id = 0) {
    if ($id === 0) {
      $query = $this->db->get('users');
      return $query->result_array();
    }
    
    $query = $this->db->get_where('users', array('id' => $id));
    return $query->row_array();
  }
  
  public function set_users($id = 0) {
    
    $data = array(
      'username' => $this->input->post('username'),
      'password' => sha1($this->input->post('password')),
      'profile' => $this->input->post('profile'),
    );
    
    if ($id === 0) {
      return $this->db->insert('users', $data);
    } else {
      $this->db->where('id', $id);
      return $this->db->update('users', $data);
    }
  }

  public function delete_user($id = 0) {
    if($id == 0) {
      redirect(base_url('users'));
    }

    $this->db->where('id', $id);
    $this->db->delete('users');
    redirect(base_url('users'));
  }
}
