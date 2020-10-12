<?php require_once('./controller/LienzoAdm.php'); ?>

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

    <script src="./assets/js/lienzoadm.js"></script>

</head>
	<body class="is-preload">
		<!-- Wrapper -->
    <div id="wrapper">

    <?php
      $tempo = new LienzoAdm();
      $Response = [];
      $active = $tempo->active;
    ?>

    <main role="main">
      <?php require('./navLogin.php'); ?>
      <br/>
      <div class="container">
        <h1>Sorry aún no funciona :)</h1>        
      </div>
    </main>
	</body>
</html>