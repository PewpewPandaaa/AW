<?php

namespace es\ucm\fdi\aw;


class Usuario
{

    public const ADMIN_ROLE = 'admin';

    public const USER_ROLE = 'user';

    private $id;

    private $nombreUsuario;

    private $password;

    private $apodo;

    private $roles;

    private $saldo;

    private $fecha;

    private $genero;

    private $lema;

    private $imagen;

    private function __construct($nombreUsuario, $password, $nombre, $id = null, $saldo, $fecha, $genero, $lema, $imagen)
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->apodo = $nombre;
        $this->saldo = $saldo;
        $this->fecha = $fecha;
        $this->genero = $genero;
        $this->lema = $lema;
        $this->imagen = $imagen;
        $this->roles= null;
    }

  
    public static function login($nombreUsuario, $password)
    {
        $result = false;
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            $result= $usuario;
        }
        return $result;
    }
    
    public static function crea($nombreUsuario, $password, $nombre, $fecha, $rol=[])
    {   
        $x = 'user';
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre, $id= NULL, 0,$fecha, NULL, NULL, NULL);
        $user->añadeRol($x);
        return $user->guarda();
    }

    public function añadeRol($role)
    {
        $this->roles = $role;
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE nombreUsuario='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {//HAY QUE MODIFICAR
              
                $result = new Usuario($fila['nombreUsuario'], $fila['contrasenia'], $fila['apodo'], $fila['id'], $fila['saldo'], $fila['fecha'],$fila['genero'],$fila['lema'], $fila['imagen']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscarUsuarioPorLetras($buscar){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM usuario WHERE nombreUsuario LIKE LOWER ('%".$buscar."%')";
        $rs = $conn->query($query);
        return $rs;

    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE id= $idUsuario");
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) { //HAY QUE MODIFICAR
                $result = new Usuario($fila['nombreUsuario'], $fila['contrasenia'], $fila['apodo'], $fila['id'], $fila['saldo'], $fila['fecha'], $fila['genero'], $fila['lema'], $fila['imagen']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function cargaRoles($usuario)
    {
            
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT rol FROM rolesusuario  WHERE usuarioid=%d", $usuario->id);
        $rs = $conn->query($query);

        if ($rs) {
            $roles = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();

            $usuario->roles = [];
            foreach($roles as $rol) {
                $usuario->roles[] = $rol['rol'];
            }
            return $usuario;

        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }
   
    private static function inserta($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuario(nombreUsuario, apodo, contrasenia, saldo) VALUES ('%s', '%s', '%s', 0)"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->apodo)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->saldo)
        );
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
            $result = self::insertaRoles($usuario);
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
   
    private static function insertaRoles($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
      
            $query = sprintf("INSERT INTO rolesusuario(usuarioid, rol) VALUES ('%d','%s')"
                , $usuario->id
                , $usuario->roles

            );
            if ( ! $conn->query($query) ) {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        
        return $usuario;
    }
    
    private static function actualiza($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s' WHERE U.id=%d"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $usuario->id
        );
        if ( $conn->query($query) ) {
            $result = self::borraRoles($usuario);
            if ($result) {
                echo"0";
                $result = self::insertaRoles($usuario);
            }
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;
    }
   
    private static function borraRoles($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM RolesUsuario RU WHERE RU.usuario = %d"
            , $usuario->id
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return $usuario;
    }
    
    private static function borra($usuario)
    {
        return self::borraPorId($usuario->id);
    }
    
    public static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        } 
        /* Los roles se borran en cascada por la FK
         * $result = self::borraRoles($usuario) !== false;
         */
        $conn = Aplicacion::getInstance()->getConexionBd();
        /*$query = sprintf ("DELETE FROM rolesusuario WHERE usuarioid = $idUsuario");*/
        $query = sprintf("DELETE FROM usuario WHERE id = %d", $idUsuario);
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function aumentarSaldo($id_usuario, $saldo){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE usuario SET saldo = saldo + $saldo WHERE  id = $id_usuario";
    
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar los puntos de usuario.";
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
    }

    public static function disminuirSaldo($id_usuario, $saldo){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE usuario SET saldo = saldo - $saldo WHERE  id = $id_usuario";
    
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar los puntos de usuario.";
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
    }

    static public function checkMute($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("SELECT fecha, dias_mute FROM usmuteado WHERE id_usuario = $id");
        $resultado = $conn->query($sql);
        
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $fecha_mute = $fila['fecha'];
            $dias_mute = $fila['dias_mute'];
        
            $fecha_desmute = date('Y-m-d', strtotime("$fecha_mute + $dias_mute days"));
            $fecha_actual = date("Y-m-d");
        
            if ($fecha_actual >= $fecha_desmute) {
                $query = sprintf("DELETE FROM usmuteado WHERE id_usuario = %d", $id);
                if ( ! $conn->query($query) ) {
                    error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
            }
        
        }
    }


    static public function muteUser($id,$fecha){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("INSERT INTO usmuteado(id_usuario,dias_mute, fecha) VALUES ('%d', '%d', '%s')"
                , $id
                , 1
                , $fecha
        );
        if ( ! $conn->query($sql) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    static public function isMute($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usmuteado WHERE id_usuario= $id");
        $rs = $conn->query($query);
        $result = false;
        if ($rs->num_rows > 0){
            $result = true;
        }
        return $result;
    }

    public static function noMute($idUsuario)
    {
        
        $conn = Aplicacion::getInstance()->getConexionBd();
       
        $query = sprintf("DELETE FROM usmuteado WHERE id_usuario = $idUsuario");
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function setnombreUsuario($id_usuario,$nombre){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE usuario SET apodo = '$nombre' WHERE id = $id_usuario";
        
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
        
    }

    public static function setgenero($id_usuario,$genero){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE usuario SET genero = '$genero' WHERE id = $id_usuario";
    
        if ( !$conn->query($query) ) {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
        
    }

    public static function setlema($id_usuario,$lema){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query="UPDATE usuario SET lema = '$lema' WHERE id = $id_usuario";

        
    
        if ( !$conn->query($query) ) {
           
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
        
    }

     
    public function setImagen($id_usuario, $imagen)
    {
        $conn = Aplicacion:: getInstance()->getConexionBd();
        $query = "UPDATE usuario SET imagen='$imagen' WHERE id = $id_usuario";
        
        $resultado = $conn->query($query);

        if($resultado){
            echo "si";
        }else {
            echo "no se inserto";
        }

        if ( !$conn->query($query) ) {
           
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . ($conn->error);
            exit();
        }
        
    }
 

    public function getimagen($id_usuario)
    {
        $conn = Aplicacion:: getInstance()->getConexionBd();
        $query = "SELECT imagen FROM usuario WHERE id = $id_usuario";
        $resultado = $conn->query($query);
        if(!$resultado){
            echo "Error al recuperar la imagen";
        }

        if($resultado->num_rows > 0){
            $fila = $resultado ->fetch_assoc();
            $imagen = $fila['imagen'];
            return base64_encode($imagen);
        }
            return NULL;
        
    }

    
    public static function getUsuarios(){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = sprintf("SELECT * FROM usuario");
        $consulta = $conn->query($sql);

        $arrayUsuarios = array();

        if($consulta->num_rows > 0){
            while ($fila = mysqli_fetch_assoc($consulta)) {
                $arrayUsuarios[] = new Usuario($fila['nombreUsuario'], $fila['contrasenia'], $fila['apodo'], $fila['id'], $fila['saldo'], $fila['fecha'], $fila['genero'], $fila['lema'], $fila['imagen']);
            }
            $consulta->free();
        }
        return $arrayUsuarios; 

    }

    public function getimagen1()
    {
        return $this->imagen;
        
    }

    public function getsaldo()
    {
        return $this->saldo;
    }

    public function getpass()
    {
        return $this->password;
    }
   

    public function getfecha()
    {
        return $this->fecha;
    }

    public function getgenero()
    {
        return $this->genero;
    }
    
    public function getlema()
    {
        return $this->lema;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getNombre()
    {
        return $this->apodo;
    }

    public function getRoles()
    {
        $query = sprintf("SELECT rol FROM rolesusuario  WHERE usuarioid", $this->getId());
        return $query;
    }

    public function tieneRol($role)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $resultado = $conn->query("SELECT rol FROM rolesusuario WHERE rol = 'admin' AND usuarioid = ". $this->getId());

        if ($resultado->num_rows > 0) {
            return true;
        } else {
            return false;
}

    }

    public function compruebaPassword($password)
    {   
        return ($password == $this->password||password_verify($password, $this->password));
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
    
    public function guarda()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }

   
}
