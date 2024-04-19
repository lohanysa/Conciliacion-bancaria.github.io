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

