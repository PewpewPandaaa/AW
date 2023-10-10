<?php 

if($_SESSION['esAdmin'] /*&& isset($_SESSION['esAdmin'])*/){?>
	
	<div id="sidebar-left">
		<ul>
			<li><a href="ListarJuegos.php">Lista de juegos</a></li>
			<li><a href="annadirJuego.php">Añadir nuevos juegos</a></li>
			<li><a href="GestionarUsuario.php">Usuarios actuales</a></li>
		</ul>
		
		<div id="space"></div>
		<div id="bottom-wrapper">
			<div id="log-out">
				<a href="logout.php">
					<img src="img/logout.png" alt="icono logout"> </a>
			</div>
		</div>
	</div>

<?php }else{ ?>

<div id="sidebar-left">
		<ul>
			<li><a href="perfil.php">Datos personales</a></li>
			<li><a href="historialCompras.php">Historial de compras</a></li>
			<li><a href="pay.php">Recargar Saldo</a></li>
			<li><a href="friend.php">Mis amigos</a></li>
			<li><a href="annadir.php"> Añadir amigos </a></li>
			<li><a href="listafavoritos.php">Favoritos </a></li>
			<li><a href="solicitud.php">Solicitudes</a></li>
			<li><a href="listadeseo.php">Lista deseos </a></li>
			<li><a href="notificacionJuego.php">Notificacion </a></li>
		</ul>
		
		<div id="space"></div>
		<div id="bottom-wrapper">
			<div id="log-out">
				<a href="logout.php">
					<img src="img/logout.png" alt="icono logout"> </a>
			</div>
		</div>
	</div>
<?php } ?>