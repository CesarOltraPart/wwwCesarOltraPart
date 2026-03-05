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

// Guardar que estamos en la sección registre
$_SESSION['apartat'] = 'registre';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['cognoms'] = $_POST['cognoms'] ?? '';
    $_SESSION['adreca'] = $_POST['adreca'] ?? '';
    $_SESSION['correu'] = $_POST['correu'];
    $_SESSION['contrasenya'] = $_POST['contrasenya'];
    $_SESSION['telefon'] = $_POST['telefon'] ?? '';
    $_SESSION['donacio'] = $_POST['donacio'] ?? '';
    $_SESSION['apadrinar'] = $_POST['apadrinar'] ?? '';
    $_SESSION['continent'] = $_POST['continent'] ?? '';
    $_SESSION['puntuacio'] = $_POST['puntuacio'] ?? 0;
    $_SESSION['mult'] = $_POST['mult'] ?? 1;
    $_SESSION['animals'] = serialize($_POST['animals'] ?? []);
    
    // Inserir usuari a la base de dades
    $resultat = insereixUsuari(
        $_POST['nom'],
        $_POST['cognoms'] ?? '',
        $_POST['correu'],
        $_POST['contrasenya']
    );
    $_SESSION['resultat_registre'] = $resultat;
    
    registrarAccionsUsuari('processa_registre', $_POST['nom'], 'processaRegistre.php');
}
?>
<?php
include "./partials/css.partial.php";
include "./partials/cap.partial.php";
include "./partials/menu.partial.php";
include "./partials/processaRegistre.partial.php";
include "./partials/peu.partial.php";
?>
</body>
</html>
