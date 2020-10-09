<?php require_once('./config.php'); ?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
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
            <a href="<?php echo BASE_URL; ?>canvas.php" class="nav-link <?php if (strtolower($active) === 'canvas') echo 'active'; ?>">canvas</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>actores.php" class="nav-link <?php if (strtolower($active) === 'actores') echo 'active'; ?>">actores</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>escenas.php" class="nav-link <?php if (strtolower($active) === 'escenas') echo 'active'; ?>">escenas</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>obra.php" class="nav-link <?php if (strtolower($active) === 'obra') echo 'active'; ?>">obra</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['auth_status'])) : ?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>temporada.php" class="nav-link <?php if (strtolower($active) === 'temporada') echo 'active'; ?>">temporada</a>
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
