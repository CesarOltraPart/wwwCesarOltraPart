<?php 
$ruta = "./";
if (strcmp(basename($_SERVER['PHP_SELF']), "index.php") !== 0) {
    $ruta = "../";
}
?>
<nav>
    <a href="<?php echo $ruta; ?>index.php?apartat=inici">Inici</a>
    <a href="<?php echo $ruta; ?>index.php?apartat=registre">Registre</a>
    <a href="<?php echo $ruta; ?>index.php?apartat=contacte">Contacte</a>
    <a href="<?php echo $ruta; ?>index.php?apartat=apadrina">Apadrina</a>
</nav>