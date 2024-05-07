
<?php 

//verificar si funciona el archivo :)
// http://localhost/Conciliacion-bancaria/PROYECTO%20DS5/php/funciones.php
//funcion para la conexion a la bd

include "../conexion/conexion.php";

 function bucarMes(){
    global $est;
     $buscar_mes = mysqli_query($est, "SELECT * FROM meses ORDER BY mes");
     while ($mes_e=mysqli_fetch_assoc($buscar_mes)){
     $seleccionado="";
     if($mes_e['mes']==$mes_e){$seleccionado ="selected";}
     print "<option value='".$mes_e['mes']."' ".$seleccionado.">".$mes_e['nombre_mes'];
     }
 }

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
    $tabla_gasto = 'SELECT * FROM transacciones';
    $resultado = $est->query($tabla_gasto);
    
    // Arreglos asociativos para almacenar las transacciones según su tipo
    $transacciones_por_tipo = array(
        'Libro 1' => array(),
        'banco' => array(),
        'transferencia' => array()
    );

    // Recorremos las filas de la consulta
    while($fila = mysqli_fetch_array($resultado)){
        $tipo = ''; // Variable para almacenar el tipo de transacción
        $signo ='';
        // Determinar el tipo de transacción según el valor de 'codigo'
        $codigo = intval($fila['codigo']);
        if($codigo >= 1 && $codigo <= 5){
            $tipo = 'Libro 1';
            if($codigo <= 3){
                $signo= '+';
            }else{
                $signo= '-';
            }
             
        } elseif($codigo >= 6 && $codigo <= 7){
            $tipo = 'banco';
                $signo= '+';
            
        } elseif($codigo >= 8){
            $tipo = 'transferencia';
                $signo= '+';
        }

        if(!empty($tipo)){
            /*Esto agrega la transacción actual al arreglo asociativo $transacciones_por_tipo. 
            $tipo se utiliza como clave para el arreglo asociativo,
             y cada transacción se agrega como un nuevo elemento al final del subarreglo */
            $transacciones_por_tipo[$tipo][] = array(
                'id' => $fila['codigo'],
                'nombre' => $fila['detalle'],
                'signo' => $signo
            );
        }
    }

   /* este bucle foreach itera sobre cada elemento del arreglo */
    foreach($transacciones_por_tipo as $tipo => $transacciones){
        echo '<optgroup label="' . $tipo . '">'; 
        foreach($transacciones as $transaccion){
            echo '<option value="' . $transaccion['id'] . '">'.$transaccion['signo'] . $transaccion['nombre'] . '</option>';
        }
    }
}

function agnos(){
    global $est; // Assuming $est is defined outside the function

    $anioActual = date("Y");
    $anioInicial = 2000; // Assuming a starting year

    // Corrected while loop syntax
    while ($anioInicial <= $anioActual) {
        echo '<option value="'.$anioInicial.'">'.$anioInicial.'</option>';
        $anioInicial++;
    }
}


?>