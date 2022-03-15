<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
echo "<br/> <br/> <br/> <br/>";
$idpaypal= $_GET['idtrans'];
$status= $_GET['status'];
$id_pedido= $_SESSION['idpedido'];
$SID= $_SESSION['usuario'];
$total= $_SESSION['total'];
$envio= $_SESSION['envio'];
echo $idpaypal."<br/>".$status."<br/>".$id_pedido."<br/>".$_SESSION['usuario']."<br/>".$_SESSION['total'].$SID.$_SESSION['envio'];

        if($status== "COMPLETED"){
             $sentencia=$pdo->prepare("UPDATE `pedidos` SET `clave_paypal` =:clave_paypal, `estatus` =:stattus 
            WHERE `pedidos`.`id_pedido` =:id_pedido
            AND `pedidos`.`clave_trans` =:clave_trans
            AND `pedidos`.`total`=:total;");
            $sentencia->bindParam(":clave_paypal",$idpaypal);
            $sentencia->bindParam(":stattus",$status);
            $sentencia->bindParam(":id_pedido",$id_pedido);
            $sentencia->bindParam(":clave_trans",$SID);
            $sentencia->bindParam(":total",$total);
            $sentencia->execute();
                                }

            if($envio=="local"){
                header('Location:pagadolo.php');
                session_destroy();
            }
            else{     
                header('Location:pagadodomi.php');
                session_destroy(); 
                }
?>