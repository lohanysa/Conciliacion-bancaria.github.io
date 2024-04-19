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
    var montoEnLetras = numeroALetras(parteEntera) + ' balboas con ' + (parteDecimal < 10 ? '0' : '') + parteDecimal + ' centavos';
    document.getElementById("sumaEnLetras").value = montoEnLetras;
}