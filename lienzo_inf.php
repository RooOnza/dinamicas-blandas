<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinámicas Blandas</title>
    <link rel="stylesheet" href="assets/css/lienzo_clean.css" />
    <link rel="stylesheet" href="assets/css/menu.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body style="cursor: crosshair;">
    <!-- Wrapper -->
    <div id="mainLienzo">
       
        <!-- Header -->
        <header id="header">
            <div class="inner">
                <!-- Nav -->
                <nav>
                    <ul>
                        <li><a href="#menu">Menu</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Menu -->
        <nav id="menu">
            <ul>
                <li><a href="indexphp.php">Home</a></li>
                <li><a href="dinamicas-blandas.php">Dinámicas Blandas</a></li>
                <li><a href="lienzo.php">Lienzo</a></li>
                <li><a href="lienzo_inf.php">Lienzo Infinito</a></li>
                <li><a href="nosotrxs.php">Nosotrxs</a></li>
                <li><a href="generic.php">Donaciones</a></li>
                <li><a href="generic.php">Tiendita</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="elements.php">Elements</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>

        <!-- Main -->
        <div id="main">
            <div class="inner">
                <header>
                    <h1>Lienzo Infinito</h1>
                    <p id="browser_size"></p>
                    <p id="window_size"></p>
                    <p>Height: <input type="number" name="txtAlto" id="txtAlto" placeholder="Height"></p>
                    <p>Width: <input type="number" name="txtAncho" id="txtAncho" placeholder="Width"></p>
                    <input type="button" name="btnResize" id="btnResize" value="Resize">                    
                </header>
            </div>
        </div>

        <div class="grid-container" id="div-container">
            <div class="grid-item">1</div>
            <div class="grid-item">2</div>
            <div class="grid-item">3</div>  
            <div class="grid-item">4</div>
            <div class="grid-item">5</div>
            <div class="grid-item">6</div>  
            <div class="grid-item">7</div>
            <div class="grid-item">8</div>
            <div class="grid-item">9</div>  
        </div>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- RG rediminsionaminto -->
    <script src="assets/js/resizing.js"></script>

</body>
</html>

