<?php
session_start();
include "./include/funcions.php";

// process form from apadrina section
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['apartat']) && $_GET['apartat'] === 'apadrina') {
    if (isset($_POST['idAnimal'], $_POST['quantitatAnimal'])) {
        $_SESSION['idAnimal'] = intval($_POST['idAnimal']);
        $_SESSION['quantitatAnimal'] = intval($_POST['quantitatAnimal']);
    }
}

esborraVariablesSessio();
if (isset($_GET['estils'])) {
    $_SESSION['estils'] = $_GET['estils'];
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apadriana animals</title>
    <link rel="stylesheet" href="css/estils.css">
</head>
<body>
  <?php
    $apartat = "";
    $incluir = "principal";
    if (isset($_GET['apartat'])) {
        $apartat = $_GET['apartat'];
    }
    switch ($apartat) {
        case "registre":
            $incluir = "registre";
            break;
        case "contacte":
            $incluir = "contacte";
            break;
        case "apadrina":
            $incluir = "apadrina";
            break;
        
        default:
            $incluir = "inici";
            $apartat = "inici";
            break;
    }
    $_SESSION['apartat'] = $apartat;
    if (isset($_SESSION['admin'])) {
        $incluir = 'admin';
    }
   
    include "./include/partials/css.partial.php";
    include "./include/partials/cap.partial.php";
    if (!isset($_SESSION['admin'])) {
        include "./include/partials/menu.partial.php";
    }

    include "./include/partials/principal.partial.php";

    if (isset($inici_override) && $inici_override) {
        include "./include/partials/inici.partial.php";
    } else {
        if (isset($_GET['error']) && $_GET['error'] === 'contrasenya' && $apartat === 'registre') {
            echo '<p class="error">Les contrasenyes no coincideixen.</p>';
        }
        include "./include/partials/" . $incluir . ".partial.php";
    }

    include "./include/partials/peu.partial.php";
    
    
?>  
</body>
</html>
