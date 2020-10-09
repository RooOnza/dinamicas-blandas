<?php require_once('./controller/Temporada.php'); ?>

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

    <script src="./assets/js/temporadaDetalle.js"></script>

</head>
	<body class="is-preload">
		<!-- Wrapper -->
    <div id="wrapper">

    <?php
      $tempo = new Temporada();
      $Response = [];
      $active = $tempo->active;
    ?>

    <main role="main">
      <?php require('./navLogin.php'); ?>
      <br/>
      <div class="container">

        <!-- Título -->
        <div class="row">
          <div class="col-sm-12">
            <h2>Administración Detalle de Temporada</h2>
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
                  <label for="desc_temporada" class="col-sm-1 col-form-label">Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc_temporada" required>
                    <small id='hlpNombreNOK' class="no_valido_gral" style='color:red;'>y mi nombre? :(</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_tipo" class="col-sm-1 col-form-label">Tipo</label>
                  <div class="col-sm-4">
                    <select id="id_tipo" class="form-control">
                      <option value=0 selected>Seleccione tipo...</option>
                      <option value=1>Abierta</option>
                      <option value=2>Cerrada</option>
                    </select>
                    <small id="hlpTipoNOK" class="no_valido_gral" style='color:red;'>wey mi tipo! :(</small>
                  </div>
                  <div class="col-sm-4" id='divPermanente'>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="permanente" value='1'>
                      <label class="form-check-label" for="permanente">Permanente</label>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- General Fechas-Temporada -->
          <div class="row">
  
            <div class="col-sm-12 my-3">
              <!-- Add Button--> 
              <button type="button" class="btn btn-primary fechas" id="btn_add">Crear Fecha</button>
            </div>
            <br>
            <div class="col-sm-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">Fecha</td>
                    <th class="text-center">Estatus</td>
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
              <input type="text" id="id_temporada" disabled>
              <input type="text" id="accion" disabled>
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
                      <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                      <div class="col-sm-5">
                        <input type="date" class="form-control" id="fecha" required>
                        <small id='hlpFechaNOK' class="no_valido" style='color:red;'>y mi fecha? :(</small>
                      </div>
                      <div class="col-sm-5">
                        <input type="time" class="form-control" id="hora" required>
                        <small id='hlpHoraNOK' class="no_valido" style='color:red;'>... tampoco mi hora? :(</small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="id_status" class="col-sm-2 col-form-label">Estatus</label>
                      <div class="col-sm-10">
                        <select id="id_status" class="form-control">
                          <option value=0 selected>Seleccione estatus...</option>
                          <option value=1>Activo</option>
                          <option value=2>Inactivo</option>
                        </select>
                        <small id="hlpEstatusNOK" class="no_valido" style='color:red;'>wey mi estatus! :(</small>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <input type="hidden" id="modal_accion">
                  <input type="hidden" id="fecha_llave">
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
                  <p> ¿Quieres eliminar esta fecha?</p>
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