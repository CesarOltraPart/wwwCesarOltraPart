<?php
// pàgina per acabar el procés d'apadrinament (resum/confirmació simplificada)
if (!isset($_SESSION['carret'])) {
    echo '<p>No hi ha cap carret per processar.</p>';
    echo '<p><a href="../index.php?apartat=apadrina">Tornar</a></p>';
    return;
}
$carret = unserialize($_SESSION['carret']);
if ($carret === null || $carret->getLlista() === null || count($carret->getLlista()) === 0) {
    echo '<p>El carret està buit.</p>';
    echo '<p><a href="../index.php?apartat=apadrina">Tornar</a></p>';
    return;
}

echo '<div class="finalitza-apadrinament">';
echo '<h3>Finalitza apadrinament</h3>';
// mostra resum senzill
$totalArticles = count($carret->getLlista());
echo '<p>Articles al carret: ' . htmlspecialchars($totalArticles) . '</p>';

echo '<p>Aquesta funcionalitat encara no processa pagaments; es mostra un resum.</p>';

    echo '<p><a href="index.php?apartat=apadrina&mostrar=carret">Tornar a veure el carret</a></p>';

    echo '<p><a href="index.php?apartat=apadrina">Tornar a llistat d\'animals</a></p>';

echo '</div>';

unset($carret);
?>