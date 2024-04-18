var buscar = document.getElementById('buscar');
var formulario = document.getElementById('anulacion');
var numero_Cheque = document.getElementById('noCheque');

buscar.addEventListener('click', function(e){
    e.preventDefault();
    var datos=new FormData(formulario)
    fetch("../php/anulacion.php", {
        method: 'POST',
        body: datos,
    })
    .then(res=> res.json())
    //aqui va los datos
    .then(datos =>{
        if (datos ==""){
            alert("no existe");
        }else{
            document.getElementById('fecha').value= datos.fecha
            document.getElementById('beneficiario').value= datos.beneficiario
            document.getElementById('cantidad').value= datos.suma
            document.getElementById('descripcion').value= datos.descripcion
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
