function fn(){
  var valid=true;
  
  var nombre=document.getElementById('valid01').value;
  var ap=document.getElementById('valid02').value;
  var am=document.getElementById('valid03').value;
  var email=document.getElementById('valid04').value;
  var pass=document.getElementById('valid05').value;

  if (nombre=='') {
    valid=false;
    var com=document.getElementById('nombre')
    com.innerHTML=" Rellene este campo"
  }
  else{
    document.getElementById('nombre').innerHTML='';
  }

  if (ap=='') {
    valid=false;
    var com=document.getElementById('ap')
    com.innerHTML=" Rellene este campo"
  }
  else{
    document.getElementById('ap').innerHTML='';
  }

  if (am=='') {
    valid=false;
    var com=document.getElementById('am')
    com.innerHTML=" Rellene este campo"
  }
  else{
    document.getElementById('am').innerHTML='';
  }

  if (pass=='') {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" Rellene este campo"
  }
  else if (pass.length<6 ) {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" Debe de contener 6 caracteres"
  }
  else{
    document.getElementById('pass').innerHTML='';
  }

  return valid;
}