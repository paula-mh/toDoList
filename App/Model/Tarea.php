<?php
    session_start();
    include_once(__DIR__ . "/../../Core/Database.php");
    $conn = Database::getInstance()->getConnection();

class Tarea{
    private static $conn;
    private $id;
    private $nombre;
    private $descripcion;
    private $estado;

    public function __construct($nombre, $descripcion, $estado) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }
    
    public function getTareas() {
        try {
            $usuario = $this->inicioSesion();
            global $conn;
            //$stmt = $conn->prepare("SELECT id, nombre, descripcion, estado FROM tareas AS t JOIN usuario_tarea AS ut
            //                        ON t.id = ut.id_tarea JOIN usuarios AS u ON u.id_usuario = ut.id_usuario
            //                       WHERE u.nombre_usuario = :nombre_usuario");
            $stmt = $conn->prepare("SELECT id, nombre, descripcion, estado FROM tareas WHERE usuario = :usuario");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getTareaById($id) {
        try {
            global $conn;
            $stmt = $conn->prepare("SELECT * FROM tareas WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    public function postTareas($nombre, $descripcion, $estado) {
        try {
            global $conn;
            $id_tarea = uniqid();
            $usuario = $_SESSION["usuario"];
            //$id_usuario = $this->obtenerUsuarioSesion($nombre_usuario);
            $stmt = $conn->prepare("INSERT INTO tareas (id, nombre, descripcion, estado, usuario) VALUES (:id, :nombre, :descripcion, :estado, :usuario)");
            $stmt->bindParam(':id', $id_tarea);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();
            //$this->postUsuarioTarea($id_tarea, $id_usuario);
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
/*
    public function postUsuarioTarea($id_tarea, $id_usuario){
        global $conn;
        if ($id_usuario == null){
            $id_usuario = session_id();
        }
        $stmt = $conn->prepare("INSERT INTO usuario_tarea (id_usuario, id_tarea) VALUES (:id_usuario, :id_tarea)");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_tarea', $id_tarea);
        $stmt->execute();
    }
    */

    public function putTarea($id, $nombre, $descripcion, $estado) {
        try {
            global $conn;
            $stmt = $conn->prepare("UPDATE tareas SET nombre = :nombre, descripcion = :descripcion, estado = :estado WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
        

    public function deleteTarea($id) {
        try {
            global $conn;
            $stmt = $conn->prepare("DELETE FROM tareas WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /*
    public function obtenerUsuarioSesion($nombre_usuario) {
        global $conn;
        $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE nombre_usuario = :nombre_usuario");
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();
        $id_usuario = $stmt->fetchColumn();
        return $id_usuario ? $id_usuario : null;
    }
    */

    public function inicioSesion(){
        if (empty($_SESSION["usuario"])) {
            $_SESSION["usuario"] = session_id();
            $nombre_usuario = 'invitado';
          } else {
            $nombre_usuario = $_SESSION["usuario"];
          }
        return $nombre_usuario;
    }
}
?>