<?php session_start(); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="inicioSesion.css">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-mb-4">
                <h1 class="text center">Bievenido al sistema Artus Facturacion</h1>
                <h2 class="text-center">Iniciar sesion</h2>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
                <form method="POST" action="login.php" class="form">
                    <div class="mb-3">
                        <label class="form-label">Numero de documento</label>
                        <input type="number" name="num_doc" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="usuario" class="form-control" required>
                     </div>

                    <div class="mb-3">
                         <label class="form-label">Contraseña</label>
                         <input type="text" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesion</button>
                    <a href="registro.php" class="d-block text-center mt-2 btn btn-secondary">Registrarse</a>

                </form>

            </div>
        </div>
    </div>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>