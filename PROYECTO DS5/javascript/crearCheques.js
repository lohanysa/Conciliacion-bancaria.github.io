var numCheque = document.getElementById('numeroDeCheque');
var formulario = document.getElementById('crearCheque');
var grabar = document.getElementById('grabarDeCheque')
//evento para verificar si el numero existe

numCheque.addEventListener('blur', function(e){
    e.preventDefault();
    // Obtener el valor del input del cheque
    // Crear un objeto FormData para enviar los datos al servidor
    var num = new URLSearchParams();
    num.append('numeroDeCheque', numCheque.value);
    
    // Envío de la solicitud al servidor
    fetch('../php/cheque_verificar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded' // Especificar el tipo de contenido URL codificada
        },
        body: num // Enviar los datos de la solicitud
    })
    .then(res => res.text()) // Si el servidor responde con texto, usar res.text() en lugar de res.json()
    .then(verificacion => {
        if(verificacion.includes('existe')){
            alert(verificacion);
            document.getElementById('grabarDeCheque').disabled = true;
            document.getElementById('grabarDeCheque').classList.add('boton-deshabilitado');
        } else {
            document.getElementById('grabarDeCheque').disabled = false;
            document.getElementById('grabarDeCheque').classList.remove('boton-deshabilitado');
        }
    })

 });


 grabar.addEventListener('click', function(e){
    e.preventDefault();
    var formData = new FormData(formulario); // Obtener los datos del formulario
    
    fetch('../php/cheque_grabar.php', {
        method: 'POST',
        body: formData // Enviar los datos del formulario directamente
    })
    .then(res => res.json())
    .then(response => {
        if (response.startsWith('error')) {
            alert('Hubo un error: ');
        } else {
            alert('Se ha guardado exitosamente.');
        }
    })

});
