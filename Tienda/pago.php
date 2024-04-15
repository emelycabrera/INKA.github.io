<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php'
?>

<?php

if($_POST){

    $total=0;
    $SID=Session_id();
    $nombre_cliente=$_POST['nombre'];
    $correo=$_POST['email'];
    $Direccion=$_POST['Direccion'];
    $Numero=$_POST['Numero'];

    foreach($_SESSION['CARRITO'] as $indice=>$Producto){

        $total=$total+($Producto['PRECIO']*$Producto['CANTIDAD']*0.18+$Producto['PRECIO']*$Producto['CANTIDAD']);

    }

       $_sentencia=$pdo->prepare("INSERT INTO `tblventas1` 
       (`ID`, `Fecha_hora`,  `Nombre_cliente`, `Correo`, `Direccion`, `Telefono`, `Total`)
        VALUES (NULL,  now(), :cliente, :Correo, :Direccion, :Numero, :Total);");
       
       
            $_sentencia->bindParam(":cliente", $nombre_cliente);
            $_sentencia->bindParam(":Correo", $correo);
            $_sentencia->bindParam(":Direccion", $Direccion);
            $_sentencia->bindParam(":Numero", $Numero);
            $_sentencia->bindParam(":Total", $total);
            $_sentencia->execute();
            $idVenta=$pdo->lastInsertId();

            foreach($_SESSION['CARRITO'] as $indice=>$Producto){
                 
                $_sentencia=$pdo->prepare ("INSERT INTO 
               `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`,  `NOMBRE_PRODUCTO`, `PRECIO`, `CANTIDAD`) 
               VALUES (NOT NULL,:IDVENTA, :IDPRODUCTO, :NOMBRE, :PRECIO, :CANTIDAD);"); 
               
               $_sentencia->bindParam(":IDVENTA", $IDVenta);
               $_sentencia->bindParam(":IDPRODUCTO", $Producto['ID']);
               $_sentencia->bindParam(":NOMBRE", $Producto['NOMBRE']);
               $_sentencia->bindParam(":PRECIO", $Producto['PRECIO']);
               $_sentencia->bindParam(":CANTIDAD", $Producto['CANTIDAD']);
               $_sentencia->execute();
               $idVenta=$pdo->lastInsertId();
           }

    //echo "<h3>" .$total. "</h3>";
}
?>