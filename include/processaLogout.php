<?php
session_start();
include "./funcions.php";
// abans de destruir la sessió registem el logout si hi ha usuari
if (isset($_SESSION['usuari_correu'])) {
    registrarAccionsUsuari('logout', $_SESSION['usuari_correu'], __FILE__);
}
// destruir tota la sessió deixant només possibles estils si es vol
session_unset();
session_destroy();
header("Location: ../index.php");
die();
