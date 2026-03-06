<?php
session_start();
include "./funcions.php";

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: ../index.php");
    die();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header("Location: ../index.php?accioadmin=errorbasedades");
    die();
}

try {
    $connexio = new mysqli('localhost', 'root', 'root', 'projectePHPCesarOltraPart');
    if ($connexio->connect_error) {
        header("Location: ../index.php?accioadmin=errorbasedades");
        die();
    }
    $connexio->set_charset('utf8mb4');

    // no es pot eliminar l'admin
    $stmt = $connexio->prepare('SELECT correu FROM usuari WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($correu);
    if ($stmt->fetch() && strcasecmp($correu, 'admin@daw.com') === 0) {
        $stmt->close();
        $connexio->close();
        header("Location: ../index.php?accioadmin=errorbasedades");
        die();
    }
    $stmt->close();

    $del = $connexio->prepare('DELETE FROM usuari WHERE id = ?');
    $del->bind_param('i', $id);
    if ($del->execute()) {
        $del->close();
        $connexio->close();
        header("Location: ../index.php?accioadmin=eliminat");
        die();
    } else {
        $del->close();
        $connexio->close();
        header("Location: ../index.php?accioadmin=errorbasedades");
        die();
    }
} catch (Exception $e) {
    header("Location: ../index.php?accioadmin=errorbasedades");
    die();
}
