
<?php 

//verificar si funciona el archivo :)
// http://localhost/Conciliacion-bancaria/PROYECTO%20DS5/php/funciones.php
//funcion para la conexion a la bd

// function bucarMes(){
 include "../conexion/conexion.php";
//     $buscar_mes = mysqli_query($est, "SELECT * FROM ch_meses ORDER BY mes");
//     while ($mes_e=mysqli_fetch_assoc($buscar_mes)){
//     $seleccionado="";
//     if($mes_e['mes']==$mes_actual){$seleccionado ="selected";}
//     print "<option value='".$mes_e['mes']."' ".$seleccionado.">".$mes_e['nombre_mes'];
//     }
// }

function proveedores(){
    global $est;
    $tabla_proveedor='SELECT * FROM proveedores'; 
        $resultado=$est->query($tabla_proveedor);
            while ($fila = mysqli_fetch_array($resultado)) {
            $id =$fila['codigo'];
            $nombre = $fila['nombre'];
        echo '<option value = "'.$id.'">' . $nombre . '</option>';
            }
            
}

function objetoGasto(){
    global $est;
    $tabla_gasto='SELECT * FROM objeto_gasto';
    $resultado = $est->query($tabla_gasto);
    while($fila = mysqli_fetch_array($resultado)){
        $id = $fila['codigo'];
        $nombre = $fila['detalle'];
        echo '<option value = "'.$id.'">' . $nombre . '</option>';
    }
    
}

function transaccion(){
    global $est;
    $tabla_gasto='SELECT * FROM transacciones';
    $resultado = $est->query($tabla_gasto);
    while($fila = mysqli_fetch_array($resultado)){
        $id = $fila['codigo'];
        $nombre = $fila['detalle'];
        echo '<option value = "'.$id.'">' . $nombre . '</option>';
    }
    
}

?>