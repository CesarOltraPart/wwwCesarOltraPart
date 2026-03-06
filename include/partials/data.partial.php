<?php
// mostrar data i, si s'ha autenticat, benvinguda amb nom formatejat

$esIndex = strcmp(basename($_SERVER['PHP_SELF']), "index.php") === 0;

date_default_timezone_set('Europe/Madrid');
$dies = ['Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte', 'Diumenge'];
$mesos = ['gener', 'febrer', 'març', 'abril', 'maig', 'juny', 'juliol', 'agost', 'setembre', 'octubre', 'novembre', 'desembre'];
$diaNumero = date('N') - 1;
$mesNumero = date('n') - 1;
$dataActual = $dies[$diaNumero] . ', ' . date('d') . ' de ' . $mesos[$mesNumero] . ' de ' . date('Y');

echo "<p class=\"data\">Data d'avui: $dataActual</p>";

// si hi ha sessió d'usuari mostrar benvinguda
if (isset($_SESSION['usuari_nom']) || isset($_SESSION['usuari_correu'])) {
    $nom = $_SESSION['usuari_nom'] ?? $_SESSION['usuari_correu'];
    $nomFormat = ucfirst(strtolower($nom));
    if ($esIndex) {
        echo '<p class="benvinguda">Benvingut, ' . htmlspecialchars($nomFormat) . '</p>';
    } else {
        echo '<p class="benvinguda">Benvingut, ' . htmlspecialchars($nomFormat) . '</p>';
    }
}
