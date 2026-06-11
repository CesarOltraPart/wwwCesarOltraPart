<?php
session_start();
include "./include/funcions.php";
include "./include/entity/CarretCompra.php";

// process form from apadrina section
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['apartat']) && $_GET['apartat'] === 'apadrina') {
    if (isset($_POST['idAnimal'], $_POST['quantitatAnimal'])) {
        $idAnimal = intval($_POST['idAnimal']);
        $quantitat = intval($_POST['quantitatAnimal']);
        
        // Determinar el ID del carret
        if (isset($_SESSION['usuari_correu'])) {
            $idCarret = $_SESSION['usuari_correu'];
        } else {
            $idCarret = session_id();
        }
        
        // Obtenir o crear el carret
        if (isset($_SESSION['carret'])) {
            $carret = unserialize($_SESSION['carret']);
        } else {
            $carret = new CarretCompra($idCarret);
        }
        
        // Obtenir els dades de l'animal de la BD
        $animal = nouAnimal($idAnimal, $quantitat);
        
        if ($animal !== null) {
            // Comprovar si l'animal ja existeix en el carret
            $animalExistent = $carret->getAnimal($idAnimal);
            
            if ($animalExistent !== null) {
                // Si existeix, acumular la quantitat
                $carret->acumularQuantitatAnimal($quantitat, $idAnimal);
            } else {
                // Si no existeix, afegir el nou animal
                $carret->afegirAnimal($animal);
            }
            
            // Serialitzar i guardar el carret en la sessió
            $_SESSION['carret'] = serialize($carret);
            
            // Guardar referència a l'últim animal afegit
            $_SESSION['idAnimal'] = $idAnimal;
            $_SESSION['quantitatAnimal'] = $quantitat;
            
            unset($carret);
        }
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
