<?php include('includes/header.php'); ?>

<!-- Main -->
    <div id="main">
        <div class="inner">
            <header>
                <h2>Administración de la programación escénica</h2>
                <form method="post" action="#">
                    <div class="redimension">
                            <h3>Redimensión de lienzo</h3>
                            <input type="number" name="txtLienzoX" id="txtLienzoX" placeholder="X">
                            <input type="number" name="txtLienzoY" id="txtLienzoY" placeholder="Y">
                            <input type="button" value="Redimensionar" name="btnRedimensionar" id="btnRedimensionar" >
                        </div>
                </form>
            </header>
        </div>
    </div>

<?php include('includes/footer.php'); ?>
