<?php require_once('./controller/LienzoAdm.php'); ?>

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

    <script src="./assets/js/lienzoadm.js"></script>

</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header y Menu -->
				<?php include('./includes/headermenu.php'); ?>

    <?php
      $lienzoadm = new LienzoAdm();
      $Response = [];
      $active = $lienzoadm->active;
    ?>
    <?php require('./navLogin.php'); ?>

    <main role="main" class="container">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
            <h2>Administración de Lienzos</h2>
            <div id='status' name='status' class="row"></div>
            <div class="row">
              <div class="col">
                <div class="card mt-3">
                  <div class="card-title ml-3 my-3">
                    <!--Registration Button--> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Registration">Crear Lienzo</button>
                  </div>
                  <div class="card-body">
                    <div id="table"></div>
                  </div>
                </div>
              </div>
            </div>

            <!--Registration Modal-->
            <div class="modal" id="Registration">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="text-dark">Crear Lienzo</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="message"></div>
                    <form>
                      <input type="text" class="form-control my-2" placeholder="User Name" id="UserName">
                      <input type="email" class="form-control my-2" placeholder="User Email" id="UserEmail">
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
                      <input type="hidden" class="form-control my-2" placeholder="User Email" id="Up_User_ID">
                      <input type="text" class="form-control my-2" placeholder="User Name" id="Up_UserName">
                      <input type="email" class="form-control my-2" placeholder="User Email" id="Up_UserEmail">
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
                    <p> ¿Quieres eliminar este registro?</p>
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