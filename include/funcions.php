<?php 

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

function registrarNavegacio($apartat) {
    $directori_registre = obtenirDirectoriRegistre();
    assegurarDirectoriRegistreExisteix($directori_registre);

    $arxiu_registre = $directori_registre . '/navegacio.log';
    if (!file_exists($arxiu_registre)) {
        touch($arxiu_registre);
    }

    $linies = @file($arxiu_registre, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $numero_linia = is_array($linies) ? count($linies) : 0;

    if ($numero_linia > 0 && $numero_linia % 10 === 0) {
        $directori_copia_seguretat = $directori_registre . '/backup';
        assegurarDirectoriRegistreExisteix($directori_copia_seguretat);

        $marca_temps_copia = date('d-m-Y_H-i-s');
        $arxiu_copia = $directori_copia_seguretat . '/backup_' . $marca_temps_copia . '.log';
        if (!copy($arxiu_registre, $arxiu_copia)) {
            error_log("Error al copiar el registre a la còpia de seguretat: $arxiu_registre -> $arxiu_copia");
        }
    }

    $linies = @file($arxiu_registre, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $numero_linia = (is_array($linies) ? count($linies) : 0) + 1;

    $marca_temps = date('d/m/Y a l\'hora H:i:s');
    $entrada = $numero_linia . ' :: Accés a l\'apartat ' . strtoupper($apartat) . ' el dia ' . $marca_temps . PHP_EOL;

    file_put_contents($arxiu_registre, $entrada, FILE_APPEND);
}
?>