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

/*******************************************CONCILIACION******************************************************/
var boton_realizar = document.getElementById('realizar_conciliacion')
var mes= document.getElementById('mesConciliacion');
var agno = document.getElementById('agno')


//para colocar la fecha
var saldo_conciliado = document.getElementById('saldo_conciliado')



//para mostrar la informacion de conciliacion
//dependiendo de la fecha(mes y año)
boton_realizar.addEventListener('click', function(e){

    e.preventDefault();

    var conciliacion =new FormData()
    conciliacion.append('mesConciliacion',mes.value)
    conciliacion.append('agno',agno.value)
    fetch("../php/Conciliacion.php", {
        method: 'POST',
        body: conciliacion,
    })
    .then(res=> res.json())
    //aqui va los datos
    
    .then(datos_conciliacion =>{
        if(typeof datos_conciliacion === 'object' && !Array.isArray(datos_conciliacion)){

           
            /*PRIMERA COLUMNA  */
            document.getElementById('saldo_anterior').value = datos_conciliacion.ultima_conciliacion.toFixed(2)
            //fecha en el saldo banco al 
            
            saldo_conciliado.textContent ='SALDO SEGÚN LIBRO AL '+ datos_conciliacion.fecha.dia_anterior +' DE '+ datos_conciliacion.fecha.nombre_mes.toUpperCase() +' DEL '+ datos_conciliacion.fecha.agno_anterior;
           

            //INPUT SEGUNGA COLUMNA
            document.getElementById('masdepositos').value = datos_conciliacion.mas_depositos.toFixed(2)
           
            document.getElementById('maschequesanulados').value =datos_conciliacion.segunda_columna.suma_CK_anulados.toFixed(2)

            document.getElementById('masnotascredito').value =datos_conciliacion.mas_notas_credito.toFixed(2)

            document.getElementById('masajusteslibro').value = datos_conciliacion.mas_ajustes_libro.toFixed(2)
            /*** */


            //suma para el primer subtotal
            document.getElementById('sub1').value =(datos_conciliacion.mas_depositos+datos_conciliacion.segunda_columna.suma_CK_anulados
                +datos_conciliacion.mas_notas_credito+datos_conciliacion.mas_ajustes_libro).toFixed(2)

                //luego la suma de el saldo anterior con el subtotal 1
                document.getElementById('subtotal1').value =  ( parseFloat(document.getElementById('sub1').value) +   parseFloat(document.getElementById('saldo_anterior').value))

            //



            document.getElementById('menoschequesgirados').value = datos_conciliacion.segunda_columna.suma_CK_creados.toFixed(2)
          
            document.getElementById('menosnotasdebito').value = datos_conciliacion.menos_notas_debito.toFixed(2)

            document.getElementById('menosajusteslibro').value = datos_conciliacion.menos_ajustes_libro.toFixed(2)
               
            
            //suma para el segundo subtotal
                document.getElementById('sub2').value = (datos_conciliacion.segunda_columna.suma_CK_creados+datos_conciliacion.menos_notas_debito
                    +datos_conciliacion.menos_ajustes_libro).toFixed(2)
            //

            //la resta en el trecer subtotal
            document.getElementById('saldolibros').value = Math.abs((parseFloat(document.getElementById('sub2').value)-parseFloat(document.getElementById('subtotal1').value))).toFixed(2)
            //

            
            document.getElementById('saldo_conciliado_2').textContent = 'SALDO CONCILIADO SEGUN LIBRO AL '+ datos_conciliacion.fecha.dia + ' DE '+ datos_conciliacion.fecha.mes.toUpperCase()+ ' DEL ' + datos_conciliacion.fecha.año_actual

            /****************** */


            document.getElementById('saldo_en_banco_al').textContent = 'SALDO EN BANCO AL '+ datos_conciliacion.fecha.dia + ' DE '+ datos_conciliacion.fecha.mes.toUpperCase()+ ' DEL ' + datos_conciliacion.fecha.año_actual



            document.getElementById('masdepositostransito').value = datos_conciliacion.mas_depositos_transito.toFixed(2)
            document.getElementById('menoschequescirculacion').value = datos_conciliacion.segunda_columna.suma_CK_circulacion.toFixed(2)
            document.getElementById('masajustesbanco').value = datos_conciliacion.mas_ajustes_banco.toFixed(2)

            
                    //input sub3 
                    document.getElementById('sub3').value = (parseFloat( document.getElementById('masdepositostransito').value)- parseFloat(document.getElementById('menoschequescirculacion').value) +parseFloat(document.getElementById('masajustesbanco').value)).toFixed(2)


                    document.getElementById('igual').value = 'SALDO SEGÚN LIBRO AL ' + datos_conciliacion.fecha.dia + ' DE '+ datos_conciliacion.fecha.mes.toUpperCase()+ ' DEL ' + datos_conciliacion.fecha.año_actual
        }else{
            alert(datos_conciliacion)
        }
       
    })
})



//evento para hacer el calculo de la conciliacion(cuando se ingresa el valor)
var saldobanco = document.getElementById('saldobanco')
var sub3 = document.getElementById('sub3')
var suma
saldobanco.addEventListener('blur', function(e) {
    e.preventDefault();
    var suma = parseFloat(saldobanco.value) - parseFloat(sub3.value); // Convertir los valores a números
    var saldoIgualado = Math.abs(suma); // Obtener el valor absoluto de la suma
    document.getElementById('saldo_igualado').value = (saldoIgualado ||0).toFixed(2);
});




//evento para guandar la conciliacion
var grabar_conciliacion = document.getElementById('grabar_conciliacion')
var conciliacion_form = document.getElementById('conciliacion')
grabar_conciliacion.addEventListener('click', function(e){
    e.preventDefault()
    var form_conciliacion = new FormData(conciliacion_form)

    fetch('../php/grabar_conciliacion.php',{
        method: 'POST',
        body: form_conciliacion
    })
    .then(res=> res.json())
    .then(mensajes=>{
        alert(mensajes)
    })
})
