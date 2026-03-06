<main>
    <h2>Àrea d'administració</h2>
    <p>Has entrat com a administrador.</p>
    <p>
        <?php
        $logoutPath = (basename($_SERVER['PHP_SELF']) === 'index.php') ? 'include/processaLogout.php' : '../include/processaLogout.php';
        ?>
        <a href="<?php echo $logoutPath; ?>">Tancar sessió</a>
    </p>

    <?php
    if (isset($_GET['accioadmin'])) {
        if ($_GET['accioadmin'] === 'eliminat') {
            echo '<p class="normal">Usuari eliminat correctament.</p>';
        } elseif ($_GET['accioadmin'] === 'errorbasedades') {
            echo '<p class="error">S\'ha produït un error en eliminar l\'usuari.</p>';
        }
    }

    include_once __DIR__ . '/../funcionsAdmin.php';
    gestionaUsuaris();
    ?>
</main>
