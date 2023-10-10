<?php

namespace es\ucm\fdi\aw;


class Report
{   
    private $idReport;
    private $idUsuario;
    private $nombreUsuario;
    private $idComReport;
    private $comentario;
    private $motivo;
    private $fecha;

    public function __construct($idReport,$idUsuario, $nombreUsuario, $idComReport, $comentario,$motivo, $fecha)
    {   
        $this->idReport = $idReport;
        $this->idUsuario = $idUsuario;
        $this->nombreUsuario = $nombreUsuario;
        $this->idComReport= $idComReport;
        $this->comentario = $comentario;
        $this->motivo = $motivo;
        $this->fecha = $fecha;
    }

    public function getIdReport(){

        return $this->idReport;

    }

    public function getIdUsuario(){

        return $this->idUsuario;

    }

    public function getnombreUsuaio(){

        return $this->nombreUsuario;

    }

    public function getIdComReport(){

        return $this->getIdComReport();

    }

    public function getComentario(){

        return $this->comentario;

    }

    public function getmotivo(){

        return $this->motivo;

    }

    public function getfecha(){

        return $this->fecha;

    }

    
    public static function crearReport($idUsuario,$nombreUsuario,$idComReport,$comentario,$motivo){
        
         $conn = Aplicacion::getInstance()->getConexionBd();

         $fecha = date("y/m/d");

         $query=sprintf("INSERT INTO report(idUsuario,nombreUsuario,idComReport,comentario,motivo,fecha) VALUES ( '%d', '%s','%d','%s','%s','%s')"
             , $conn->real_escape_string($idUsuario)
             , $conn->real_escape_string($nombreUsuario)
             , $conn->real_escape_string($idComReport)
             , $conn->real_escape_string($comentario)
             , $conn->real_escape_string($motivo)
             ,$fecha
         );
         if ( !$conn->query($query) ) {
             error_log("Error BD ({$conn->errno}): {$conn->error}");
             return false;
         }
 
         return true;
     }


    public static function getTodosReport(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM report");
        $consulta=$conn->query($query);
        $arrayReport = array();
        if($consulta->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($consulta)) {
                $arrayReport[] = new Report($fila["idReport"],$fila["idUsuario"],$fila["nombreUsuario"],$fila["idComReport"],$fila["comentario"],$fila["motivo"],$fila["fecha"]);
            }
            $consulta->free();
        }
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return $arrayReport;
    }

    public static function borrarReport($idReport){
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $query = sprintf("DELETE FROM report WHERE idReport=$idReport");

        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return true;
    }
    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM report WHERE nombreUsuario='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {//HAY QUE MODIFICAR
              
                $arrayReport[] = new Report($fila["idReport"],$fila["idUsuario"],$fila["nombreUsuario"],$fila["idComReport"],$fila["comentario"],$fila["motivo"],$fila["fecha"]);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    
}
