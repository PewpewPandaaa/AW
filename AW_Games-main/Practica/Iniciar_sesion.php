<!DOCTYPE html>
<html>

<head>

    <title>ABD Games - Inicio</title>

</head>

<body>
    <div>

        <?php

        $busqueda = strtolower($_POST["nom"]);
        $contra = strtolower($_POST["con"]);

        if ($busqueda == "" ||  $contra == "") {
            include("entradaPagina.html");
            echo " <center><FONT SIZE=5 COLOR=  '#ff3300' > <p>No se puede dejar los campos vacíos</p></FONT> </center>";
        } else {

            include("conexion.php");

            $sql = "SELECT * FROM usuario WHERE id = '$busqueda'";

            $consulta = mysqli_query($db, $sql);
            $a = mysqli_num_rows($consulta);

            if ($a > 0) {

                $fila = mysqli_fetch_assoc($consulta);

                if ($fila['contrasenia'] != $contra) {
                    include ("entradaPagina.html");
                    echo " <center><FONT SIZE=5 COLOR=  '#ff3300' > <p>Contraseña incorrecta</p></FONT> </center>";
                } else {
                    
                    include ("tienda.php");
                }
            } else {
                include ("entradaPagina.html");
                echo " <center><FONT SIZE=5 COLOR=  '#ff3300' > <p>Usuario no encotrado</p></FONT> </center>";
            }

        }

        ?>

    </div>

</body>

</html>