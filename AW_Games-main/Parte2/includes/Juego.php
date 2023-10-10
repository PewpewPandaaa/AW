<?php

namespace es\ucm\fdi\aw;

class Juego{

    private $idJuego;
    private $nombre;
    private $precio;
    private $genero;
    private $infoBasica;
    private $fechaLanz;
    private $desarrollador;
    private $rutaImagen;
    private $rutaVideo;
    private $valoracion;

    //Constructor

    private function __construct($nombre,$precio,$genero,$infoBasica,$fechaLanz,$desarrollador, $imagen, $video, $valoracion, $id=NULL){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->genero = $genero;
        $this->infoBasica = $infoBasica;
        $this->fechaLanz = $fechaLanz;
        $this->desarrollador = $desarrollador;
        $this->rutaImagen = $imagen;
        $this->rutaVideo = $video;
        $this->valoracion = $valoracion;
        $this->idJuego = $id;
    }

    //Getters
    public function getIdJuego()
    {
        return $this->idJuego;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getInfoBasica()
    {
        return $this->infoBasica;
    }

    public function getFechaLanz()
    {
        return $this->fechaLanz;
    }

    public function getDesarrollador()
    {
        return $this->desarrollador;
    }

    public function getRutaImagen()
    {
        return $this->rutaImagen;
    }

    public function getRutavideo()
    {
        return $this->rutaVideo;
    }

    public function getValoracion()
    {
        return $this->valoracion;
    }

    //Setters
    public function setIdJuego($idJuego)
    {
        $this->idJuego = $idJuego;

        return $this;
    }


    public function setNombre($idJuego,$nombre)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE juegos SET nombre = '$nombre' WHERE idJuego = $idJuego";
    
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
       
    }

    public function setPrecio($idJuego,$precio){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE juegos SET precio = '$precio' WHERE idJuego = $idJuego";
    
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
    }

    public function setPrecioReb($idJuego,$precio){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE oferta SET precioReb = '$precio' WHERE idJuego = $idJuego";
    
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
    }


    

    public function setGenero($genero){

        $this->genero = $genero;

        return $this;
    }

    public function setInfoBasica($idJuego,$infoBasica){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE juegos SET infoBasica = '$infoBasica' WHERE idJuego = $idJuego";
    
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
    }

    public function setDesarrollador($idJuego,$desarrollador){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE juegos SET desarrollador = '$desarrollador' WHERE idJuego = $idJuego";
    
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
    }

    public function setFechaLanz($fechaLanz){

        $this->fechaLanz = $fechaLanz;

        return $this;
    }

    public function setRutaImagen($imagen,$idJuego){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE juegos SET imagen = '$imagen' WHERE idJuego = $idJuego";
    
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
    }

    public function setRutaVideo($video,$idJuego){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE juegos SET video = '$video' WHERE idJuego = $idJuego";
    
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
    }

    //**Crear nuevo juego */

    public static function crearJuego($nombre,$precio,$genero,$infoBasica,$desarrollador,$imagen){
       // $juego = new Juego($nombre,$precio,$genero,$infoBasica,$desarrollador,$imagen, NULL);
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO juegos(nombre, precio, imagen, genero, infoBasica, desarrollador) VALUES ( '%s', '%f','%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($nombre)
            , $conn->real_escape_string($precio)
            , $conn->real_escape_string($imagen)
            , $conn->real_escape_string($genero)
            , $conn->real_escape_string($infoBasica)
            , $conn->real_escape_string($desarrollador)
        );
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return true;
    }


    public static function insertarJuegoFav($idUsuario, $idJueg,$nombreJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO listafavoritos(idUsuario, idJuego, nomJuego) VALUES ( '%d', '%d', '%s')"
            , $conn->real_escape_string($idUsuario)
            , $conn->real_escape_string($idJueg)
            , $conn->real_escape_string($nombreJueg)

        );
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return true;
    }

    public static function insertarJuegoDes($idUsuario, $idJueg,$nombreJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO listadeseo(idUsuario, idJuego, nomJuego) VALUES ( '%d', '%d', '%s')"
            , $conn->real_escape_string($idUsuario)
            , $conn->real_escape_string($idJueg)
            , $conn->real_escape_string($nombreJueg)

        );
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return true;
    }


    public static function insertarJuegoReb( $idJueg,$precioReb){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO oferta( idJuego, precioReb) VALUES ( '%d', '%d')"
            , $conn->real_escape_string($idJueg)
            , $conn->real_escape_string($precioReb)

        );
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        return true;
    }




    //**Buscar juego*/

    public static function buscarJuego($nombre){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("SELECT * FROM juegos WHERE nombre LIKE '%$nombre%'",$nombre);
        $consulta=$conn->query($sql);
        $array = array();

        if($consulta->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($consulta)) {
            $array[] = new Juego( $fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"],$fila["idJuego"]);
            }
            $consulta->free();
        }
        return $array;
    }
    
    public static function buscarJuegoAllGenero($gen){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("SELECT * FROM juegos WHERE genero= '%s'",$gen);
        $consulta=$conn->query($sql);
        $array = array();

        if($consulta->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($consulta)) {
            $array[] = new Juego( $fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"],$fila["idJuego"]);
            }
            $consulta->free();
        }
        return $array;
    }
   

    public static function buscarJuegoPorNombre($idJuego){
        
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query = sprintf("SELECT * FROM juegos WHERE nombre='%s'", $idJuego);
            $rs = $conn->query($query);
            
            if ($rs && $rs->num_rows > 0) {
                $fila = $rs->fetch_assoc();
                $juego = new Juego( $fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"], $fila["idJuego"]);
                $rs->free();
                return $juego;
            }  else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            
            return null;
        
        //$juego = new Juego($nombre,$precio,$genero,$infoBasica,$fechaLanz,$desarrollador,$rutaImagen); //esta mal,先放着然后等base datos搞完改
    }

    public static function buscarJuegoPorGenero($gen){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM juegos WHERE genero='%s'", $gen);
        $rs = $conn->query($query);

        $arrayJuegos = array();
        if ($rs && $rs->num_rows > 0) {
            while($fila = $rs->fetch_assoc()){

                $juego = new Juego( $fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"], $fila["idJuego"]);
                $arrayJuegos[] = $juego;
               
            }
        
             $rs->free();
            
            return $arrayJuegos;

        }  else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return null;

    }


    // Filtro

        public static function filtrarJuego($op){
            $conn = Aplicacion::getInstance()->getConexionBd();
    
            switch ($op) {
                case "1":
                    $query = sprintf( "SELECT * FROM juegos ORDER BY nombre ASC");
                    break;
                case "2":
                    $query = sprintf("SELECT * FROM juegos ORDER BY nombre DESC");
                    break;
                case "3":
                    $query = sprintf("SELECT * FROM juegos ORDER BY precio ASC");
                    break;
                case "4":
                    $query =sprintf("SELECT * FROM juegos ORDER BY precio DESC");
                    break;
        
             }
    
            $rs = $conn->query($query);
    
            $arrayJuegos = array();
            if ($rs && $rs->num_rows > 0) {
                while($fila = $rs->fetch_assoc()){
                    
                    $juego = new Juego( $fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"], $fila["idJuego"]);
                    $arrayJuegos[] = $juego;
                   
                }
            
                 $rs->free();
                
                return $arrayJuegos;
    
            }  else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            
            return null;
    
        }
        //filtrar despues de buscar
        public static function filtrarBusquedaJuego($op,$nombre){
            $conn = Aplicacion::getInstance()->getConexionBd();
    
            switch ($op) {
                case "1":
                    $query = sprintf( "SELECT * FROM juegos WHERE nombre LIKE '%$nombre%' ORDER BY nombre ASC", $nombre);
                    break;
                case "2":
                    $query = sprintf("SELECT * FROM juegos WHERE nombre LIKE '%$nombre%' ORDER BY nombre DESC", $nombre);
                    break;
                case "3":
                    $query = sprintf("SELECT * FROM juegos WHERE nombre LIKE '%$nombre%' ORDER BY precio ASC", $nombre);
                    break;
                case "4":
                    $query =sprintf("SELECT * FROM juegos WHERE nombre LIKE '%$nombre%' ORDER BY precio DESC", $nombre);
                    break;
        
             }
    
            $rs = $conn->query($query);
    
            $arrayJuegos = array();
            if ($rs && $rs->num_rows > 0) {
                while($fila = $rs->fetch_assoc()){
                    
                    $juego = new Juego( $fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"], $fila["idJuego"]);
                    $arrayJuegos[] = $juego;
                   
                }
            
                 $rs->free();
                
                return $arrayJuegos;
    
            }  else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            
            return null;
    
        }
        //filtrar despues de elegir categoria
        public static function filtrarCategoriaJuego($op,$genero){
            $conn = Aplicacion::getInstance()->getConexionBd();
    
            switch ($op) {
                case "1":
                    $query = sprintf( "SELECT * FROM juegos WHERE genero='%s' ORDER BY nombre ASC", $genero);
                    break;
                case "2":
                    $query = sprintf("SELECT * FROM juegos WHERE genero='%s' ORDER BY nombre DESC", $genero);
                    break;
                case "3":
                    $query = sprintf("SELECT * FROM juegos WHERE genero='%s' ORDER BY precio ASC", $genero);
                    break;
                case "4":
                    $query =sprintf("SELECT * FROM juegos WHERE genero='%s' ORDER BY precio DESC", $genero);
                    break;
        
             }
    
            $rs = $conn->query($query);
    
            $arrayJuegos = array();
            if ($rs && $rs->num_rows > 0) {
                while($fila = $rs->fetch_assoc()){
                    
                    $juego = new Juego( $fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"], $fila["idJuego"]);
                    $arrayJuegos[] = $juego;
                   
                }
            
                 $rs->free();
                
                return $arrayJuegos;
    
            }  else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
            
            return null;
    
        }
    public static function buscarJuegoNombrePorId($idJuego){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM juegos WHERE idJuego='%s'", $idJuego);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows > 0) {
            $fila = $rs->fetch_assoc();
                $juego = new Juego( $fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"]);
                $rs->free();
                return $juego;
        }  else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }



    public static function buscarJuegoFav ($idUsuario, $idJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf ("SELECT * FROM listafavoritos WHERE idUsuario = '%s' AND idJuego = '%d'", $idUsuario,$idJueg);
        $rs = $conn -> query($query);

        if ( $rs && $rs-> num_rows >0){

            return true;
        }

        else {

            return false;
        }

    }


    public static function inmygamelist ($idUsuario, $idJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf ("SELECT * FROM usuariojuego WHERE idUsuario = '%s' AND idJuego = '%d'", $idUsuario,$idJueg);
        $rs = $conn -> query($query);

        if ( $rs && $rs-> num_rows >0){

            return true;
        }

        else {

            return false;
        }

    }

    public static function buscarJuegoDes ($idUsuario, $idJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf ("SELECT * FROM listadeseo WHERE idUsuario = '%s' AND idJuego = '%d'", $idUsuario,$idJueg);
        $rs = $conn -> query($query);

        if ( $rs && $rs-> num_rows >0){

            return true;
        }

        else {

            return false;
        }

    }
  
    public static function buscarJuegoReb ( $idJueg){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf ("SELECT * FROM oferta WHERE  idJuego = '%d'", $idJueg);
        $rs = $conn -> query($query);

        if ( $rs && $rs-> num_rows >0){

            return true;
        }

        else {

            return false;
        }

    }


    //**Eliminar juego */

    public static function eliminarJuego($idJuego){
        
            $conn = Aplicacion::getInstance()->getConexionBd();
            $query = sprintf("DELETE FROM juegos WHERE idJuego=$idJuego");
            
            if ( ! $conn->query($query) ) {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
            return true;
        
    }


    public static function eliminarJuegoReb($idJuego){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM oferta WHERE idJuego=$idJuego");
        
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    
}



    public static function buscarJuegoNombrePorId1($idJuego){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM juegos WHERE idJuego=%d", $idJuego);
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $game = $fila["nombre"];
            $rs->free();
            return $game;
        }  else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }


    public static function buscarJuegoNombreReb1($idJuego){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM oferta WHERE idJuego='%s'", $idJuego);
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows > 0) {
            $fila = $rs->fetch_assoc();
                $juego = $fila["precioReb"];
                $rs->free();
                return $juego;
        }  else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }



    //**Modificar datos juego */

    public static function getJuegos(){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("SELECT * FROM juegos");
        $consulta = $conn->query($sql);

        $arrayJuegos = array();

        if($consulta->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($consulta)) {
                $arrayJuegos[] = new Juego($fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"], $fila["idJuego"]);
            }
            $consulta->free();
        }
        return $arrayJuegos; 

    }
    //return generos que haya
    public static function getAllGenero(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf ( "SELECT DISTINCT genero FROM juegos");
        $consulta=$conn->query($sql);
        $arrayGenero = array();

        if($consulta->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($consulta)) {
                $arrayGenero[] = $fila["genero"];
            }
            $consulta->free();
        }
        return $arrayGenero;
    }

    //return 3 juegos relacionados
    public static function getJuegoRelacionado($genero,$idJuego){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf ( "SELECT * FROM juegos where genero='%s' and idJuego!='%s' order by RAND() LIMIT 3",$genero,$idJuego);
        $consulta=$conn->query($sql);
        $arrayJuego = array();

        if($consulta->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($consulta)) {
                $arrayJuego[] = new Juego($fila["nombre"], $fila["precio"], $fila["genero"], $fila["infoBasica"], $fila["fechaLanz"], $fila["desarrollador"],  $fila["imagen"], $fila["video"], $fila["valoracion"], $fila["idJuego"]);;
            }
            $consulta->free();
        }
        return $arrayJuego;
    }



}

