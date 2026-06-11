<?php
require_once __DIR__ . '/../entity/CarretCompra.php';
require_once __DIR__ . '/../entity/Animal.php';

if (!isset($_SESSION['carret'])) {
    echo '<p>El carret està buit.</p>';
    return;
}
$carret = unserialize($_SESSION['carret']);
if ($carret === null || $carret->getLlista() === null || count($carret->getLlista()) === 0) {
    echo '<p>El carret està buit.</p>';
    return;
}

// utilitza el mètode de la classe per mostrar una versió no editable
if (method_exists($carret, 'mostrarApadrina')) {
    $carret->mostrarApadrina();
} else {
    // fallback: mostrar resum manual
    echo '<div class="mostrar-apadrina">';
    echo '<h3>Resum apadrinament</h3>';
    $total = 0.0;
    foreach ($carret->getLlista() as $animal) {
        $quant = $animal->getQuantitat();
        $don = $animal->getDonacio();
        $total += $quant * $don;
    }
    echo '<p>Animals diferents: ' . htmlspecialchars(count($carret->getLlista())) . '</p>';
    echo '<p>Preu total: ' . htmlspecialchars(number_format($total,2)) . ' €</p>';
    echo '<ul>';
    foreach ($carret->getLlista() as $animal) {
        echo '<li>' . htmlspecialchars($animal->getNomCo()) . ' - Quantitat: ' . intval($animal->getQuantitat()) . ' - Donació: ' . htmlspecialchars($animal->getDonacio()) . ' €</li>';
    }
    echo '</ul>';

    if (!isset($_SESSION['usuari_correu'])) {
        echo '<p>Has d\'autenticar-te per confirmar l\'apadrinament. <a href="index.php?apartat=registre">Login/Registre</a></p>';
    } else {
        echo '<p><a href="include/processaApadrina.php">Confirmar apadrinament</a></p>';
    }

    echo '<p><a href="index.php?apartat=apadrina&mostrar=carret">Tornar al carret</a></p>';
    echo '</div>';
}

unset($carret);
?>
