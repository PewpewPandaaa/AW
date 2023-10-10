<!DOCTYPE html>
<html>
<head>

    <title>ABD Games - Registrar Usuario</title>

</head>

<body>
    <div>

        <?php



        $busqueda = strtolower($_POST["nom"]);
        $contra = strtolower($_POST["con"]);

        if ($busqueda == "" ||  $contra == "") {
            include("registrarUsuario.html");
            echo " <center><FONT SIZE=5 COLOR=  '#ff3300' > <p>No se puede dejar los campos vacíos</p></FONT> </center>";
        } else {

                include("conexion.php");

            $sql = "SELECT * FROM usuario WHERE id = '$busqueda'";
            $consulta = mysqli_query($db, $sql);
            $a = mysqli_num_rows($consulta);

            if ($a > 0) {
                include ("registrarUsuario.html");
                echo " <center><FONT SIZE=5 COLOR=  '#ff3300' > <p> Error: Usuario ya registrado</p></FONT> </center>";
            } else {
                mysqli_query($db, "INSERT INTO usuario(id, contrasenia) VALUES ('$busqueda','$contra')");
                include ("tienda.php");
			  
            }


            
            mysqli_close($db);
        }



        ?>

    </div>

</body>
</html>