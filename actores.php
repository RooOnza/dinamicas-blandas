<?php require_once('./controller/Actores.php'); ?>

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

    <script src="./assets/js/actores.js"></script>

</head>
	<body class="is-preload">
		<!-- Wrapper -->
    <div id="wrapper">

    <?php
      $actores = new Actores();
      $Response = [];
      $active = $actores->active;
    ?>

    <main role="main">
      <?php require('./navLogin.php'); ?>
      <br/>
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
            <h2>Administración de Actores</h2>
            <div id='status' name='status' class="row"></div>
            <div class="row">
              <div class="col">
                <div class="card mt-3">
                  <div class="card-title ml-3 my-3">
                    <!-- Add Button--> 
                    <button type="button" class="btn btn-primary" id="btn_add">Crear Actor</button>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">Id</td>
                          <th>Nombre</td>
                          <!-- 
                          <th class="text-center">Posicion X</td>
                          <th class="text-center">Posicion Y</td>
                          --> 
                          <th class="text-center">Tipo</td>
                          <th class="text-center">Estatus</td>
                          <th class="text-center"> Edit </td>
                          <th class="text-center"> Delete </td>
                        </tr>
                      </thead>
                      <tbody id="table"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!--Detail Modal-->
            <div class="modal fade" id="detail_modal" tabindex="-1" aria-labelledby="lbl_detail_modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="lbl_detail_modal">Craer</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="message"></div>
                    <form>
                      <div class="form-group row">
                        <label for="desc_actor" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                          <input type="hidden" id="id_actor">
                          <input type="text" class="form-control" id="desc_actor" required>
                          <small id='hlpNombreNOK' class="no_valido" style='color:red;'>y mi nombre? :(</small>
                        </div>
                      </div>
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
                          <small id="hlpTipoNOK" class="no_valido" style='color:red;'>... tampoco mi tipo! :(</small>
                        </div>
                        <label for="id_status" class="col-sm-1 offset-sm-1 col-form-label">Estatus</label>
                        <div class="col-sm-4">
                          <select id="id_status" class="form-control">
                            <option value=0 selected>Seleccione estatus...</option>
                            <option value=1>Activo</option>
                            <option value=2>Inactivo</option>
                          </select>
                          <small id="hlpEstatusNOK" class="no_valido" style='color:red;'>wey mi estatus! :(</small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="estilo" class="col-sm-2 col-form-label" style='color:darkblue;'>Estilo</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="estilo">
                        </div>
                      </div>

                      <!-- Punto -->
                      <div id='divPunto' class="divTipo">
                        <div class="form-group row">
                          <label for="p_diametro" class="col-sm-2 col-form-label">Diámetro</label>
                          <div class="col-sm-4">
                            <div class="input-group mb-2">
                              <input type="number" class="form-control" id="p_diametro">
                              <div class="input-group-append">
                                <div class="input-group-text">px</div>
                              </div>
                            </div>
                            <small id="hlpPDiametroNOK" class="no_valido" style='color:red;'>... y mi diámetro? :(</small>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="p_color" class="col-sm-2 col-form-label" style='color:darkblue;'>Color</label>
                          <div class="col-sm-4">
                            <div class="input-group mb-2">
                              <input type="text" class="form-control" id="p_color">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="p_contenido" class="col-sm-2 col-form-label" style='color:darkblue;'>Contenido</label>
                          <div class="col-sm-10">
                            <div class="input-group mb-2">
                              <input type="text" class="form-control" id="p_contenido">
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Rectangulo -->
                      <div id='divRectangulo' class="divTipo">
                        <div class="form-group row">
                          <label for="r_tamano_x" class="col-sm-2 col-form-label">Tamaño</label>
                          <div class="col-sm-4">
                            <div class="input-group mb-2">
                              <input type="number" class="form-control" id="r_tamano_x">
                              <div class="input-group-append">
                                <div class="input-group-text">px X</div>
                              </div>
                            </div>
                            <small id="hlpRTamanoXNOK" class="no_valido" style='color:red;'>... y mi x? :(</small>
                          </div>
                          <div class="col-sm-4 offset-sm-2">
                            <div class="input-group mb-2">
                              <input type="number" class="form-control" id="r_tamano_y">
                              <div class="input-group-append">
                                <div class="input-group-text">px Y</div>
                              </div>
                            </div>
                            <small id="hlpRTamanoYNOK" class="no_valido" style='color:red;'>... y mi y? :(</small>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="r_color" class="col-sm-2 col-form-label" style='color:darkblue;'>Color</label>
                          <div class="col-sm-4">
                            <div class="input-group mb-2">
                              <input type="text" class="form-control" id="r_color">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="r_contenido" class="col-sm-2 col-form-label" style='color:darkblue;'>Contenido</label>
                          <div class="col-sm-10">
                            <div class="input-group mb-2">
                              <input type="text" class="form-control" id="r_contenido">
                            </div>
                          </div>
                        </div>
                      </div>

                    </form>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" id="modal_accion">
                    <button type="button" class="btn btn-primary" id="btn_register">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>

            <!--Delete Modal-->
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>
	</body>
</html>