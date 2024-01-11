function validar(event) {
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

/* Formulario de edicion
function validar2(event) {
  console.log('Función validar2 iniciada');  // Nueva línea

  // Validación de horas de entrada y salida
  var selectedTimeValue = document.getElementById('hs').value;
  var selectedTimeValue2 = document.getElementById('he').value;

  console.log('selectedTimeValue: ' + selectedTimeValue);
  console.log('selectedTimeValue2: ' + selectedTimeValue2);

  var currentTime = new Date();
  var selectedTime = new Date('1970-01-01 ' + selectedTimeValue);
  var selectedTime2 = new Date('1970-01-01 ' + selectedTimeValue2);

  console.log('currentTime: ' + currentTime);
  console.log('selectedTime: ' + selectedTime);
  console.log('selectedTime2: ' + selectedTime2);

  // Resto de la validación...

  console.log('Validación de horas finalizada');

  return true;
}*/




  
  //Limpiar fromulario 1
  function limpiar() {
    var formulario = document.getElementById("myForm");
    // Resetear el formulario
    formulario.reset();
  }

    //Limpiar fromulario 2
    function limpiar2() {
      var formulario = document.getElementById("myForm2");
      // Resetear el formulario
      formulario.reset();
    }