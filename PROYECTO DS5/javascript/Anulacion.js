var buscar = document.getElementById('buscarDeAnulacion');
var formulario = document.getElementById('anulacionDeCheque');
//var numero_Cheque = document.getElementById('noCheque');

buscar.addEventListener('click', function(e){
    e.preventDefault();
    var datos=new FormData(formulario)
    fetch("../php/anulacion_Verificacion.php", {
        method: 'POST',
        body: datos,
    })
    .then(res=> res.json())
    //aqui va los datos
    .then(datos =>{
        if (is_array(datos) && count(array_filter(array_keys(datos), 'is_string')) > 0) {
            document.getElementById('fechaDeAnulacion').value= datos.fechaDeAnulacion
            document.getElementById('beneficiarioDeAnulacion').value= beneficiarioDeAnulacion
            document.getElementById('sumaDeAnulacion').value= datos.sumaDeAnulacion
            document.getElementById('detalleDeAnulacion').value= datos.detalleDeAnulacion
        }else{
            alert(datos)
           }
    })
})


formulario.addEventListener('submit', function(e){
//evita que por defecto procece el formulario xd
    e.preventDefault();
    //vas hacer un nuevo formulario del formulario
    //es para guardar los datos.
    var datos=new FormData(formulario)
    //el metodo fetch envia la informacion al formulario, por defecto utiliza el mtodo get
    //pero lo podemos modificar diciendole que utilize el metodo post
    fetch("../php/anulacion .php", {
        method: 'POST',
        body: datos
    })
    //esto es para de codificar las respuesta del php, ademas el fetch siempre retorna un valor en formato json
    //en el rest esta la respuesta decodificada
    .then(res=> res.json())
    //aqui va los datos
    .then(data =>{
        console.log(data)
        })
    }) 
