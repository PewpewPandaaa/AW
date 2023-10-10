<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/Formulario.php';
require_once __DIR__.'/Usuario.php';
class FormRecargo extends Formulario
{

    public function __construct() {
        parent::__construct('formRecargo', ['urlRedireccion' => 'recarga.php']);
    }

    protected function generaCamposFormulario(&$datos)
    {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['amount'], $this->errores, 'span', array('class' => 'error'));
        $us = Usuario::buscaUsuario($_SESSION['username']);

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        $htmlErroresGlobales
        <div id = "content_balance_wrapper">
            
            <div id = "method_pay_wrapper" >
                <div id = "method_pay_now"> Recarga Online </div>
        
                <div class="recharge_name"> 
                    <div class="form-row">
                        <div>Cuenta a Recargar</div>
                    </div>
                    
                    <div class="user_basic">
                        <div id="user">{$us->getNombre()}</div>
                    </div>
            
                    
                    <div class="form-row">
                        <div>Escribe o pulse el importe que desea recargar</div>
                        <input required type="text" id="amount" name="amount" placeholder="Importe"> 
                        <span id="importeOK">
                            <img src="img/tick.png">
                            </span>
                        <span id="importeNoOK">&#x274c;</span>
    
                        <br><br>
                        <ul>
                        <li id="5" type="radio" name="op" value="5" onclick="seleccionarCantidad(5)">
                        5</li>
                        <li id="10" type="radio" name="op" value="10" onclick="seleccionarCantidad(10)">
                        10</li>
                        <li id="20" type="radio" name="op" value="20" onclick="seleccionarCantidad(20)">
                        20</li>

                        </ul>
                        {$erroresCampos['amount']}
                    </div>

                    <div>
                        <span class="btn-recharge-container">
                        <button type="submit" class = "btn-recharge" name="recargar">PAGAR Y RECARGAR</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>          
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $amount = trim($datos['amount'] ?? '');
        $amount = filter_var($amount, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $amount || empty($amount) ) {
            $this->errores['amount'] = 'El Importe no puede estar vacío';
        }else if (!is_numeric($amount)){
            $this->errores['amount'] = 'Solo debe contener números enteros';
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::buscaUsuario($_SESSION["username"]);
            
            $usuario->aumentarSaldo($usuario->getId(),$amount);
        }
    }

}

?>