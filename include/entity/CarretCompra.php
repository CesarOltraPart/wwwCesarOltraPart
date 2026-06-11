<?php

class CarretCompra {
    private string $idUsuari;
    private ?array $llista = null;

    public function __construct(string $idUsuari) {
        $this->idUsuari = $idUsuari;
        $this->llista = null;
    }

    // Getters
    public function getIdUsuari(): string {
        return $this->idUsuari;
    }

    public function getLlista(): ?array {
        return $this->llista;
    }

    // Setters
    public function setIdUsuari(string $idUsuari): void {
        $this->idUsuari = $idUsuari;
    }

    public function setLlista(?array $llista): void {
        $this->llista = $llista;
    }

    // Mètodes
    public function afegirAnimal(Animal $animal): void {
        if ($this->llista === null) {
            $this->llista = [];
        }
        // evitar duplicats: si ja existeix no afegim (s'utilitza acumularQuantitatAnimal)
        foreach ($this->llista as $ex) {
            if ($ex->getId() === $animal->getId()) {
                return;
            }
        }
        $this->llista[] = $animal;
        // ordenar per id ascendent
        usort($this->llista, function($a, $b) {
            return $a->getId() <=> $b->getId();
        });
    }

    public function eliminarAnimal(int $idAnimal): void {
        if ($this->llista === null) {
            return;
        }
        foreach ($this->llista as $idx => $animal) {
            if ($animal->getId() === $idAnimal) {
                unset($this->llista[$idx]);
                // reindex
                $this->llista = array_values($this->llista);
                return;
            }
        }
    }

    public function getAnimal(int $idAnimal): ?Animal {
        if ($this->llista === null) {
            return null;
        }
        foreach ($this->llista as $animal) {
            if ($animal->getId() === $idAnimal) {
                return $animal;
            }
        }
        return null;
    }

    public function canviarQuantitatAnimal(int $quantitat, int $idAnimal): void {
        if ($this->llista === null) {
            return;
        }
        foreach ($this->llista as $animal) {
            if ($animal->getId() === $idAnimal) {
                $animal->setQuantitat($quantitat);
                return;
            }
        }
    }

    public function acumularQuantitatAnimal(int $quantitat, int $idAnimal): void {
        if ($this->llista === null) {
            return;
        }
        foreach ($this->llista as $animal) {
            if ($animal->getId() === $idAnimal) {
                $quantitatActual = $animal->getQuantitat();
                $animal->setQuantitat($quantitatActual + $quantitat);
                return;
            }
        }
    }

    public function mostrarCarret(): void {
        if ($this->llista === null || count($this->llista) === 0) {
            echo '<p>El carret està buit.</p>';
            return;
        }
        echo '<ul>';
        foreach ($this->llista as $animal) {
            echo '<li>';
            echo htmlspecialchars($animal->getNomCo()) . ' - Quantitat: ' . $animal->getQuantitat();
            echo '</li>';
        }
        echo '</ul>';
    }

    public function buidarCarret(): void {
        $this->llista = null;
    }
}
?>
