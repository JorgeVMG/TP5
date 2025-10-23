<?php
session_start();
print_r($_SESSION['contenidoUsuario']);
unset($_SESSION['contenidoUsuario']);