<?php
// si l'usuari ja està autenticat i es vol veure registre, fem override
$inici_override = false;
if (isset($_SESSION['usuari_correu'])) {
    if (isset($_GET['apartat']) && $_GET['apartat'] === 'registre') {
        $inici_override = true;
    }
}
?>
