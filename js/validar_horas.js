  // Validación de horas de entrada y salida
  var fechai = document.getElementById('Fechainicio').value;
  var fechaf = document.getElementById('Fechafinalizacion').value;
  var horai = document.getElementById('Horainicio').value;
  var horaf = document.getElementById('Horafinalizacion').value;
  
  if (fechai != 0 && fechai == fechaf) {
      if (horai == horaf || horaf < horai) {
          document.getElementById('Horafinalizacion').classList.add('is-invalid');
          event.preventDefault();
      } else {
          document.getElementById('Horafinalizacion').classList.remove('is-invalid');
      }
  } else {
      document.getElementById('Fechafinalizacion').classList.remove('is-invalid');
  }
  