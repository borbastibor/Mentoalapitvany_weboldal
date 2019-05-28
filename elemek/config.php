<?php
$fejléc = array('cím' => 'Szeghalmi Mentőalapítvány');

$oldalak = array(
  '/' => array('fájl' => 'kezdo', 'szoveg' => 'Kezdőlap'), 
  'rolunk' => array('fájl' => 'rolunk', 'szoveg' => 'Rólunk'), 
  'tamogatoink' => array('fájl' => 'tamogatoink', 'szoveg' => 'Támogatóink'),
  'nyiltnap' => array('fájl' => 'nyiltnap', 'szoveg' => 'Nyílt nap'),
  'kapcsolat' => array('fájl' => 'kapcsolat', 'szoveg' => 'Kapcsolat'),
  'galeria' => array('fájl' => 'galeria', 'szoveg' => 'Galéria')
);

$hiba_oldal = array ('fájl' => '404', 'szoveg' => 'A keresett oldal nem található');

$dbserver = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "borbastibor";
$dbcon = null;

// Adatbázis kapcsolat létrehozása
try {
  $dbcon = new PDO("mysql:host=$dbserver;dbname=$dbname;charset=utf8",$dbusername,$dbpassword);
  $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo("<script>alert('Adatbáziskapcsolat létrehozása sikeretelen volt!');</script>");
}
?>