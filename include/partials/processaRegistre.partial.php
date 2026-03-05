<?php
include "./dadesAnimals.php";
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
$animals = [];
$resultat_registre = "";

if (isset($_SESSION['nom'])) {
    $nom = trim(htmlspecialchars($_SESSION['nom']));
}
if (isset($_SESSION['cognoms'])) {
    $cognoms = trim(htmlspecialchars($_SESSION['cognoms']));
}
if (isset($_SESSION['adreca'])) {
    $adreca = trim(htmlspecialchars($_SESSION['adreca']));
}
if (isset($_SESSION['correu'])) {
    $correu = trim(htmlspecialchars($_SESSION['correu']));
}
if (isset($_SESSION['contrasenya'])) {
    $contrasenya = trim(htmlspecialchars($_SESSION['contrasenya']));
}
if (isset($_SESSION['telefon'])) {
    $telefon = trim(htmlspecialchars($_SESSION['telefon']));
}
if (isset($_SESSION['donacio'])) {
    $donacio = trim(htmlspecialchars($_SESSION['donacio']));
}
if (isset($_SESSION['apadrinar'])) {
    $apadrinar = trim(htmlspecialchars($_SESSION['apadrinar']));
}
if (isset($_SESSION['continent'])) {
    $continent = trim(htmlspecialchars($_SESSION['continent']));
}
if (isset($_SESSION['puntuacio'])) {
    $puntuacio = (int) trim(htmlspecialchars($_SESSION['puntuacio']));
}
if (isset($_SESSION['mult'])) {
    $mult = (int) trim(htmlspecialchars($_SESSION['mult']));
}
if (isset($_SESSION['resultat_registre'])) {
    $resultat_registre = $_SESSION['resultat_registre'];
}
$animals = isset($_SESSION['animals']) ? unserialize($_SESSION['animals']) : [];
?>
<main>
    <h2>Dades de Registre d'Usuari</h2>
    <?php
    if ($resultat_registre === 'usuariInserit') {
        echo '<div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; background-color: #e8f5e9; border: 1px solid green; border-radius: 5px;">';
        echo 'Usuari inserit correctament en la base de dades.';
        echo '</div>';
    } elseif ($resultat_registre === 'usuariExisteix') {
        echo '<div style="color: orange; font-weight: bold; margin-bottom: 20px; padding: 10px; background-color: #fff3e0; border: 1px solid orange; border-radius: 5px;">';
        echo 'El correu electrònic introduït ja està registrat en el sistema.';
        echo '</div>';
    } elseif ($resultat_registre === 'error') {
        echo '<div style="color: red; font-weight: bold; margin-bottom: 20px; padding: 10px; background-color: #ffebee; border: 1px solid red; border-radius: 5px;">';
        echo 'Error en la inserció de l\'usuari. Si us plau, intenteu de nou més tard.';
        echo '</div>';
    }
    ?>
    <p class="resultat">Nom: <?php echo $nom === "" ? $buit : $nom; ?></p>
    <p class="resultat">Cognoms: <?php echo $cognoms === "" ? $buit : $cognoms; ?></p>
    <p class="resultat">Adreça: <?php echo $adreca === "" ? $buit : $adreca; ?></p>
    <p class="resultat">Correu electrònic: <?php echo $correu === "" ? $buit : $correu; ?></p>
    <p class="resultat">Contrasenya: <?php echo $contrasenya === "" ? $buit : $contrasenya; ?></p>
    <p class="resultat">Telèfon: <?php echo $telefon === "" ? $buit : $telefon; ?></p>
    <p class="resultat">Donació: <?php echo $donacio === "" ? $buit : $donacio; ?></p>
    <p class="resultat">Animal apadrinat: </p>
    <?php echo $apadrinar === "" ? "<img src=\"../imatges/que.jpg\" width=\"350px\" height=\"350px\">" : "<img src=\"../imatges/$apadrinar.jpg\" alt=\"$apadrinar\" width=\"350px\" height=\"350px\">"; ?>
    <p class="resultat">Continent: <?php echo $continent === "" ? $buit : $continent; ?></p>
    <div class="resultat">
        <table>
            <tr>
                <th colspan="2">
                    <p>Dades del animal:</p>
                </th>
            </tr>
            <?php
            foreach ($arrayDades[$apadrinar] as $animal => $dades) {
                echo "<tr><td>$animal</td>";
                echo "<td>$dades</td></tr>";  
            }
            ?>

        </table>
    </div>
    <div class="resultat">
        <p>Puntuació de la pàgina: <?php
        echo "$puntuacio * $mult</p>";
        $estrella = $puntuacio;
        $puntuacio *= $mult;
        for ($i = 0; $i < $puntuacio; $i++) {
            echo "<img src=\"../imatges/estrella$estrella.png\" alt=\"Estrella\" width=\"40px\" height=\"40px\">";
        }
        
        ?>
    </div>
    <div class="resultat"></div>
    <p>Animals en perill d'extinció seleccionats:</p>
    <?php
    if (empty($animals)) {
        echo "<img src=\"../imatges/que.jpg\" width=\"350px\" height=\"350px\">";
    } else {
        foreach ($animals as $animal) {
            echo "<img src=\"../imatges/$animal.jpg\" alt=\"$animal\" width=\"350px\" height=\"350px\">";
        }
    }
    ?>
    </div>
</main>