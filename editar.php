<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once 'model/conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("select * from mascotas where id = ?;");
    $sentencia->execute([$codigo]);
    $mascota = $sentencia->fetch(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" required 
                        value="<?php echo $mascota->nombre; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Raza: </label>
                        <input type="text" class="form-control" name="txtRaza" autofocus required
                        value="<?php echo $mascota->raza; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Peso: </label>
                        <input type="number" class="form-control" name="txtPeso" autofocus required
                        value="<?php echo $mascota->peso; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Edad: </label>
                        <input type="number " class="form-control" name="txtEdad" autofocus required
                        value="<?php echo $mascota->edad; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contacto: </label>
                        <input type="number" class="form-control" name="txtContacto" autofocus required
                        value="<?php echo $mascota->contacto; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $mascota->id; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>