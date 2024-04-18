
    var grabar = document.getElementById('grabar');
    var crear = document.getElementById('crear');
    grabar.addEventListener('submit', function(e){
        e.preventDefault();
        var datos=new FormData(formulario)
       fetch('../php/grabarCheque.php', {
        method:'post',
        body: datos,
    })
    .then(res => res.json())
    .then(datos => {
        alert.arguments(datos); // Mostrar la respuesta del servidor como una alerta
        // Puedes manejar los datos de respuesta aquí, como actualizar la página o mostrar mensajes al usuario
    })
   
});