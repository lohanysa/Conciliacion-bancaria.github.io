
<?php 

//funcion para la conexion a la bd
function conexionServer(){
    define('HOST', "localhost");
    define('USER', "d52024");
    define('PASS',"12345");
    define('DB', "nombre de base de datos");
    $est = mysqli_connect(HOST,USER,PASS, DB);
    if($est->connect_errno){
        die(("fallo la conexion a mySQL: ".$est->connect_errno." ".mysqli_connect_errno()));
    }
    $est->set_charset('utf8');
    $est->close();
}
// http://localhost/Conciliacion-bancaria/PROYECTO%20DS5/php/funciones.php
?>