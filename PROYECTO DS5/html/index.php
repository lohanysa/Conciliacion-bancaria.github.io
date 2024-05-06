<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proyecto ds5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/estilo.css">
</head>
<body>
 <?php include "../php/funciones.php";?>

<!-------------------------BARRA DE NAVEGACION---------------------------------------------------------------------------------------------->
    <nav>
        <ul class="menu-horizontal">
            <li><a onclick="mostrarSeccion()">Inicio</a></li>
            <li><a onclick="mostrarSeccion('seccionCheque')">Cheques</a></li>
            <li>
                <a >Operaciones Cks</a>
                <ul class="menu-vertical">
                    <li><a onclick="mostrarSeccion('seccionAnulacion')">Anulación</a></li>
                    <li><a onclick="mostrarSeccion('seccionSaCirculacion')">Sacar de circulación</a></li>
                </ul>
            
            </li>
            <li><a onclick="mostrarSeccion('seccionOtrsTransacciones')">Otras transacciones</a></li>
            <li><a onclick="mostrarSeccion('seccionConciliacion')">Conciliación</a></li>
            <li><a onclick="mostrarSeccion()">Reportes</a></li>
            <li><a onclick="mostrarSeccion()">Mantenimiento</a></li>
        </ul>
    </nav>
<!-----------------------PRIMERA #1 SECCION CREACION DE CHEQUES-------------------------------------------------------------->
    
<section id="seccionCheque" style="display: none;">
        <div class="container-fluid">
            <!--method="post" action="../php/cheque_grabar.php"-->
            <form id="crearCheque" name="crearCheque" method="post">
                <div class="card">
                    <h5 class="card-header">Creación</h5>
                    <div class="card-body">
                        <div class="row">
                            
<!-----------------------------PRIMERA COLUMNA DE CREACION DE CHEQUES--------------------------------------------------->
                            
                            <div class="col-md-6">
                                <h5 class="card-title">Cheque</h5>
                            
                                <label>No. de Cheque:</label>
                                <input type="text" id="numeroDeCheque" name="numeroDeCheque" autocomplete="off" onkeypress= "return solonumeros(event)" maxlength="5" placeholder="Campo obligatorio" required >

                                <label>Fecha:</label>
                                <input type="date" id="fechaDeCheque" name="fechaDeCheque" required>
                            
                                <label>Paguese a la orden de:</label>
                                <select type="text" id="beneficiarioDeCheque" name="beneficiarioDeCheque" required >
                                  <?php
                                    proveedores();
                                  ?>
                                </select> 

                                <label>La suma de:</label>
                                <div style="display: flex;">
                                    <input type="text" style="width: 30%; margin-right: 10px; text-align: right;" id="sumaDeCheque" name="sumaDeCheque" autocomplete="off" onkeypress="return numerosPunto(event)" maxlength="10" onchange="mostrarMontoEnLetras()" required >
                                    <input type="text" style="width: 70%;" id="sumaEnLetras" name="sumaEnLetras" readonly>
                                </div>
                            
                                <label for="detalle">Detalle:</label>
                                <textarea id="detalleDeCheque" name="detalleDeCheque" autocomplete="off"></textarea>
                                <br><br>
<!-------------------------------BOTONOES DE LA PRIMERA COLUMNA DE CREACION DE CHEQUE------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                                
                                <button id="grabarDeCheque" name="grabarDeCheque" type="submit" class="#grabarDeCheque.boton-deshabilitado">Grabar</button>
                                <button>Imprimir</button>
                            </div>
                            
<!------------------------------SEGUNDA COLUMNA DE CREACION DE CHEQUES------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                      
                            <div class="col-md-6">
                                <h5 class="card-title">Objeto de gasto</h5>
    
                                    <label>Objeto:</label>
                                    <select  id="objetoDeCheque" name="objetoDeCheque">
                                      <?php 
                                      objetoGasto();
                                      ?>
                                    </select>
                                    <label>Monto:</label>
                                    <input type="text" id="montoDeCheque" name="montoDeCheque" readonly>
                                    <br><br>

<!----------------------------------BOTONES DE LA SEGUNDA COLUMNA CREACION DE CHEQUE--------------------------------------------------------------------->                        
                                    
                                    <button type="reset">Nuevo Cheque</button>

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
                            </div>
                        </div>
                    </div>
                  </div>
            </form>
        </div>
    </section>

<!----------------SEGUNDA #2 SECCION ANULACION DE CHEQUES--------------------------------------------------------------------------------------------------->

    <section id="seccionAnulacion" style="display: none;">
        <div class="container-fluid">
            <form id="anulacionDeCheque" name="anulacionDeCheque">
                <div class="card">
                    <h5 class="card-header">Anulación</h5>
                    <div class="card-body">
                        <div class="row">

<!----------------------------PRIMERA COLUMNA DE ANULACION DE CHEQUES---------------------------------------------------------------------------------------------------->

                            <div class="col-md-6">
                                <label>No. Cheque:</label>
                                <input type="text" id="numeroChequeAnulacion" name="numeroChequeAnulacion" autocomplete="off" onkeypress= "return solonumeros(event)" maxlength="5">

<!-----------------------------------BOTON DE LA PRIMERA COLUMNA ANULACION DE CHEQUE------------------------------------------------------------------>

                                    <button id="buscarDeAnulacion" name="buscarDeAnulacion" >Buscar</button>

<!----------------------------------------------------------------------------------------------------------------------------------------------------->                                    
                                    <label>Fecha:</label>
                                    <input type="date" id="fechaDeAnulacion" name="fechaDeAnulacion" readonly>
                            
                                    <label>Paguese a la orden de:</label>
                                    <input type="text" id="beneficiarioDeAnulacion" name="beneficiarioDeAnulacion" readonly>
                            
                                    <label>La suma de:</label>
                                    <input type="text" id="sumaDeAnulacion" name="sumaDeAnulacion" readonly>
                            
                                    <label>Descripción de gasto:</label>
                                    <input type="text" id="detalleDeAnulacion" name="detalleDeAnulacion" readonly>
                            </div>

<!---------------------------SEGUNDA COLUMNA DE ANULACION DE CHEQUES----------------------------------------------------------------------->

                            <div class="col-md-6">
    
                            <label for="fechaAnulacion">Fecha de Anulación:</label>
                            <input type="date" id="fechaAnulacion" name="fechaAnulacion" autocomplete="off" required>
      
                            <label>Detalle de Anulación:</label>
                            <textarea id="detalleDeAnulacion" name="detalleDeAnulacion" autocomplete="off" required></textarea>

<!---------------------------BOTON DE LA SEGUNDA COLUMNA ANULACION DE CHEQUE---------------------------------------------------------------->

                            <button type="submit" id="Anulacionzion">Anular</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->                            
                            </div>
                        </div>
                    </div>
                  </div>
            </form>
        </div>
    </section>

<!----------------TERCERA #3 SECCION SACAR DE CIRCULACION--------------------------------------------------------------------------------------------------->

    <section id="seccionSaCirculacion" style="display: none;">
        <div class="container-fluid">
            <form id="circulacion__Form" name="circulacion__Form">
                <div class="card">
                    <h5 class="card-header">Sacar cheques de circulación</h5>
                    <div class="card-body">
                        <div class="row">

<!----------------------------PRIMERA COLUMNA DE SACAR DE CIRCULACION---------------------------------------------------------------------------------------------------->

                            <div class="col-md-6">
                               <!-- <form>-->
                                    <label>No. Cheque:</label>
                                    <input type="text" id="numeroChequeCirculacion" name="numeroChequeCirculacion" autocomplete="off" onkeypress= "return solonumeros(event)" maxlength="5">
                              
<!---------------------------BOTON DE LA PRIMERA COLUMNA DE SACAR DE CIRCULACION---------------------------------------------------------------->

                                    <button  id="bucar_circulacion" name="bucar_circulacion">Buscar</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->
                              
                                    <label>Fecha:</label>
                                    <input type="date" id="fechaDeSacarCirculacion" name="fechaDeSacarCirculacion" readonly >
                              
                                    <label> Paguese a la Orden de:</label autocomplete="off">
                                    <input type="text" id="pagueseSacarCirculacion" name="pagueseSacarCirculacion" readonly>
                              
                                    <label for="suma">La suma de:</label>
                                    <input type="text" id="sumaDeSacarCirculacion" name="sumaDeSacarCirculacion" readonly>
                              
                                    <label for="descripcion">Descripción de Gasto:</label>
                                    <input type="text" id="descripcionSacarCirculacion" name="descripcionSacarCirculacion" readonly>
                                <!--  </form>-->
                            </div>
                            
<!---------------------------SEGUNDA COLUMNA DE SACAR DE CIRCULACION----------------------------------------------------------------------->

                            <div class="col-md-6">
                               <!-- <form>-->
                                    <label>Fecha/Banco</label>
                                    <input type="date" id="fechaSacarCirculacion" name="fechaSacarCirculacion" autocomplete="off" required>
                                    <br><br>

<!---------------------------BOTON DE LA SEGUNDA COLUMNA DE SACAR DE CIRCULACION---------------------------------------------------------------->

                                    <button type="submit" id="sacarCirculacionSubmint" name="sacarCirculacionSubmint">Sacar de circulacion</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->

                                <!--</form>-->
                            </div>
                        </div>
                    </div>
                  </div>
            </form>
        </div>
    </section>

<!----------------CUARTA #4 SECCION OTRAS TRANSACCIONES--------------------------------------------------------------------------------------------------->

    <section id="seccionOtrsTransacciones" style="display: none;">
        <div class="container-fluid">
            <form id="transaccion" name="transaccion">
                <div class="card">
                    <h5 class="card-header">Otras transacciones - Depósitos, Ajustes, Notas (Db/Cr)</h5>
                    <div class="card-body">
                        <div class="row">

<!---------------------------PRIMERA COLUMNA DE ANULACION DE SACAR DE CIRCULACION----------------------------------------------------------------------->

                            <div class="col-md-6">
                                
                                  <label>Transacción</label>
                                  <select type="text" id="transaccionOtrasTrans" name="transaccionOtrasTrans">
                                    <?php transaccion()?>
                                  </select>
                                  
                                  <label>Fecha:</label>
                                  <input type="date" id="fechaOtrasTrans" name="fechaOtrasTrans">
                    
                                  <label>Monto:</label>
                                  <input type="text" id="montoOtrasTrans" name="montoOtrasTrans" autocomplete="off" onkeypress="return numerosPunto(event)" maxlength="10">
                    
                                  <br><br>

<!---------------------------BOTON DE LA PRIMERA COLUMNA DE OTRAS TRANSACCIONES---------------------------------------------------------------->

                                  <button type="submit">Grabar</button>
                                  <button type="reset">Nuevo</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->

                                
                            </div>
                        </div>
                    </div>
                  </div>
            </form>
        </div>
    </section>

<!----------------QUINTA #5 SECCION CONCILIACION--------------------------------------------------------------------------------------------------->

<section id="seccionConciliacion" style="display: none;">
        <div class="container-fluid ">
            <form id="conciliacion" name="conciliacion">
            <div class="card">
                    <h5 class="card-header">Conciliación Bancaria</h5>
                    <div class="card-body">
                        <div class="row">

<!---------------------------PRIMERA COLUMNA DE CONCILIACION----------------------------------------------------------------------->

                            <div class="col-md-6">
                                <div class="card-body">
                                  
                                    <div style="text-align: right;">
                                        <label for="mes">Mes</label>
                                        <select type="text" id="mesConciliacion" name="mesConciliacion" style="width: 150px;">
                                        <?php bucarMes() ?>
                                        </select>
                                    </div>
                                  
                                  <br>
                                  
                                  <b><output id='saldo_conciliado' name='saldo_conciliado'>SALDO SEGÚN LIBRO AL</output></b>
                                  
                                  <br><br>
                                  
                                  <p style="text-indent: 2%;">Más: Depósito</p>
                                  <p style="text-indent: 4%;">Cheques Anulados</p>
                                  <p style="text-indent: 4%;">Notas de Crédito</p>
                                  <p style="text-indent: 4%;">Ajustes</p>
                                  <br>

                                  <b>SUBTOTAL</b>
                                  
                                  <br><br>
                                  
                                  <p style="text-indent: 2%;">Menos: Cheques girados en el mes</p>
                                  <p style="text-indent: 4%;">Notas de Debitos</p>
                                  <p style="text-indent: 4%;">Ajustes</p>
                                  
                                  <br><br>

                                  <b id="saldo_conciliado" name="saldo_conciliado" >SALDO CONCILIADO SEGUN LIBRO AL</b>
                                  
                                  <br><br><br><br>
                                  
                                  <b id="saldo_en_banco_al" name="saldo_en_banco_al">SALDO EN BANCO AL</b>
                                  
                                  <br><br>
                                  
                                  <p style="text-indent: 2%;">Más: Depósito en transito</p>
                                  <p style="text-indent: 2%;">Menos: Cheques en circulación</p>
                                  <p style="text-indent: 2%;">Más: Ajustes</p>

                                  <br><br>

                                  <b>SALDO SEGÚN LIBRO AL</b>
                                  
                                  <br><br><br>

<!---------------------------BOTON DE LA PRIMERA COLUMNA DE CONCILIACION---------------------------------------------------------------->

                                  <button type="submit" id="grabar_conciliacion" name="grabar_conciliacion">Grabar</button>
                                  <button type="reset">Nuevo</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->
                                
                                </div>
                            </div>
                            
<!---------------------------SEGUNDA COLUMNA DE CONCILIACION----------------------------------------------------------------------->

                            <div class="col-md-3">
                                <div class="card-body">
                                    
                                    <label>Año</label>
                                    <select id="agno" name="agno" style="width: 150px;">
                                    <?php agnos() ?>
                                    </select>
                                    <br><br><br>
                                    
                                    <div class="input-container">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="mas_Deposito" id="masdepositos" name="masdepositos">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="maschequesanulados" id="maschequesanulados" name="maschequesanulados">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="masnotascredito" id="masnotascredito" name="masnotascredito">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="masajusteslibro" id="masajusteslibro" name="masajusteslibro">
                                        <a style="display: block; text-align: right; padding-right: 120px;">Subtotal</a>  
                                    </div>
                                    
                                    <br><br>
                                    
                                    <div class="input-container">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="menoschequesgirados" id="menoschequesgirados" name="menoschequesgirados">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="menosnotasdebito" id="menosnotasdebito" name="menosnotasdebito">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="menosajusteslibro" id="menosajusteslibro" name="menosajusteslibro">
                                        <a style="display: block; text-align: right; padding-right: 120px;">Subtotal</a>   
                                    </div>
                                    
                                    <br><br><br><br><br><br><br>

                                    <div class="input-container">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="masdepositostransito" id="masdepositostransito" name="masdepositostransito">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="menoschequescirculacion" id="menoschequescirculacion" name="menoschequescirculacion">
                                        <input type="text" readonly style="background: whitesmoke" placeholder="masajustesbanco" id="masajustesbanco" name="masajustesbanco">
                                        <a style="display: block; text-align: right; padding-right: 120px;">Subtotal</a>
                                    </div>

                                </div>
                            </div>
                            
<!---------------------------TERCERA COLUMNA DE CONCILIACION----------------------------------------------------------------------->

                            <div class="col-md-3">
                                <div class="card-body">
                                  
                                  <button id="realizar_conciliacion" name="realizar_conciliacion" type="button" >Realizar Conciliación</button>
                                  
                                  <br><br>
                                  
                                  <input type="text" readonly style="background: whitesmoke" placeholder="saldo-anterior" id="saldo_anterior" name="saldo_anterior">
                                  
                                  <br><br><br><br><br><br><br>
                                
                                  <div class="input-container">
                                    <input type="text" readonly style="background: whitesmoke" placeholder="subtotal_1" id="sub1" name="sub1">
                                    <input type="text" readonly style="background: whitesmoke" placeholder="sopongo que es la suma" id="subtotal1" name="subtotal1">
                                  </div>
                                  
                                  <br><br><br><br><br>

                                  <div class="input-container">
                                    <input type="text" readonly style="background: whitesmoke" placeholder="sub2" id="sub2" name="sub2">
                                    <input type="text" readonly style="background: whitesmoke" placeholder=" saldolibros" id="saldolibros" name="saldolibros">
                                  </div>
                                  
                                  <br><br><br>
                                  <input type="text" onkeypress="return numerosPunto(event)" maxlength="10" placeholder="saldobanco" id="saldobanco" name="saldobanco" require>
                                  
                                  <br><br><br><br><br><br>

                                  <div class="input-container">
                                    <input type="text" readonly style="background: whitesmoke" placeholder="sub3" id="sub3" name="sub3">
                                    <input type="text" readonly style="background: whitesmoke" placeholder="saldo igualado" id="saldo_igualado" name="saldo_igualado">
                                  </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
          </div>
    </section>
    <!--los scrips van al final -->
<script src="../javascript/crearCheques.js"></script>
<script src="../javascript/otras_pantallas.js"></script>

<!----------------SECCION DE SCRIPTS-------------------------------------------------------------------------------------------------------------->
<script>
function mostrarSeccion(idSeccion) {
    // Ocultar todas las secciones
    document.querySelectorAll('section').forEach(seccion => {
      seccion.style.display = 'none';
    });

    // Mostrar la sección deseada
    document.getElementById(idSeccion).style.display = 'block';
  }

     // SOLO NUMEROS 
     function solonumeros(evento) {
        var code = (evento.which) ? evento.which : evento.keyCode;
            if (code == 8) { // Retroceso
            return true;
            } else if (code >= 48 && code <= 57) { // Números 0-9
            return true;
            } else {
            return false;
    }
}

function numerosPunto(evento) {
  var code = (evento.which) ? evento.which : evento.keyCode;
  var inputValue = evento.target.value;
  var dotCount = (inputValue.match(/\./g) || []).length;

  if (code == 8) { // Retroceso
      return true;
  } else if (code == 46 && dotCount == 0) { // Punto
      return true;
  } else if (code >= 48 && code <= 57) { // Números 0-9
      return true;
  } else {
      return false;
  }
}  

document.addEventListener('DOMContentLoaded', function() {
    // Obtener los elementos input
    const sumaDeChequeInput = document.getElementById('sumaDeCheque');
    const montoDeChequeInput = document.getElementById('montoDeCheque');

    // Función para actualizar el valor del input montoDeCheque
    function actualizarMontoDeCheque() {
        // Obtener el valor del input sumaDeCheque
        const sumaDeChequeValue = sumaDeChequeInput.value.trim();

        // Verificar si el valor es un número válido
        if (!isNaN(sumaDeChequeValue) && sumaDeChequeValue !== '') {
            // Actualizar el valor del input montoDeCheque
            montoDeChequeInput.value = sumaDeChequeValue;
        } else {
            // Si el valor no es válido, dejar el input montoDeCheque vacío
            montoDeChequeInput.value = '';
        }
    }

    // Agregar evento keyup al input sumaDeCheque para actualizar automáticamente montoDeCheque
    sumaDeChequeInput.addEventListener('keyup', actualizarMontoDeCheque);
});

function numeroALetras(numero) {
    const unidades = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
    const especiales = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
    const decenas = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
    const centenas = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];
    const miles = ['', 'mil', 'millón'];

    let letras = '';

    if (numero >= 1000000) {
        letras += numeroALetras(Math.floor(numero / 1000000)) + ' ' + miles[2] + ' ';
        numero %= 1000000;
    }
    if (numero >= 1000) {
        if (numero >= 1000 && numero <= 1999) {
            letras += 'mil ';
        } else if (numero >= 2000 && numero <= 9999) {
            letras += numeroALetras(Math.floor(numero / 1000)) + ' ' + miles[1] + ' ';
        } else {
            letras += numeroALetras(Math.floor(numero / 1000)) + ' ' + miles[1] + ' ';
        }
        numero %= 1000;
    }
    if (numero >= 100) {
        if (numero === 100) {
            letras += 'cien ';
        } else {
            letras += centenas[Math.floor(numero / 100)] + ' ';
        }
        numero %= 100;
    }
    if (numero >= 10 && numero <= 19) {
        letras += especiales[numero - 10];
        numero = 0; 
    } else if (numero >= 10) {
        letras += decenas[Math.floor(numero / 10)] + ' ';
        numero %= 10;
    }
    if (numero > 0) {
        letras += unidades[numero];
    }

    return letras.trim(); 
}

function mostrarMontoEnLetras() {
    var monto = parseFloat(document.getElementById("sumaDeCheque").value);
    var parteEntera = Math.floor(monto);
    var parteDecimal = Math.round((monto - parteEntera) * 100);
    var montoEnLetras = numeroALetras(parteEntera) + ' balboas con ' + (parteDecimal < 10 ? '0' : '') + parteDecimal + ' /100 centavos';
    document.getElementById("sumaEnLetras").value = montoEnLetras;
}

</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('crearCheque').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario estándar
    var formData = new FormData(this);

    fetch('../php/cheque_grabar.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      alert(data); // Muestra el mensaje de éxito o error
      // Aquí puedes realizar otras acciones, como limpiar el formulario
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Hubo un error al procesar la solicitud.');
    });
  });
});






//verificar la fecha de anulacion sea menor a cuando se creo
var fechaAnulacion = document.getElementById('fechaAnulacion'); // fecha de creacion
fechaAnulacion.addEventListener('blur', function(e) {
    // Convierte las fechas a objetos de fecha
   var date1 = new Date(fechaAnulacion.value);
   var date2 = new Date(document.getElementById('fechaDeAnulacion').value);


 if(date1 < date2) {
    alert("La fecha de anulacion nu puede ser menor que la fecha de creacion");
    document.getElementById('Anulacionzion').disabled = true;
    }else{
        document.getElementById('Anulacionzion').disabled = false;
    }
});

//VERIFICAR LA FECHA DE CIRCULACION
var fechaCirculacionzin =document.getElementById('fechaSacarCirculacion')// fecha de creacion

fechaCirculacionzin.addEventListener('blur', function(e){

    var date1 = new Date(fechaCirculacionzin.value);
    var date2 = new Date(document.getElementById('fechaDeSacarCirculacion').value);

    if(date1 < date2) {
        alert("La fecha de sacar de circulacion no puede ser menor que la fecha de creacion");
        document.getElementById('Anulacionzion').disabled = true;
    }else{
        document.getElementById('Anulacionzion').disabled = false;
    }
})
</script>

</body>
</html>