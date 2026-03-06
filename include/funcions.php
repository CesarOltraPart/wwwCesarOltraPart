<?php 

// accés a constants de connexió
require_once __DIR__ . '/entity/CredencialsBD.php';

function obtenirDirectoriRegistre(): string {
    $arrel = realpath(__DIR__ . '/..');
    if ($arrel === false) {
        $arrel = dirname(__DIR__);
    }

    $directori_registre = $arrel . '/log';

    if (basename($directori_registre) === 'backup') {
        $directori_registre = dirname($directori_registre);
    }

    return $directori_registre;
}

function assegurarDirectoriRegistreExisteix(string $directori): void {
    if (!is_dir($directori)) {
        mkdir($directori, 0755, true);
    }

    if (!is_writable($directori)) {
        @chmod($directori, 0755);
    }

    if (function_exists('posix_geteuid') && posix_geteuid() === 0) {
        @chown($directori, 'www-data');
        @chgrp($directori, 'www-data');
    }
}

function registrarAccionsUsuari(string $accio, string $usuari, string $fitxer): void {
    $directori_registre = obtenirDirectoriRegistre();
    assegurarDirectoriRegistreExisteix($directori_registre);

    $arxiu_registre = $directori_registre . '/accionsUsuari.log';
    if (!file_exists($arxiu_registre)) {
        touch($arxiu_registre);
    }

    $marca_temps = date('d/m/Y') . ' a l\'hora ' . date('H:i:s');
    $entrada = 'L\'usuari ' . $usuari . ' ha realitzat l\'acció ' . strtoupper($accio) . ' el dia ' . $marca_temps . PHP_EOL;

    file_put_contents($arxiu_registre, $entrada, FILE_APPEND);
}

function esborraVariablesSessio() {
    // apart de l'estil i dades d'usuari/admin també conservem les dades del carret
    $keep = ['estils', 'usuari_nom', 'usuari_correu', 'admin', 'idAnimal', 'quantitatAnimal'];
    foreach ($_SESSION as $key => $value) {
        if (!in_array($key, $keep)) {
            unset($_SESSION[$key]);
        }
    }
}

function errorContrasenya(): void {
    header("Location: ../index.php?apartat=registre&error=contrasenya");
    die();
}

function missatgeErrorLogin(string $error): void {
    $msg = '';
    if ($error === 'loginCorreu') {
        $msg = 'L\'usuari no existeix.';
    } elseif ($error === 'loginContrasenya') {
        $msg = 'Contrasenya incorrecta.';
    }
    if ($msg !== '') {
        echo '<p class="error error-login">' . htmlspecialchars($msg) . '</p>';
    }
}

function usuariExisteix(string $correu): bool {
    try {
        $connexio = new mysqli('localhost', 'root', 'root', 'projectePHPCesarOltraPart');
        
        if ($connexio->connect_error) {
            error_log('Error connexió: ' . $connexio->connect_error);
            return false;
        }
        
        $connexio->set_charset('utf8mb4');
        
        $sql = 'SELECT id FROM usuari WHERE correu = ?';
        $stmt = $connexio->prepare($sql);
        
        if (!$stmt) {
            error_log('Error prepare: ' . $connexio->error);
            $connexio->close();
            return false;
        }
        
        $stmt->bind_param('s', $correu);
        
        if ($stmt->execute()) {
            $stmt->store_result();
            $existeix = $stmt->num_rows > 0;
            $stmt->close();
            $connexio->close();
            return $existeix;
        } else {
            error_log('Error execute: ' . $stmt->error);
            $stmt->close();
            $connexio->close();
            return false;
        }
    } catch (Exception $e) {
        error_log('Exception: ' . $e->getMessage());
        return false;
    }
}

function insereixUsuari(string $nom, string $cognoms, string $correu, string $contrasenya): string {
    try {
        if (usuariExisteix($correu)) {
            return 'usuariExisteix';
        }

        // generar hash de la contrasenya
        $hash = password_hash($contrasenya, PASSWORD_DEFAULT);

        $connexio = new mysqli(
            CredencialsBD::SERVIDOR,
            CredencialsBD::USUARI,
            CredencialsBD::CONTRASENYA,
            CredencialsBD::BASEDADES
        );
        if ($connexio->connect_error) {
            error_log('Error connexió: ' . $connexio->connect_error);
            return 'error';
        }
        $connexio->set_charset('utf8mb4');

        // si el hash és molt llarg, s'intenta ampliar la columna abans d'insistir
        if (strlen($hash) > 255) {
            $connexio->query("ALTER TABLE usuari MODIFY contrasenya VARCHAR(512) NOT NULL");
        }

        $cognoms_valor = trim($cognoms);
        $sql = 'INSERT INTO usuari (nom, cognoms, correu, contrasenya) VALUES (?, ?, ?, ?)';
        $stmt = $connexio->prepare($sql);
        if (!$stmt) {
            error_log('Error prepare: ' . $connexio->error);
            $connexio->close();
            return 'error';
        }
        $stmt->bind_param('ssss', $nom, $cognoms_valor, $correu, $hash);
        if ($stmt->execute()) {
            $stmt->close();
            $connexio->close();
            return 'usuariInserit';
        } else {
            if (stripos($stmt->error, 'Data too long') !== false) {
                $connexio->query("ALTER TABLE usuari MODIFY contrasenya VARCHAR(512) NOT NULL");
            }
            error_log('Error execute: ' . $stmt->error);
            $stmt->close();
            $connexio->close();
            return 'error';
        }
    } catch (Exception $e) {
        error_log('Exception: ' . $e->getMessage());
        return 'error';
    }
}
function mostraFormulariAnimal(int $id): void {
    // cada formulari té un identificador únic basat en l'id de l'animal
    $formId   = 'formAnimal' . $id;
    $hidId    = 'idAnimal' . $id;
    $quantId  = 'quantitatAnimal' . $id;
    $btnId    = 'enviaFormAnimal' . $id;

    echo '<form id="' . $formId . '" name="' . $formId . '" action="index.php?apartat=apadrina" method="POST">';
    echo '<input type="hidden" id="' . $hidId . '" name="idAnimal" value="' . $id . '">';
    echo '<div><span><label for="' . $quantId . '">Quantitat:</label></span>';
    echo '<span><input id="' . $quantId . '" name="quantitatAnimal" type="number" min="0" step="1"></span></div>';
    echo '<div><span><button id="' . $btnId . '" name="envia" type="submit">Afegeix al carret</button></span></div>';
    echo '</form>';
}

function mostraAnimals(): void {
    try {
        $conn = new mysqli(
            CredencialsBD::SERVIDOR,
            CredencialsBD::USUARI,
            CredencialsBD::CONTRASENYA,
            CredencialsBD::BASEDADES
        );
        if ($conn->connect_error) {
            echo '<p class="error">Error de connexió amb la base de dades.</p>';
            return;
        }
        $conn->set_charset('utf8mb4');
        $sql = 'SELECT id, nom_comu, nom_cientific, descripcio, donacio, imatge, quantitat, data_afegit FROM animal';
        $result = $conn->query($sql);
        if (!$result) {
            echo '<p class="error">No s\'ha pogut recuperar la llista d\'animals.</p>';
            $conn->close();
            return;
        }
        echo '<div class="llista-animals">';
        while ($animal = $result->fetch_assoc()) {
            $imgPath = './imatges/' . htmlspecialchars($animal['imatge']);
            echo '<div class="tarjeta-animal">';
            echo '<h3>' . htmlspecialchars($animal['nom_comu']) . '</h3>';
            echo '<p><em>' . htmlspecialchars($animal['nom_cientific']) . '</em></p>';
            echo '<div class="imatge-animal"><img src="' . $imgPath . '" alt="' . htmlspecialchars($animal['nom_comu']) . '" /></div>';
            if ($animal['descripcio'] !== '') {
                echo '<p>' . htmlspecialchars($animal['descripcio']) . '</p>';
            }
            echo '<p>Donació: ' . htmlspecialchars($animal['donacio']) . ' €</p>';
            echo '<p>Quantitat apadrinada: ' . htmlspecialchars($animal['quantitat']) . '</p>';

            // afegim formulari específic per cada animal
            mostraFormulariAnimal((int)$animal['id']);

            echo '</div>';
        }
        echo '</div>';
        $result->free();
        $conn->close();
    } catch (Exception $e) {
        echo '<p class="error">Exception: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
