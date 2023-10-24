<?php
//print_r($_POST);
if (empty($_POST["oculto"]) || empty($_POST["txtNombre"]) || empty($_POST["txtRaza"]) || empty($_POST["txtPeso"]) || empty($_POST["txtEdad"]) || empty($_POST["txtContacto"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombre = $_POST["txtNombre"];
$raza = $_POST["txtRaza"];
$peso = $_POST["txtPeso"];
$edad = $_POST["txtEdad"];
$contacto = $_POST["txtContacto"];

$sentencia = $bd->prepare("INSERT INTO mascotas(nombre,raza,peso,edad,contacto) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([$nombre, $raza, $peso, $edad, $contacto]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}

