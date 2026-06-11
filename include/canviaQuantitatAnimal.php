<?php
session_start();
require_once __DIR__ . '/entity/CarretCompra.php';
require_once __DIR__ . '/entity/Animal.php';

$id = isset($_POST['idAnimal']) ? intval($_POST['idAnimal']) : null;
$quantitat = isset($_POST['quantitat']) ? intval($_POST['quantitat']) : null;

if ($id === null || $quantitat === null) {
    header('Location: ../index.php?apartat=apadrina&mostrar=carret');
    die();
}

if (!isset($_SESSION['carret'])) {
    header('Location: ../index.php?apartat=apadrina&mostrar=carret');
    die();
}

$carret = unserialize($_SESSION['carret']);
if ($carret !== null) {
    $carret->canviarQuantitatAnimal($quantitat, $id);
    // si s'està modificant l'últim apadrinament, actualitzem la sessió
    if (isset($_SESSION['idAnimal']) && intval($_SESSION['idAnimal']) === $id) {
        $_SESSION['quantitatAnimal'] = $quantitat;
    }
    $_SESSION['carret'] = serialize($carret);
}

header('Location: ../index.php?apartat=apadrina&mostrar=carret');
die();
?>