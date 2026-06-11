<main>
    <h2>Apadrina</h2>
    <section>
        <?php
        include_once __DIR__ . '/../funcions.php';
        // Si s'ha passat ?mostrar=carret o ?mostrar=apadrina, carreguem els partials corresponents
        $mostrar = $_GET['mostrar'] ?? '';
        if ($mostrar === 'carret') {
            include __DIR__ . '/mostraCarret.partial.php';
        } elseif ($mostrar === 'apadrina') {
            include __DIR__ . '/mostraApadrina.partial.php';
        } else {
            mostraAnimals();
        }
        ?>
    </section>
</main>