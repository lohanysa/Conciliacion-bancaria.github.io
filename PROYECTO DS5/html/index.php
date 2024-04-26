<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proyecto ds5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/estilo.css">
    <script src="../javascript/script.js"> </script>
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
            <form id="crearCheque" name="crearCheque" >
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
                                
                                <button id="grabarDeCheque" name="grabarDeCheque"  class="#grabarDeCheque.boton-deshabilitado">Grabar</button>
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

                            <button type="submit">Anular</button>

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
            <form>
                <div class="card">
                    <h5 class="card-header">Sacar cheques de circulación</h5>
                    <div class="card-body">
                        <div class="row">

<!----------------------------PRIMERA COLUMNA DE SACAR DE CIRCULACION---------------------------------------------------------------------------------------------------->

                            <div class="col-md-6">
                                <form>
                                    <label>No. Cheque:</label>
                                    <input type="text" id="numeroChequeCirculacion" name="numeroChequeCirculacion" autocomplete="off" onkeypress= "return solonumeros(event)" maxlength="5">
                              
<!---------------------------BOTON DE LA PRIMERA COLUMNA DE SACAR DE CIRCULACION---------------------------------------------------------------->

                                    <button type="button">Buscar</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->
                              
                                    <label>Fecha:</label>
                                    <input type="date" id="fechaDeSacarCirculacion" name="fechaDeSacarCirculacion" readonly >
                              
                                    <label> Paguese a la Orden de:</label autocomplete="off">
                                    <input type="text" id="pagueseSacarCirculacion" name="pagueseSacarCirculacion" readonly>
                              
                                    <label for="suma">La suma de:</label>
                                    <input type="text" id="sumaDeSacarCirculacion" name="sumaDeSacarCirculacion" readonly>
                              
                                    <label for="descripcion">Descripción de Gasto:</label>
                                    <input type="text" id="descripcionSacarCirculacion" name="descripcionSacarCirculacion" readonly>
                                  </form>
                            </div>
                            
<!---------------------------SEGUNDA COLUMNA DE SACAR DE CIRCULACION----------------------------------------------------------------------->

                            <div class="col-md-6">
                                <form>
                                    <label>Fecha/Banco</label>
                                    <input type="date" id="fechaSacarCirculacion" name="fechaSacarCirculacion" autocomplete="off" required>
                                    <br><br>

<!---------------------------BOTON DE LA SEGUNDA COLUMNA DE SACAR DE CIRCULACION---------------------------------------------------------------->

                                    <button type="submit">Sacar de circulacion</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->

                                </form>
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
            <form>
                <div class="card">
                    <h5 class="card-header">Otras transacciones - Depósitos, Ajustes, Notas (Db/Cr)</h5>
                    <div class="card-body">
                        <div class="row">

<!---------------------------PRIMERA COLUMNA DE ANULACION DE SACAR DE CIRCULACION----------------------------------------------------------------------->

                            <div class="col-md-6">
                                <form>
                                  <label>Transacción</label>
                                  <input type="text" id="transaccionOtrasTrans" name="transaccionOtrasTrans">
                    
                                  <label>Fecha:</label>
                                  <input type="date" id="fechaOtrasTrans" name="fechaOtrasTrans">
                    
                                  <label>Monto:</label>
                                  <input type="text" id="montoOtrasTrans" name="montoOtrasTrans" autocomplete="off" onkeypress="return numerosPunto(event)" maxlength="10">
                    
                                  <br><br>

<!---------------------------BOTON DE LA PRIMERA COLUMNA DE OTRAS TRANSACCIONES---------------------------------------------------------------->

                                  <button type="submit">Grabar</button>
                                  <button type="submit">Nuevo</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->

                                </form>
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
            <form>
            <div class="card">
                    <h5 class="card-header">Conciliación Bancaria</h5>
                    <div class="card-body">
                        <div class="row">

<!---------------------------PRIMERA COLUMNA DE ANULACION DE CONCILIACION----------------------------------------------------------------------->

                            <div class="col-md-6">
                                <div class="card-body">
                                  
                                    <div style="text-align: right;">
                                        <label for="mes">Mes</label>
                                        <input type="text" id="mesConciliacion" name="mesConciliacion" style="width: 150px;">
                                    </div>
                                  
                                  <br>
                                  
                                  <b>SALDO SEGÚN LIBRO AL</b>
                                  
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

                                  <b>SALDO CONCILIADO SEGUN LIBRO AL</b>
                                  
                                  <br><br><br><br>
                                  
                                  <b>SALDO EN BANCO AL</b>
                                  
                                  <br><br>
                                  
                                  <p style="text-indent: 2%;">Más: Depósito en transito</p>
                                  <p style="text-indent: 2%;">Menos: Cheques en circulación</p>
                                  <p style="text-indent: 2%;">Más: Ajustes</p>

                                  <br><br><br>

                                  <b>SALDO SEGÚN LIBRO AL</b>
                                  
                                  <br><br><br>

<!---------------------------BOTON DE LA PRIMERA COLUMNA DE CONCILIACION---------------------------------------------------------------->

                                  <button type="submit">Grabar</button>
                                  <button type="reset">Nuevo</button>

<!------------------------------------------------------------------------------------------------------------------------------------------->
                                
                                </div>
                            </div>
                            
<!---------------------------SEGUNDA COLUMNA DE ANULACION DE CONCILIACION----------------------------------------------------------------------->

                            <div class="col-md-3">
                                <div class="card-body">
                                    
                                    <label>Año</label>
                                    <input type="text" style="width: 150px;">
                                    
                                    <br><br>
                                    
                                    <div class="input-container">
                                        <input type="text">
                                        <input type="text">
                                        <input type="text">
                                        <input type="text">
                                        <a style="display: block; text-align: right; padding-right: 120px;">Subtotal</a>  
                                    </div>
                                    
                                    <br><br>
                                    
                                    <div class="input-container">
                                        <input type="text">
                                        <input type="text">
                                        <input type="text">
                                        <a style="display: block; text-align: right; padding-right: 120px;">Subtotal</a>   
                                    </div>
                                    
                                    <br><br><br><br><br><br><br>

                                    <div class="input-container">
                                        <input type="text">
                                        <input type="text">
                                        <input type="text">
                                        <a style="display: block; text-align: right; padding-right: 120px;">Subtotal</a>
                                    </div>

                                </div>
                            </div>
                            
<!---------------------------TERCERA COLUMNA DE ANULACION DE CONCILIACION----------------------------------------------------------------------->

                            <div class="col-md-3">
                                <div class="card-body">
                                  
                                  <button>Realizar Conciliación</button>
                                  
                                  <br><br>
                                  
                                  <input type="text">
                                  
                                  <br><br><br><br><br><br><br>
                                
                                  <div class="input-container">
                                    <input type="text">
                                    <input type="text">
                                  </div>
                                  
                                  <br><br><br><br><br><br>

                                  <div class="input-container">
                                    <input type="text">
                                    <input type="text">
                                  </div>
                                  
                                  <br><br>
                                  
                                  <input type="text">
                                  
                                  <br><br><br><br><br><br>

                                  <div class="input-container">
                                    <input type="text">
                                    <input type="text">
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
<script src="../javascript/anulacion.js"></script>
</body>
</html>