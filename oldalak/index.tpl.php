<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?= $fejléc['cím'] ?></title>
        <link rel="stylesheet" href="stilusok/mainstyles.css" type="text/css">
        <link rel="stylesheet" href="stilusok/modalstyles.css" type="text/css">
        <link rel="stylesheet" href="stilusok/gallerystyles.css" type="text/css">
        <link rel="stylesheet" href="stilusok/formstyles.css" type="text/css">
        <script src="main.js"></script>
    </head>
    <body>
        <header>
            <img src="elemek/logo.png" alt="logo">
            <p class="headlogin">
                <?php
                if (isset($_SESSION['loginname'])) {
                    echo('Bejelentkezve: ' . $_SESSION['userlname'] . ' ' . $_SESSION['userfname'] . ' (' . $_SESSION['loginname'] . ')');
                } else {echo('Nincs bejelentkezve felhasználó!'); }?>
            </p>
            <div class="headercontainer">
                <div class="accessheader">
                    <?php
                    if (isset($_SESSION['loginname'])) {
                        echo('<a class="exitbutton" href="?kilepes=true">Kilépés</a>');
                    } else { ?>
                        <button class="accessbutton" id="accessbutton">Belépés</button>
                    <?php } ?>
                </div>
                <div class="searchheader">
                    <form action="http://www.google.com/search" method="GET">
                        <input class="searchtext" type="text" name="q">
                        <input class="searchbutton" type="submit" value="Keresés">
                    </form>
                </div>
            </div>
        </header>
        <div id="bodycontainer">
            <nav class="sidebar">
                <?php foreach ($oldalak as $url => $oldal) { ?>
                    <a class="navbutton" href="<?php echo ($url == '/') ? '.' : ('?oldal=' . $oldal['fájl']); ?>"><?php echo $oldal['szoveg']; ?></a><br>
                <?php } ?>
                <hr>
                <div class="advertisment">
                    <div class="sidebartitle">Hirdetések</div>
                    <?php include("elemek/hirdetesek.php"); ?>
                </div>
            </nav>
            <div class="maincontent">
                <img class="staticbodyimg" src="elemek/1ado.png" alt="ado"><br>
                <?php
                    if (!$needMessages) {
                        include("oldalak/" . "{$keres['fájl']}.tpl.php");
                    } else {
                        include("oldalak/uzenetek.tpl.php");
                    }
                ?>
            </div>
        </div>
        <footer>
            Copyright © 2010 - 2019 Szeghalmi Mentőalapítvány.<br>
            Designed by Tibor Borbás<br>
            Original website: <a href="http://szeghalmimentoalapitvany.hu/">http://szeghalmimentoalapitvany.hu/</a>
        </footer>
        <!-- Modális ablak kódja -->
        <div id="accesswindow" class="modal">
            <div class="modal-content">
                <div class="close">&times;</div><br>
                <div class="modalcontainer">
                    <div class="modalcontaineritem">
                        <form name="belepesform" action="" method="POST">
                            <fieldset class="modalfieldset">
                                <legend><strong>Belépés</strong></legend>
                                <label for="accessname">Felhasználónév:</label><br>
                                <input type="text" id="accessname" name="belepesinev" required><br>
                                <label for="accesspswd">Jelszó:</label><br>
                                <input type="password" id="accesspswd" name="belepesijelszo" required><br>
                                <input class="modalbutton" type="submit" onsubmit="validateSignIn()" name="belepes" value="Bejelentkezés">
                            </fieldset>
                        </form>
                    </div>
                    <div class="modalcontaineritem">
                        <form name="regform" action="" method="POST">
                            <fieldset class="modalfieldset">
                                <legend><strong>Regisztráció</strong></legend>
                                <label for="regloginname">Felhasználónév:</label><br>
                                <input type="text" id="regloginname" name="loginnev" required><br>
                                <label for="regfirstname">Családnév:</label><br>
                                <input type="text" id="regfirstname" name="csaladnev" required><br>
                                <label for="reglastname">Keresztnév:</label><br>
                                <input type="text" id="reglastname" name="keresztnev" required><br>
                                <label for="regemail">E-mail cím:</label><br>
                                <input type="text" id="regemail" name="emailcim" required><br>
                                <label for="regpswd">Jelszó:</label><br>
                                <input type="password" id="regpswd" name="regjelszo" required><br>
                                <input class="modalbutton" type="submit" onsubmit="validateRegister()" name="regisztracio" value="Regisztráció">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>