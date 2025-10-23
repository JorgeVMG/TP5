<?php
include_once "librerias/phpass-0.5/PasswordHash.php";
session_start();
//toma los datos enviados por el formulario 
$method = $_SERVER['REQUEST_METHOD'];
$data   = $method === 'POST' ? $_POST : $_GET;
$url = "uploads/";
$name = $_FILES['fileToUpload']['name'];
$target_file = $url . basename($name);
//se verifica si el qr existe o no
if(file_exists($target_file)){
    $error = 0;
}else{
    $error = 1;
}
if($error === 0){
    //si existe se obtiene la informacion del usuario del session
    $datos = $_SESSION["contenidoUsuario"];
    $hasher = new PasswordHash(8, false);
    //se obtiene la contrasenia ingresada y se compara con la hasheada
    $contrasenia = $data['password'];
    $usuario = $datos['usuario'];
    $password = $datos['clave'];
    if($hasher->CheckPassword($contrasenia, $password)){
        $mensaje = "Bienvenido, " . $usuario . "!";
    }else{
        $mensaje = "Contraseña incorrecta.";
    }
}else{
    $mensaje = "El usuario no existe";
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio de sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row col-lg-4 mt-5 border border-dark border-4 mx-auto p-3 card">
            <div class="card-header text-success">
                <h2 class="text-center" >Resultado de inicio de sesión</h2> 
            </div>
            <!--al finalizar se muestra si el usaurio existe o si su contrasenia es correcta o incorecta-->
            <div class="card-body text-success">
                <h2 class="text-center"><?php echo $mensaje; ?></h2>
            </div>
        </div>
    </div>
</body>
</html>