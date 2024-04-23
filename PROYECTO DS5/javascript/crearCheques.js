var numCheque = document.getElementById('numeroDeCheque');
var formulario = document.getElementById('crearCheque');
var grabar = document.getElementById('grabarDeCheque')
//evento para verificar si el numero existe
numCheque.addEventListener('blur', function(e){
    e.preventDefault()
    cheque_data = new FormData(formulario)
    //envio solo el valor del cheque (numero)
    fetch('../php/cheque_verificar.php',{
        method: 'POST',
        body: cheque_data
    })
    //ago las promesas 
    .then(res => res.json())
    //capto la respuesta del php
    .then(verificacion => {
        if(verificacion!=''){
            alert(verificacion)
            document.getElementById('grabarDeCheque').disabled = true;
            document.getElementById('grabarDeCheque').classList.add('boton-deshabilitado');
        }else{
            document.getElementById('grabarDeCheque').disabled = false;
            document.getElementById('grabarDeCheque').classList.remove('boton-deshabilitado');
        }

    })
})

grabar.addEventListener('click', function(e){
    e.preventDefault()
    cheque = new FormData(formulario)
    //console.log(cheque.value)
    //envio solo el valor del cheque (numero)
    fetch('../php/cheque_grabar.php',{
        method: 'POST',
        body: cheque
    })
    //ago las promesas 
    .then(res => res.json())
    //capto la respuesta del php
    .then(grabar => {
        if(grabar.includes('error')){
            alert('hubo un error')
        }else{
            alert('se registro exitosamente ')
        }
    })
})