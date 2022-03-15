<?php 
include 'global/config.php';
include 'global/conexion.php';
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
        <script language="JavaScript"> 
        
    function mueveReloj(){ 
        momentoActual = new Date() 
        hora = momentoActual.getHours() 
        minuto = momentoActual.getMinutes() 
        segundo = momentoActual.getSeconds() 

        horaImprimible = hora + " : " + minuto + " : " + segundo 

        document.form_reloj.reloj.value = horaImprimible 

        //La función se tendrá que llamar así misma para que sea dinámica, 
        //de esta forma:

        setTimeout(mueveReloj,1000)
    }




</script>


           
    </head>
    <body onload="mueveReloj()">

            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <img title="Logo" src="img/logoPizza.jpg" alt="Peppito'sPizza's" style="width:50px;height:60px">
                <a class="navbar-brand" >Peppito's Pizza's</a>
                
                <form name="form_reloj"> 
                <input type="text" name="reloj" size="10"> 
                </form>
            </nav>
            <br/>
            <br/>
            <br/>
            <br/>

            <table >
                <tr>
            <th width="10%" >NOMBRE</th>
            <th width="20%" >TELEFONO</th>
            <th width="20%" >DIRECCION</th>
            <th width="20%" >METODO DE PAGO</th>
            <th width="20%" >TOTAL</th>
            </tr>
            
            
            
            
            <?php 
$sentencia_repar=$pdo->prepare("SELECT * FROM `repar` Where envio = 'domicilio' ;");
$sentencia_repar->execute();
$lista_repar=$sentencia_repar->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>REPARTIDORES</h2>
    <?php
        foreach($lista_repar as $pizza){  
    ?>
                <tr>
                <th width="20%"><p ><?php echo $pizza['nombre']?></p></th>
                <th width="20%"><p ><?php echo $pizza['telefono']?></p></th> 
                <th width="20%"><p ><?php echo $pizza['direccion'];?></p></th>
                <th width="20%"><p ><?php echo $pizza['metodo_pago'];?></p></th>
                <th width="20%"><p ><?php echo $pizza['total'];?></p></th>
              
                    <form action="generar.php" method="post">
                    <th width="20%">
                    <input type="hidden" name="idpedido" value="<?php echo $pizza['id_pedido'];?>">
                    <button class="btn btn-primary" type="submit" name="btnCompletar" value="generar">Generar</button>
                    </th>            
                    </form>
                        <form action="" method="post">
                        <th width="20%">
                        <input type="hidden" name="idpedidor" value="<?php echo $pizza['id_pedido'];?>">
                        <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                        </th>
                        </form>
                </tr>
      
            
<?php
} 
$idpedido= $_POST['idpedidor'];
 if ($idpedido != 0) {
      $completado=$pdo->prepare("DELETE  FROM `repar` WHERE `repar`.`id_pedido` =:id_pedido;");
      $completado->bindParam(":id_pedido",$idpedido);     
       $completado->execute();
    
 }else{
     echo "hubo un error";
 }
?>
</table>

 <?php 
include 'templates/pie.php';
?>