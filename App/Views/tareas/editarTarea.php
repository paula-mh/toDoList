<?php
	include_once '../templates/header.php';
    include_once '../../Model/Tarea.php';
    $database = Database::getInstance();
    $conn = $database->getConnection();
    $tarea = new Tarea('', '', '', '');
    $id = $_GET['id'];
    $tareaData = $tarea->getTareaById($id);
?>

<!DOCTYPE html>
<html> 
<head> 
	<title> Editar tarea | To Do List </title>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../templates/style.css" type="text/css">
</head> 
<body>
    <div class="container">
        <h1> Editar tarea </h1>
        <form action="../../Controller/TareaController.php?action=updateTarea&id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $tareaData['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $tareaData['descripcion']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Estado</label>
                <select class="form-control" id="status" name="status">
                    <option value="Pendiente" <?php if($tareaData['estado'] == "Pendiente") echo "selected"; ?>>Pendiente</option>
                    <option value="En curso" <?php if($tareaData['estado'] == "En curso") echo "selected"; ?>>En curso</option>
                    <option value="Terminado" <?php if($tareaData['estado'] == "Terminado") echo "selected"; ?>>Terminado</option>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" value="Enviar">
        </form>
        <button class="btn btn-secondary"><a href="listaTareas.php">Atrás</a></button>
    </div>
</body>
</html>
 