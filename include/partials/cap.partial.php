<header>
    <h1>Apadrina un animal en perill d'extincio</h1>
    <section>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="formulari">
        <label>Estils</label>
        <label><input id="roig" name="estils" type="radio" value="_roig"/> Roig</label>
        <label><input id="groc" name="estils" type="radio" value="_groc"/> Groc</label>
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