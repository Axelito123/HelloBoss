<?php 
session_start();


$mensaje= "" ;

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){

        case 'Agregar':
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY)))
            {
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                $mensaje.="ID correcto ".$ID."<br/>";

        }else{
            $mensaje.="Error en el ID ".$ID."<br/>";

        }
        if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY)))
            {
                $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                $mensaje.="Precio correcto ".$PRECIO."<br/>";

        }else{
            $mensaje.="Error en el precio ".$PRECIO."<br/>";

        }

        if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY)))
            {
                $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
                $mensaje.="Cantidad correcta ".$CANTIDAD."<br/>";

        }else{
            $mensaje.="Error en la cantidad".$CANTIDAD."<br/>";
        }

        if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY)))
            {
                $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                $mensaje.="Nombre correcto ".$NOMBRE."<br/>";

        }else{
            $mensaje.="Error en el nombre".$$NOMBRE."<br/>";
        }


        if(!isset($_SESSION['CARRITO'])){

            $producto=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO);
                $_SESSION['CARRITO'][0]=$producto;
        }else{
            $cantidad_productos=count($_SESSION['CARRITO']);
            $producto=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO);
                $_SESSION['CARRITO'][$cantidad_productos]=$producto;
        }
        //$mensaje= print_r($producto,true);
        $mensaje="Producto Agregado";


            break;
            case 'Eliminar':

                    if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY)))
                        {
                    $ID=openssl_decrypt($_POST['id'],COD,KEY);
                    
                        foreach($_SESSION['CARRITO'] as $indice=>$producto){
                                if($producto['ID']==$ID){
                                    unset($_SESSION['CARRITO'][$indice]);
                                    echo "<script>alert('Producto borrado...')</script>";
                                }
                            
                        }



                        }else   {
                    $mensaje.="Error en el ID ".$ID."<br/>";

                                }
               

        

                  
                
                
                
                
            break;









    }
}





?>