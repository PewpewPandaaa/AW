<?php
    namespace es\ucm\fdi\aw;
    require_once __DIR__.'/includes/config.php';

    $buscar = $_POST['buscar'];
    $resultado = Usuario::buscarUsuarioPorLetras($buscar);
    $usuarios[]=array();
    while($rs=$resultado->fetch_assoc()){
        $usuario = array(
            "id"=>$rs["id"],
            "nombreUsuario" => $rs["nombreUsuario"],
            "apodo"=>$rs["apodo"],
            "imagen"=> base64_encode($rs["imagen"]),
            "genero"=>$rs["genero"],
         
            // Agrega más propiedades aquí según sea necesario
        );
        $usuarios[] = $usuario; // Agregar cada usuario al array
    };
  

    // Devolver los usuarios en formato JSON
    echo json_encode($usuarios);
    
?>
    
