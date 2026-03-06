<?php
session_start();
include "./funcions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    die();
}

$correu = $_POST['correuLogin'] ?? '';
$contrasenya = $_POST['contrasenyaLogin'] ?? '';

// cerquem l'usuari amb correu sense tenir en compte majúscules
try {
    $connexio = new mysqli('localhost', 'root', 'root', 'projectePHPCesarOltraPart');
    if ($connexio->connect_error) {
        error_log('Error connexió login: ' . $connexio->connect_error);
        header("Location: ../index.php");
        die();
    }
    $connexio->set_charset('utf8mb4');

    $sql = 'SELECT nom, correu, contrasenya FROM usuari WHERE LOWER(correu) = LOWER(?)';
    $stmt = $connexio->prepare($sql);
    if (!$stmt) {
        error_log('Error prepare login: ' . $connexio->error);
        $connexio->close();
        header("Location: ../index.php");
        die();
    }
    $stmt->bind_param('s', $correu);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $stmt->close();
        $connexio->close();
        header("Location: ../index.php?error=loginCorreu");
        die();
    }

    $stmt->bind_result($nomDB, $correuDB, $contrasenyaDB);
    $stmt->fetch();
    $stmt->close();
    $connexio->close();

    if ($contrasenya !== $contrasenyaDB) {
        header("Location: ../index.php?error=loginContrasenya");
        die();
    }

    // autenticació correcta: creem variables de sessió
    $_SESSION['usuari_nom'] = $nomDB;
    $_SESSION['usuari_correu'] = $correuDB;
    // bandera d'administrador segons correu
    if (strcasecmp($correuDB, 'admin@daw.com') === 0) {
        $_SESSION['admin'] = true;
    }

    header("Location: ../index.php");
    die();
} catch (Exception $e) {
    error_log('Exception login: ' . $e->getMessage());
    header("Location: ../index.php");
    die();
}
