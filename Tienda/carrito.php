<?php
 session_start();

    $mensaje = "";

     if(isset($_POST['btnAccion'])){
        
        switch($_POST['btnAccion']){
          
            case 'agregar':
                
                    if(is_numeric(openssl_decrypt( $_POST['id'], COD, KEY))){
                        $ID = openssl_decrypt( $_POST['id'], COD, KEY);
                        $mensaje.="ID Correcto... ".$ID."<br/>";
                    }else{
                        $mensaje.="Upss... ID Incorecto".$ID."<br/>";
                    }


                    if(is_string(openssl_decrypt( $_POST['nombre'], COD, KEY))){
                        $NOMBRE = openssl_decrypt( $_POST['nombre'], COD, KEY);
                        $mensaje.="Nombre ".$NOMBRE."<br/>";
                    }else{
                        $mensaje.="Upss... Algo paso con tu nombre".$NOMBRE."<br/>";
                    }


                    if(is_numeric($_POST['cantidad'])){
                           $CANTIDAD=($_POST['cantidad']);
                           $mensaje.="Cantidad Correcta".$CANTIDAD."<br/>";
                        
                    }else{$mensaje.="Ups... Algo pasa con la cantidad"."<br/>"; break;}


                    if(is_numeric(openssl_decrypt( $_POST['precio'], COD, KEY))){
                        $PRECIO = openssl_decrypt( $_POST['precio'], COD, KEY);
                        $mensaje.="El precio es... ".$PRECIO."<br/>";
                    }else{
                        $mensaje.="Upss... ID Incorecto".$PRECIO."<br/>";
                    }

                    if(!isset($_SESSION['CARRITO'])){

                        $Producto=array(
                            'ID'=>$ID,
                            'NOMBRE'=>$NOMBRE,
                            'CANTIDAD'=>$CANTIDAD,
                            'PRECIO' => $PRECIO
                        );
                       $_SESSION['CARRITO'][0]=$Producto;
                       $mensaje= "Producto agregado al carrito";

                    }else{
                         
                        $idProductos=array_column($_SESSION['CARRITO'],"ID");

                        if (in_array($ID,$idProductos)){
                            echo "<script>alert('El producto ya ha sido seleccionado...')</script>";
                        }else{
                        $NumeroProductos=count($_SESSION['CARRITO']);

                        $Producto=array(
                            'ID'=>$ID,
                            'NOMBRE'=>$NOMBRE,
                            'CANTIDAD'=>$CANTIDAD,
                            'PRECIO' => $PRECIO
                        );

                        $_SESSION['CARRITO'][$NumeroProductos]=$Producto;
                        $mensaje= "Producto agregado al carrito";
                      }
                    }

                    //$mensaje= print_r($_SESSION,true);
                

                break;

                case"Eliminar":
               
                if(is_numeric(openssl_decrypt( $_POST['id'], COD, KEY))){
                    $ID = openssl_decrypt( $_POST['id'], COD, KEY);
                   
                    foreach($_SESSION['CARRITO']as $indice=>$Producto){
                        if ($Producto['ID']==$ID){
                            unset($_SESSION['CARRITO'][$indice]);
                            //echo"<script>alert('elemento borrado...');</script>";
                        }
                    }
                }else{
                    $mensaje.="Upss... ID Incorecto".$ID."<br/>";
                }

                break;
        }
    }
?>