/**
 * @file El js de Eliminar, Ajax
 * @namespace Eliminar
 * @author Alberto
 */
 
 
/**
*@param {object} xmlHttp.
*@return {object} Devuelve un objeto de clase XMLHttpRequest.
*/
function getXmlHttpRequestObject() {
	var xmlHttp=null;
	if (window.XMLHttpRequest) 
	xmlHttp = new XMLHttpRequest();
	else if(window.ActiveXObject) 
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		return xmlHttp;
	else 
		alert("Your Browser Sucks!\nIt's about time to upgrade don't you think?");
}
/** @param {object} searchReq Creo searchReq y contiene un objeto de clase XMLHttpRequest. */ var searchReq = getXmlHttpRequestObject();
function elimina() {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var txtSearch = escape(document.getElementById('search_suggest1').value);
		searchReq.open("GET", './modulomedicos/modelo/eliminarMedicosAjax1.php?txtSearch=' + txtSearch, true);
		searchReq.onreadystatechange = handleSearchSuggest1; 
		searchReq.send(null);
	}	
}

/** 
* @property readyState Almacena el estado del requerimiento hecho al servidor.
* @property innerHTML
* @property innerHTML
* @property innerHTML
* @property innerHTML
* @param {object} ss. 
* @property innerHTML
* @param {object} str. 
* @property responseText Almacena el string devuelto por el servidor, luego de haber hecho una petición.
* @property innerHTML
*/
function handleSearchSuggest1() {
	if (searchReq.readyState == 4) {
		document.getElementById('search_suggest1').innerHTML = '';
		document.getElementById('search_suggest3').innerHTML = '';
		document.getElementById('search_suggest2').innerHTML = '';
		document.getElementById('search_suggest4').innerHTML = '';
		var ss = document.getElementById('search_suggest5')
		ss.innerHTML = '';
		var str = searchReq.responseText;
		ss.innerHTML = str;
	}
}