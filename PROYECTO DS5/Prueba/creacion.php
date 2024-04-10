<!DOCTYPE html>
<html>
<head>
<script src="../javascript/script.js"> </script>
<link rel="stylesheet" href="../style/estilo.css">
</head>
<body>
<form method="post" action='../php/grabarCheque.php' >
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
            <input type="text" id="cantidad" name="cantidad" value="0" required onkeydown="return numeropunto(event)" autocomplete="off">
    
            <label for="detalle">Detalle:</label>
            <input type="text" id="detalle" name="detalle" value="detalle" required autocomplete="off" >
    <br><br>
        </div>
        <div class="section">
          <h3>Objetos de Gastos</h3>
            <label for="objeto">Objeto:</label>
            <select  id="objeto" name="objeto">
              <?php 
              objetoGasto(); ?>
            </select>
            
            <label for="monto">Monto:</label>
            <input type="text" id="monto" name="monto" required autocomplete="off">
    <br><br>
            <button type="reset">Nuevo</button>
            <button type="submit">Grabar</button>
            <button type="">Imprimir</button>
          </form>
        </div>
</body>
        </html>