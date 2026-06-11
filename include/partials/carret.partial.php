<?php
// mostra el resum del carret i de l'últim animal apadrinat
require_once __DIR__ . '/../entity/CredencialsBD.php';
require_once __DIR__ . '/../entity/CarretCompra.php';
require_once __DIR__ . '/../entity/Animal.php';

if (isset($_SESSION['carret'])) {
    $carret = unserialize($_SESSION['carret']);
    
    if ($carret !== null && $carret->getLlista() !== null && count($carret->getLlista()) > 0) {
        echo '<div class="carret">';
        echo '<h3>Carret de compra</h3>';
        
        // Nombre d'animals diferents
        $numAnimals = count($carret->getLlista());
        echo '<p>Animals al carret: ' . htmlspecialchars($numAnimals) . '</p>';
        
        // Últim animal afegit
        if (!empty($_SESSION['idAnimal'])) {
            $idUltim = intval($_SESSION['idAnimal']);
            $quantitatActual = intval($_SESSION['quantitatAnimal']);
            
            $animal = $carret->getAnimal($idUltim);
            if ($animal !== null) {
                // Quantitat de l'últim animal en el carret
                $quantitatTotal = $animal->getQuantitat();
                $donacio = $animal->getDonacio();
                
                echo '<p><strong>Últim apadrinament:</strong></p>';
                echo '<p>Nom: ' . htmlspecialchars($animal->getNomCo()) . '</p>';
                echo '<p>Donació actual: ' . htmlspecialchars($quantitatActual) . ' unitat/s de ' . htmlspecialchars($donacio) . ' €</p>';
                echo '<p>Total d\'aquest animal al carret: ' . htmlspecialchars($quantitatTotal) . ' unitat/s</p>';
            }
        }
        
        echo '</div>';
    }
    
    unset($carret);
}

