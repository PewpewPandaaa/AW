<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Usuario;
require_once __DIR__.'/Formulario.php';

class FormLogin extends Formulario
{
    public function __construct() {
        parent::__construct('formLogin', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario = $datos['nombreUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'password'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <head>
        <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
        </head>
        $htmlErroresGlobales
        <body>
            <section>
                <div class ="form-box">
                    <div class ="form-value">
                        <h2>Login</h2>

                            <div class="inputbox">
                            <ion-icon name="person-circle-outline"></ion-icon>
                            <input id="nombreUsuario" type='text' name='nombreUsuario' value="$nombreUsuario" required><label for=''>Usuario</label>
                            {$erroresCampos['nombreUsuario']}
                            </div>

                            <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input id="password" type="password"  name='password' required><label for=''>Contraseña</label>
                            {$erroresCampos['password']}
                            </div>

                            <div class="forget">
                            <label for=""><input type="checkbox" name="remember">Recordar contraseña</label>
    
                            <a href=""> </a>
                            </div>
    
                            <button type="submit">Login</button>
        
                            <div class="register">
                                <p>¿Aún no tienes cuenta?  <a href="registrar.php">Registrar</a></p>
                            </div>
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
        if ( ! $nombreUsuario || empty($nombreUsuario) ) {
            $this->errores['nombreUsuario'] = 'Nombre de usuario no puede estar vacío';
        }
        
        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password) ) {
            $this->errores['password'] = 'La contraseña no puede estar vacía.';
        }
        
        if (count($this->errores) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
        
            if (!$usuario) {
                $this->errores[] = "Su usuario o contraseña es incorrecto".$nombreUsuario." ".$password;
            } else {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $usuario->getNombreUsuario();
                $_SESSION['esAdmin'] = $usuario->tieneRol(Usuario::ADMIN_ROLE);
            }
        }
    }
}
