<!DOCTYPE html>
<html lang="en">
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta charset="utf-8">
      <title> prueba </title>
    </head>
    <body>
    <form  id= 'anulacion'>
            <label for="fechaAnulacion">Fecha de Anulación:</label>
            <input type="date" id="fechaAnulacion" name="fechaAnulacion" autocomplete="off">
      
            <label for="detalleAnulacion">Detalle de Anulación:</label>
            <textarea id="detalleAnulacion" name="detalleAnulacion" autocomplete="off"></textarea>
      
            <button type="submit">Anular</button>
          <h2>Anulación de Cheques</h2>
            <label for="noCheque">No. Cheque:</label>
            <input type="text" id="noCheque" name="noCheque" autocomplete="off">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" autocomplete="off">
      
            <label for="paguese"> Paguese a la Orden de:</label autocomplete="off">
            <input type="text" id="paguese" name="paguese">
      
            <label for="suma">La suma de:</label>
            <input type="text" id="suma" name="suma" autocomplete="off">
      
            <label for="descripcion">Descripción de Gasto:</label>
            <input type="text" id="descripcion" name="descripcion" autocomplete="off">
            <button type="submit">Buscar</button>
          </form>
          <script src="../javascript/anulacion.js"></script>
    </body>
</html>
