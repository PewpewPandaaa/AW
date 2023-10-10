<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
class FormModifUser extends Formulario
{

    public function __construct() {
        parent::__construct('formModifUser', ['enctype' => 'multipart/form-data','urlRedireccion' => "perfil.php?idUser={$_SESSION['username']}"]);
    }

    protected function generaCamposFormulario(&$datos)
    {

        $us = Usuario::buscaUsuario($_SESSION['username']);
        // Se generan los mensajes de error si existen.
       $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
       $erroresCampos = self::generaErroresCampos(['username','infoUser'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        
            <div id= "user_content_wrapper">
                <div class ="avatar_wrapper">
        EOF;

        if($us->getimagen1()!=NULL) {
            $html .= <<<EOF
            $htmlErroresGlobales     
            <img class="avatar-img" src="data:image/jpeg;base64,{$us->getimagen($us->getId())}" alt="avatar">
                </div>
        EOF;
        }else{
            $html .= <<<EOF
            $htmlErroresGlobales     
            <img class="avatar-img" src="img/avatar.png" alt="avatar">
                </div>
            EOF;    
        }

        $html .= <<<EOF
        $htmlErroresGlobales 
                <div class="form-row">
                    <label for="username"> Nombre : </label>
                    <input required id="username" type="text" name="username" value={$us->getNombre()}>
                    <span id="nombreOK">
                        <img src="img/tick.png">
                    </span>
                    <span id="nombreNo">&#x274c;</span>

                    {$erroresCampos['username']}
                </div>

                <div class="form-row">
                    <br>
                    <label for="genero"> Genero :  </label>
                    <select name="genero">
                        <option value="femenina">femenina</option>
                        <option value="masculino">masculino</option>
                    </select>
                </div>
        
                <div class= "change-photo">
                    <input type="file"  name="imagen_perfil" enctype= "multipart/form-data">
                </div>
            </div>

            <div id="user_info_wrapper">
                <div id="title">Sobre mí
                    <span id="infoOK">
                        <img src="img/tick.png">
                    </span>
                    <span id="infoNo">&#x274c;</span>
                    </div>
                <label for="infoUser"> </label>
                <div id="lema-wrapper">
                    <textarea required id="infoUser" maxlength="200" name="infoUser" >{$us->getlema()}</textarea>
                    
                    {$erroresCampos['infoUser']}
                </div>
            </div>
            <div class="btn-accept-wrapper">
                <span id="btn-accept">
                    <button type="submit" class = "btn-change" name="recargar">ACEPTAR CAMBIO</button>
            </div>
   

        
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {   
       
        $this->errores = [];
        $username = trim($datos['username'] ?? '');
        $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $username || empty($username) ) {
            $this->errores['username'] = 'El nombre de usuario no puede estar vacío';
        }

       
       $infoUser = filter_var($datos['infoUser'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $infoUser || empty($infoUser) ) {
            $this->errores['infoUser'] = 'El texto no puede estar vacío';
        }

        $genero = trim($datos['genero']);
      
       if($_FILES['imagen_perfil']['tmp_name'] != NULL){
            $imagen_perfil = addslashes(file_get_contents($_FILES['imagen_perfil']['tmp_name']));
       }
 
        if (count($this->errores) === 0) {
            $usuario = Usuario::buscaUsuario($_SESSION["username"]);
            
            $usuario->setnombreUsuario($usuario->getId(),$username);
            $usuario->setgenero($usuario->getId(),$genero);
            $usuario->setlema($usuario->getId(),$infoUser);
           if($imagen_perfil !=null){
                $usuario->setImagen($usuario->getId(),$imagen_perfil);
            }
        }
    }

}

?>