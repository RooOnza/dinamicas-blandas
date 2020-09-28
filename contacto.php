<?php include('includes/header.php'); ?>

<!-- Main -->
    <div id="main">
        <div class="inner">
            <header>
                <section>
                    <h2>contactanos</h2>
                    <form method="post" action="#">
                        <div class="fields login">
                            <div class="field half">
                                <input type="text" name="name" id="name" placeholder="Name" />
                            </div>
                            <div class="field half">
                                <input type="email" name="email" id="email" placeholder="Email" />
                            </div>
                            <div class="field">
                                <textarea name="message" id="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="envía" class="primary" /></li>
                        </ul>
                    </form>
                </section>
            </header>
        </div>
    </div>

<?php include('includes/footer.php'); ?>