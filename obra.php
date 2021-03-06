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

    <script src="./assets/js/obra.js"></script>

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
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
            <h2>Administración de Obra</h2>
            <div id='status' name='status' class="row"></div>
            <div class="row">
              <div class="col">
                <div class="card mt-3">
                  <div class="card-title ml-3 my-3">
                    <!-- Add Button--> 
                    <button type="button" class="btn btn-primary" id="btn_add">Crear Obra</button>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">Id</td>
                          <th>Nombre</td>
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
            
            <!--Delete Modal-->
            <div class="modal" id="delete">
              <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <p> ¿Quieres eliminar esta obra?</p>
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