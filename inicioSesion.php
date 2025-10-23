<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <!--en esta pagina se pedira el qr de identificacion y la contrasenia-->
    <div class="container">
        <div class="row col-lg-4 border border-dark mx-auto mt-5 p-3">
            <form action="ingresoASesion.php" method="post" enctype="multipart/form-data">

                <h2 class="text-center">Ingrese su identificacion</h2>
                <label for="fileToUpload">identificacion</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                <label for="password" class="form-label">ingrese su contrasenia</label>
                <input type="password" name="password" id="password" class="form-control">
                <div class="d-grid gap-2 mt-4">
                    <input type="submit" value="Ingresar" class="btn btn-primary mt-3">
                </div>
            </form>
        </div>
    </div>
</body>
</html>