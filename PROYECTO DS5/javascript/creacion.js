
    var grabar = document.getElementById('grabar');
    var crear = document.getElementById('crear');
    grabar.addEventListener('submit', function(e){
        e.preventDefault();
        var datos=new FormData(formulario)
       fetch('../php/grabarCheque.php', {
        method: 'POST',
        body: datos,
    })
    .then(res => res.json())
    .then(datos => {
        alert(datos); // Mostrar la respuesta del servidor como una alerta
        // Puedes manejar los datos de respuesta aquí, como actualizar la página o mostrar mensajes al usuario
    })
   
});