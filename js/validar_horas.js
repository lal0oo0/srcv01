// validar_horas.js

document.addEventListener('DOMContentLoaded', function() {
    function validarHoras() {
        var fechaInicio = document.getElementById('Fechainicio').value;
        var fechaFinalizacionInput = document.getElementById('Fechafinalizacion');
        var horaInicio = document.getElementById('Horainicio').value;
        var horaFinalizacion = document.getElementById('Horafinalizacion').value;

        var fechaInicioObj = new Date(fechaInicio + 'T' + horaInicio); 

        // Restringe la fecha mínima de Fechafinalizacion
        fechaFinalizacionInput.setAttribute('min', fechaInicio);

        var fechaFinalizacion = fechaFinalizacionInput.value;
        var fechaFinalizacionObj = new Date(fechaFinalizacion + 'T' + horaFinalizacion);

        if (fechaInicioObj >= fechaFinalizacionObj) {
            document.getElementById('Fechafinalizacion').classList.add('is-invalid');
            document.getElementById('Horafinalizacion').classList.add('is-invalid');
            return false;
        } else {
            document.getElementById('Fechafinalizacion').classList.remove('is-invalid');
            document.getElementById('Horafinalizacion').classList.remove('is-invalid');
            return true;
        }
    }

    // Ejecuta la validación al cargar la página
    validarHoras();

    // Ejecuta la validación al cambiar las fechas y horas
    document.getElementById('Fechainicio').addEventListener('input', validarHoras);
    document.getElementById('Horainicio').addEventListener('input', validarHoras);
    document.getElementById('Fechafinalizacion').addEventListener('input', validarHoras);
    document.getElementById('Horafinalizacion').addEventListener('input', validarHoras);
});
