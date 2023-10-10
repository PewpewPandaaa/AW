<?php
namespace es\ucm\fdi\aw;
?>


<header>
    
    <nav class="navbar">

        <a href="index.php" class="logo">
        <img src="img/awsd.png" alt="logo"> </a>
        </a>

        <div class="nav-link">
            <ul>
               
                <?php 
                if(isset($_SESSION["login"])){  
                  echo "<li> <a href='index.php'> Inicio</a> </li>";
                  echo "<li> <a href='tienda.php'>Tienda</a> </li>";
                  echo "<li> <a href='comunidad.php'>Comunidad</a> </li>";
                 
                
                    if(isset($_SESSION["login"]) && !$_SESSION['esAdmin']){
                        $us=Usuario::buscaUsuario($_SESSION["username"]);
                        $gmID=UsuarioCesta::getJuegoPorUsuario($us->getId());
                        $items = count($gmID);
                        $s=Amigo::misSolicitudes($us->getId());   
                        
                        if($items!=0)
                            echo "<li><a href='carrito.php' id='carritoBtn'>Carrito</a><span id='itemCount'>$items</span></li>";
                        else
                            echo "<li> <a href='carrito.php'> carrito </a></li>";
                        

                        echo "<li> <a href='historialCompras.php'>Mis Juegos</a> </li>";

                        if(sizeof($s)!=0){
                            echo" <li> <a href='perfil.php?idUser={$_SESSION['username']}'> <span class='punto-rojo'>{$_SESSION['username']}</a>";  
                        }else{
                            echo "<li> <a href='perfil.php?idUser={$_SESSION['username']}'>{$_SESSION['username']}</a>";}
                            echo 
                            "<ul class='desplegable_us'> 
                                <li> <a href='perfil.php?idUser={$_SESSION['username']}'> Cuenta </a> </li>
                                <li><a href='recarga.php'>Recarga</a></li>
                                <li><a href='amigo.php'>Amigos</a></li>";

                                if(sizeof($s)!=0){
                                    echo "<li><a href='solicitud.php'><span class='punto-rojo'>Buzón</a></li>";
                                    }
                                    else echo "<li><a href='solicitud.php'>Buzón</a></li>";
                                echo"
			                    <li><a href='listafavoritos.php'>Favoritos </a></li> 
			                    <li><a href='listadeseo.php'>Lista deseos </a></li>
                                <li><a href='notificacionJuego.php'>Notificacion </a></li>
                                
                            </ul>                        
                            </li>
                            <li><a href='logout.php'>Log Out</a> </li>
                           ";
                    }
                    else if(isset($_SESSION["login"]) && $_SESSION['esAdmin']){
                        echo"<li> <a href='ListarJuegos.php'>{$_SESSION['username']}</a>
                            <ul>
                                <li><a href='ListarJuegos.php'>Juegos</a></li>
                                <li><a href='annadirJuego.php'>Añadir juegos</a></li>
                                <li><a href='GestionarUsuario.php'>Usuarios</a></li> 
                                <li><a href='BuzonReport.php'>Reports</a></li> 
                            </ul>
                            </li>    
                            <li> <a href='logout.php'>LOG OUT</a> </li>
                            ";
                    }
                }
                else{
                    echo "<li> <a href='index.php'> Inicio</a> </li>";
                    echo "<li> <a href='tienda.php'>Tienda</a> </li>";
                    echo "<li> <a href='comunidad.php'>Comunidad</a> </li>";
                    echo "<li> <a href='login.php'>Login</a> </li>";
                }?>

            </ul>

        </div>
        <img src="img/menu.png" alt="menu" class="menu">

    </nav>

    </header>

<script>
    const menu = document.querySelector(".menu")
    const navLinks = document.querySelector(".nav-link")

    menu.addEventListener('click', () => {
        navLinks.classList.toggle('mobile-menu')
    })
</script>


