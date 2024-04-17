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

    <section id="seccionCheque" style="display: none;">
        <div class="container-fluid">
            <!--method="post" action="../php/grabarCheque.php"-->
            <form id="crear" name="crear" method="post" action="../php/grabarCheque.php">
                <div class="card">
                    <h5 class="card-header">Creación</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">Cheque</h5>
                            
                                <label for="numero">No. de Cheque:</label>
                                <input type="text" id="numero" name="numero" required autocomplete="off"  onkeypress= "return solonumeros(event)" maxlength="5" placeholder="Campo obligatorio">

                            
                                <label for="fecha">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" required>
                            
                                <label for="beneficiario">Paguese a la orden de:</label>
                                <select type="text" id="beneficiario" name="beneficiario" >
                                  <?php
                                    proveedores();
                                  ?>
                                </select> 
                            
                                <label for="cantidad">La suma de:</label>
                                <div style="display: flex;">
                                    <input type="text" style="width: 30%; margin-right: 10px; text-align: right;" id="cantidad2" name="cantidad2" required autocomplete="off" onkeypress="return numerosPunto(event)"  oninput="actualizarMonto(this.value)" maxlength="10">
                                    <input type="text" style="width: 70%;" id="otroInput" name="otroInput" autocomplete="off" readonly>
                                </div>
                            
                                <label for="detalle">Detalle:</label>
                                <textarea id="detalleCreacion" name="detalleCreacion" autocomplete="off"></textarea>
                            
                                <br><br>
                                <button id="grabar" name="grabar" type="submit">Grabar</button>
                                <button type="submit">Imprimir</button>
                            </div>
                            
                            
                            
                            <div class="col-md-6">
                                <h5 class="card-title">Objeto de gasto</h5>
    
                                    <label for="objeto">Objeto:</label>
                                    <select  id="objeto" name="objeto">
                                      <?php 
                                      objetoGasto();
                                      ?>
                                    </select>
                                    <label for="monto">Monto:</label>
                                    <input type="text" id="monto" name="monto" autocomplete="off" readonly>
                        
                                    <br><br>
                                    <button type="reset">Nuevo</button>
    
                            </div>
                        </div>
                    </div>
                  </div>
                  <script src="../javascript/creacion.js"></script>
            </form>
        </div>
    </section>

    <section id="seccionAnulacion" style="display: none;">
        <div class="container-fluid">
            <form id="anulacion" name="anulacion">
            
                <div class="card">
                    <h5 class="card-header">Anulación</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="noCheque">No. Cheque:</label>
                                <input type="text" id="noCheque" name="noCheque" autocomplete="off">
                          
                                    <button id="buscar" name="buscar" type="submit">Buscar</button>
                                    
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" id="fecha" name="fecha" >
                            
                                    <label for="beneficiario"> Paguese a la orden de:</label>
                                    <input type="text" id="beneficiario" name="beneficiario" autocomplete="off" >
                            
                                    <label for="cantidad">La suma de:</label>
                                    <input type="text" id="cantidad" name="cantidad" autocomplete="off">
                            
                                    <label for="detalle">Descripción de gasto:</label>
                                    <input type="text" id="detalle" name="detalle"  autocomplete="off">
    
                            </div>
                            
                            <div class="col-md-6">
    
                            <label for="fechaAnulacion">Fecha de Anulación:</label>
                            <input type="date" id="fechaAnulacion" name="fechaAnulacion" autocomplete="off">
      
                            <label for="detalleAnulacion">Detalle de Anulación:</label>
                            <textarea id="detalleAnulacion" name="detalleAnulacion" autocomplete="off"></textarea>
                            <button type="submit">Anular</button>
                            
                            </div>
                        </div>
                    </div>
                  </div>
                  <script src="../javascript/anulacion.js"></script>
            </form>
        </div>
    </section>

    <section id="seccionSaCirculacion" style="display: none;">
        <div class="container-fluid">
            <form>
                <div class="card">
                    <h5 class="card-header">Sacar cheques de circulación</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form>
                                    <label for="noCheque">No. Cheque:</label>
                                    <input type="text" id="noCheque" name="noCheque" autocomplete="off">
                              
                                    <button type="button">Buscar</button>
                              
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" id="fecha" name="fecha" autocomplete="off" >
                              
                                    <label for="paguese"> Paguese a la Orden de:</label autocomplete="off">
                                    <input type="text" id="paguese" name="paguese" >
                              
                                    <label for="suma">La suma de:</label>
                                    <input type="text" id="suma" name="suma" autocomplete="off" >
                              
                                    <label for="descripcion">Descripción de Gasto:</label>
                                    <input type="text" id="descripcion" name="descripcion" autocomplete="off" >
                                  </form>
                            </div>
                            
                            <div class="col-md-6">
                                <form>
                                    <label for="fechaAnulacion">Fecha/Banco</label>
                                    <input type="date" id="fechaAnulacion" name="fechaAnulacion" autocomplete="off">
                                    <br><br>
                                    <button type="submit">Sacar de circulacion</button>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
            </form>
        </div>
    </section>

    <section id="seccionOtrsTransacciones" style="display: none;">
        <div class="containerTransac" id="containerTransac">
            <form>
                <div class="card">
                    <h5 class="card-header">Otras transacciones - Depósitos, Ajustes, Notas (Db/Cr)</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form>
                                  <label>Transacción</label>
                                  <input type="text">
                    
                                  <label for="fecha">Fecha:</label>
                                  <input type="date" id="fecha" name="fecha" >
                    
                                  <label for="monto1">Monto:</label>
                                  <input type="text" id="monto1" name="monto1" autocomplete="off" >
                    
                                  <br><br>
                                  <button type="submit">Grabar</button>
                                  <button type="submit">Nuevo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
            </form>
        </div>
    </section>

    <section id="seccionConciliacion" style="display: none;">
        <div class="container-fluid ">
            <form>
            <div class="card">
                    <h5 class="card-header">Conciliación Bancaria</h5>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                  
                                    <div style="text-align: right;">
                                        <label for="mes">Mes</label>
                                        <input type="text" id="mes" style="width: 150px;">
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

                                  <button type="submit">Grabar</button>
                                  <button type="reset">Nuevo</button>
                                
                                </div>
                            </div>
                            
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
</body>
</html>