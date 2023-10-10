<?php 
namespace es\ucm\fdi\aw;

class Amigo{

    public function __construct(){}

    static public function getAmigoPorUsuario($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("SELECT * FROM amigos WHERE id_usuario1 = $id OR id_usuario2 = $id");
        $consulta = $conn->query($sql);
        $arrayAmigos = array();

        if($consulta->num_rows > 0){
	        while ($fila = mysqli_fetch_assoc($consulta)) {	
               if($fila['id_usuario1'] == $id){
                    $amigo = $fila['id_usuario2'];
                }else {
                    $amigo = $fila['id_usuario1'];
                }
	        	$arrayAmigos[]= Usuario::buscaPorId($amigo);
	        }
	        $consulta->free();
    	}
        
        return $arrayAmigos;
    }

    static public function UsuarioAmigo($idS, $id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("SELECT * FROM amigos WHERE (id_usuario1 = $idS AND id_usuario2 = $id) OR (id_usuario1 = $id AND id_usuario2 = $idS)");
        $consulta = $conn->query($sql);
        $ret = false;

        if($consulta->num_rows > 0){
	        $ret=true;
	        $consulta->free();
    	}
        
        return $ret;
    }


    static public function borrarAmigo($id1, $id2){
        $conn = Aplicacion::getInstance()->getConexionBd();

        $query = sprintf("DELETE FROM amigos WHERE ((id_usuario1 = $id1 AND id_usuario2 = $id2) OR (id_usuario1 = $id2 AND id_usuario2 = $id1 ))");
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    static public function yaSolicite($id1, $id2){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf ("SELECT * FROM solicitudamistad WHERE (id_solicitante = $id1 AND id_solicitado = $id2)");
        $consulta = $conn->query($sql);
        $ret =false;

        if($consulta->num_rows > 0){
	        $ret=true;
	        $consulta->free();
    	}
        
        return $ret;
    }

    static public function annadirAmigo($id1, $id2){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("INSERT INTO amigos(id_usuario1,id_usuario2) VALUES ('%d', '%d')"
                , $id1
                , $id2
        );

        if ( ! $conn->query($sql) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    static public function solicitudAmigo($id1, $id2){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("INSERT INTO solicitudamistad(id_solicitante,id_solicitado) VALUES ('%d', '%d')"
                , $id1
                , $id2
        );

        if ( ! $conn->query($sql) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    static public function borrarSolicitud($id1, $id2){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "DELETE FROM solicitudamistad WHERE (id_solicitante =$id1 AND id_solicitado =$id2) OR (id_solicitante=$id2 AND id_solicitado=$id1)";

        if ( ! $conn->query($sql) ) {
            
            error_log("Error BD ({$conn->errno}): {$conn->error}");

        }
    }

    static public function misSolicitudes($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM solicitudamistad WHERE id_solicitado = $id";

        $consulta = $conn->query($sql);
        $arrayS= array();

        if($consulta->num_rows > 0){
	        while ($fila = mysqli_fetch_assoc($consulta)) {	
	        	$arrayS[]= Usuario::buscaPorId($fila['id_solicitante']);
	        }
	        $consulta->free();
    	}
        
        return $arrayS;
    }

   

}
