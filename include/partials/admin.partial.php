<main>
    <h2>Àrea d'administració</h2>
    <p>Has entrat com a administrador.</p>
    <p>
        <?php
        $logoutPath = (basename($_SERVER['PHP_SELF']) === 'index.php') ? 'include/processaLogout.php' : '../include/processaLogout.php';
        ?>
        <a href="<?php echo $logoutPath; ?>">Tancar sessió</a>
    </p>
</main>
