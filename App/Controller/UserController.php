<?php
    require_once('../Model/User.php');
    $controller = new UserController();
    $controller->handleRequest();

class UserController {
    public function handleRequest() {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            switch ($action) {
                case 'login':
                    $this->login();
                    break;
                case 'register':
                    $this->register();
                    break;
                case 'logout':
                    $this->logout();
                    break;
            }
        }
    }

    public function login() {
        $error_message = "";
        if (!empty($_POST['nombre_usuario']) && !empty($_POST['passwd'])) {
            $nombre_usuario = $_POST['nombre_usuario'];
            $passwd = $_POST['passwd'];
            $user = new User($nombre_usuario, $passwd);
            if($user->inicio($nombre_usuario, $passwd)){
                header("Location: ../Views/tareas/listaTareas.php");
                exit();
            } else {
                $error_message = "Usuario o contraseña incorrecta";
                echo $error_message;
            }
        }else{
            $error_message = "Todos los campos son obligatorios";
            echo $error_message;
        }
        header("Location: ../Views/autentication/login.php?error_message=" . urlencode($error_message));
        exit();
    }
    

    public function register() {
        if (!empty($_POST['nombre_usuario']) && !empty($_POST['passwd'])) {
            $nombre_usuario = $_POST['nombre_usuario'];
            $passwd = $_POST['passwd'];
            $user = new User($nombre_usuario, $passwd);
            if($user->registro($nombre_usuario, $passwd)){
                header("Location: ../Views/autentication/login.php");
                exit();
            }else{
                $error_message = "El nombre de usuario ya existe";
                echo $error_message;
            }
        }else{
            $error_message = "Todos los campos son obligatorios";
            echo $error_message;
        }
        header("Location: ../Views/autentication/register.php?error_message=" . urlencode($error_message));
        exit();
    }
}

?>
