<?php 

$title = "Erreur";
ob_start();
$content = ob_get_clean();
require ('template.php')
?>