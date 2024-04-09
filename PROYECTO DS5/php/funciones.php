
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

function objetoGasto(){
    include "../conexion/conexion.php";
    $tabla_gasto="SELECT * FROM objeto_gasto";
    $resultado = $est->query($tabla_gasto);
    while($fila = mysqli_fetch_array($resultado)){
        $id = $fila['codigo'];
        $nombre = $fila['detalle'];
        echo '<option value = "'.$id.'">' . $nombre . '</option>';
    }
}

function grabarCheque(){
 include "../conexion/conexion.php";
 //$_SERVER["REQUEST_METHOD"]. Luego, se comprueba si el campo 'nombre' está presente en $_POST. 
 //Si lo está, se asigna su valor a la variable $nombre, que luego se puede usar según sea necesario. 
 //Si el campo 'nombre' no está presente, se muestra un mensaje indicando que no se ha enviado el campo.
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //el post es un array
   
    if(isset($_POST["numero"])){
        $id = $_POST["numero"];
        //no se pone directamente por motivos de seguridad
        $consulta = "SELECT numero_cheque FROM cheque WHERE numero_cheque = ?";
        //preparo la consulta
        //se coloca en un if para verificar si la preparacion de la consulta fue exisa 
        $stmt=$est->prepare($consulta);
        if($stmt){
            //se le añade los parametros a la consulta preperada
            mysqli_stmt_bind_param($stmt, 's', $id,);
            //ejecutar consulta
            $stmt->execute();
            //almacenar el resultado
            $consulta_preparada->store_result();
            if(isset($_POST["nombre"] ) && isset( $_POST["fecha"]) && isset($_POST["beneficiario"])
                 && isset( $_POST["cantidad"]) && isset($_POST["detalle"])&& isset($_POST["objeto"] )&& isset($_POST["monto"])){
                $numero_cheque = $_POST["numero"];
                $fecha = (date($_POST["fecha"]));
                $beneficiario = $_POST["beneficiario"];	
                $monto =(float) $_POST["monto"];	
                $descripcion=(is_string($_POST["detalle"])) ;
                $fecha_anulado=date("00/00/0000");	
                $detalle_anulado="null";	
                $fecha_circulacion= date("00/00/0000");	
                $fecha_reintegro=date("00/00/0000");
                $codigo_objeto1="null";	
                $monto_objeto1=(float)0.0;
                    
                $Con_insert ="INSERT numero_cheque, fecha, beneficiario, monto, descripcion, fecha_anulado, detalle_anulado, 
                fecha_circulacion, fecha_reintegro, codigo_objeto1, monto_objeto1  FROM cheque";
                
                $consulta_preparada2 = $est->prepare($Con_insert);
                mysqli_stmt_bind_param($consulta_preparada2, '');
                echo "grabado"; 
            }
        }
        
    }else{
        echo "ingrese numero de cheque";
    }
   
}

    
}
?>