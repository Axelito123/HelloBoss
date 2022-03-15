<?php 
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<br/>

<h2>Lista del Pedido</h2>
<?php if(!empty($_SESSION['CARRITO'])) {?>
<table class="table table-light table-bordered" >
    <tbody>
        <tr>
            <th width="40%">Producto</th>
            <th width="40%" class="text-center">Cantidad</th>
            <th width="40%" class="text-center">Precio</th>
            <th width="40%" class="text-center">Total</th>
            <th width="40%">---</th>
            
        </tr>
        <?php $total=0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){?>
        <tr>
            <th width="40%"><?php echo $producto['NOMBRE'];?></th>
            <th width="40%" class="text-center"><?php echo $producto['CANTIDAD'];?></th>
            <th width="40%" class="text-center"><?php echo $producto['PRECIO'];?></th>
            <th width="40%" class="text-center"><?php echo $producto['PRECIO']*$producto['CANTIDAD'];?></th>
            
            <th width="40%">
            <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
            <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
            
            </th>
            </form>
            </tr>
        <?php $total=$total+$producto['PRECIO']*$producto['CANTIDAD']; ?>
        <?php } ?>
        <tr>
            <td colspan="3" align="right" ><h2>TOTAL</h2></td>
            <td align="right"><?php echo number_format($total,2);?></td>
        </tr>

        <tr>
            <td colspan="4">
                <form action="pagar.php" method="post">
                    <div class="form-group">
                        <label for="my-input">Nombre:</label>
                        <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Introduce tu nombre y apellidos" required>
                        <label for="my-input">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Introduce tu direccion:Calle,Portal,Piso." required>
                        <label for="my-input">Telefono de contacto:</label>
                        <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" name="telefono" id="telefono" class="form-control" placeholder="Formato: xxx-xxx-xxx" required>
                        <label for="my-input">Metodo de Pago:</label>
                        <br/>
                        <label for="Efectivo">Efectivo</label>
                        <input type="radio" id="efectivo" name="metodo_pago" value="efectivo" required>
                        <label for="tarjeta">Tarjeta</label>
                        <input type="radio" id="tarjeta" name="metodo_pago" value="tarjeta" required>
                        <label for="paypal">Paypal</label>
                        <input type="radio" id="paypal" name="metodo_pago" value="paypal" required>
                        <br/>
                        <br/>
                        <label for="my-input">Forma de entrega:</label>
                        <br/>
                        <label for="Efectivo">Recoger en el local</label>
                        <input type="radio" id="local" name="forma_envio" value="local" required>
                        <label for="tarjeta">Domicilio</label>
                        <input type="radio" id="domicilio" name="forma_envio" value="domicilio" required>
                    </div>
                    <th width="100%" rowspan="4"><button class="btn btn-primary btn-lg btn-block" value="pagar" name="btnAccion" type="submit">Pagar</button></th>
                </form>                
            </td>           
        </tr>
      
    </tbody>
</table>
<?php }else{?>
    <div class="alert alert-success">No hay productos seleccionados</div>
    <?php }?>












<?php 
include 'templates/pie.php';
?>