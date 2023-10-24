<?php include 'template/header.php' ?>      <!--Implementar ecabezado-->

<?php
include_once "model/conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from mascotas where id = ?;");
$sentencia->execute([$codigo]);
$mascota = $sentencia->fetch(PDO::FETCH_OBJ);   //Utilizar fila de datos en una base de datos

$sentencia_promocion = $bd->prepare("select * from promociones where id_mascotas = ?;");
$sentencia_promocion->execute([$codigo]);
$promocion = $sentencia_promocion->fetchAll(PDO::FETCH_OBJ); 
//print_r($mascota);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos para Promocion para: <br><?php echo $mascota->nombre.'<br> Raza: '.$mascota->raza; ?>
                </div>
                <form class="p-4" method="POST" action="registrarPromocion.php">
                    <div class="mb-3">
                        <label class="form-label">Promocion: </label>
                        <input type="text" class="form-control" name="txtPromocion" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duración de la Promocion: </label>
                        <input type="text" class="form-control" name="txtDuracion" autofocus required>
                    </div>
                    <div class="d-grid">
                    <input type="hidden" name="codigo" value="<?php echo $mascota->id; ?>"><P></P>
                        <!--Boton Registrar-->
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Lista de Promociones
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Promocion</th>
                                <th scope="col">Duracion</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($promocion as $dato) {//Bucle recorrer cada elemento de $promocion
                            ?>
                                <tr>
                                    <!--Mostrar datos extraido de la base de datos-->
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->promocion; ?></td>
                                    <td><?php echo $dato->duracion; ?></td>
                                    <!-->Boton -> Redireccionar a enviarMensaje.php-->
                                    <td><a class="text-primary" href="enviarMensaje.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-cursor"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="container mt-1">
            <!-- Botón -> Volver al inicio-->
            <!-- Colores boton: 
            btn-primary: azul 
            btn-secondary: gris
            btn-success: verde 
            btn-danger: rojo
            btn-warning: amarillo 
            btn-info: celeste-->
            <a href="index.php" class="btn btn-warning btn-sm btn-block mt-1">Volver al inicio</a>
            </div>
        </div>
    </div>
    
</div>

<?php include 'template/footer.php' ?>