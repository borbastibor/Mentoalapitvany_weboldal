<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?= $fejléc['cím'] ?></title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src="main.js"></script>
    </head>
    <body>
        <header>
            <img src="images/logo.png" alt="logo" style="align:left">
        </header>
        <aside>
            <ul>
                <?php foreach ($oldalak as $url => $oldal) { ?>
                <li <?php echo (($oldal == $keres) ? ' class="aktiv"' : '') ?>>
                    <a href="<?php echo ($url == '/') ? '.' : ('?oldal=' . $oldal['fájl'])
                    ?>"><?php echo $oldal['szoveg'] ?></a>
                </li>
                <?php } ?>
            </ul>
        </aside>
        <footer>
            Copyright © 2010 - 2019 Szeghalmi Mentőalapítvány.
            Designed by Tibor Borbás
        </footer>
    </body>
</html>