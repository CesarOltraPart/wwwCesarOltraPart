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

echo '<div class="mostra-carret">';
echo '<h3>Contingut del carret</h3>';

echo '<ul>';
foreach ($carret->getLlista() as $animal) {
    $id = $animal->getId();
    $nom = htmlspecialchars($animal->getNomCo());
    $quantitat = intval($animal->getQuantitat());
    $donacio = htmlspecialchars($animal->getDonacio());

    echo '<li>';
    echo $nom . ' - Quantitat: ' . $quantitat . ' - Donació per unitat: ' . $donacio . ' €';
    echo ' <a href="include/eliminaAnimalCarret.php?id=' . urlencode($id) . '">Elimina</a>';
    // formulari per canviar quantitat
    echo '<form action="include/canviaQuantitatAnimal.php" method="POST" style="display:inline;margin-left:8px">';
    echo '<input type="hidden" name="idAnimal" value="' . htmlspecialchars($id) . '">';
    echo '<input type="number" name="quantitat" min="0" step="1" value="' . $quantitat . '" style="width:60px">';
    echo '<button type="submit">Actualitza</button>';
    echo '</form>';
    echo '</li>';
}
echo '</ul>';

// enllaç per tornar a llistat d'animals apadrinables
echo '<p><a href="index.php?apartat=apadrina">Tornar a llistat d\'animals</a></p>';

echo '</div>';

unset($carret);
?>