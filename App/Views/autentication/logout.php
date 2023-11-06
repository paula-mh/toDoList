<?php
        session_start();
        session_unset();
        session_destroy();
        header("Location: App/Views/autentication/login.php");
        exit();
?>