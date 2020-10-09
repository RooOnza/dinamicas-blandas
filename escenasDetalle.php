<?php require_once('./controller/Escenas.php'); ?>

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

    <script src="./assets/js/escenasDetalle.js"></script>

</head>
	<body class="is-preload">
		<!-- Wrapper -->
    <div id="wrapper">

    <?php
      $Escenas = new Escenas();
      $Response = [];
      $active = $Escenas->active;
    ?>

    <main role="main">
      <?php require('./navLogin.php'); ?>
      <br/>
      <div class="container">

        <!-- Título -->
        <div class="row">
          <div class="col-sm-12">
            <h2>Administración Detalle de Escena</h2>
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
                  <label for="desc_escena" class="col-sm-1 offset-sm-1 col-form-label">Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc_escena" required>
                    <small id='hlpNombreNOK' class="no_valido_gral" style='color:red;'>y mi nombre? :(</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_tipo_esc" class="col-sm-1 offset-sm-1 col-form-label">Tipo</label>
                  <div class="col-sm-3">
                    <select id="id_tipo_esc" class="form-control">
                      <option value=0 selected>Seleccione tipo...</option>
                      <option value=1>Escena</option>
                      <option value=2>Break</option>
                    </select>
                    <small id="hlpTipoEscNOK" class="no_valido_gral" style='color:red;'>oouch mi tipo :(</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="id_canvas" class="col-sm-1 offset-sm-1 col-form-label">Lienzo</label>
                  <div class="col-sm-10">
                    <select id="id_canvas" class="form-control"></select>
                    <small id="hlpCanvasNOK" class="no_valido_gral" style='color:red;'>... y mi lienzo? :(</small>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tiempo" class="col-sm-1 offset-sm-1 col-form-label">Tiempo</label>
                  <div class="col-sm-2">
                    <div class="input-group mb-2">
                      <input type="number" class="form-control" id="tiempo">
                      <div class="input-group-append">
                        <div class="input-group-text">min</div>
                      </div>
                    </div>
                    <small id="hlpTiempoNOK" class="no_valido_gral" style='color:red;'>... sin tiempo? nooo :(</small>
                  </div>
                  <label for="id_status" class="col-sm-1 offset-sm-4 col-form-label">Estatus</label>
                  <div class="col-sm-3">
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

          <!-- General Escenas-Escenas -->
          <div class="row">
  
            <div class="col-sm-12 my-3">
              <!-- Add Button--> 
              <button type="button" class="btn btn-primary escenas" id="btn_add">Asignar Actor</button>
            </div>
            <br>
            <div class="col-sm-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Actor</td>
                    <th class="text-center">Tipo</td>
                    <th class="text-center">Pos X</td>
                    <th class="text-center">Pos Y</td>
                    <th class="text-center">Permanente</td>
                    <th class="text-center">Tiempo Ini</td>
                    <th class="text-center">Tiempo Fin</td>
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
              <input type="text" id="id_escena" disabled>
              <input type="text" id="accion" disabled>
              <button type="button" class="btn btn-primary" id="btn_register">Guardar</button>
              <button type="button" class="btn btn-secondary" id="btn_close">Cancelar</button>
            </div>

          </div>          
        </div>

        <!-- Modal Save -->
        <div class="row">
          <div class="modal fade" id="detail_modal" tabindex="-1" aria-labelledby="lbl_detail_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
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
                      <label for="id_tipo" class="col-sm-2 col-form-label">Tipo</label>
                      <div class="col-sm-4">
                        <select id="id_tipo" class="form-control">
                          <option value=0 selected>Seleccione tipo...</option>
                          <option value=1>Punto</option>
                          <option value=2>Rectángulo</option>
                          <option value=3>Texto</option>
                          <option value=4>Imagen</option>
                          <option value=5>Audio</option>
                          <option value=6>Video</option>
                        </select>
                        <small id="hlpTipoNOK" class="no_valido" style='color:red;'>... no hay tipo? :(</small>
                      </div>
                      <label for="id_status_det" class="col-sm-1 col-form-label">Estatus</label>
                      <div class="col-sm-4">
                        <select id="id_status_det" class="form-control">
                          <option value=0 selected>Seleccione estatus...</option>
                          <option value=1>Activo</option>
                          <option value=2>Inactivo</option>
                        </select>
                        <small id="hlpEstatusDetNOK" class="no_valido" style='color:red;'>wey mi estatus! :(</small>
                      </div>

                    </div>
                    <div class="form-group row">
                    <label for="id_actor" class="col-sm-2 col-form-label">Actor</label>
                      <div class="col-sm-9">
                        <select id="id_actor" class="form-control"></select>
                        <small id="hlpActorNOK" class="no_valido" style='color:red;'>quien actua? :(</small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="posicion_x" class="col-sm-2 col-form-label">Posición</label>
                      <div class="col-sm-4">
                        <div class="input-group mb-2">
                          <input type="number" class="form-control" id="posicion_x">
                          <div class="input-group-append">
                            <div class="input-group-text">px X</div>
                          </div>
                        </div>
                        <small id="hlpPosXNOK" class="no_valido" style='color:red;'>... y mi x? :(</small>
                      </div>
                      <div class="col-sm-4 offset-sm-1">
                        <div class="input-group mb-2">
                          <input type="number" class="form-control" id="posicion_y">
                          <div class="input-group-append">
                            <div class="input-group-text">px Y</div>
                          </div>
                        </div>
                        <small id="hlpPosYNOK" class="no_valido" style='color:red;'>... y la y qué? :(</small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="tiempo_ini" class="col-sm-2 col-form-label">Tiempo</label>
                      <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="permanente" value='1'>
                          <label class="form-check-label" for="permanente">Permanente</label>
                        </div>
                      </div>
                    </div>
                    <div id='divTiempo' class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <div class="input-group mb-2">
                          <div class="input-group-preppend">
                            <div class="input-group-text">Inicio</div>
                          </div>
                          <input type="number" class="form-control" id="tiempo_ini">
                          <div class="input-group-append">
                            <div class="input-group-text">min</div>
                          </div>
                        </div>
                        <small id="hlpTiempoIniNOK" class="no_valido" style='color:red;'>... cuando empieza? :(</small>
                      </div>
                      <div class="col-sm-4 offset-sm-1">
                        <div class="input-group mb-2">
                          <div class="input-group-preppend">
                            <div class="input-group-text">Fin</div>
                          </div>
                          <input type="number" class="form-control" id="tiempo_fin">
                          <div class="input-group-append">
                            <div class="input-group-text">min</div>
                          </div>
                        </div>
                        <small id="hlpTiempoFinNOK" class="no_valido" style='color:red;'>... sin fin? :(</small>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="estilo" class="col-sm-2 col-form-label" style='color:darkblue;'>Estilo</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="estilo">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="id_status" class="col-sm-2 col-form-label">Orden</label>
                      <div class="col-sm-2">
                        <input type="number" class="form-control" id="orden" required>
                        <small id="hlpOrdenNOK" class="no_valido" style='color:red;'>wey mi orden! :(</small>
                      </div>
                    </div>
                    
                  </form>
                </div>
                <div class="modal-footer">
                  <input type="text" id="modal_accion" disabled>
                  <input type="text" id="id_actor_llave" disabled>
                  <input type="text" id="orden_llave" disabled>
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
                  <p> ¿Quieres eliminar este actor?</p>
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