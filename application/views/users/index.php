<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div style="position: relative; background-color: #fff; -webkit-background-clip: padding-box; background-clip: padding-box; border: 1px solid #999; border: 1px solid rgba(0,0,0,.2); border-radius: 6px; outline: 0;"> 
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Confirmar eliminación</h4>
        </div>
        <div class="modal-body">
            <p>Estás a punto de eliminar un usuario, este procedimiento es irreversible.</p>
            <p>¿Quieres continuar?</p>
            <p class="debug-url"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-danger btn-ok">Eliminar</a>
        </div>
      </div>
    </div>
</div>
<div class="container">
<h1>Lista de usuarios</h1>
    <?php echo anchor('users/create', 'Crear usuario', 'class="btn btn-success"'); ?>
    <div class="row">
      <div class="col-md-12">&nbsp;</div>
    </div>
<div class="panel panel-default">
  <div class="table-responsive">
    <table class="table table-hover">
    <thead>
    <tr>
      <th>#</th>
      <th>Username</th>
      <th>Profile</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <th class="scope"><?php echo $user['id'] ?></th>
          <td><?php echo $user['username'] ?></td>
          <td><?php echo $user['profile'] ?></td>
          <td><?php
            echo anchor('users/edit/' . $user['id'], 'Edit', 'class="btn btn-warning"') . ' ';
            echo anchor('users/view/' . $user['id'], 'View', 'class="btn btn-primary"') . ' ';
            echo anchor('', 'Delete', 'class="btn btn-danger" data-href="' . base_url() . 'users/delete/' . $user['id'] . '" data-toggle="modal" data-target="#confirm-delete"');
          ?></td>
        </tr>
      </tbody>
      <?php endforeach ?>
    </table>
  </div>
</div>
</div>
<script type="text/javascript">
  $(document).on('ready', function() {
    $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
  });

</script>
