<?php

function abrirDB()
{
    $archivo="./basededatos.sqlite3";
    if(file_exists($archivo)){
        echo "la base de datos ya existe";
        return null;
    }else{
        $baseDeDatos = new PDO("sqlite:" . $archivo);
        $baseDeDatos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $baseDeDatos;
    }
}

function crearTablaProductos($baseDeDatos)
{
    $definicionTabla = "create table if not exists productos(
        id integer primary key autoincrement,
           nombre varchar(30),
           categoria varchar(10),
           descripcion varchar(50),
           stock integer,
           precio float
           
       );";

    $resultado = $baseDeDatos->exec($definicionTabla);
    return $resultado;
}

function crearTablaclientes($baseDeDatos)
{
    $definicionTabla = "create table if not exists clientes(
        id integer primary key autoincrement,
        nombre varchar(30),
        telefono varchar(10),
        direccion varchar(30),
        correo varchar(30)
        
    );";

    $resultado = $baseDeDatos->exec($definicionTabla);
    return $resultado;
}

function insertaProducto($baseDeDatos, $producto)
{
    $query="insert into productos(nombre, categoria, descripcion, stock, precio) VALUES(:nombre, :categoria, :descripcion, :stock, :precio);";
    $sentencia = $baseDeDatos->prepare($query);
    $resultado = $sentencia->execute($producto);
    if ($resultado === true) {
        http_response_code(200);
        return true;
    } else {
        http_response_code(400);
        return false;
    }
}

function insertaclientes($baseDeDatos, $clientes)
{
    $query="insert into clientes(nombre, telefono, direccion, correo) VALUES(:nombre, :telefono, :direccion, :correo);";
    $sentencia = $baseDeDatos->prepare($query);
    $resultado = $sentencia->execute($clientes);
    if ($resultado === true) {
        http_response_code(200);
        return true;
    } else {
        http_response_code(400);
        return false;
    }
}

function insertaDatosProductos($baseDeDatos, $DatosProductos)
{
   
    $producto = [
        "nombre" => "",
        "categoria" => "",
        "descripcion" => "",
        "stock" => "",
        "precio" => ""
    ];
    foreach ($DatosProductos as $valor) {
        $producto["nombre"] = $valor["nombre"];
        $producto["categoria"] = $valor["categoria"];
        $producto["descripcion"] = $valor["descripcion"];
        $producto["stock"] = $valor["stock"];
        $producto["precio"] = $valor["precio"];
        insertaProducto($baseDeDatos, $producto);
    }
}

function insertaDatosClientes($baseDeDatos, $DatosClientes)
{
    
    $clientes = [
        "nombre" => "",
        "telefono" => "",
        "direccion" => "",
        "correo" => ""
    ];
    foreach ($DatosClientes as $valor) {
        $producto["nombre"] = $valor["nombre"];
        $producto["telefono"] = $valor["telefono"];
        $producto["direccion"] = $valor["direccion"];
        $producto["correo"] = $valor["correo"];
        insertaProducto($baseDeDatos, $clientes);
    }
}
$db = abrirDB();
if ($db) {
    try{
        crearTablaProductos($db);
        insertaDatosProductos($db, $DatosProductos);
        crearTablaclientes($db);
        insertaDatosclientes($db, $DatosClientes);
        http_response_code(200);
        echo "ok";
    }catch(Exception $Exception){
        http_response_code(400);
        echo "Error: " . $Exception;
    }
} else {
    http_response_code(400);
    echo "la base de datos ya existe";
}

?>