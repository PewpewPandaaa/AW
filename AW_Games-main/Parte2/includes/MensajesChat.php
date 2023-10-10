<?php

namespace es\ucm\fdi\aw;


class MensajesChat
{   private $id_enviado;
    private $id_recibido;
    private $mensaje;

    public function __construct($id_enviado,$id_recibido, $mensaje)
    {   
        $this->id_enviado = $id_enviado;
        $this->id_recibido = $id_recibido;
        $this->mensaje = $mensaje;
        
    }
    
    public static function InsertarMensaje($id_enviado,$id_recibido,$mensaje){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO chat(id_enviado, id_recibido,mensaje) VALUES ( '%d', '%d','%s')"
            , $conn->real_escape_string($id_enviado)
            , $conn->real_escape_string($id_recibido)
            , $conn->real_escape_string($mensaje)
        );
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return true;
    }

    
     
    static public function getAllMesanjes($me, $id2){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM chat WHERE (id_enviado = $me AND id_recibido = $id2) OR (id_enviado = $id2 AND id_recibido = $me)";

        $consulta = $conn->query($sql);
        $arrayC= array();

        if($consulta->num_rows > 0){
	        while ($fila = mysqli_fetch_assoc($consulta)) {	
	        	$arrayC[]= new MensajesChat($fila['id_enviado'], $fila['id_recibido'], $fila['mensaje']);
	        }
	        $consulta->free();
    	}
        
        return $arrayC;
    }

    public function getIdRecibido()
    {
        return $this->id_recibido;
    }


    public function getIdEnviado()
    {
        return $this->id_enviado;
    }


    public function getMensaje()
    {
        return $this->mensaje;
    }

   
}
