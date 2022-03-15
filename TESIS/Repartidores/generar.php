<?php 
include 'global/config.php';
include 'global/conexion.php';
  $idpedido= $_POST['idpedido'];
  $sentencia=$pdo->prepare("SELECT direccion,telefono,pedidos.nombre,total, metodo_pago from pedidos where pedidos.id_pedido= :id_pedido;");
  $sentencia->bindParam(":id_pedido",$idpedido);
  $sentencia->execute();
   $sentenciadpf=$sentencia->fetchAll(PDO::FETCH_ASSOC);
   ob_start();
?>
<?php
   header("Content-type: application/vnd.ms-word");
   header("Content-Disposition: attachment; Filename=FacturaSimplificada.doc");
?>
<!DOCTYPE html>
    <head>
    <title>Pepitos Pizzas Repartidores</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
<table style="width: 30%">
<?php foreach($sentenciadpf as $pizza){  
?>
  <tr>
  <th>Direccion</th>
    <th><?php echo $pizza['direccion'];?></th>
  </tr>
  <tr>
  <td>Telefono</td>
    <td><p ><?php echo $pizza['telefono']?></p></td>
  </tr>
  <tr>
  <td>Cliente</td>
    <td><p ><?php echo $pizza['nombre']?></p></td>
  </tr>
  
  <tr>
  <td>Total</td>
    <td><p ><?php echo $pizza['total'];?> €</p></td>
  </tr>
  <tr>
  <td>Metodo De Pago</td>
    <td><p ><?php echo $pizza['metodo_pago'];?></p></td>
  </tr>
<?php } ?>
</table>
<p>Muchas gracias por su compra.</p>
</body>
</html>

<?php
$html=ob_get_clean();
echo $html;
?>
