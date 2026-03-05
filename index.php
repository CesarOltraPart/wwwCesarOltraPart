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
            break;
    }
    include "./include/funcions.php";
    registrarNavegacio($apartat ?: 'inici');
    include "./include/partials/css.partial.php";
    include "./include/partials/cap.partial.php";
    include "./include/partials/menu.partial.php";
    include "./include/partials/" . $incluir . ".partial.php";
    include "./include/partials/peu.partial.php";
    
    
?>  
</body>
</html>
