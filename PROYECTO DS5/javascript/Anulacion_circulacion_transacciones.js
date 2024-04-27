var buscar = document.getElementById('buscarDeAnulacion');
var formulario = document.getElementById('anulacionDeCheque');






/*******************************ANULACION*************************************/

//TRAE LOS DATOS DEL CHEQUE Y VERIFICA QUE EXISTAN DE ANULACION
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
        if (typeof datos === 'object' &&  Object.keys(datos).length > 0) {
            document.getElementById('fechaDeAnulacion').value = datos.fechaDeAnulacion;
            document.getElementById('beneficiarioDeAnulacion').value = datos.beneficiarioDeAnulacion; 
            document.getElementById('sumaDeAnulacion').value = datos.sumaDeAnulacion;
            document.getElementById('detalleDeAnulacion').value = datos.detalleDeAnulacion;
        }else{
            alert(datos)
           }
    })
})

//*******************ANULA EL CHEQUE ******************************************

formulario.addEventListener('submit', function(e){
//evita que por defecto procece el formulario xd
    e.preventDefault();

    var datos_2=new FormData(formulario)
 
    fetch("../php/anulacion_update.php", {
        method: 'POST',
        body: datos_2
    })

    .then(res=> res.json())
    //aqui va los datos
    .then(data_2 =>{
        alert(data_2)
        })
    }) 





    /*********************CIRCULACION************************************************/
    var formulario_circulacion = document.getElementById('circulacion__Form')
    var buscar_2 =document.getElementById('bucar_circulacion')
    var numero_Cheque = document.getElementById('numeroChequeCirculacion');
    var botonSubmint = document.getElementById('sacarCirculacionSubmint')



    //BUSCA Y TRAE LOS DATOS DE LA BASE DE DATOS

    buscar_2.addEventListener('click', function(e){
        e.preventDefault();
        //var datos=new FormData(formulario_circulacion)
        var num = new URLSearchParams();
        num.append('numeroChequeCirculacion', numero_Cheque.value);
        fetch("../php/Circulacion_verificar.php", {
            method: 'POST',

            // Especificar el tipo de contenido URL codificada
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded' 
            },
            body: num,
        })
        .then(res=> res.json())
        //aqui va los datos
        .then(datos =>{
            if (typeof datos === 'object' &&  Object.keys(datos).length > 0) {
                document.getElementById('fechaDeSacarCirculacion').value = datos.fechaDeSacarCirculacion;
                document.getElementById('pagueseSacarCirculacion').value = datos.pagueseSacarCirculacion; 
                document.getElementById('sumaDeSacarCirculacion').value = datos.sumaDeSacarCirculacion;
                document.getElementById('descripcionSacarCirculacion').value = datos.descripcionSacarCirculacion;
            }else{
                alert(datos)
               }
        })
    })


    //SACA DE DE CIRCULACION
    formulario_circulacion.addEventListener('submit', function(e){
       
        console.log('estoy en el formulario')


            e.preventDefault();

            var datos_3=new FormData(formulario_circulacion)
            console.log('verificar el dato numero de cheque en del formData: ', datos_3.get('fechaSacarCirculacion'));
           
           
            fetch("../php/Circulacion_G.php", {
                method: 'POST',
                body: datos_3,
            })

            .then(res=> res.json())

            .then(data_3 =>{

                alert(data_3)

                })
    }) 

    /**************************OTRA TRANSACCIONES************************************/
    var transacciones = document.getElementById('transaccion')

    transacciones.addEventListener('submit', function(e){

        e.preventDefault();

        var tranc =new FormData( transacciones)
        fetch("../php/transacciones.php", {
            method: 'POST',
            body: tranc,
        })
        .then(res=> res.json())
        //aqui va los datos
        
        .then(datos_tran =>{
            if (datos_tran.includes('error')) {
                
            }
            
            if(datos_tran.includes('vacio')){
               
            }else{
                alert(datos_tran)
              }
        })
    })