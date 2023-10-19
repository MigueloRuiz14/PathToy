<?php
$host = 'localhost';
$dbname = 'db_pathtoys';
$user = 'root';
$pass = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
// class db{
//     private $host="localhost";
//     private $dbname="login";
//     private $user="root";
//     private $password="";
//     public function conexion(){
//         try {
//             $PDO = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
//             return $PDO;
//         } catch (PDOException $e) {
//             return $e->getMessage();
//         }
//     }
// }
?>