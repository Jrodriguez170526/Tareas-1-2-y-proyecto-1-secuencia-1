<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero); 


$stmt_productos = $conex->prepare('SELECT * FROM productos;');
$stmt_productos->execute();
$productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);


$stmt_clientes = $conex->prepare('SELECT * FROM clientes;');
$stmt_clientes->execute();
$clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);

$stmt_productos = null;
$stmt_clientes = null;
$conex = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Generales</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<div class="w3-container">
    <h2>Datos Generales</h2>

    <div class="w3-row">
        <div class="w3-col m4">
            <h3>Productos</h3>
            <table class="w3-table-all">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto['id'] ?></td>
                        <td><?= $producto['nombre'] ?></td>
                        <td><?= $producto['categoria'] ?></td>
                        <td><?= $producto['descripcion'] ?></td>
                        <td><?= $producto['stock'] ?></td>
                        <td><?= $producto['precio'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="w3-col m4">
            <h3>$clientes</h3>
            <table class="w3-table-all">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $clientes): ?>
                    <tr>
                        <td><?= $clientes['id'] ?></td>
                        <td><?= $clientes['nombre'] ?></td>
                        <td><?= $clientes['telefono'] ?></td>
                        <td><?= $clientes['direccion'] ?></td>
                        <td><?= $clientes['correo'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>