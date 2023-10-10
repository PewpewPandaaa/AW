<?php

$db = new mysqli('localhost', 'root', '', 'abd_games');
if ($db->connect_errno) {
    echo "ERROR de Conexión a base de datos";
}

?>