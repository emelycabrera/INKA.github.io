<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php'
?>

<br>
<br>
<h2><center>Lista del carrito<center></h2>
<br>
<?php if(!empty($_SESSION['CARRITO'])) {?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="25%">Descripción</th>
            <th width="10%" class="text-center">Cantidad</th>
            <th width="10%" class="text-center">Precio</th>
            <th width="15%" class="text-center">Subtotal</th> 
            <th width="15%" class="text-center">ITBIS</th> 
            <th width="5%">--</th>
        </tr>

        <?php $total=0; ?>

        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){?>

        <tr>
            <td width="25%"><?php echo $producto['NOMBRE']?></td>
            <td width="10%" class="text-center"><?php echo $producto['CANTIDAD']?></td>
            <td width="10%" class="text-center">$RD <?php echo $producto['PRECIO']?></td>
            <td width="15%" class="text-center">$RD <?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],0);?></td>
            <td width="15%" class="text-center">$RD <?php echo number_format($producto['PRECIO']*$producto['CANTIDAD']*0.18,0);?></td>
            <td width="5%"> 

            <form action="" method="post">

            <input type="hidden" 
            name="id" 
            id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">

            <button 
            class="btn btn-danger" 
            type="submit"
            name="btnAccion"
            value="Eliminar"
            >Eliminar</button> </td>
            </form>
        </tr>
        <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']*0.18+$producto['PRECIO']*$producto['CANTIDAD']);?>
        <?php } ?>


        <tr>
            <td colspan="4" align="right"><h3>Total:</h3></td>
            <td align="right"><h3>$RD <?php echo number_format($total,0);?></h3></td>
            <td></td>
        </tr>
        
        <tr>
            <td colspan="6">
                <form action="pagar.php" method="post">
                <div class="alert alert-success">

                <div class="form-group">
                     <label for="my-input" id="datos">Datos de envio:</label>
                       <input id="nombre" name="nombre" 
                       class="form-control"
                       type="text"
                       placeholder="Nombre completo" 
                       required>
                </div>

                <div class="form-group">
                       <input id="email" name="email" 
                       class="form-control"
                       type="email"
                       placeholder="Correo" 
                       required>
                </div>


                <div class="form-group">
                       <input id="Numero" name="Numero" 
                       class="form-control"
                       type="number"
                       placeholder="Numero de telefono" 
                       required>
                </div>


                <div class="form-group">
                       <input id="Direccion" name="Direccion" 
                       class="form-control"
                       type="text"
                       placeholder="Direccion" 
                       required>
                </div>


                  <small id="emailHelp"
                  class="form-text text-muted"
                  >
               
                  </small>
            </div>
               <button class="btn btn-primary btn-lg btn-block w-100" type="submit" 
                  name="btnAccion"
                  value="proceder">
                  Proceder a pagar
                </button>
                <br>
                <br>
                <style>
    #paypal-button-container {
        margin: auto; /* Esto centrará el contenedor de los botones */
        text-align: center; /* Esto centrará los botones dentro del contenedor */
    }
</style>
    <!-- Resto de tu código -->

<!-- Set up a container element for the button -->
<div id="paypal-button-container"></div>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>

<script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({
        // ... (resto de tu código)
    }).render('#paypal-button-container');
</script>

<html lang="es">

    <head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> PayPal Checkout Integration | Button Styles </title> 
    </head>

    <body>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            style: {
                color:  'blue',
                shape:  'pill',
                label:  'pay',
                height: 40
            },
            
            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/create/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/' + data.orderID + '/capture/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    // Three cases to handle:
                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    //   (2) Other non-recoverable errors -> Show a failure message
                    //   (3) Successful transaction -> Show confirmation or thank you

                    // This example reads a v2/checkout/orders capture response, propagated from the server
                    // You could use a different API or structure for your 'orderData'
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart(); // Recoverable state, per:
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                    }

                    if (errorDetail) {
                        var msg = 'Sorry, your transaction could not be processed.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        return alert(msg); // Show a failure message (try to avoid alerts in production environments)
                    }

                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }

        }).render('#paypal-button-container');
    </script>
    </body>

</html>
            </form>

        
    <?php }else{ ?>
        <div class="alert alert-success" role="alert">
        No hay productos en el carrito...
        </div>
        <div class="dropdown">
        <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
              Puedes ir a comprar por categorias en:
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="accesorios.php">Accesorios</a>
          <a class="dropdown-item" href="minimochilas.php">Mini Mochilas</a>
          <a class="dropdown-item" href="botellas.php">Termos</a>
          <a class="dropdown-item" href="miniabanicos.php">Mini Abanicos</a>
          <a class="dropdown-item" href="tasas.php">Tasas</a>
          <a class="dropdown-item" href="peluches.php">Peluches</a>

        </div>
        </div>
    <?php } ?>
    
<?php include 'templates/pie.php';?>