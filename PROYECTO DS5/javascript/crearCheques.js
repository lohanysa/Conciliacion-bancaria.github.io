var numCheque = document.getElementById('numeroDeCheque');
var formulario = document.getElementById('crearCheque');
var grabar = document.getElementById('grabarDeCheque')
//evento para verificar si el numero existe


//ESTE EVENTO SI FUNCIONA :)

//ESTE EVENTO ES PARA VERIFICAR QUE EL NUMERO DE CK NO EXISTA 
//SOLO TOMA EL INPUT DE NUMERO DE CK Y VERIFICA 
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
//  Sí, puedes enviar los datos del formulario utilizando el método URLSearchParams.
//   Este método crea una nueva estructura de datos similar a un mapa, que permite trabajar con la cadena de
//    consulta de la URL. Aquí te dejo un ejemplo de cómo puedes hacerlo:



//ESTE EVENTO NO FUNCIONA NO ENVIA EL FORMULARIO
//ESTE EVENTO ES EL QUE GRABA

 /*grabar.addEventListener('click', function(e){
    e.preventDefault();

    //SOSPECHO QUE EL PROBLEMA ES ESTE SEÑOR (FormData)
    const params = new FormData(formulario)
    
    fetch('../php/cheque_grabar.php', {
        method: 'POST',
        body: params
    })
    .then(res => res.json())
    .then(response => {
        if (response.startsWith('error')) {
            alert('Hubo un error:',response);
        } else {
            alert('Se ha guardado exitosamente.');
        }
    })
});*/


