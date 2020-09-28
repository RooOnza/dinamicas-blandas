<?php require_once('./controller/Contenido.php'); ?>

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
  $Contenido = new Contenido();
  $Response = [];
  $active = $Contenido->active;
  $News = $Contenido->getNews();
?>
<?php require('./navLogin.php'); ?>
<main role="main" class="container">
  <div class="container">
    <div class="row mt-5">
      <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
        <h2>administración de contenido</h2>
        <hr>
      </div>
    </div>
    <!--
    <div class="row">
      <?php if ($News['status']) : ?>
        <?php foreach ($News['data'] as $new) :  ?>
          <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
              <div class="news_title">
                <h3><?php echo ucwords($new['title']); ?></h3>
              </div>
              <div class="news_body">
                <p><?php echo $new['content']; ?> <a href="javascript:void(0)">Read More</a></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif;  ?>
    </div>
    -->
  </div>
</main>

<?php include('./includes/footer.php'); ?>