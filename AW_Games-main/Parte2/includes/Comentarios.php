<?php

namespace es\ucm\fdi\aw;


class Comentarios
{   private $id;
    private $idJuego;
    private $idUsuario;
    private $comentario;

    public function __construct($id,$idJuego, $idUsuario, $comentario)
    {   
        $this->id = $id;
        $this->idJuego = $idJuego;
        $this->idUsuario = $idUsuario;
        $this->comentario = $comentario;
    }

    public function getId()
    {
        return $this->id;
    }


    public function getIdJuego()
    {
        return $this->idJuego;
    }


    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getComentario()
    {
        return $this->comentario;
    }



    static public function comentariosJuegos($id)
    {

        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM comunidadjuego WHERE id_Juego = $id";

        $consulta = $conn->query($sql);
        $arrayComentario = array();

        if ($consulta->num_rows > 0) {
            while ($fila = mysqli_fetch_assoc($consulta)) {
                $arrayComentario[] = new Comentarios($fila["id_comentario"],$fila["id_Juego"], $fila["id_Usuario"], $fila["comentario"]);
                
            }

            $consulta->free();
        }

        return $arrayComentario;
    }

    
    public static function crearComentario($idJuego,$idUsuario,$comentario){
        
         $conn = Aplicacion::getInstance()->getConexionBd();
         $query=sprintf("INSERT INTO comunidadjuego(id_Juego, id_Usuario,comentario) VALUES ( '%d', '%d','%s')"
             , $conn->real_escape_string($idJuego)
             , $conn->real_escape_string($idUsuario)
             , $conn->real_escape_string($comentario)
         );
         if ( !$conn->query($query) ) {
             error_log("Error BD ({$conn->errno}): {$conn->error}");
             return false;
         }
 
         return true;
     }

     
    public static function eliminarComentario($id){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM comunidadjuego WHERE id_comentario=$id");
        
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    
}

     
    public static function addNewComment($idUsuario, $idJueg, $comment){
        $conn = Aplicacion::getInstance()->getConexionBd();
         $query=sprintf("INSERT INTO comentarios( idUsuario, idJuego, contentComent) VALUES ( '%d', '%d','%s')"
             , $conn->real_escape_string($idUsuario)
             , $conn->real_escape_string($idJueg)
             , $conn->real_escape_string($comment)
         );
         if ( !$conn->query($query) ) {
             error_log("Error BD ({$conn->errno}): {$conn->error}");
             return false;
         }
 
         return true;
    }

    public static function deleteComment($idUser, $idJueg){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM comentarios WHERE idUsuario = $idUser AND idJuego = $idJueg");
        
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    
    }

    public static function getAllCommentOfThisGame($idJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        //$query= sprintf("SELECT idUsuario, cotentComent WHERE idJuego = $idJueg FROM comentarios");
        $query= sprintf("SELECT id, idUsuario, contentComent FROM comentarios WHERE idJuego = '%s'", mysqli_real_escape_string($conn, $idJueg));
        $consulta=$conn->query($query);
        $arrayComment = array();
        if($consulta->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($consulta)) {
                $arrayComment[] = array(
                    'id' => $fila['id'],
                    'idUsuario' => $fila['idUsuario'],
                    'contentComent' => $fila['contentComent']
                );
            }
            $consulta->free();
        }
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return $arrayComment;
    }

    public static function buscarComentario($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM comentarios WHERE id='%d'", $id);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows > 0) {
            $fila = $rs->fetch_assoc();
                $comentario = new Comentarios( $fila["id"], $fila["idJuego"], $fila["idUsuario"], $fila["contentComent"]);
                $rs->free();
                return $comentario;
        }  else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }

    public static function makeVal($valor, $idUser, $idJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $val = sprintf("UPDATE usuariojuego SET valoracion = $valor WHERE idUsuario = $idUser AND idJuego = $idJueg");
        $result = $conn->query($val);
        if ($result === false) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function calcValOfGame($idJueg){
        $val = 0;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("SELECT valoracion FROM usuariojuego WHERE idJuego = $idJueg");
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $sum = 0;
            while ($row = $result->fetch_assoc()) {
                $sum += $row["valoracion"];
            }
            $val = $sum / $result->num_rows;
            $s = sprintf("UPDATE juegos SET valoracion = $val WHERE idJuego = $idJueg");
            $conn->query($s);
        }  else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return true;
    }

    static public function searchComment($idUser, $idJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql =  sprintf("SELECT * FROM comentarios WHERE idUsuario = $idUser AND idJuego = $idJueg");
        $rs = $conn->query($sql);
        if($rs && $rs->num_rows > 0)
            return true;
        else
            return false;
    }

    static public function updateComment($idUser, $idJueg, $comment){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql =  sprintf("UPDATE comentarios SET contentComent = '$comment' WHERE idUsuario = $idUser AND idJuego = $idJueg");
        $rs = $conn->query($sql);
    }
}
