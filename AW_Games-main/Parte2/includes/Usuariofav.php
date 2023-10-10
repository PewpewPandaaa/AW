<?php 
namespace es\ucm\fdi\aw;


class Usuariofav{

    public function __construct(){}


    static public function getJuegoFavoritos($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM listafavoritos WHERE idUsuario = $id";

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



    static public function eliminarJuegoFav($idGm, $idUs){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM listafavoritos WHERE idJuego=$idGm and idUsuario=$idUs");
        
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;

    }

}
?>