<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
$total=0;
foreach($_SESSION['CARRITO'] as $indice=>$producto)
    {
        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
    }
?>
<br/>
<br/>
<br/>
<div class="jumbotron text-center">
    <h1 class="display-4">Ultimo paso.</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con Paypal la cantidad de:
      <h4><?php echo number_format($total,2);?>€</h4>
    </p>

<script src="https://www.paypal.com/sdk/js?client-id=AcIgsjpEnVqUkWnvQ9XT7MuXny_MEm92Wa17Pj-aQgeYGZcGZ-v6DzpJJzcrIsPHcBsUMBHjIJJiBsLu&currency=EUR"></script>
<!-- Set up a container element for the button -->
<div id="paypal-button-container"></div>
<script>
 paypal.Buttons({
 style: {
 layout: 'horizontal',
 fundingicons: 'true',
        },
// Sets up the transaction when a payment button is clicked
createOrder: function(data, actions) {
return actions.order.create
({
purchase_units: [
{
          reference_id: "default",
          amount: {
          currency_code: "EUR",
          value: "<?php echo $total ?>",
},
}],
}
)},
// Finalize the transaction after payer approval
onApprove: function(data, actions) {
return actions.order.capture().then(function(orderData) {
// Successful capture! For dev/demo purposes:
console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
var transaction = orderData.purchase_units[0].payments.captures[0];
alert('Transaction '+  transaction.status + '#' + transaction.id + '\n\nSee console for all available details');
window.location="verificador.php?idtrans="+transaction.id+"&status="+transaction.status;
// When ready to go live, remove the alert and show a success message within this page. For example:
// var element = document.getElementById('paypal-button-container');
// element.innerHTML = '';
// element.innerHTML = '<h3>Thank you for your payment!</h3>';
// Or go to another URL:  actions.redirect('thank_you.html');
});
}
}).render('#paypal-button-container');
</script>
</div>
<?php 
include 'templates/pie.php';
?>