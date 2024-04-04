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

//de numeros a letras
function Numeros_letras(id){
  num = document.getElementById(id).value
  Unidades= ["CERO","UNO","DOS","TRES","CUATRO","CINCO",
  "SEIS","SIETE","OCHO","NUEVE","DIEZ","ONCE","DOCE","TRECE","CATROCE","QUINCE"]
  decenas= ["","DIEZ","VEINTE","TREINTA","CUARENTA","CINCUENTA","SESENTA","SETENTA","OCHENTA", "NOVENTA"]
  centena = decenas= ["","CIEN","DOCIENTOS","TRECIENTOS","CUATROCIENTOS","QUINIENTOS","SEISCIENTOS","SETECIENTOS","OCHOCIENTOS", "NOVECIENTOS"]
  if (num< 0 || num >999){
    print("error")
  }else{
    U = num %10
    decidades = num %100
    Deci = Math.floor(num / 10) % 10
    C = Math.floor(num / 100)

    if (C != 0) {
      if(C == 1){
        if(decidades == 0){
          print("CIEN" , end="")
        }else{
          print("CIENTO", end="")
        }
      }else{
        print(centena[C], end="")
        if (decidades !=0){
          print(" ", end="")
        }
      }
    }
  }
}


