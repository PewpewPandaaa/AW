<?php 
namespace es\ucm\fdi\aw;

class UsuarioCesta{

    public function __construct(){}

    static public function getJuegoPorUsuario($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM cesta WHERE idUsuario = $id";

        $consulta = $conn->query($sql);
        $arrayJuegos = array();

        if($consulta){
            if($consulta->num_rows > 0){
                while ($fila = mysqli_fetch_assoc($consulta)) {	
                    $arrayJuegos[]= Juego::buscarJuegoNombrePorId1($fila['idJuego']);
                }
                $consulta->free();
            }
        }
        
        return $arrayJuegos;
    }

    static public function eliminarJuegoEnCesta($idGm, $idUs){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM cesta WHERE idJuego=$idGm and idUsuario=$idUs");
        
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;

    }

    static public function insertarJuegoEnCesta( $juegoID, $usID, $nombJuego){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("INSERT INTO cesta(idJuego, idUsuario, nomJuego) VALUES ( '%d', '%d', '%s')"
        , $juegoID
        , $usID
        , $nombJuego
    );
        
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;

    }

    static public function vaciarCestaUsuario($idUs){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM cesta WHERE idUsuario=$idUs");
        
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;

    }

    static public function buscarEnCesta($idUs, $idGm) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT COUNT(*) as count FROM cesta WHERE idJuego=$idGm AND idUsuario=$idUs");
    
        $result = $conn->query($query);
        if (!$result) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    
        $row = $result->fetch_assoc();
        $count = (int)$row['count'];
    
        return ($count > 0);
    }

}