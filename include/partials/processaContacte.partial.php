<?php
$correu = "";
$assumpte = "";
$missatge = "";
$buit = "Valor buit";
if (isset($_POST['correu'])) {
    $correu = trim(htmlspecialchars($_POST['correu']));
}
if (isset($_POST['assumpte'])) {
    $assumpte = trim(htmlspecialchars($_POST['assumpte']));
}
if (isset($_POST['missatge'])) {
    $missatge = trim(htmlspecialchars($_POST['missatge']));
}
?>
<main>
    <h2>Dades de Contacte</h2>
    <p>Correu electrònic: <?php echo $correu === "" ? $buit : $correu; ?></p>
    <p>Assumpte: <?php echo $assumpte === "" ? $buit : $assumpte; ?></p>
    <p>Missatge: <?php echo $missatge === "" ? $buit : $missatge; ?></p>
</main>