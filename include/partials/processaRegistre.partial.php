<?php
    $nom = "";
    $cognoms = "";
    $adreca = "";
    $correu = "";
    $contrasenya = "";
    $telefon = "";
    $donacio = "";
    $continent = "";
    $apadrinar = "";
    $buit = "Valor buit";
    $puntuacio = 0;
    $mult = 1;
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
    if (isset($_POST['apadrinar'])) {
        $apadrinar = trim(htmlspecialchars($_POST['apadrinar']));
    }
    if (isset($_POST['continent'])) {
        $continent = trim(htmlspecialchars($_POST['continent']));
    }
    if (isset($_POST['puntuacio'])) {
        $puntuacio = (int)trim(htmlspecialchars($_POST['puntuacio']));
    }
    if (isset($_POST['mult'])) {
        $mult = (int)trim(htmlspecialchars($_POST['mult']));
    }
    
    ?>
<main>
    <h2>Dades de Registre d'Usuari</h2>
    <p class="resultat">Nom: <?php echo $nom === "" ? $buit : $nom; ?></p>
    <p class="resultat">Cognoms: <?php echo $cognoms === "" ? $buit : $cognoms; ?></p>
    <p class="resultat">Adreça: <?php echo $adreca === "" ? $buit : $adreca; ?></p>
    <p class="resultat">Correu electrònic: <?php echo $correu === "" ? $buit : $correu; ?></p>
    <p class="resultat">Contrasenya: <?php echo $contrasenya === "" ? $buit : $contrasenya; ?></p>
    <p class="resultat">Telèfon: <?php echo $telefon === "" ? $buit : $telefon; ?></p>
    <p class="resultat">Donació: <?php echo $donacio === "" ? $buit : $donacio; ?></p>
    <p class="resultat">Animal apadrinat: </p><?php echo $apadrinar === "" ? "<img src=\"../imatges/que.jpg\" width=\"350px\" height=\"350px\">" : "<img src=\"../imatges/$apadrinar.jpg\" alt=\"$apadrinar\" width=\"350px\" height=\"350px\">"; ?>
    <p class="resultat">Continent: <?php echo $continent === "" ? $buit : $continent; ?></p>
    <div class="resultat">
    <p>Puntuació de la pàgina: <?php 
    echo "$puntuacio * $mult</p>";
    $puntuacio *= $mult;
    for($i = 0; $i < $puntuacio; $i++) {
        echo "<img src=\"../imatges/estrella.png\" alt=\"Estrella\" width=\"40px\" height=\"40px\">";
    }
    ?>
    </div>
</main>