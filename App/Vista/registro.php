<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cajero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <section class="vh-100" style="background-color:rgb(39, 37, 37);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
              <div class="card-body p-4 p-lg-5 text-black">
                <h1>Registra el empleado</h1>

               <form class="user" action="/registrar" method="POST">
                  <div class="form-outline mb-4">
                      <input type="number" name="num_doc" class="form-control form-control-lg" required />
                      <label class="form-label">Numero de documento</label>
                  </div>

                  <div class="form-outline mb-4">
                      <input type="text" name="nombreCompleto" class="form-control form-control-lg" required />
                      <label class="form-label">Nombre Completo</label>
                  </div>

                  <div class="form-outline mb-4">
                      <input type="email" name="email" class="form-control form-control-lg" required />
                      <label class="form-label">Correo Electronico</label>
                  </div>

                  <div class="form-outline mb-4">
                      <input type="password" name="password" class="form-control form-control-lg" required />
                      <label class="form-label">Contraseña</label>
                  </div>

                  <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Registrar Cajero</button>
                  </div>
              </form>
              </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>