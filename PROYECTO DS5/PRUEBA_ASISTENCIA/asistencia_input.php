<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <form id="archivoForm">
        <input id="archivo" name="archivo" type="file" accept=".dat">
       <button id="enviar" name="enviar">ENVIAR</button> 
       <br>
       <br>
       <output id="mensaje" name="mensaje"> </output>
    </form>
    </body>
</html>
<script>
   
   document.getElementById('enviar').addEventListener('click', function(e){
    e.preventDefault();
    var archivoData = new FormData();
    archivoData.append('archivo', document.getElementById('archivo').files[0]);
    fetch('../php/asistencia.php', {
        method: 'POST',
        body: archivoData
    })
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        document.getElementById('mensaje').value = respuesta
        
        
    });
});

</script>