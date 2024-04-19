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