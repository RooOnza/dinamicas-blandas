<?php require_once('./controller/Users.php'); ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Dinámicas Blandas</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<!-- Css Styles... -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.db.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/fonts.css">

		<!-- Script -->
		<script src="./assets/js/jquery.js" charset="utf-8"></script>
    <script src="./assets/js/bootstrap.min.js" charset="utf-8"></script>

    <!-- Script 
    <script src="./assets/js/lienzoadm.js"></script> -->

</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

    <?php
      $usuarios = new Users();
      $Response = [];
      $active = $usuarios->active;
    ?>

    <main role="main">

      <?php require('./navLogin.php'); ?>
      <br>
      
      <div class="container">

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
            <h2>Usuarios</h2>
            <div id='status' name='status' class="row"></div>
            <div class="row">
              <div class="col">
                <div class="card mt-3">
                  <div class="card-title ml-3 my-3">
                    <!-- Add Button--> 
                    <button type="button" class="btn btn-primary" id="btn_add">Crear Usuario</button>
                  </div>
                  <div class="card-body">
                    <div id="table"></div>
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