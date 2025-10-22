<?php
include_once "../librerias/phpqrcode/qrlib.php";
    $tipo = $_POST['tipoDato'] ?? '';
    if ($tipo === 'texto' || $tipo === 'numero') {
        $valor = $_POST['valor'] ?? '';
        $contenido = $valor;
    } elseif ($tipo === 'imagen' && isset($_FILES['archivo'])) {
        $nombre = $_FILES['archivo']['name'];
        $rutaTemporal = $_FILES['archivo']['tmp_name'];
        $destino = 'uploads/' . $nombre;

        // Crea carpeta si no existe
        if (!is_dir('uploads')) mkdir('uploads');

        move_uploaded_file($rutaTemporal, $destino);

        // En el QR guardamos el enlace o nombre del archivo
        $contenido = "Imagen subida: " . $destino;
    } else {
        die("Error: datos inválidos");
    }
    $nombreQR = 'qr_' . time() . '.png';
    QRcode::png($contenido, $nombreQR, QR_ECLEVEL_M, 6, 2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
            <h2 class="text-center">Qr creado</h2>
            <img src="<?php echo $nombreQR;?>" class="rounded mx-auto d-block" alt="qr">
        
</body>
</html>