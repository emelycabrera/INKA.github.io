<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>INKA | Productos</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilo.css">
    <link rel="icon" href="https://i.ibb.co/pdnpLy2/Imagen1-modified.png" />
    <style>
        .nav-link{
            display: inline-block;
            padding: 10px;
            margin-top: 10px;
            text-decoration: none;
            color: #000000;
            border-radius: 4px;
            transition: all 400ms ease;
            margin-bottom: 5px;
        }

        .nav-link:hover{
            background: #FFC0CB;
            color: #000;
        }

        .titulo {
        text-align: center;
        background: #ffc0cba4;
        padding: 5px;
        color: #000;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg fixed-top" style="background-color: #000;">
        <a class="navbar-brand" href="http://localhost/INKA/index.php"><img src="https://i.ibb.co/jD3bVjy/zyro-image-7-Photo-Room-png-Photo-Room.png"  width="150" height="50" ></a>
       
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/INKA/index.php">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/tienda/accesorios.php">Accesorios</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/tienda/minimochilas.php">Mini Mochilas</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/tienda/botellas.php">Termos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/tienda/miniabanicos.php">Mini Abanicos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/tienda/tasas.php">Tasas</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/tienda/peluches.php">Peluches</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/tienda/glos.php">Gloss</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/tienda/perfumes.php">Perfumes</a>
                </li>
                </li>
        
                <li class="nav-item active">
                    <a class="nav-link" href="mostrarCarrito.php">Carrito(<?php
                    echo (empty ($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                    ?>)</a>
                </li>
            </ul>
        </div>
       

    </nav>
    <br>
    <br>
    <div class="container">