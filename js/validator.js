function fn(){
  var valid=true;
  var pass=document.getElementById('valid01').value;

  if (pass=='') {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" Rellene este campo"
    return true; 
  }
  else if (pass.length>8 || pass.length<16) {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" Debe de contener de 8-16 caracteres, por lo menos una mayuscula, una minuscula, un numero "
  }
  else{
    document.getElementById('pass').innerHTML='';
  }
  

  return valid;
}