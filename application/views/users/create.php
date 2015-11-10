<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Inputs */
$username = array('name' => 'username', 'placeholder' => 'Nombre de usuario', 'class' => 'form-control', 'value' => '');
$password = array('name' => 'password', 'placeholder' => 'Contraseña', 'class' => 'form-control', 'value' => '');
$profile = array(
    '' => 'Seleccionar perfil'
  ,  1 => 'Administrador'
  , 2 => 'Usuario normal'
  );
$submit = array('type' => 'submit', 'content' => 'Crear', 'class' => 'btn btn-success');

?>
<div class="row">
  <h2>Crear usuario</h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <?php 
        echo validation_errors();
        echo form_open('users/create', array('autocomplete' => 'off'));
      ?>
      <div class="input-group">
        <?php
        /*
         * Nombre de usuario
         */
        echo form_label('Nombre de usuario', 'username');
        echo form_input($username);
        ?>
      </div>
      <div class="input-group">
        <?php
        /*
         * Contraseña
         */
        echo form_label('Contraseña', 'password');
        echo form_password($password);
        ?>
      </div>
      <div class="input-group">
        <?php
        /*
         * Perfil de usuario
         */
        echo form_label('Perfil de usuario', 'profile');
        echo form_dropdown('profile', $profile, '', 'class="form-control"');
        ?>
      </div>
      <hr />
        <?php
        /*
         * Boton crear
         */
        echo form_button($submit);
        ?>
    <?php
    echo form_close();
    ?>
    </div>
  </div>
</div>
