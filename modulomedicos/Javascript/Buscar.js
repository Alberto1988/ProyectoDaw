/**
 * @file El js de Buscar, Ajax
 * @namespace Buscar
 * @author Alberto
 */


/** 
* @function addEvent Agrega un controlador de eventos para este objeto. 

*/ 
addEvent(window,'load',inicializarEventos,false);

/**
* @param ob Almaceno cedula mediante DOM
* @param ob1 Almaceno radi1 mediante DOM
* @param ob2 Almaceno radio2 mediante DOM
* @param ob3 Almaceno criterio_ord mediante DOM
* @param ob4 Almaceno mas mediante DOM
*/
function inicializarEventos(){
  var ob=document.getElementById('cedula3');
  addEvent(ob,'keyup',presionTecla,false);
  var ob1=document.getElementById('radio1');
  addEvent(ob1,'click',presionTecla,false);
  var ob2=document.getElementById('radio2');
  addEvent(ob2,'click',presionTecla,false);
  var ob3=document.getElementById('criterio_ord');
  addEvent(ob3,'change',presionTecla,false);
  var ob4=document.getElementById('mas');
  addEvent(ob4,'change',presionTecla,false);
}
/** @param {object} conexion1. */ var conexion1;
/**
* @property onreadystatechange Almacena el nombre de la función que se ejecutará cuando el objeto XMLHttpRequest cambie de estado.
*/
function presionTecla(e){
  conexion1=crearXMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('GET','./modulomedicos/modelo/buscarMedicosAjax.php?cedula3='+document.getElementById('cedula3').value+"&radio1="+document.getElementById('radio1').checked+
	"&radio2="+document.getElementById('radio2').checked+"&criterio_ord="+document.getElementById('criterio_ord').value+"&mas="+document.getElementById('mas').value, true);
  conexion1.send(null);
}
/** 
*@param {object} resultados. 
*@property readyState Almacena el estado del requerimiento hecho al servidor.
*@property innerHTML
*@property responseText Almacena el string devuelto por el servidor, luego de haber hecho una petición.
*@property statusText
*/
function procesarEventos(){
   var resultados = document.getElementById("resultados");
   if(conexion1.readyState == 4){
    if (conexion1.status==200)
	   resultados.innerHTML = conexion1.responseText;
    else
      alert(conexion1.statusText);
  } 
  else 
    resultados.innerHTML = '';
}
//***************************************
//Añadir Evento y creación para Ajax
//***************************************

/**
*@param {object} elemento El objeto que creo recojiendolo del DOM.
*@property attachEvent.
*@property addEventListener.
*@param {string} nomevento El string que recojo para usarlo dentro de la funcion con el on.
*@param {function} funcion Le paso la funcion presiontecla.
*@param {Boolean} captura Le paso el boleano para que si todo es correcto me devuelva true.
*@return {Boolean} Devuelve true o false.
*/
function addEvent(elemento,nomevento,funcion,captura){
  if (elemento.attachEvent){
    elemento.attachEvent('on'+nomevento,funcion);
    return true;
  }
  else  
    if (elemento.addEventListener){
      elemento.addEventListener(nomevento,funcion,captura);
      return true;
    }
    else
      return false;
}
/**
*@param {object} xmlHttp.
*@return {object} Devuelve un objeto de clase XMLHttpRequest.
*/
function crearXMLHttpRequest() {
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
    xmlHttp = new XMLHttpRequest();
  return xmlHttp;
  else 
		alert("Your Browser Sucks!\nIt's about time to upgrade don't you think?");
}