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
function convertirNumeroALetras(numero) {
  //ejemplo de ingreso de dato en input
  //document.getElementById("miInput").value = dato
  // Arreglos para las unidades, decenas y centenas
  var unidades= [" ","UNO","DOS","TRES","CUATRO","CINCO","SEIS","SIETE","OCHO","NUEVE"]
  var unidadesDiez= ["DIEZ","ONCE","DOCE","TRECE","CATROCE","QUINCE", "DIECISEIS", "DIECISIETE", "DICIOCHO", "DIECINUEVE"]
  var decenas = [" ","DIEZ","VEINTE","TREINTA","CUARENTA","CINCUENTA","SESENTA","SETENTA","OCHENTA", "NOVENTA"]
  var centenas = [" ","CIEN","DOCIENTOS","TRECIENTOS","CUATROCIENTOS","QUINIENTOS","SEISCIENTOS","SETECIENTOS","OCHOCIENTOS", "NOVECIENTOS"]

  // Función para convertir un número a palabras hasta 999
  function convertirNumeroHasta999(numero) {
      if (numero < 10) {
          return unidades[numero];
      } else if (numero < 20) {
          return unidadesDiez[numero - 10];
      } else if (numero < 100) {
          return decenas[Math.floor(numero / 10)] + ' ' + convertirNumeroHasta999(numero % 10);
      } else {
          return centenas[Math.floor(numero / 100)] + ' ' + convertirNumeroHasta999(numero % 100);
      }
  }

  if (numero === 0) {
      return 'cero';
  } else if (numero < 1000) {
      return convertirNumeroHasta999(numero);
  } else if (numero < 1000000) {
      var miles = Math.floor(numero / 1000);
      var restante = numero % 1000;
      var resultado = convertirNumeroHasta999(miles) + ' mil';
      if (restante !== 0) {
          resultado += ' ' + convertirNumeroHasta999(restante);
      }
      return resultado;
  } else {
      return 'Número fuera de rango';
  }
}



function numeropunto(event) {
  // Obtener el código de la tecla presionada
  var keyCode = event.which || event.keyCode;
  
  // Permitir teclas especiales como retroceso (backspace) y tabulador (tab)
  if (keyCode == 8 || keyCode == 9) {
      return true;
  }
  
  // Convertir el código de la tecla a su carácter correspondiente
  var char = String.fromCharCode(keyCode);
  
  // Verificar si el carácter es un número o un punto (.)
  if (/[\d.]/.test(char)) {
      // Verificar si ya hay un punto en el valor actual del input
      var input = document.getElementById('inputNumber');
      var value = input.value;
      if (char === '.' && value.indexOf('.') !== -1) {
          // Si ya hay un punto, no permitir otro
          return false;
      }
      return true;
  } else {
      // Si no es un número ni un punto, prevenir la entrada
      return false;
  }
}

