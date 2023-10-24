<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $nombre = $_POST['txtNombre'];
    $raza = $_POST['txtRaza'];
    $peso = $_POST['txtPeso'];
    $edad = $_POST['txtEdad'];
    $contacto = $_POST['txtContacto'];

    $sentencia = $bd->prepare("UPDATE mascotas SET nombre = ?, raza = ?, peso = ?,edad = ?, contacto = ? where id = ?;");
    $resultado = $sentencia->execute([$nombre, $raza, $peso, $edad, $contacto,$codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
