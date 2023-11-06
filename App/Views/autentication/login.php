<!DOCTYPE html>
<html>
<head>
<head>
    <style>
        .gradient-custom {
            background: #6a11cb;
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        }
    </style> 
	<title> Login | To Do List </title>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
</head>
<body>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-light mb-3" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2">Iniciar sesión</h2>
                            <p class="text-black-50 mb-5">Introduce tu usuario y contraseña</p>
                            <div class="form-outline form-white mb-4">
                            <div id="errorDiv" class="alert alert-danger" style="display: <?php echo isset($_GET['error_message']) ? 'block' : 'none'; ?>;">
                                <?php echo isset($_GET['error_message']) ? $_GET['error_message'] : ''; ?>
                            </div>
                            <form method="post" action="../../Controller/userController.php?action=login">
                                <input type="user" id="nombre_usuario" name="nombre_usuario" class="form-control form-control-lg" placeholder="Usuario"/>
                            </div>
                            <div class="form-outline form-black mb-4">
                            <input type="password" id="passwd" name="passwd" class="form-control form-control-lg" placeholder="Contraseña"/>
                        </div>
                        <input class="btn btn-outline-dark btn-lg px-5" type="submit" value="Iniciar sesión">
                        </form>
                    </div>
                    <p class="mb-0">¿Aún no te has registrado? <a href="register.php" class="text-black-50 fw-bold">Regístrate</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function validateForm() {
        var errorMessage = '';
        if (document.getElementById('nombre_usuario').value === '') {
            errorMessage += 'El campo usuario es obligatorio. ';
        }
        if (document.getElementById('passwd').value === '') {
            errorMessage += 'El campo contraseña es obligatorio. ';
        }
        if (errorMessage !== '') {
            document.getElementById('errorDiv').style.display = 'block';
            document.getElementById('errorDiv').innerHTML = errorMessage;
            return false;
        }
        return true;
    }
</script>
    
</body>
</html>
