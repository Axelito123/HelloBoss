<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php'
?>
<?php 
$cliente=strip_tags($_POST['cliente'],);
$telefono=$_POST['telefono'];
$metodo=$_POST['metodo_pago'];
$envio=$_POST['forma_envio'];
$direccion=strip_tags($_POST['direccion']);
$SID=session_id();
if($_POST){
    $total=0;
    foreach($_SESSION['CARRITO'] as $indice=>$producto)
    {
        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
    }
    $sentencia=$pdo->prepare("INSERT INTO `pedidos` (`id_pedido`, `clave_trans`, `fecha`, `nombre`, `telefono`, `direccion`, `metodo_pago`, `envio`, `total`) 
    VALUES (NULL, :clave_trans, NOW(), :nombre, :telefono, :direccion, :metodo_pago, :envio , :total);");
    $sentencia->bindParam(":clave_trans",$SID);
    $sentencia->bindParam(":nombre",$cliente);
    $sentencia->bindParam(":telefono",$telefono);
    $sentencia->bindParam(":direccion",$direccion);
    $sentencia->bindParam(":metodo_pago",$metodo);
    $sentencia->bindParam(":envio",$envio);
    $sentencia->bindParam(":total",$total);
    $sentencia->execute();
    $idpedido=$pdo->lastInsertId();
        
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $sentencia=$pdo->prepare("INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_producto`) 
        VALUES (NULL, :id_pedido, :id_producto);");
        $sentencia->bindParam(":id_pedido",$idpedido);
        $sentencia->bindParam(":id_producto",$producto['ID']);
        $sentencia->execute();
        $_SESSION['idpedido']= $idpedido;
        $_SESSION['total']= $total;
        $_SESSION['usuario']= $SID;
        $_SESSION['envio']=$envio;
   }
          foreach($_SESSION['CARRITO'] as $indice=>$producto){
          $sentenciarepar=$pdo->prepare("INSERT INTO `repar` (`id_pedido`, `nombre`, `direccion`, `telefono`, `metodo_pago`, `envio`, `total`) 
          VALUES (:id_pedido, :nombre, :direccion, :telefono, :metodo_pago, :envio, :total);");
          $sentenciarepar->bindParam(":id_pedido",$idpedido);
          $sentenciarepar->bindParam(":nombre",$cliente);
          $sentenciarepar->bindParam(":telefono",$telefono);
          $sentenciarepar->bindParam(":direccion",$direccion);
          $sentenciarepar->bindParam(":metodo_pago",$metodo);
          $sentenciarepar->bindParam(":envio",$envio);
          $sentenciarepar->bindParam(":total",$total);
          $sentenciarepar->execute();
                                                            }
                foreach($_SESSION['CARRITO'] as $indice=>$producto){
                $sentencia=$pdo->prepare("INSERT INTO `cocina` (`id_pedido`, `id_pizza`) 
                VALUES (:id_pedido, :id_producto);");
                $sentencia->bindParam(":id_pedido",$idpedido);
                $sentencia->bindParam(":id_producto",$producto['ID']);
                $sentencia->execute();
                                                                  }
                      if($producto['ID'] != ""){
                      $sentencia_ingredientes=$pdo->prepare("UPDATE cocina as U1, ingredientes as U2 set U1.nombre = U2.nombre, U1.salsa = U2.salsa, 
                      U1.ingrediente_A = U2.ingrediente_A, U1.ingrediente_B = U2.ingrediente_B, U1.ingrediente_C = U2.ingrediente_C 
                      where U1.id_pizza=U2.id_pizza;");
                      $sentencia_ingredientes->execute();
                      };
                      }
?>
<?php
if($metodo=="paypal"){
  header('Location:paypal.php');
                    }

                    elseif
                    ($envio=="domicilio")
                    {   
                      header('Location:pagadodomi.php');
                    }else{
                      header('Location:pagadolo.php');
                          }
?>
<?php 
include 'templates/pie.php';
?>