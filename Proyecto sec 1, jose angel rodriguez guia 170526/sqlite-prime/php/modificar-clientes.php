<?php
include 'vars.php';


if (empty($_POST["id"])) {
    http_response_code(400);
	exit("Falta insertar el id a cambiar"); 
}

if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("Falta insertar el nuevo nombre"); 
}

if (empty($_POST["telefono"])) {
    http_response_code(400);
	exit("falta insertar el nuevo telefono"); 
}
if (empty($_POST["direccion"])) {
    http_response_code(400);
	exit("falta insertar la nueva direccion"); 
}
if (empty($_POST["correo"])) {
    http_response_code(400);
	exit("falta insertar el nuevo correo"); 
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$clientes=[
    "id" => $_POST["id"],
    "nombre"=> $_POST["nombre"],
    "telefono"=> $_POST["telefono"],
    "direccion"=> $_POST["direccion"],
    "correo"=> $_POST["correo"]
];
try{
    # preparando la consulta
    $sentencia = $conex->prepare("update clientes set nombre=:nombre, telefono=:telefono, direccion=:direccion, correo=:correo where id=:id;");
    $resultado = $sentencia->execute($clientes);
    http_response_code(200);
    echo "datos actualizados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();
}

?>