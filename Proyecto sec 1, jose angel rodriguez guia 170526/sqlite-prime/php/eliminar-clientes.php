<?php
include 'vars.php';

if (empty($_POST["id"])) {
    http_response_code(400);
	exit("Falta insertar el id a eliminar"); 

$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$id_clientes = $_POST["id"];

try {
 
    $sentencia = $conex->prepare("DELETE FROM clientes WHERE id = :id");
    $sentencia->bindParam(':id', $id_clientes);
    $resultado = $sentencia->execute();

    if ($resultado) {
        http_response_code(200);
        echo "Datos eliminados";
    } else {
        http_response_code(400);
        echo "No se pudo eliminar el producto";
    }

} catch (PDOException $exc) {
    http_response_code(400);
    echo "Lo siento, ocurrió un error: " . $exc->getMessage();
}

?>