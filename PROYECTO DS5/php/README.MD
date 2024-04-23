# EXPLICACION DEL LENGUAJE PHP
la variables de declaran con el simbolo "$"

### explicacion del simbolo "->"

El símbolo “->” en el código que proporcionaste se utiliza en PHP para acceder a métodos o propiedades de un objeto. Permíteme explicarte en detalle:

**Objetos y Propiedades:**
En PHP, los objetos son instancias de clases. Una clase define la estructura y el comportamiento de un objeto.
Las propiedades(son atributos) son variables dentro de un objeto(los metodos) que almacenan datos específicos relacionados con ese objeto.
**Operador de Acceso a Propiedades:**

El operador “->” se utiliza para acceder a las propiedades y métodos de un objeto.
La sintaxis general es: $objeto->propiedad o $objeto->método().
Aquí, $objeto es una instancia de una clase.

>$est = mysqli_connect($host, $user, $pass, $db); crea una conexión a la base de datos y asigna esa conexión a la variable $est.

Después, utilizas el operador “->” para acceder a los métodos y propiedades de la conexión:

>$est->connect_errno: Devuelve el número de error de la conexión si hay un fallo.
>$est->set_charset('utf8'): Establece el conjunto de caracteres para la conexión.
>$est->close(): Cierra la conexión.

### explicacion de la funcion conexion 

La función conexionServer() que proporcionaste en PHP se encarga de establecer una conexión a una base de datos utilizando la extensión MySQLi. Permíteme explicarte cada parte del código:

**Definición de Variables:**

$host, $user, $pass y $db son variables que almacenan la información necesaria para conectarse a la base de datos.
Estas variables contienen:

>$host: El nombre del servidor de la base de datos (generalmente “localhost” si está en el mismo servidor).

>$user: El nombre de usuario para acceder a la base de datos.

>$pass: La contraseña asociada al usuario.

>$db: El nombre de la base de datos a la que deseas conectarte.

Establecimiento de la Conexión:

>$est = mysqli_connect($host, $user, $pass, $db); crea una conexión a la base de datos utilizando los valores proporcionados.

La variable $est ahora contiene la conexión activa.
Verificación de Errores de Conexión:

El siguiente bloque de código verifica si hubo algún error al establecer la conexión:
PHP

>if ($est->connect_errno) {
    die("Fallo la conexión a MySQL: " . $est->connect_errno . " " . mysqli_connect_errno());
}


Establecimiento del Conjunto de Caracteres:
>La línea $est->set_charset('utf8'); establece el conjunto de caracteres de la conexión a UTF-8. Esto es importante para manejar correctamente caracteres especiales y acentos.

Cierre de la Conexión:

>$est->close(); cierra la conexión a la base de datos para liberar recursos.

### CAMBIE LAS VARIABLES POR CONSTANTES :) 