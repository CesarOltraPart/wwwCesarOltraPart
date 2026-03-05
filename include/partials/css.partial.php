<?php
$path = strpos($_SERVER['PHP_SELF'], '/include/') !== false ? '../css/' : 'css/';
$estil = isset($_SESSION['estils']) ? $_SESSION['estils'] : '';
if ($estil) {
    echo "<link rel=\"stylesheet\" href=\"$path/estils$estil.css\">";
}
?>
