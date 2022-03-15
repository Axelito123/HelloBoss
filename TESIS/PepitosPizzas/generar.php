<?php 
include 'global/config.php';
include 'global/conexion.php';
 $idpedido= $_POST['idpedido'];

 ?>

<html>
    <head>
        <title>Pepito's Pizza's</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        </head>
    <body>

    <table style="width: 30%">
  <?php
 $sentencia=$pdo->prepare("SELECT direccion,telefono,pedidos.nombre,total, metodo_pago from pedidos where pedidos.id_pedido= :id_pedido;");
 $sentencia->bindParam(":id_pedido",$idpedido);
 $sentencia->execute();
 $sentenciadpf=$sentencia->fetchAll(PDO::FETCH_ASSOC);
 
?>
<?php
        foreach($sentenciadpf as $pizza){  
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

 <?php 
include 'templates/pie.php';
?>