<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <form id="archivoForm">
        <input id="archivo" name="archivo" type="file" accept=".dat">
       <button id="enviar" name="enviar">ENVIAR</button> 
       <input id="ruta" name="ruta" hidden>
    </form>
    </body>
</html>
<script>
   
   document.getElementById('enviar').addEventListener('click', function(e){
    e.preventDefault();
    archivoData = new FormData();
    archivoData.append('archivo', document.getElementById('archivo').files[0]);
    fetch('../php/asistencia.php', {
        method: 'POST',
        body: archivoData
    })

    .then(respuesta => respuesta.json())
    .then(respuesta => {
        alert(respuesta);
    });

});

</script>