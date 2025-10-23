<?php
include_once "librerias/phpqrcode/qrlib.php";
include_once 'librerias/phpass-0.5/PasswordHash.php';
    session_start();
    //toma los datos enviados por el formulario
    $method = $_SERVER['REQUEST_METHOD'];
    $data   = $method === 'POST' ? $_POST : $_GET;
    $tipo = $data['tipoDato'] ?? '';
    $ruta = "uploads/";
    //dependinedo del tipo el contenido cambiara la forma de como se guarda
    if ($tipo === 'texto' || $tipo === 'numero') {
        //texto o numero se guardaran directamnete en el valor
        $valor = $data['valor'];
        $contenido = $valor;
    } elseif ($tipo === 'imagen' && isset($data['archivo'])) {
        //imgagen se guardara en la carpeta uploads y se guardara la ruta
        $nombre = $data['archivo']['name'];
        $rutaTemporal = $data['archivo']['tmp_name'];
        $destino = $ruta.$nombre;
        move_uploaded_file($rutaTemporal, $destino);
        $contenido = $destino;
    }else if( $tipo === "usuario"){
        //usuario se guardara en sesion el usuario y la contrasenia hasheada
        $hasher = new PasswordHash(8, false);
        $name = $data['name'];
        $password = $data['password']; 
        $hash = $hasher->HashPassword($password);
        $datos = [
            'usuario' => $name,
            'clave' => $hash
        ];
        $_SESSION["contenidoUsuario"] = $datos;
        $contenido = "Usuario: " . $name . "\nContraseña: " . $hash;
    } 
    else {
        die("Error: datos inválidos");
    }
    //al finalizar se genera el qr con el contenido correspondiente 
    $nombreQR = $ruta. 'QRimg' . time() . '.png';
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
    <div class="container">
        <div class="row col-lg-4">
            <h2 class="text-center">Código QR Generado</h2>
            <div class="text-center">
                <img src="<?php echo $nombreQR; ?>" alt="Código QR">
            </div>
            <!--luego si los valores del qr fueron caracteres se mostrar al continuacion del qr-->
            <?php if($tipo === "texto" || $tipo === "numero"): ?>
            <div class="text-center mt-2">
                <p><strong>Contenido Qr:</strong><?php echo $contenido?></p>
            </div>
            <?php else:?>
                <div clas="text-center mt-2">
                    <!--Al igual que los caracteres se presentara el usuario y la contrasenia codificada-->
                    <p><strong>Usuario: </strong><?php echo $name ?></p>
                    <p><strong>Contraseña: </strong><?php echo $hash;?></p>
                    <a href="inicioSesion.php">ingresar a inicio se sesion</a>
                </div>
            <?php endif; ?>
            <div class="d-grid gap-2 mt-4">
                <a href="datosQr.php" class="btn btn-primary">Generar otro QR</a>
            </div>
        </div>
    </div>
</body>
</html>