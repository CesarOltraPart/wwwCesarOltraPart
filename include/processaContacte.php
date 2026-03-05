<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apadriana animals</title>
    <link rel="stylesheet" href="../css/estils.css">
</head>
<body>
<?php
session_start();
include "./funcions.php";

$_SESSION['apartat'] = 'contacte';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['correu'] = $_POST['correu'];
    $_SESSION['assumpte'] = $_POST['assumpte'];
    $_SESSION['missatge'] = $_POST['missatge'];
    
    registrarAccionsUsuari('processa_contacte', $_POST['correu'], 'processaContacte.php');
}
?>
<?php
include "./partials/css.partial.php";
include "./partials/cap.partial.php";
include "./partials/menu.partial.php";
include "./partials/processaContacte.partial.php";
include "./partials/peu.partial.php";
?>
</body>
</html>