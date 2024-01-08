function validar() {
    // Validación de fecha
    var selectedDateValue = document.getElementById('fecha').value;

    if (!selectedDateValue) {
      document.getElementById('fecha').classList.add('is-invalid');
      event.preventDefault();
      return;
    }

    var currentDate = new Date().toISOString().split('T')[0];

    if (selectedDateValue < currentDate) {
      document.getElementById('fecha').classList.add('is-invalid');
      event.preventDefault();
    } else {
      document.getElementById('fecha').classList.remove('is-invalid');
    }

    // Validación de horas de entrada y salida
    var selectedTimeValue = document.getElementById('hs').value;
    var selectedTimeValue2 = document.getElementById('he').value;

    if (selectedTimeValue != 0 && selectedTimeValue < selectedTimeValue2) {
      document.getElementById('hs').classList.add('is-invalid');
      event.preventDefault();
    } else {
      document.getElementById('hs').classList.remove('is-invalid');
    }

    // Validación de otros campos
    var fieldsToValidate = ['he', 'nombre', 'ap', 'am', 'empresa', 'asunto'];

    fieldsToValidate.forEach(function(fieldId) {
      var fieldValue = document.getElementById(fieldId).value;
      if (!fieldValue) {
        document.getElementById(fieldId).classList.add('is-invalid');
        event.preventDefault();
      } else {
        document.getElementById(fieldId).classList.remove('is-invalid');
      }
    });
  };
  
  //Limpiar fromulario
  function limpiar() {
    var formulario = document.getElementById("myForm");
    // Resetear el formulario
    formulario.reset();
  }
