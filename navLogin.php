<?php require_once('./config.php'); ?>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">dinámicas blandas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        <?php if (!isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a class="nav-link <?php if (strtolower($active) === 'login') echo 'active'; ?>" href="<?php echo BASE_URL; ?>login.php">login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (strtolower($active) === 'register') echo 'active'; ?>" href="<?php echo BASE_URL; ?>register.php" tabindex="-1" aria-disabled="true">register</a>
          </li>
        <?php elseif (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>dashboard.php" class="nav-link <?php if (strtolower($active) === 'dashboard') echo 'active'; ?>">dashboard</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>users.php" class="nav-link <?php if (strtolower($active) === 'users') echo 'active'; ?>">users</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>upload.php" class="nav-link <?php if (strtolower($active) === 'upload') echo 'active'; ?>">upload</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>lienzoadm.php" class="nav-link <?php if (strtolower($active) === 'lienzo') echo 'active'; ?>">lienzo</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>contenido.php" class="nav-link <?php if (strtolower($active) === 'contenido') echo 'active'; ?>">contenido</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>logout.php">logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
