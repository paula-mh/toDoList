<?php
    include_once("../../Model/Tarea.php");
    global $usuario;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="listaTareas.php">Tareas </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="crearTarea.php">Crear tarea</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <?php
            if (empty($_SESSION["usuario"])) {
                echo '<a class="nav-link" href="../autentication/login.php">Iniciar sesión</a>';
                echo '<a class="nav-link" href="../autentication/register.php">Registrarse</a>';
            } else {
                $usuario =  $_SESSION["usuario"];
                if (strlen($usuario) > 20) {
                    echo '<a class="nav-link" href="../autentication/login.php">Iniciar sesión</a>';
                    echo '<a class="nav-link" href="../autentication/register.php">Registrarse</a>';
                }else{
                echo 'Hola, ' . $usuario . '&nbsp;';
                echo '<a class="nav-link" href="../autentication/logout.php">Cerrar sesión</a>';
                }
            }
            ?>
        </div>
    </div>
</nav>

