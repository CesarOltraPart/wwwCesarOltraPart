<?php
session_start();
// destruir tota la sessió deixant només possibles estils si es vol
session_unset();
session_destroy();
header("Location: ../index.php");
die();
