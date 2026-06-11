<?php

class Animal {
    private int $id;
    private string $nomCo;
    private string $nomCientifc;
    private int $quantitat;
    private float $donacio;
    private string $descripcio;
    private string $imatge;

    public function __construct(
        int $id,
        string $nomCo,
        string $nomCientifc,
        int $quantitat,
        float $donacio,
        string $descripcio,
        string $imatge
    ) {
        $this->id = $id;
        $this->nomCo = $nomCo;
        $this->nomCientifc = $nomCientifc;
        $this->quantitat = $quantitat;
        $this->donacio = $donacio;
        $this->descripcio = $descripcio;
        $this->imatge = $imatge;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getNomCo(): string {
        return $this->nomCo;
    }

    public function getNomCientifc(): string {
        return $this->nomCientifc;
    }

    public function getQuantitat(): int {
        return $this->quantitat;
    }

    public function getDonacio(): float {
        return $this->donacio;
    }

    public function getDescripcio(): string {
        return $this->descripcio;
    }

    public function getImatge(): string {
        return $this->imatge;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNomCo(string $nomCo): void {
        $this->nomCo = $nomCo;
    }

    public function setNomCientifc(string $nomCientifc): void {
        $this->nomCientifc = $nomCientifc;
    }

    public function setQuantitat(int $quantitat): void {
        $this->quantitat = $quantitat;
    }

    public function setDonacio(float $donacio): void {
        $this->donacio = $donacio;
    }

    public function setDescripcio(string $descripcio): void {
        $this->descripcio = $descripcio;
    }

    public function setImatge(string $imatge): void {
        $this->imatge = $imatge;
    }
}
?>
