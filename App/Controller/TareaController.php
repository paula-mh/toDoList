<?php
include_once '../Model/Tarea.php';

$controller = new TareaController();
$controller->handleRequest();


class TareaController {
    public function handleRequest() {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            switch ($action) {
                case 'createTarea':
                    $this->createTarea();
                    break;
                case 'updateTarea':
                    $this->updateTarea();
                    break;
                case 'deleteTarea':
                    $this->deleteTarea();
                    break;
                case 'searchTarea':
                    $this->searchTarea();
                    break;
            }
        }
    }

    
    public function createTarea() {
        if (!empty($_POST['name']) && !empty($_POST['description'])) {
            $nombre = $_POST['name'];
            $descripcion = $_POST['description'];
            $estado = "Pendiente";
            
            $tarea = new Tarea($nombre, $descripcion, $estado);
            if($tarea->postTareas($nombre, $descripcion, $estado)){
                header("Location: ../Views/tareas/listaTareas.php");
            }
        }
    }

    
    public function updateTarea() {
        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['status']) && !empty($_GET['id'])) {
            $nombre = $_POST['name'];
            $descripcion = $_POST['description'];
            $estado = $_POST['status'];
    
            $tarea = new Tarea('', '', '', '');
            $id = $_GET['id']; 
            $updated = $tarea->putTarea($id, $nombre, $descripcion, $estado);
    
            if ($updated) {
                header("Location: ../Views/tareas/listaTareas.php");
                exit();
            }
        }
    }

    public function deleteTarea() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $tarea = new Tarea('', '', '', '');
            $deleted = $tarea->deleteTarea($id);
    
            if ($deleted) {
                header("Location: ../Views/tareas/listaTareas.php");
                exit();
            }
        }
    }
}
?>