<?php 
$ruta = "./";
if (strcmp(basename($_SERVER['PHP_SELF']), "index.php") !== 0) {
    $ruta = "../";
}
?>
<nav>
    <?php $current = isset($_SESSION['apartat']) ? $_SESSION['apartat'] : 'inici'; ?>

    <?php if ($current === 'inici'): ?>
        <span class="menu-actiu">Inici</span>
    <?php else: ?>
        <a href="<?php echo $ruta; ?>index.php?apartat=inici">Inici</a>
    <?php endif; ?>

    <?php if (!isset($_SESSION['usuari_correu'])): ?>
        <?php if ($current === 'registre'): ?>
            <span class="menu-actiu">Registre</span>
        <?php else: ?>
            <a href="<?php echo $ruta; ?>index.php?apartat=registre">Registre</a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($current === 'contacte'): ?>
        <span class="menu-actiu">Contacte</span>
    <?php else: ?>
        <a href="<?php echo $ruta; ?>index.php?apartat=contacte">Contacte</a>
    <?php endif; ?>

    <?php if ($current === 'apadrina'): ?>
        <span class="menu-actiu">Apadrina</span>
    <?php else: ?>
        <a href="<?php echo $ruta; ?>index.php?apartat=apadrina">Apadrina</a>
    <?php endif; ?>
</nav>
