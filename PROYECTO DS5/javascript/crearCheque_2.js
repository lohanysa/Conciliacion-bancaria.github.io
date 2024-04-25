var numCheque = document.getElementById('numeroDeCheque')
var formulario = document.getElementById('crearCheque')
var grabar = document.getElementById('grabarDeCheque')


grabar.addEventListener('click', function(e){
    e.preventDefault();
    var params = new FormData(formulario)
    
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
});