function validarContra(pass){
    const decimal = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
  
    if(pass.value.match(decimal)){
      alert("contraseña segura");
    }
    else{
      alert("verifique su contraseña");
    }
  }