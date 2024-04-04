<!DOCTYPE html>
<html>
    <head>
    <?php  ?>   
    </head>
    <body>
    
        <div >
        <label for="proveedores">SELECT DE PROVEEDORES</label>
        <br>
        <select id= "proveedor">
        <?php 
        include "../conexion/conexion.php";
        $tabla_proveedor="SELECT * FROM proveedores"; 
        $resultado= $est->query($tabla_proveedor);
            while ($fila = mysqli_fetch_array($resultado)) {
            $id =$fila['codigo'];
            $nombre = $fila['nombre'];
        print '<option value = "'.$id.'">' . $nombre . '</option>';
    } ?>
        </select>
        </div>
    
    </body>
</html>