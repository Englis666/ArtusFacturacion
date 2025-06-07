
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | ArtusFacturación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-bg">
        <div class="login-container">
            <div class="login-card">
                <div class="login-logo mb-4">
                    <img src="/Public/img/logo2.png" alt="Logo" height="64">
                </div>
                <h2 class="text-center mb-2">¡Bienvenido!</h2>
                <p class="login-desc mb-4 text-center">Accede a tu cuenta para continuar</p>
                <form class="user w-100" action="/logearse" method="POST" autocomplete="off">
                    <div class="form-group mb-3">
                        <label class="form-label" for="num_doc">Número de documento</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                            <input type="number" id="num_doc" name="num_doc" class="form-control" placeholder="Ingresa tu documento" required autofocus>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="password">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                            <span class="input-group-text password-toggle" style="cursor:pointer;">
                                <i class="fa fa-eye" id="togglePassword"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">Iniciar Sesión</button>
                </form>
                <div class="divider my-3"><span>o</span></div>
                <a href="registro" class="btn btn-outline-secondary w-100">Registrar un cajero</a>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.password-toggle').addEventListener('click', function() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('togglePassword');
            if (pwd.type === "password") {
                pwd.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pwd.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>