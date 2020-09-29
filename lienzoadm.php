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
    
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/lienzoadm.js"></script>

		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>

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
      //$News = $lienzo->getNews();
      //if (isset($_POST) && count($_POST) > 0) $Response = $lienzo->login($_POST);
    ?>
    <?php require('./navLogin.php'); ?>

    <main role="main" class="container">
      <div class="container">
        <div class="row mt-5">
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
            <h2>administración de lienzo</h2>
            <hr>
            <!-- Ocultar temp mientras depuro
            <?php //if (isset($Response['status']) && !$Response['status']) : ?>
              <div class="alert alert-danger" role="alert" style="overflow: auto;">
                <span id='alertMensaje'><B>Oops!</B> Invalid Credentials Used.</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" class="text-danger">&times;</span>
                </button>
              </div>
            <?php //endif; ?>
            -->
            <div id='status' name='status'></div>
            <div class="row">
              <div class="col">
                <div class="card mt-5">
                  <div class="card-title ml-5 my-2">
                    <!--Registration Button--> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Registration">Add New User </button>
                  </div>
                  <div class="card-body">
                    <p id="delete-message" class="text-dark"></p>
                    <div id="table"></div>
                  </div>
                </div>
              </div>
            </div>

            <!--Registration Modal-->
            <div class="modal" id="Registration">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="text-dark">Registration Form</h3>
                  </div>
                  <div class="modal-body">
                    <p id="message" class="text-dark"></p>
                    <form>
                      <input type="text" class="form-control my-2" placeholder="User Name" id="UserName">
                      <input type="email" class="form-control my-2" placeholder="User Email" id="UserEmail">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_register">Register Now</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!--Update Modal-->
            <div class="modal" id="update">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="text-dark">Update Form</h3>
                  </div>
                  <div class="modal-body">
                    <p id="up-message" class="text-dark"></p>
                    <form>
                      <input type="hidden" class="form-control my-2" placeholder="User Email" id="Up_User_ID">
                      <input type="text" class="form-control my-2" placeholder="User Name" id="Up_UserName">
                      <input type="email" class="form-control my-2" placeholder="User Email" id="Up_UserEmail">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_update">Update Now</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!--Delete Modal-->
            <!--Update Modal-->
            <div class="modal" id="delete">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="text-dark">Delete Record</h3>
                  </div>
                  <div class="modal-body">
                    <p> Do You Want to Delete the Record ?</p>
                    <button type="button" class="btn btn-success" id="btn_delete_record">Delete Now</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
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