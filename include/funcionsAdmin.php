<?php
require_once __DIR__ . '/entity/CredencialsBD.php';

function gestionaUsuaris(): void {
    // obtenim tots els usuaris
    try {
        $connexio = new mysqli(
            CredencialsBD::SERVIDOR,
            CredencialsBD::USUARI,
            CredencialsBD::CONTRASENYA,
            CredencialsBD::BASEDADES
        );
        if ($connexio->connect_error) {
            echo '<p class="error">Error de connexió a la base de dades.</p>';
            return;
        }
        $connexio->set_charset('utf8mb4');

        $sql = 'SELECT id, nom, correu, contrasenya FROM usuari';
        $result = $connexio->query($sql);
        if (!$result) {
            echo '<p class="error">Error en la consulta de la taula d\'usuaris.</p>';
            $connexio->close();
            return;
        }

        echo '<table border="1" cellpadding="5" cellspacing="0">';
        echo '<tr><th>Id</th><th>Nom</th><th>Correu</th><th>Contrasenya</th><th>Acció</th></tr>';
        while ($row = $result->fetch_assoc()) {
            $isAdmin = strcasecmp($row['correu'], 'admin@daw.com') === 0;
            $pw = $row['contrasenya'];
            $pwShow = substr($pw, 0, 15) . (strlen($pw) > 15 ? '...' : '');
            echo '<tr';
            if ($isAdmin) {
                echo ' style="background-color:#f0f0f0;font-weight:bold;"';
            }
            echo '>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
            echo '<td>' . htmlspecialchars($row['correu']) . '</td>';
            echo '<td>' . htmlspecialchars($pwShow) . '</td>';
            echo '<td>';
            if (!$isAdmin) {
                $ruta = (basename($_SERVER['PHP_SELF']) === 'index.php') ? 'include/eliminaUsuari.php' : '../include/eliminaUsuari.php';
                echo '<a href="' . $ruta . '?id=' . urlencode($row['id']) . '">';
                echo '<img src="./imatges/eliminar.png" alt="esborra" width="20" height="20">';
                echo '</a>';
            }
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';

        $result->free();
        $connexio->close();
    } catch (Exception $e) {
        echo '<p class="error">Exception: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}

// Mostra el contingut del fitxer de registre amb color segons l'acció
function mostraAccionsUsuari(): void {
    $directori = obtenirDirectoriRegistre();
    $fitxer = $directori . '/accionsUsuari.log';
    if (!file_exists($fitxer)) {
        echo '<p>No hi ha registres disponibles.</p>';
        return;
    }

    $lines = file($fitxer, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    echo '<div class="log-entries">';
    foreach ($lines as $line) {
        // generem un color de fons aleatori per a cada línia
        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        echo '<div style="background-color:' . $color . '; padding:0.3em; margin:0.1em 0; border-radius:4px;">'
             . htmlspecialchars($line) . '</div>';
    }
    echo '</div>';
}
