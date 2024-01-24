function formatoMoneda(input) {
    // Obtener el valor del campo de entrada
    let valor = input.value;
  
    // Eliminar caracteres no numéricos (excepto el punto para decimales)
    valor = valor.replace(/[^0-9.]/g, '');
  
    // Formatear como moneda utilizando Intl.NumberFormat con configuración para pesos mexicanos
    const formatoMoneda = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' });
    valor = formatoMoneda.format(parseFloat(valor));
  
    // Actualizar el valor del campo de entrada con el formato de moneda
    input.value = valor;
  }
  
  