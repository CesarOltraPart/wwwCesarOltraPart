<div class="formulari" id="login-block">
    <h3>Login</h3>
    <form action="<?php echo htmlspecialchars($login_action); ?>" method="post">
        <div class="formulari">
            <label for="correuLogin">Correu electrònic</label><br>
            <input id="correuLogin" name="correuLogin" type="email" required maxlength="254" />
        </div>
        <div class="formulari">
            <label for="contrasenyaLogin">Contrasenya</label><br>
            <input id="contrasenyaLogin" name="contrasenyaLogin" type="password" required />
        </div>
        <div class="formulari">
            <input type="submit" value="Accedir" />
        </div>
    </form>
    <?php
    if (isset($_GET['error'])) {
        missatgeErrorLogin($_GET['error']);
    }
    ?>
</div>
