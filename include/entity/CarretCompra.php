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
        $this->llista[$animal->getId()] = $animal;
    }

    public function eliminarAnimal(int $idAnimal): void {
        if ($this->llista !== null && isset($this->llista[$idAnimal])) {
            unset($this->llista[$idAnimal]);
        }
    }

    public function getAnimal(int $idAnimal): ?Animal {
        if ($this->llista === null) {
            return null;
        }
        return $this->llista[$idAnimal] ?? null;
    }

    public function canviarQuantitatAnimal(int $quantitat, int $idAnimal): void {
        if ($this->llista !== null && isset($this->llista[$idAnimal])) {
            $this->llista[$idAnimal]->setQuantitat($quantitat);
        }
    }

    public function acumularQuantitatAnimal(int $quantitat, int $idAnimal): void {
        if ($this->llista !== null && isset($this->llista[$idAnimal])) {
            $quantitatActual = $this->llista[$idAnimal]->getQuantitat();
            $this->llista[$idAnimal]->setQuantitat($quantitatActual + $quantitat);
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
