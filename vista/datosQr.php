<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row col-lg-4 border border-dark border-2 mx-auto mt-5 p-3">
            <h2 class="text-center">Datos para Qr</h2>
            <form action="../control/generarQr.php" class="mt-3" method="post" enctype="multipart/form-data">
                <label for="tipoDato" class="form-label">Seleccione el tipo de dato</label>
                <select name="tipoDato" id="tipoDato" class="form-control mb-3">
                    <option value="">seleccionar un dato</option>
                    <option value="texto">texto</option>
                    <option value="numero">numero</option>
                    <option value="imagen">imagen</option>
                </select>
                <div id="ingresoDato"></div>
                <div class="d-grid gap-2 mt-4">
                    <input type="submit" class="btn btn-success" value="Crear Qr">
                </div>
            </form>
        </div>
    </div>
    <script>
    var tipo = document.getElementById("tipoDato");
    var campo = document.getElementById('ingresoDato');

    tipo.addEventListener('change', () => {
        let valor = tipo.value;
        campo.innerHTML = ''; 
        if (valor == "texto") {
            campo.innerHTML = "<label for='valor' class='form-label'>Ingrese texto:</label><input type='text' name='valor' class='form-control' required>";
        } else if (valor === "numero") {
            campo.innerHTML = "<label for='valor' class='form-label'>Ingrese número:</label><input type='number' name='valor' class='form-control' required>";
        } else if (valor === "imagen") {
            campo.innerHTML = "<label for='archivo' class='form-label'>Seleccione una imagen:</label><input type='file' name='archivo'  class='form-control' accept='image/*' required>";
        }
    });
  </script>
</body>
</html>