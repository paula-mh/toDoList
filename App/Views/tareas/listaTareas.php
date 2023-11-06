<?php

	include_once '../templates/header.php';
    include_once '../../Model/Tarea.php';
    
    $tarea = new Tarea('', '', '');
    $tareas = $tarea->getTareas();
?>

<!DOCTYPE html>
<html>
<head> 
	<title> Listado de tareas | To Do List </title>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../templates/style.css" type="text/css">
</head> 
<body>
    <div class="container">
        <h1>Listado de tareas</h1>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tarea</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if ($tareas) {
                    foreach ($tareas as $tarea) {
                        echo "<tr>
                                <td>" . $i . "</td>
                                <td>" . $tarea['nombre'] . "</td>
                                <td>" . $tarea['descripcion'] . "</td>
                                <td>" . $tarea['estado'] . "</td>
                                <td> 
                                    <a href='editarTarea.php?id=" . $tarea['id'] . "' class='btn btn-primary'>Editar</a>
                                    <a href='../../Controller/TareaController.php?action=deleteTarea&id=" . $tarea['id'] . "' class='btn btn-danger'>Eliminar</a>
                                </td>
                            </tr>";
                            $i++;
                    }
                } else {
                    echo "No hay tareas para mostrar";
                }
                ?>
            </tbody>
        </table>
        <a href='crearTarea.php' class='btn btn-primary'>Crear nueva tarea</a>
    </div>
</body>
</html>