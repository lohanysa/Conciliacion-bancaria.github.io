<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <script src="../javascript/script.js"> </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/estilo.css">
  </head>
<body>

    <nav>
        <ul class="menu-horizontal">
            <li><a href="inicio.html">Inicio</a></li>
            <li><a href="#" onclick="mostrarSeccion('seccion1')">Cheques</a></li>
            <li>
                <a href="#">Operaciones Cks</a>
                <ul class="menu-vertical">
                    <li><a href="#" onclick="mostrarSeccion('seccion2')">Anulación</a></li>
                    <li><a href="#" onclick="mostrarSeccion('seccion3')">Sacar de circulación</a></li>
                </ul>
            
            </li>
            <li><a href="#">Otras transacciones</a></li>
            <li><a href="#">Conciliación</a></li>
            <li><a href="#">Reportes</a></li>
            <li><a href="#">Mantenimiento</a></li>
        </ul>
    </nav>
    
    <section id="seccion1" >
      <div class="containeruno">
        <div class="section">
          <h2>Creación de cheque</h2>
          <form method="$_POST" action='../php/grabarCheque.php' >
            <label for="numero">No. de Cheque:</label>
            <input type="text" id="numero" name="numero" value="0" required onkeypress="return solonumeros(event)" autocomplete="off" placeholder="Campo obligatorio">
    
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha"  required>
    
            <label for="beneficiario"> Paguese a la orden de:</label>
            <select id="beneficiario" name="beneficiario" >
              <?php include "../php/funciones.php";
                proveedores(); ?>
            </select>
            <br><br>
            <label for="cantidad">La suma de:</label>
            <input type="text" id="cantidad" name="cantidad" value="0" required onkeydown="return numeropunto(event)" autocomplete="off" placeholder="Campo obligatorio">
    
            <label for="detalle">Detalle:</label>
            <input type="text" id="detalle" name="detalle" value="detalle" required autocomplete="off" placeholder="Campo obligatorio">
    <br><br>
            <button type="submit" onclick="grabarCheque()">Grabar</button>
            <button type="submit">Imprimir</button>
          </form>
        </div>
        <div class="section">
          <h3>Objetos de Gastos</h3>
          <form method="$_POST" action="../php/grabarCheque.php">
            <label for="objeto">Objeto:</label>
            <select  id="objeto" name="objeto">
              <?php 
              objetoGasto(); ?>
            </select>
            
            <label for="monto">Monto:</label>
            <input type="text" id="monto" name="monto" required autocomplete="off">
    <br><br>
            <button type="submit">Nuevo</button>
          </form>
        </div>
      </div>
    </section>     

      <section id="seccion2">
        <div class="containerdos">
          <div class="section2">
          <h2>Anulación de Cheques</h2>
          <form method="$_POST" action="../php/funciones.php">
            <label for="noCheque">No. Cheque:</label>
            <input type="text" id="noCheque" name="noCheque" autocomplete="off">
      
            <button type="button">Buscar</button>
      
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" autocomplete="off">
      
            <label for="paguese"> Paguese a la Orden de:</label autocomplete="off">
            <input type="text" id="paguese" name="paguese">
      
            <label for="suma">La suma de:</label>
            <input type="text" id="suma" name="suma" autocomplete="off">
      
            <label for="descripcion">Descripción de Gasto:</label>
            <input type="text" id="descripcion" name="descripcion" autocomplete="off">
          </form>
        </div>
        
        <div class="section2">
          <form method="$_POST" action="../php/funciones.php">
            <label for="fechaAnulacion">Fecha de Anulación:</label>
            <input type="date" id="fechaAnulacion" name="fechaAnulacion" autocomplete="off">
      
            <label for="detalleAnulacion">Detalle de Anulación:</label>
            <textarea id="detalleAnulacion" name="detalleAnulacion" autocomplete="off"></textarea>
      
            <button type="submit">Anular</button>
          </form>
        </div>
      </div>
      </section>
      
      <section id="seccion3">
        <div class="containertres">
          <div class="section3">
          <h2>Anulación de Cheques</h2>
          <form method="$_POST" action="../php/funciones.php">
            <label for="noCheque">No. Cheque:</label>
            <input type="text" id="noCheque" name="noCheque" autocomplete="off">
      
            <button type="button">Buscar</button>
      
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" autocomplete="off">
      
            <label for="paguese"> Paguese a la Orden de:</label autocomplete="off">
            <input type="text" id="paguese" name="paguese">
      
            <label for="suma">La suma de:</label>
            <input type="text" id="suma" name="suma" autocomplete="off">
      
            <label for="descripcion">Descripción de Gasto:</label>
            <input type="text" id="descripcion" name="descripcion" autocomplete="off">
          </form>
        </div>
        
        <div class="section3">
          <form method="$_POST" action="../php/funciones.php">
            <label for="fechaAnulacion">Fecha/Banco</label>
            <input type="date" id="fechaAnulacion" name="fechaAnulacion" autocomplete="off">
      
            <button type="submit">Sacar de circulacion</button>
          </form>
        </div>
      </div>
      </section>

      <section id="seccion4">
        <h2>REINTEGRO</h2>
        <p>REINTEGRO</p>
      </section>
    

</body>
</html>