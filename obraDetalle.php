<?php require_once('./controller/Obra.php'); ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Dinámicas Blandas</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<!-- Css Styles... -->
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/fonts.css">

		<!-- Script -->
		<script src="./assets/js/jquery.js" charset="utf-8"></script>
    <script src="./assets/js/bootstrap.min.js" charset="utf-8"></script>

    <script src="./assets/js/obraDetalle.js"></script>

</head>
	<body class="is-preload">
		<!-- Wrapper -->
    <div id="wrapper">

    <?php
      $obra = new Obra();
      $Response = [];
      $active = $obra->active;
    ?>

    <main role="main">
      <?php require('./navLogin.php'); ?>
      <br/>
      <div class="container">

        <!-- Título -->
        <div class="row">
          <div class="col-sm-12">
            <h2>Administración Detalle de Obra</h2>
            <div id='status' name='status' class="row"></div>
          </div>
        </div>

        <div class="card col-sm-12 mt-3">
          <!-- Detalle Temporada -->
          <div class="row">
            <div class="col-sm-12">
              <h3 class="modal-title" id="lbl_detail" style="color: darkblue;">Crear</h3>
              <hr>
            </div>
            <div class="col-sm-12">
              <div id="estatus"></div>
              <form id="form_general">
                <div class="form-group row">
                  <label for="desc_obra" class="col-sm-1 col-form-label">Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc_obra" required>
                    <small id='hlpNombreNOK' class="no_valido_gral" style='color:red;'>y mi nombre? :(</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_status" class="col-sm-1 col-form-label">Estatus</label>
                  <div class="col-sm-4">
                    <select id="id_status" class="form-control">
                      <option value=0 selected>Seleccione estatus...</option>
                      <option value=1>Activo</option>
                      <option value=2>Inactivo</option>
                    </select>
                    <small id="hlpEstatusNOK" class="no_valido_gral" style='color:red;'>wey mi estatus! :(</small>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- General Escenas-Obra -->
          <div class="row">
  
            <div class="col-sm-12 my-3">
              <!-- Add Button--> 
              <button type="button" class="btn btn-primary escenas" id="btn_add">Crear Escena</button>
            </div>
            <br>
            <div class="col-sm-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">Escena</td>
                    <th class="text-center">Orden</td>
                    <th class="text-center"> Edit </td>
                    <th class="text-center"> Delete </td>
                  </tr>
                </thead>
                <tbody id="table"></tbody>
              </table>
            </div>
        
          </div>
          <!-- Acciones -->
          <div class="row">

            <div class="col-sm-12 mb-3">
              <input type="text" id="id_obra">
              <input type="text" id="accion">
              <button type="button" class="btn btn-primary" id="btn_register">Guardar</button>
              <button type="button" class="btn btn-secondary" id="btn_close">Cancelar</button>
            </div>

          </div>          
        </div>

        <!-- Modal Save -->
        <div class="row">
          <div class="modal fade" id="detail_modal" tabindex="-1" aria-labelledby="lbl_detail_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="lbl_detail_modal">Crear</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="message"></div>
                  <form id="form_detalle">
                  <div class="form-group row">
                      <label for="id_escena" class="col-sm-2 col-form-label">Escena</label>
                      <div class="col-sm-10">
                        <select id="id_escena" class="form-control"></select>
                        <small id="hlpEscenaNOK" class="no_valido" style='color:red;'>... y mi escena? :(</small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="id_status" class="col-sm-2 col-form-label">Orden</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" id="orden" required>
                        <small id="hlpOrdenNOK" class="no_valido" style='color:red;'>wey mi orden! :(</small>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <input type="hidden" id="modal_accion">
                  <input type="hidden" id="id_escena_llave">
                  <button type="button" class="btn btn-primary" id="btn_register_detail">Guardar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close_detail">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Delete -->
        <div class="row">

          <div class="modal" id="delete">
            <div class="modal-dialog modal-dialog-centered modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <p> ¿Quieres eliminar esta escena?</p>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-footer">                   
                  <button type="button" class="btn btn-primary" id="btn_delete_record">Eliminar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close_detail">Cancelar</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
	</body>
</html>