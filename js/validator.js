function fn(){
  var valid=true;
  var nombre=document.getElementById('valid01').value;
  var ap=document.getElementById('valid02').value;
  var am=document.getElementById('valid03').value;
  var pass=document.getElementById('valid04').value;

  if (nombre=='') {
    valid=false;
    var com=document.getElementById('nombre')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (nombre.length>3 || nombre.length<30) {
    valid=false;
    var com=document.getElementById('nombre')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('nombre').innerHTML='';
  }

  if (ap=='') {
    valid=false;
    var com=document.getElementById('ap')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (ap.length>4 || ap.length<16) {
    valid=false;
    var com=document.getElementById('ap')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('ap').innerHTML='';
  }

  if (am=='') {
    valid=false;
    var com=document.getElementById('am')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (am.length>4 || am.length<16) {
    valid=false;
    var com=document.getElementById('am')
    com.innerHTML=" *Campo obligatorio"
  }
  else{
    document.getElementById('am').innerHTML='';
  }


  if (pass=='') {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" *Campo obligatorio"
  }
  else if (pass.length>8 || pass.length<16) {
    valid=false;
    var com=document.getElementById('pass')
    com.innerHTML=" *Debe de contener de 8-16 caracteres, por lo menos una mayuscula, un numero, sin espacios"
  }
  else{
    document.getElementById('pass').innerHTML='';
  }
  

  return valid;
}

function Vista_form(){
  let pass = document.getElementById('pass');
  let ver = document.getElementById('ver');
  let ocultar = document.getElementById('ocultar');
  if (pass.type === 'password') {
    pass.type = 'text';
    ver.style.display = 'none';
    ocultar.style.display = 'block';
  } else {
    pass.type = 'password';
    ver.style.display = 'block';
    ocultar.style.display = 'none';
  }
}