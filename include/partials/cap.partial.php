<header>
    <h1>Apadrina un animal en perill d'extincio</h1>
    <section>
        <?php 
        $current_apartat = isset($_SESSION['apartat']) ? $_SESSION['apartat'] : 'inici';
        // Detectar si estamos en un archivo de procesamiento
        $filename = basename($_SERVER['PHP_SELF']);
        $form_action = ($filename === 'processaRegistre.php' || $filename === 'processaContacte.php') ? '../index.php' : $_SERVER['PHP_SELF'];
        ?>
        <form action="<?php echo $form_action; ?>" method="GET">
        <input type="hidden" name="apartat" value="<?php echo htmlspecialchars($current_apartat); ?>">
        <div class="formulari">
        <label>Estils</label>
        <label><input id="defecte" name="estils" type="radio" value="" <?php echo (!isset($_SESSION['estils']) || $_SESSION['estils'] == '') ? 'checked' : ''; ?>/> Per defecte</label>
        <label><input id="roig" name="estils" type="radio" value="_roig" <?php echo (isset($_SESSION['estils']) && $_SESSION['estils'] == '_roig') ? 'checked' : ''; ?>/> Roig</label>
        <label><input id="groc" name="estils" type="radio" value="_groc" <?php echo (isset($_SESSION['estils']) && $_SESSION['estils'] == '_groc') ? 'checked' : ''; ?>/> Groc</label>
        <button type="submit">Aplicar estilss</button>
        </form>
        </div> 
        <?php
        date_default_timezone_set('Europe/Madrid');
        $dataActual = date('d/m/Y');
        $dies = ['Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte', 'Diumenge'];
        $mesos = ['gener', 'febrer', 'març', 'abril', 'maig', 'juny', 'juliol', 'agost', 'setembre', 'octubre', 'novembre', 'desembre'];
        $diaNumero = date('N') - 1;
        $mesNumero = date('n') - 1;
        $dataActual = $dies[$diaNumero] . ', ' . date('d') . ' de ' . $mesos[$mesNumero] . ' de ' . date('Y');
        echo "<p>Data d'avui: $dataActual</p>";
        ?>
    </section>
</header>