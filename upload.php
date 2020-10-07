<?php require_once('./controller/Upload.php'); ?>

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
    
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
    <div id="wrapper">
    <?php
      $Upload = new Upload();
      $Response = [];
      $active = $Upload->active;
    ?>
    <main role="main">

      <?php require('./navLogin.php'); ?>
      <br>

      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
            <h2>Upload de multimedia</h2>
            <hr>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>