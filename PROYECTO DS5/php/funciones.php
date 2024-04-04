
<?php 

//verificar si funciona el archivo :)
// http://localhost/Conciliacion-bancaria/PROYECTO%20DS5/php/funciones.php
//funcion para la conexion a la bd

function bucarMes(){
    include "../conexion/conexion.php";
    $buscar_mes = mysqli_query($est, "SELECT * FROM ch_meses ORDER BY mes");
    while ($mes_e=mysqli_fetch_assoc($buscar_mes)){
    $seleccionado="";
    if($mes_e['mes']==$mes_actual){$seleccionado ="selected";}
    print "<option value='".$mes_e['mes']."' ".$seleccionado.">".$mes_e['nombre_mes'];
    }
}

function buscarObjeto_Gasto(){
    include "../conexion/conexion.php";
    $objeto_busqueda = mysqli_query($est, "SELECT * FROM objeto ORDER BY objeto");
    while ($objeto=mysqli_fetch_assoc($objeto_busqueda)){
    
    }
    
}

function proveedores(){
    include "../conexion/conexion.php";
    $tabla_proveedor="SELECT * FROM proveedores"; 
        $resultado= $est->query($tabla_proveedor);
            while ($fila = mysqli_fetch_array($resultado)) {
            $id =$fila['codigo'];
            $nombre = $fila['nombre'];
        print '<option value = "'.$id.'">' . $nombre . '</option>';
            }
}

?>