<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <?php include "../php/funciones.php";?>
    <form id="archivoForm">
        <section>
        <input id="archivo" name="archivo" type="file" accept=".dat">
        <button id="enviar" name="enviar">ENVIAR</button> 
        <br>
        <br>
        </section>

        <section>
            <select id="nombre_asistencias" name="nombre_asistencias">
                <?php 
                marcaciones();
                ?>
            </select>
            
            <input id="Fecha_inicial" name="Fecha_inicial" type="date">
            a
            <input id="Fecha_final" name="Fecha_final" type="date">

            <button id="buscar_marcacion" name="buscar_marcacion">BUSCAR</button>

        </section>
        <output id="mensaje" name="mensaje"> </output>
    </form>
    </body>
</html>
<script>
   //scrip para enviar el archivo 
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

//escrip para validar las fechas

document.getElementById("Fecha_final").addEventListener("blur", function(e){
    e.preventDefault();
    final = document.getElementById("Fecha_final").value || 0;
    inicio = document.getElementById("Fecha_inicial").value || 0;

    if(final<inicio){
        document.getElementById('mensaje').value = "La fecha final no puede ser menor que la fecha inicial";
        document.getElementById("Fecha_final").value = "";
        document.getElementById("Fecha_inicial").value= "";
        document.getElementById("buscar_marcacion").disabled = true
        document.getElementById("buscar_marcacion").style.backgroundColor = "gray";
        document.getElementById("buscar_marcacion").style.color = "white";
    }else{
        document.getElementById("buscar_marcacion").disabled = false
        document.getElementById("buscar_marcacion").style.backgroundColor = "";
        document.getElementById("buscar_marcacion").style.color = "";
        document.getElementById('mensaje').value = "";
    }
})

//este es el scrip del boton buscar 
document.getElementById("buscar_marcacion").addEventListener("click", function(e) {
    e.preventDefault();
    const fechas = new FormData();
    fechas.append("inicio", document.getElementById("Fecha_inicial").value);
    fechas.append("final", document.getElementById("Fecha_final").value);
    fechas.append("codigo", document.getElementById("nombre_asistencias").value);

    fetch('../php/pdf.php', {
        method: "POST",
        body: fechas
    })
    .then(response => response.blob())
    .then(blob => {
        const url = URL.createObjectURL(blob);
        window.open(url, '_blank');
        URL.revokeObjectURL(url); // Limpieza de la URL del objeto
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('mensaje').value = 'Error al generar el reporte.';
    });
});

</script>