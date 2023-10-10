<?php 
namespace es\ucm\fdi\aw;


class Usuariodeseo{

    public function __construct(){}

    static public function getJuegoDeseo($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM listadeseo WHERE idUsuario = $id";

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



    static public function eliminarJuegoDes($idGm, $idUs){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM listadeseo WHERE idJuego=$idGm and idUsuario=$idUs");
        
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;

    }


}
?>