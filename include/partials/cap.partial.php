<header>
    <h1>Apadrina un animal en perill d'extincio</h1>
    <section>
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