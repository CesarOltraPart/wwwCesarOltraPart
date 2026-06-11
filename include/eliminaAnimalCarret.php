<?php
session_start();
require_once __DIR__ . '/entity/CarretCompra.php';
require_once __DIR__ . '/entity/Animal.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if ($id === null) {
    header('Location: ../index.php?apartat=apadrina&mostrar=carret');
    die();
}

if (!isset($_SESSION['carret'])) {
    header('Location: ../index.php?apartat=apadrina&mostrar=carret');
    die();
}

$carret = unserialize($_SESSION['carret']);
if ($carret !== null) {
    $carret->eliminarAnimal($id);
    // si l'animal eliminat era l'últim vist, eliminem la informació d'últim apadrinament
    if (isset($_SESSION['idAnimal']) && intval($_SESSION['idAnimal']) === $id) {
        unset($_SESSION['idAnimal']);
        unset($_SESSION['quantitatAnimal']);
    }
    $_SESSION['carret'] = serialize($carret);
}

header('Location: ../index.php?apartat=apadrina&mostrar=carret');
die();
?>