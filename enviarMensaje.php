<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_mascotas, per.nombre , per.raza, per.contacto
  FROM promociones pro 
  INNER JOIN mascotas per ON per.id = pro.id_mascotas
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$mascotas = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance7103865766/SendMessage/ae0788fdcd9a49bc8e8f83d0725cab4077153cde4d01467f94';
    $data = [
        "chatId" => "51".$mascotas->contacto."@c.us",
        "message" =>  'Estimado(a) cliente aprobecha ya nuestra promocion para su engreido(a) *'.strtoupper($mascotas->nombre).' de raza '.strtoupper($mascotas->raza).'* No se pierda *'.strtoupper($mascotas->promocion).'* valido solo *'.$mascotas->duracion.'*'
    ];
    //Creacion de arreglo con metodo POST =  enviar datos al servidor de forma segura y eficiente
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data), // Convertir el arreglo $data a formato JSON --> Formato de dartos estandar en lengajes de progrmaacion
            'header' =>  "Content-Type: application/json\r\n" . //cabecera: se envia el contenido en JSON y Respuestas esperadas en JSON
                "Accept: application/json\r\n"      
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: agregarPromocion.php?codigo='.$mascotas->id_mascotas);
?> 
