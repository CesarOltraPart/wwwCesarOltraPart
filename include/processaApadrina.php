<?php
session_start();
require_once __DIR__ . '/entity/CredencialsBD.php';
require_once __DIR__ . '/entity/CarretCompra.php';
require_once __DIR__ . '/entity/Animal.php';

if (!isset($_SESSION['carret'])) {
    header('Location: ../index.php?apartat=apadrina');
    die();
}

$carret = unserialize($_SESSION['carret']);
if ($carret === null || $carret->getLlista() === null || count($carret->getLlista()) === 0) {
    header('Location: ../index.php?apartat=apadrina');
    die();
}

if (!isset($_SESSION['usuari_correu'])) {
    header('Location: ../index.php?apartat=registre');
    die();
}

$conn = new mysqli(
    CredencialsBD::SERVIDOR,
    CredencialsBD::USUARI,
    CredencialsBD::CONTRASENYA,
    CredencialsBD::BASEDADES
);
if ($conn->connect_error) {
    error_log('Error connexió processaApadrina: ' . $conn->connect_error);
    header('Location: ../index.php?apartat=apadrina&error=db');
    die();
}
$conn->set_charset('utf8mb4');

// Assegurar que la taula apadrina existeix
$createSql = "CREATE TABLE IF NOT EXISTS apadrina (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idapadrina INT NOT NULL,
    idusuari VARCHAR(255) NOT NULL,
    idanimal VARCHAR(255) NOT NULL,
    quantitat INT NOT NULL,
    donacio FLOAT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($createSql);

// calcular el següent idapadrina
$res = $conn->query('SELECT MAX(idapadrina) AS m FROM apadrina');
$nextIdApadrina = 1;
if ($res) {
    $row = $res->fetch_assoc();
    if ($row && $row['m'] !== null) {
        $nextIdApadrina = intval($row['m']) + 1;
    }
    $res->free();
}

$idusuari = $conn->real_escape_string($_SESSION['usuari_correu']);

$stmt = $conn->prepare('INSERT INTO apadrina (idapadrina, idusuari, idanimal, quantitat, donacio) VALUES (?,?,?,?,?)');
if (!$stmt) {
    error_log('Error prepare insert apadrina: ' . $conn->error);
    header('Location: ../index.php?apartat=apadrina&error=db');
    die();
}

foreach ($carret->getLlista() as $animal) {
    $idanimal = $animal->getId();
    $quantitat = $animal->getQuantitat();
    $donacio = $animal->getDonacio();
    $stmt->bind_param('issid', $nextIdApadrina, $idusuari, $idanimal, $quantitat, $donacio);
    if (!$stmt->execute()) {
        error_log('Error insert apadrina: ' . $stmt->error);
    } else {
        // actualitzar quantitat a la taula animal
        $qUpdate = $conn->prepare('UPDATE animal SET quantitat = quantitat + ? WHERE id = ?');
        if ($qUpdate) {
            $qUpdate->bind_param('ii', $quantitat, $idanimal);
            $qUpdate->execute();
            $qUpdate->close();
        }
    }
}
$stmt->close();

// buidar carret i netsessió de l'últim apadrinament
$carret->buidarCarret();
$_SESSION['carret'] = serialize($carret);
unset($_SESSION['idAnimal']);
unset($_SESSION['quantitatAnimal']);

$conn->close();

header('Location: ../index.php?apartat=apadrina&msg=apadrinat');
die();
?>
