<?php require_once('./controller/Register.php'); ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Dinámicas Blandas</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<!-- Css Styles... -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.db.css">

		<link rel="stylesheet" href="assets/css/mainadmon.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/fonts.css">

		<!-- Script -->
		<script src="./assets/js/jquery.js" charset="utf-8"></script>
    <script src="./assets/js/bootstrap.min.js" charset="utf-8"></script>
    
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header y Menu -->
				<?php include('./includes/headermenu.php'); ?>

    <?php
      $Register = new Register();
      $Response = [];
      $active = $Register->active;
      if (isset($_POST) && count($_POST) > 0) $Response = $Register->register($_POST);
    ?>
    <?php require('./navLogin.php'); ?>
    <main role="main" class="container">
      <div class="container">
        <div class="row justify-content-center mt-5">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 center-align center-block">
            <?php if (isset($Response['status']) && !$Response['status']) : ?>
            <br>
            <div class="alert alert-danger" role="alert">
              <span><B>Oops!</B> Some errors occurred in your form.</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-danger">&times;</span>
              </button>
            </div>
            <?php endif; ?>
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin">
              <h4 class="h3 mb-3 font-weight-normal text-center">Register</h4>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
                <div class="form-group">
                  <label for="inputName" class="sr-only">Names</label>
                  <input type="text" id="inputName" class="form-control" placeholder="Enter Full Name" name="name" required autofocus value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                  <?php if (isset($Response['name']) && !empty($Response['name'])): ?>
                    <small class="text-danger"><?php echo $Response['name']; ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
                <div class="form-group">
                  <label for="inputEmail" class="sr-only">Email</label>
                  <input type="email" id="inputEmail" class="form-control" placeholder="Enter Email Address" name="email" required autofocus value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                  <?php if (isset($Response['email']) && !empty($Response['email'])): ?>
                    <small class="text-danger"><?php echo $Response['email']; ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                <div class="form-group">
                  <label for="inputPassword" class="sr-only">Password</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                  <?php if (isset($Response['password']) && !empty($Response['password'])): ?>
                    <small class="text-danger"><?php echo $Response['password']; ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
                <button class="btn btn-md btn-primary btn-block" type="submit">Register</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>