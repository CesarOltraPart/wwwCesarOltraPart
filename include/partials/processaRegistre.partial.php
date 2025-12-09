<?php
    $nom = "";
    $cognoms = "";
    $adreca = "";
    $correu = "";
    $contrasenya = "";
    $telefon = "";
    $donacio = "";
    $continent = "";
    $buit = "Valor buit";
    if (isset($_POST['nom'])) {
        $nom = trim(htmlspecialchars($_POST['nom']));
    }
    if (isset($_POST['cognoms'])) {
        $cognoms = trim(htmlspecialchars($_POST['cognoms']));
    }
    if (isset($_POST['adreca'])) {
        $adreca = trim(htmlspecialchars($_POST['adreca']));
    }
    if (isset($_POST['correu'])) {
        $correu = trim(htmlspecialchars($_POST['correu']));
    }
    if (isset($_POST['contrasenya'])) {
        $contrasenya = trim(htmlspecialchars($_POST['contrasenya']));
    }
    if (isset($_POST['telefon'])) {
        $telefon = trim(htmlspecialchars($_POST['telefon']));
    }
    if (isset($_POST['donacio'])) {
        $donacio = trim(htmlspecialchars($_POST['donacio']));
    }
    if (isset($_POST['continent'])) {
        $continent = trim(htmlspecialchars($_POST['continent']));
    }
?>
<main>
    <h2>Dades de Registre d'Usuari</h2>
    <p>Nom: <?php echo $nom === "" ? $buit : $nom; ?></p>
    <p>Cognoms: <?php echo $cognoms === "" ? $buit : $cognoms; ?></p>
    <p>Adreça: <?php echo $adreca === "" ? $buit : $adreca; ?></p>
    <p>Correu electrònic: <?php echo $correu === "" ? $buit : $correu; ?></p>
    <p>Contrasenya: <?php echo $contrasenya === "" ? $buit : $contrasenya; ?></p>
    <p>Telèfon: <?php echo $telefon === "" ? $buit : $telefon; ?></p>
    <p>Donació: <?php echo $donacio === "" ? $buit : $donacio; ?></p>
    <p>Continent: <?php echo $continent === "" ? $buit : $continent; ?></p>
</main>