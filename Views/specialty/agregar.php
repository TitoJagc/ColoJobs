<?php
ob_start();
?>

<p>Hola en agregar!</p>


<?php
$contenido = ob_get_clean();
require("Views/layout.php");
?>