  <div class="container-fluid">
    <h1>Bienvenido de nuevo <?php echo $this->session->userdata('perfil'); ?></h1>
    <div class="panel panel-primary">
      <div class="panel-heading">Panel de administración</div>
      <div class="panel-body">
        Seleccione donde desea ir:
        <div class="form-group text-center">
          <div class="btn-group">
            <?php
              echo anchor('estudiantes', 'Estudiantes', 'class="btn btn-lg btn-warning"') . ' ';
              echo anchor('docentes', 'Docentes', 'class="btn btn-lg btn-info"') . ' ';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
