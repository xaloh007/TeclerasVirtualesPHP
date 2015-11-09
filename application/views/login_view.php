<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  $username = array('name' => 'username', 'placeholder' => 'Nombre de usuario', 'class' => 'form-control');
  $password = array('name' => 'password', 'placeholder' => 'Introduce tu contraseña', 'class' => 'form-control');
  $submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión', 'class' => 'btn btn-primary');
?>

  <div class="container">
    <?php if($this->session->flashdata('usuario_incorrecto')) { ?>
    <div class="alert alert-info" role="alert">
      <p><?php echo $this->session->flashdata('usuario_incorrecto'); ?></p>
    </div>
    <?php } ?>
    <h1>Acceso de usuario</h1>
    <?php echo form_open(site_url('login/new_user')); ?>
      <div class="form-group">
        <label for="username">Nombre de usuario:</label>
        <?php echo form_input($username); ?>
        <p><?php echo form_error('username'); ?></p>
      </div>
      <div class="form-group">
        <label for="password">Introduce tu contraseña:</label>
        <?php echo form_password($password); ?>
        <p><?php echo form_error('password'); ?></p>
        <?php echo form_hidden('token', $token); ?>
      </div>
      <div class="form-group">
        <?php echo form_submit($submit); ?>
      </div>
    <?php echo form_close(); ?>
  </div>

