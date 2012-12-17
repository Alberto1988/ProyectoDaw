  var map;

function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map_canvas"));
        map.setCenter(new GLatLng(38.82395,-0.601973), 20);
        map.setUIToDefault();
      }
    }
/*	
function ocultar(){
$(document).ready(function(){
  $("#mostrar").click(function(){
    $("#map_canvas").toggle();
  });
});
}*/
 