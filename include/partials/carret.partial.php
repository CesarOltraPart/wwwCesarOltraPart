<?php
// mostra el resum del darrer animal apadrinat si existeixen sessió
if (!empty($_SESSION['idAnimal']) && !empty($_SESSION['quantitatAnimal'])) {
    // necessitem dades del animal
    require_once __DIR__ . '/../entity/CredencialsBD.php';

    $id = intval($_SESSION['idAnimal']);
    $qt = intval($_SESSION['quantitatAnimal']);

    $conn = new mysqli(
        CredencialsBD::SERVIDOR,
        CredencialsBD::USUARI,
        CredencialsBD::CONTRASENYA,
        CredencialsBD::BASEDADES
    );
    if (!$conn->connect_error) {
        $conn->set_charset('utf8mb4');
        $sql = "SELECT nom_comu, donacio FROM animal WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                $stmt->bind_result($nom, $donacio);
                if ($stmt->fetch()) {
                    $total = $qt * $donacio;
                    echo '<div class="carret">';
                    echo '<h3>Últim apadrinament</h3>';
                    echo '<p>Id: ' . htmlspecialchars($id) . '</p>';
                    echo '<p>Nom: ' . htmlspecialchars($nom) . '</p>';
                    echo '<p>Quantitat: ' . htmlspecialchars($qt) . '</p>';
                    echo '<p>Donació total: ' . htmlspecialchars($total) . ' €</p>';
                    echo '</div>';
                }
            }
            $stmt->close();
        }
        $conn->close();
    }
}
