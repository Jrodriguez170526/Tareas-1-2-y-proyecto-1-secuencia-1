<?php
include 'vars.php';


if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta insertar el nombre"); 
}

if (empty($_POST["telefono"])) {
    http_response_code(400);
	exit("falta insertar el telefono"); 
}
if (empty($_POST["direccion"])) {
    http_response_code(400);
	exit("falta insertar la direccion"); 
}
if (empty($_POST["correo"])) {
    http_response_code(400);
	exit("falta insertar el correo"); 
}

$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$clientes=[
    "nombre"=> $_POST["nombre"],
    "telefono"=> $_POST["telefono"],
    "direccion"=> $_POST["direccion"],
    "correo"=> $_POST["correo"]
];
try{

    $sentencia = $conex->prepare("insert into clientes(nombre, telefono, direccion, correo) values(:nombre, :telefono, :direccion, :correo);");
    $resultado = $sentencia->execute($clientes);
    http_response_code(200);
    echo "datos insertados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();
}
?>