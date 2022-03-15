<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
    <br/>
<?php if($mensaje!=""){?>
    <div class="alert alert-success">
<?php echo $mensaje ?>
<a href="mostrarcarro.php" class="badge badge-success">Ver Carrito</a>
</div>
</div>
<?php } ?>
<div class="row">
<?php 
$sentencia_pizza=$pdo->prepare("SELECT * FROM `pizzas` ORDER BY `id_pizza` ASC");
$sentencia_pizza->execute();
$lista_pizza=$sentencia_pizza->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Pide cualquiera de nuestras maravillosas pizzas</h2>
<?php 
    foreach($lista_pizza as $pizza){  ?>
        <div class="col-3">
        <div class="card">
        <img title="foto"  class="card-img-top" src="<?php echo $pizza['imagen'];?>"  alt='titulo'>
        <div class="card-body">
        <span><?php echo $pizza['nombre'];?></span>
        <h5 class="card-title"><?php echo $pizza['precio'].'€';?></h5>
        <p class="card-text"><?php echo $pizza['descripcion'];?></p>      
        <form action="" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($pizza['id_pizza'],COD,KEY);?>">
            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($pizza['nombre'],COD,KEY);?>">
            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($pizza['precio'],COD,KEY);?>">
            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
            <button class="btn btn-primary" type="submit" name="btnAccion" value="Agregar">Agregar al carro</button>
            </form>
            </div>
            </div>            
            </div>
<?php } ?>
<br/>
<br/>
<h2>Acompaña tu pizza con una refrescante bebida</h2>

<?php 
$sentencia_bebida=$pdo->prepare("SELECT * FROM `bebidas` ORDER BY `id_bebida` ASC");
$sentencia_bebida->execute();
$lista_bebida=$sentencia_bebida->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
foreach($lista_bebida as $bebida){  ?>
<div class="col-3">
<div class="card">
<img title="foto"  class="card-img-top" src="<?php echo $bebida['imagen'];?>"  alt='titulo'>
<div class="card-body">
<span><?php echo $bebida['nombre'];?></span>
<h5 class="card-title"><?php echo $bebida['precio'].'€';?></h5>
<form action="" method="post">
<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($bebida['id_bebida'],COD,KEY);?>">
<input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($bebida['nombre'],COD,KEY);?>">
<input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($bebida['precio'],COD,KEY);?>">
<input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
<button class="btn btn-primary" type="submit" name="btnAccion" value="Agregar">Agregar al carro</button>
</form>
</div>
</div>            
</div>
<?php } ?>
</div>
<?php 
include 'templates/pie.php';
?>
    
    
    
  




