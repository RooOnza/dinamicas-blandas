<?php require_once('./controller/ConTexto.php'); ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Dinámicas Blandas</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<!-- Css Styles... -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.db.css">

		<link rel="stylesheet" href="./assets/css/mainadmon.css" />
		<noscript><link rel="stylesheet" href="./assets/css/noscript.css" /></noscript>

    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/fonts.css">

		<!-- Script -->
		<script src="./assets/js/jquery.js" charset="utf-8"></script>
    <script src="./assets/js/bootstrap.min.js" charset="utf-8"></script>

    <script src="./assets/js/contexto.js"></script>

</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header y Menu -->
				<?php include('./includes/headermenu.php'); ?>

    <?php
      $conTexto = new ConTexto();
      $Response = [];
      $active = $conTexto->active;
    ?>
    <?php require('./navLogin.php'); ?>

    <main role="main" class="container">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
            <h2>Administración de Textos</h2>
            <div id='status' name='status' class="row"></div>
            <div class="row">
              <div class="col">
                <div class="card mt-3">
                  <div class="card-title ml-3 my-3">
                    <!-- Add Button--> 
                    <button type="button" class="btn btn-primary" id="btn_add">Crear Texto</button>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">Id</td>
                          <th>Nombre</td>
                          <th>Texto</td>
                          <th class="text-center">Top</td>
                          <th class="text-center">Left</td>
                          <th class="text-center">Height</td>
                          <th class="text-center">Width</td>
                          <th class="text-center">Estatus</td>
                          <th class="text-center">Created at</td>
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

            <!--Add Modal-->
            <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="lbl_add_modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title"  id="lbl_add_modal">Crear Texto</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="message"></div>
                    <form>
                      <input type="text" class="form-control my-2" placeholder="Nombre Texto" id="nombre">
                      <textarea class="form-control" placeholder="Texto" id="texto" rows=10></textarea>
                      <input type="number" class="form-control my-2" placeholder="Top" id="ntop">
                      <input type="number" class="form-control my-2" placeholder="Left" id="nleft">
                      <input type="number" class="form-control my-2" placeholder="Height" id="nheight">
                      <input type="number" class="form-control my-2" placeholder="Width" id="nwidth">
                      <select id="status_id" class="form-control my-2">
                        <option value=0 selected>Seleccione estatus...</option>
                        <option value=1>Activo</option>
                        <option value=2>Inactivo</option>
                      </select>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_register">Crear</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close">Salir</button>
                  </div>
                </div>
              </div>
            </div>

            <!--Update Modal-->
            <div class="modal" id="update">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="text-dark">Update Form</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="up-message"></div>
                    <form>
                      <input type="hidden" class="form-control my-2" placeholder="Id" id="up_id">
                      <input type="text" class="form-control my-2" placeholder="Nombre Texto" id="up_nombre">
                      <textarea class="form-control" placeholder="Texto" id="up_texto" rows=10></textarea>
                      <input type="number" class="form-control my-2" placeholder="Top" id="up_ntop">
                      <input type="number" class="form-control my-2" placeholder="Left" id="up_nleft">
                      <input type="number" class="form-control my-2" placeholder="Height" id="up_nheight">
                      <input type="number" class="form-control my-2" placeholder="Width" id="up_nwidth">
                      <select id="up_status_id" class="form-control my-2">
                        <option value=0 selected>Seleccione estatus...</option>
                        <option value=1>Activo</option>
                        <option value=2>Inactivo</option>
                      </select>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_update">Update Now</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!--Delete Modal-->
            <div class="modal" id="delete">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <p> ¿Quieres eliminar este texto?</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-footer">                   
                    <button type="button" class="btn btn-primary" id="btn_delete_record">Delete Now</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close">Close</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>

    <!-- Scripts -->
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>