<?php
include('elemek/config.php');
session_start();

$needMessages = false;

// Üzenetküldés
if (isset($_POST['uzenetkuldes'])) {
  $messageOk = 1;
  $username = $_POST['kapcsolatnev'];
  $useremail = $_POST['kapcsolatemail'];
  $msgtext = $_POST['kapcsolatmsgtext'];
  // szerver oldali ellenőrzések
  if (empty($username)) {
    echo('<script>alert("Nem adott meg nevet!");</script>');
    $messageOk = 0;
  } else {
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      echo('<script>alert("A név csak betűket és szóközt tartalmazhat!");</script>');
      $messageOk = 0;
    }
  }
  if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
    echo('<script>alert("Helytelen e-mail címet adott meg!");</script>');
    $messageOk = 0;
  }
  if (empty($msgtext)) {
    echo('<script>alert("Nem írt szöveget az üzenethez!");</script>');
    $messageOk = 0;
  }
  // Ellenőrzés után kiiratás és adatbázisba írás
  if ($messageOk == 1) { ?>
    <script>
      var msgwindow = window.open("", "_blank");
      msgwindow.document.write("<h3>Elküldött üzenet adatai</h3>");
      msgwindow.document.write("<p><strong>Küldő neve: </strong><?php echo($username) ?></p>");
      msgwindow.document.write("<p><strong>Küldő e-mail címe: </strong><?php echo($useremail) ?></p>");
      msgwindow.document.write("<p><strong>Üzenet: </strong><?php echo($msgtext) ?></p>");
    </script>
    <?php
    // Az üzenet adatbázisba írása
    $sqlstmt = $dbcon->prepare("INSERT INTO messages(msgsendername,msgsenderemail,msgtext) VALUES('$username','$useremail','$msgtext')");
    try {
      $sqlstmt->execute();
    } catch(PDOException $e) {
      echo("<script>alert('Nem sikerült az üzenetet letárolni!');</script>");
    }
  }
}

// Beléptetés kezelése
if (isset($_POST['belepes'])) {
  unset($_GET['kilepes']);
  $username = $_POST['belepesinev'];
  $userpswd = $_POST['belepesijelszo'];
  $sqlstmt = $dbcon->prepare("SELECT userfirstname,userfamilyname FROM users WHERE username = '$username' and userpassword = '$userpswd'");
  try {
    $sqlstmt->execute();
    $row = $sqlstmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($row) > 0) {
      $_SESSION['userlname'] = $row[0]['userfamilyname'];
      $_SESSION['userfname'] = $row[0]['userfirstname'];
      $_SESSION['loginname'] = $username;
    } else {
      echo("<script>alert('Nem megfelelő felhasználónév vagy jelszó!');</script>");
    }
  } catch(PDOException $e) {
    echo("<script>alert('Nem sikerült csatlakozni az adatbázishoz!');</script>");
  }
}

// Regisztráció kezelése
if (isset($_POST['regisztracio'])) {
  $regdataOk = true;
  $loginname = $_POST['loginnev'];
  $familyname = $_POST['csaladnev'];
  $firstname = $_POST['keresztnev'];
  $emailaddress = $_POST['emailcim'];
  $regpassword = $_POST['regjelszo'];
  // Már létező loginnev ellenőrzése
  $sqlstmt = $dbcon->prepare("SELECT userid FROM users WHERE username = '$loginname'");
  try {
    $sqlstmt->execute();
    $row = $sqlstmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($row) > 0) {
      $regdataOk = false;
      echo("<script>alert('Már létezik ilyen felhasználónév!');</script>");
    }
  } catch(PDOException $e) {
    echo("<script>alert('Hiba történt a regisztrációkor!');</script>");
  }
  // Már létező emailcim ellenőrzése
  $sqlstmt = $dbcon->prepare("SELECT userid FROM users WHERE useremail = '$emailaddress'");
  try {
    $sqlstmt->execute();
    $row = $sqlstmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($row) > 0) {
      $regdataOk = false;
      echo("<script>alert('Már létezik ilyen e-mail cím!');</script>");
    }
  } catch(PDOException $e) {
    echo("<script>alert('Hiba történt a regisztrációkor!');</script>");
  }
  // Ha jók voltak az adatok, akkor mentés az adatbázisba
  if ($regdataOk) {
    $sqlstmt = $dbcon->prepare("INSERT INTO users(username,userfirstname,userfamilyname,useremail,userpassword) VALUES('$loginname','$firstname','$familyname','$emailaddress','$regpassword')");
    try {
      $sqlstmt->execute();
      echo("<script>alert('A regisztráció sikeres volt!');</script>");
    } catch(PDOException $e) {
      echo("<script>alert('Hiba történt a regisztrációkor!');</script>");
    }
  }
}

// Kép feltöltése
if (isset($_POST['kepfeltoltes'])) {
  $target_dir = "kepek/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo('<script>alert("A megadott fájl nem kép.");</script>');
    $uploadOk = 0;
  }
  if (file_exists($target_file)) {
    echo('<script>alert("A megadott fájlnév már létezik.");</script>');
    $uploadOk = 0;
  }
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo('<script>alert("Csak JPG, JPEG, PNG és GIF tölthető fel.");</script>');
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    echo('<script>alert("Nem sikerült a feltöltés.");</script>');
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $fname = "\n" . basename($_FILES["fileToUpload"]["name"]);
      file_put_contents('kepek/kepek.txt', $fname, FILE_APPEND | LOCK_EX);
      echo('<script>alert("A feltöltés sikerült.");</script>');
    } else {
      echo('<script>alert("Hiba történt a feltöltés során.");</script>');
    }
  }
}

// Kilépés kezelése
if (isset($_GET['kilepes']) and $_GET['kilepes'] == 'true') {
  unset($_SESSION['userlname']);
  unset($_SESSION['userfname']);
  unset($_SESSION['loginname']);
  unset($_GET['kilepes']);
  session_abort();
}

// Összes üzenet megjelenítése egy új oldalon
if (isset($_GET['uzenetek'])) {
  $needMessages = true;
}

// Aktuális oldal beállítása
$keres = current($oldalak);
if (isset($_GET['oldal'])) {
  if (isset($oldalak[$_GET['oldal']])) {
    $keres = $oldalak[$_GET['oldal']];
  } else {
    $keres = $hiba_oldal;
    header("HTTP/1.0 404 Not Found");
  }
}

// index template oldal betöltése
include('oldalak/index.tpl.php');
?>