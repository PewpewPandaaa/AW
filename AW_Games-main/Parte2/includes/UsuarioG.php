<?php 
namespace es\ucm\fdi\aw;

class UsuarioG{

    public function __construct(){}

    static public function getJuegoPorUsuario($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM usuariojuego WHERE idUsuario = $id";

        $consulta = $conn->query($sql);
        $arrayJuegos = array();

        if($consulta->num_rows > 0){
	        while ($fila = mysqli_fetch_assoc($consulta)) {	
	        	$arrayJuegos[]= Juego::buscarJuegoNombrePorId1($fila['idJuego']);
	        }
	        $consulta->free();
    	}
        
        return $arrayJuegos;
    }

    static public function getJuegoPorUsuario1($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM usuariojuego WHERE idUsuario = $id";

        $consulta = $conn->query($sql);
        $arrayJuegos = array();

        if($consulta->num_rows > 0){
	        while ($fila = mysqli_fetch_assoc($consulta)) {	
	        	$arrayJuegos[]= array(
                    'id' => $fila['idJuego'],
                    'juego' => Juego::buscarJuegoNombrePorId($fila['idJuego'])

                );
                
	        }
	        $consulta->free();
    	}
        
        return $arrayJuegos;
    }

    static public function insertarUsuarioJuego($usID, $juegoID, $nombJuego, $precio){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuariojuego(idJuego, idUsuario, nomJuego, precio) VALUES ( '%d', '%d', '%s', '%f')"
            , $juegoID
            , $usID
            , $nombJuego
            , $precio
        );
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return true;
    }

    static public function buscarEnUsuarioJuego($idUs, $idGm) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT COUNT(*) as count FROM usuariojuego WHERE idJuego=$idGm AND idUsuario=$idUs");
    
        $result = $conn->query($query);
        if (!$result) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    
        $row = $result->fetch_assoc();
        $count = (int)$row['count'];
    
        return ($count > 0);
    }

    static public function searchGame($idJueg, $idUser){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql =  sprintf("SELECT * FROM usuariojuego WHERE idUsuario = $idUser AND idJuego = $idJueg");
        $rs = $conn->query($sql);
        if($rs && $rs->num_rows > 0)
            return true;
        else
            return false;
    }

    static public function getPrecio($idGm, $idUs){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql =  sprintf("SELECT precio FROM usuariojuego WHERE idUsuario = $idUs AND idJuego = $idGm");
        $rs = $conn->query($sql);
        if($rs && $rs->num_rows > 0) {
            $row = $rs->fetch_assoc();
            return $row['precio'];
        }
        else {
            return false;
        }
    }
}