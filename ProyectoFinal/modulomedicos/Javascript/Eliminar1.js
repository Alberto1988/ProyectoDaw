/**
 * @file El js de Eliminar, Ajax
 * @namespace Eliminar
 * @author Alberto
 */

/**
*@param {object} xmlHttp
*@return {object} Devuelve un objeto de clase XMLHttpRequest.
*/
function getXmlHttpRequestObject() {
	var xmlHttp=null;
	if (window.XMLHttpRequest) 
		xmlHttp= new XMLHttpRequest();
	else if(window.ActiveXObject) 
		xmlHttp new ActiveXObject("Microsoft.XMLHTTP");
		return xmlHttp;
	else 
		alert("Your Browser Sucks!\nIt's about time to upgrade don't you think?");
}
/** @param {object} searchReq Creo searchReq y contiene un objeto de clase XMLHttpRequest. */ var searchReq = getXmlHttpRequestObject();
/**
* @param {string} txtSearch El contenido en el html de txtSeach, lo hacemos un string portable con escape y lo guardamos en txtSearch.
* @property value
* @property onreadystatechange Almacena el nombre de la función que se ejecutará cuando el objeto XMLHttpRequest cambie de estado.
 */
function searchSuggest() {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var txtSearch = escape(document.getElementById('txtSearch').value);
		searchReq.open("GET", './modulomedicos/modelo/eliminarMedicosAjax.php?txtSearch=' + txtSearch, true);
		searchReq.onreadystatechange = handleSearchSuggest; 
		searchReq.send(null);
	}		
}

/** 
* @param {object} resultados. 
* @property readyState Almacena el estado del requerimiento hecho al servidor.
* @param {object} ss. 
* @property innerHTML
* @param {object} str. 
* @property responseText Almacena el string devuelto por el servidor, luego de haber hecho una petición.
* @param {object} suggest.
* @property innerHTML
*/

function handleSearchSuggest() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_suggest')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}
/**
* @param {object} div_value.
* @property className
*/
function suggestOver(div_value) {
	div_value.className = 'suggest_link_over';
}
/**
* @param {object} div_value.
* @property className
*/
function suggestOut(div_value) {
	div_value.className = 'suggest_link';
}
/**
* @param {object} value.
* @property value
* @property innerHTML
*/
function setSearch(value) {
	document.getElementById('txtSearch').value = value;
	document.getElementById('search_suggest').innerHTML = '';
	document.getElementById('search_suggest1').value = value;
	document.getElementById('search_suggest3').innerHTML = '<div> '+'<input type="button" id="item_elimina" name="item_elimina" value="Elimina" onclick="elimina();"/>'+ '</div>';
}
