<?php 
  class homeModel{
    private $PDO;
    public function __construct(){
        require_once("c://xampp/htdocs/PathToy/config/database.php");
        $this->PDO = $db;
    }
    public function agregarNuevoUsuario($correo, $nombre, $apellido, $genero, $password){
        $statement = $this->PDO->prepare("INSERT INTO usuarios values(null,:correo, :nombre, :apellido, :genero, :password)");
        $statement->bindParam(":correo", $correo);
        $statement->bindParam(":nombre", $nombre);
        $statement->bindParam(":apellido", $apellido);
        $statement->bindParam(":genero", $genero);
        $statement->bindParam(":password", $password);
        //return ($statement->execute()) ? true : false;
        try{
            $statement->execute();
              return true;
        }catch (PDOException $e) {
            return false;
        }
    }
    public function obtenerclave($correo){
      $statement = $this->PDO->prepare("SELECT password FROM usuarios WHERE correo = :correo");
      $statement->bindParam(":correo",$correo);
      return ($statement->execute()) ? $statement->fetch()['password'] : false;
    }
  }


?>