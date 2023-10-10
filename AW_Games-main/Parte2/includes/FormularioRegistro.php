<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Usuario;
require_once __DIR__.'/Formulario.php';

class FormularioRegistro extends Formulario
{
    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $nombreUsuario = $datos['nombreUsuario'] ?? '';
        $nombre = $datos['nombre'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['email','nombreUsuario', 'nombre', 'password', 'password2'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        <head>
        <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
        </head>
        $htmlErroresGlobales
        <body>
            <section>
                <div class ="form-box">
                    <div class ="form-value">
                        <br>
                        <h2>Registrar</h2>

                            <div class="inputbox">
                            <ion-icon name="person-circle-outline"></ion-icon>
                            <input id="nombreUsuario" type="text" name="nombreUsuario" value="$nombreUsuario" required><label for=''>Usuario (para acceder a la página)</label>
                            {$erroresCampos['nombreUsuario']}
                            </div>

                            <div class="inputbox">
                            <ion-icon name="person-circle-outline"></ion-icon>
                            <input type='text' name='nombre'value="$nombre" required><label for=''>Nombre de usuario (apodo) </label>
                            {$erroresCampos['nombre']}
                            </div>

                            <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type='password' name='password' required><label for=''>Contraseña</label>
                            {$erroresCampos['password']}
                            </div>

                            <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type='password' name='password2' required><label for=''>Confirme su contraseña</label>
                            {$erroresCampos['password2']}
                            </div>
                            
                            <button type="submit">Registrar</button>
                            <button onclick="window.location.href = 'login.php'">Ya tienes cuenta?</button>
                           
                    </div>
                </div>
            </section>
        </body>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombreUsuario = trim($datos['nombreUsuario'] ?? '');
        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreUsuario || mb_strlen($nombreUsuario) < 5) {
            $this->errores['nombreUsuario'] = 'El apodo debe tener una longitud de al menos 5 caracteres.';
        }

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || mb_strlen($nombre) < 5) {
            $this->errores['nombre'] = 'Usuario debe tener una longitud de al menos 5 caracteres.';
        }

        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || mb_strlen($password) < 5 ) {
            $this->errores['password'] = 'La contraseña debe tener una longitud de al menos 5 caracteres.';
        }

        $password2 = trim($datos['password2'] ?? '');
        $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password2 || $password != $password2 ) {
            $this->errores['password2'] = 'Ambas contraseñas deben coincidir';
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::buscaUsuario($nombreUsuario);
	
            if ($usuario) {
                $this->errores[] = "El usuario ya existe";
            } else {
                $rol = Usuario::USER_ROLE;
                $fecha = getdate();
                $usuario = Usuario::crea($nombreUsuario, $password, $nombre, $fecha, $rol);
                $_SESSION['login'] = true;
                $_SESSION['username'] = $nombreUsuario;
                $_SESSION['esAdmin'] = $usuario->tieneRol(Usuario::ADMIN_ROLE);
            }
        }
    }
}