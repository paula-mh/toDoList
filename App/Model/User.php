<?php

    include_once(__DIR__ . "/../../Core/Database.php");
    $conn = Database::getInstance()->getConnection();


class User {
    private $nombre_usuario;
    private $passwd;

    public function __construct($nombre_usuario, $passwd){
        $this->nombre_usuario = $nombre_usuario;
        $this->passwd = $passwd;
    }

    public function registro($nombre_usuario, $passwd){
        try {
            global $conn;
            if(!$this->check($nombre_usuario)){
                $hashed_passwd = password_hash($this->passwd, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, passwd) VALUES (:nombre_usuario, :passwd)");
                $stmt->bindParam(':nombre_usuario', $this->nombre_usuario);
                $stmt->bindParam(':passwd', $hashed_passwd);
                $stmt->execute();
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function inicio($nombre_usuario, $passwd){
        global $conn;
        $stmt = $conn->prepare("SELECT nombre_usuario, passwd FROM usuarios WHERE nombre_usuario = (:nombre_usuario)");
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();
        $row = $stmt->fetch();
        $hashed_passwd = $row['passwd'];
        if (password_verify($passwd, $hashed_passwd)) {
            session_start();
            $_SESSION["usuario"] = $nombre_usuario;
            return true;
        } else {
            return false;
        }
    }

    public function check($nombre_usuario){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = (:nombre_usuario)");
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
?>