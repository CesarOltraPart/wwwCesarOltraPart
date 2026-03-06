<?php 
$ruta = "./";
if (strcmp(basename($_SERVER['PHP_SELF']), "index.php") !== 0) {
    $ruta = "../";
}
?>
<nav>
    <a href="<?php echo $ruta; ?>index.php?apartat=inici">Inici</a>
    <?php if (!isset($_SESSION['usuari_correu'])): ?>
        <a href="<?php echo $ruta; ?>index.php?apartat=registre">Registre</a>
    <?php endif; ?>
    <a href="<?php echo $ruta; ?>index.php?apartat=contacte">Contacte</a>
    <a href="<?php echo $ruta; ?>index.php?apartat=apadrina">Apadrina</a>
</nav>