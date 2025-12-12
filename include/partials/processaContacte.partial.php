<?php
$correu = "";
$assumpte = "";
$missatge = "";
$buit = "Valor buit";
if (isset($_POST['correu'])) {
    $correu = trim(htmlspecialchars($_POST['correu']));
}
if (isset($_POST['assumpte'])) {
    $assumpte = trim(htmlspecialchars($_POST['assumpte']));
}
if (isset($_POST['missatge'])) {
    $missatge = trim(htmlspecialchars($_POST['missatge']));
}
?>
<main>
    <h2>Dades de Contacte</h2>
    <p class="resultat">Correu electrònic: <?php echo $correu === "" ? $buit : $correu; ?></p>
    <p class="resultat">Assumpte: <?php echo $assumpte === "" ? $buit : $assumpte; ?></p>
    <p class="resultat">Missatge: </p> <div class="resultat"><ul style="list-style-type:none;">
    <?php 
    if ($missatge === "") {
        echo "<li>$buit</li>";
    } else {
        foreach (explode(" ", $missatge) as $paraula) {
            if (strtolower(trim($paraula)) === "apadrinar" || strtolower(trim($paraula)) === "animal") {
                echo "<li class=animal>";
            } else if (strlen(trim($paraula))  >= 10) {
                echo "<li class=llarg>";
            } else {
                echo "<li class=normal>";
            }
            echo nl2br(htmlspecialchars($paraula)) . "</li>";
        }
    }
    ?>
    </ul>
</div>
</main>