<?php
if (isset($_GET['estils'])) {
    $estil = $_GET['estils'];
    echo "<link rel=\"stylesheet\" href=\"css/estils$estil.css\">";
}


?>
