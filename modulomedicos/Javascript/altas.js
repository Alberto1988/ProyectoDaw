function valida(){
 	// Expresiones regulares que usaremos para comprobar patrones aceptados.

 	erNombre=/^[a-zA-Z�������������� ]{5,50}$/;

 	

 	if(erNombre.test(document.formulario.nombre.value)==false){
 	 	alert("Nombre incorrecto");
 	 	document.formulario.nombre.focus();
 	 	return false;
 	}


 	return true; // Devolvemos true para que se env�en los datos a la p�gina php.
 }
 
 function soloLetras(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " �����abcdefghijklmn�opqrstuvwxyz";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            } 
 }
 
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
     return false;
     }
	 
function validar(){
	valida();
	soloLetras(e);
}
