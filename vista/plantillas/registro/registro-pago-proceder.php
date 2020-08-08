<div class="jumbotron text-center jumbotron-fluid">
    <h1 class="display-4">¡Paso final!</h1>
    <hr class="my-4">
    <p class="lead"> Estas a punto de pagar con PayPal la cantidad de
        <h4>$ <?php echo number_format($venta->total, 2) ?> </h4>
        <div id="paypal-button-container"></div>
    </p>
    <p>Podrá descargar los boletos una vez que se procese el pago<br />
        <strong>(Para aclaraciones :fisme@untrm.edu.pe)</strong>
    </p>
</div>

<form style="display: none" id="verificar" action="" method="POST">
    <input type="hidden" id="paymentToken" name="paymentToken" value="">
    <input type="hidden" id="paymentID" name="paymentID" value="">
</form>

<script>
    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout', // checkout | credit | pay | buynow | generic
            size: 'responsive', // small | medium | large | responsive
            shape: 'pill', // pill | rect
            color: 'gold' // gold | blue | silver | black
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox: '<?php echo CLIENTID ?>',
            production: '<?php echo CLIENTID ?>'
        },

        // Wait for the PayPal button to be clicked

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [{
                        amount: {
                            total: '<?php echo $venta->total; ?>',
                            currency: 'USD'
                        },
                        description: "Compra de productos a la FISME: $<?php echo number_format($venta->total, 2) ?>",
                        custom: "<?php echo $venta->idSesion ?>#<?php echo openssl_encrypt($venta->idventa, COD, KEY);   ?>"
                    }]
                }
            });
        },

        // Wait for the payment to be authorized by the customer

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {

                $("#paymentToken").val(data.paymentToken);
                $("#paymentID").val(data.paymentID);
                $("#verificar").submit();

            });
        }

    }, '#paypal-button-container');
</script>