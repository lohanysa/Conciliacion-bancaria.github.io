<?php 
//tambien se puede hacer una conexion con drive como en java
    define('HOST', "localhost");
    define('USER', "d52024");
    define('PASS',"12345");
    define('DB', "conciliacion");
    $est = mysqli_connect(HOST,USER,PASS, DB);
    if($est->connect_errno){
        die(("fallo la conexion a mySQL: ".$est->connect_errno." ".mysqli_connect_errno()));
    }

    $est->set_charset('utf8');
    //$est->close();

?>