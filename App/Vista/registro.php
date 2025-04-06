<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cajero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6e7dff, #5e60d2);
            color: #fff;
        }
        .card {
            border-radius: 1.25rem;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        .form-label {
            font-size: 1.1rem;
            color: #333;
            position: absolute;
            top: 10px;
            left: 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: -15px;
            left: 15px;
            font-size: 0.9rem;
            color: #4e73df;
        }
        .form-control {
            border-radius: 0.75rem;
            padding-left: 2.5rem;
            position: relative;
            border: 2px solid #ccc;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 8px rgba(72, 101, 241, 0.3);
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
            transform: translateY(-3px);
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
            transform: translateY(-3px);
        }
        .input-group-text {
            background-color: #f4f4f4;
            border-color: #ddd;
            border-radius: 0.75rem;
        }
        .form-outline {
            margin-bottom: 1.5rem;
            position: relative;
        }
        .input-group-prepend {
            position: absolute;
            top: 10px;
            left: 15px;
        }
        .form-control::placeholder {
            color: transparent;
        }
        .input-group-text {
            position: absolute;
            top: 15px;
            left: 15px;
        }
        .text-center h1 {
            font-size: 2.5rem;
            color: #333;
            font-weight: bold;
        }
        .small.text-muted {
            color: #777;
        }
        .pt-1 {
            padding-top: 1.5rem;
        }
        .position-relative {
            position: relative;
        }
    </style>
</head>
<body>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card">
                        <div class="card-body p-4 p-lg-5 text-black">
                            <h1 class="text-center mb-4">Registrar un Cajero</h1>

                            <form class="user" action="/registrar" method="POST">
                                <div class="form-outline mb-4 position-relative">
                                    <input type="number" name="num_doc" class="form-control form-control-lg" required />
                                    <label class="form-label">Número de documento</label>
                                    <i class="fa fa-id-card position-absolute top-50 start-0 translate-middle-y ps-3"></i>
                                </div>

                                <div class="form-outline mb-4 position-relative">
                                    <input type="text" name="nombreCompleto" class="form-control form-control-lg" required />
                                    <label class="form-label">Nombre Completo</label>
                                    <i class="fa fa-user position-absolute top-50 start-0 translate-middle-y ps-3"></i>
                                </div>

                                <div class="form-outline mb-4 position-relative">
                                    <input type="email" name="email" class="form-control form-control-lg" required />
                                    <label class="form-label">Correo Electrónico</label>
                                    <i class="fa fa-envelope position-absolute top-50 start-0 translate-middle-y ps-3"></i>
                                </div>

                                <div class="form-outline mb-4 position-relative">
                                    <input type="password" name="password" class="form-control form-control-lg" required />
                                    <label class="form-label">Contraseña</label>
                                    <i class="fa fa-lock position-absolute top-50 start-0 translate-middle-y ps-3"></i>
                                </div>

                                <div class="pt-1 mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Registrar Cajero</button>
                                </div>
                            </form>
                            <div class="pt-1">
                                <a href="login" class="btn btn-secondary btn-lg btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
