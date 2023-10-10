<?php
namespace es\ucm\fdi\aw;

require_once __DIR__ . '/includes/config.php';
$tituloPagina = 'Contactar con nosotros';

$contenidoPrincipal = '';

$contenidoPrincipal = <<<EOS

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.013881503717!2d-3.7354574346667553!3d40.45282972936107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4229d2a9f08b1f%3A0xcf68cce94ec84cb8!2sFacultad%20de%20Inform%C3%A1tica.%20UCM!5e0!3m2!1ses!2ses!4v1680975436027!5m2!1ses!2ses" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    
    <div class="tituloFAQ">
        <div>
            <h2>Contactar con nosotros</h2>
        </div>
    </div>

	<section class="dos-columnas">
		<div class="formularioContactar">
			<form action="enviar.php" method="post">
				<input type="text" name="nombre" placeholder="Nombre" class="caja-1" required>
				<input type="email" name="email" placeholder="E-mail" class="caja-1" required>
				<input type="tel" name="telefono" placeholder="Teléfono" class="caja-1" required>
				<input type="text" name="asunto" placeholder="Asunto" class="caja-1" required>
				<textarea name="mensaje" id="" cols="30" rows="10" placeholder="Comentarios" class="caja-2"></textarea>
				<button type="submit" class="contratar-a correr">Enviar</button>
                <br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</form>
		</div>

		
		
		
	</section>



EOS;

require __DIR__ . '/includes/vistas/plantillas/plantilla.php';
?>