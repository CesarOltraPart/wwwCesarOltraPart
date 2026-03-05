<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apadriana animals</title>
    <link rel="stylesheet" href="../css/estils<?php 
    $estils = "";
    if (isset($_POST['estils'])) {
        $estils = trim(htmlspecialchars($_POST['estils']));
    }
    echo $estils;
    ?>.css">
</head>
<body>
  <?php
    include "./partials/css.partial.php";
    include "./partials/cap.partial.php";
    include "./partials/menu.partial.php";
    include "./partials/processaRegistre.partial.php";
    include "./partials/peu.partial.php";
    include "./include/funcions.php";
    registrarAccionsUsuari('processa_registre', $_POST['usuari'], 'processaRegistre.php');
    
?>  
</body>
</html>
