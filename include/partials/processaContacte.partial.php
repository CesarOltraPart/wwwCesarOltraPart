<?php
$correu = "";
$assumpte = "";
$missatge = "";
$buit = "Valor buit";
$columnes = 0;
$files = 0;
if (isset($_SESSION['correu'])) {
    $correu = trim(htmlspecialchars($_SESSION['correu']));
}
if (isset($_SESSION['assumpte'])) {
    $assumpte = trim(htmlspecialchars($_SESSION['assumpte']));
}
if (isset($_SESSION['missatge'])) {
    $missatge = trim(htmlspecialchars($_SESSION['missatge']));
}
?>
<main>
    <h2>Dades de Contacte</h2>
    <p class="resultat">Correu electrònic: <?php echo $correu === "" ? $buit : $correu; ?></p>
    <p class="resultat">Assumpte: <?php echo $assumpte === "" ? $buit : $assumpte; ?></p>
    <p class="resultat">Missatge: </p> <div class="resultat"><table>
    <?php 
    if ($missatge === "") {
        echo "<tr><td>$buit</td></tr>";
    } else {
        if (count(explode(" ", $missatge)) < 36) {
            $files = ceil(sqrt(count(explode(" ", $missatge))));
            $columnes = $files;
        } else {
            $columnes = 6;
            $files = ceil(count(explode(" ", $missatge)) / $columnes);
        }
        for ($i = 0; $i < $files; $i++) {
                echo "<tr>";
            for ($j = 0; $j < $columnes; $j++) {
            $fons = random_int(1, 5);
            $paraula = explode(" ", $missatge)[$i * $columnes + $j] ?? "";
            if (strtolower(trim($paraula)) === "apadrinar" || strtolower(trim($paraula)) === "animal") {
                echo "<td class='fons$fons'> <span class='animal'>"; 
            } else if (strlen(trim($paraula))  >= 10) {
                echo "<td class='fons$fons'><span class='llarg'>";
            } else {
                echo "<td class='fons$fons'>";
                if ($paraula !== "") {echo "<span class='normal'>";}
            }
            if($paraula !== "") {
                echo htmlspecialchars($paraula) . "</span> </td>";
            } else {
                echo "</td>";
            }
            }
            echo "</tr>";
        }
    }
    ?>
    </table>
</div>
</main>