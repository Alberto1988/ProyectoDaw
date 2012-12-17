function inicializar() {  
      
        if (GBrowserIsCompatible()) {  
            var map = new GMap2(document.getElementById("map"));  
            map.setCenter(new GLatLng(38.821926,-0.600665), 18); 
			    map.addControl(new GMapTypeControl());  
				map.addControl(new GLargeMapControl());  
				map.addControl(new GScaleControl());  
				map.addControl(new GOverviewMapControl());  
				
				function informacion(ubicacion, descripcion) {  
  
			var marca = new GMarker(ubicacion);  
			GEvent.addListener(marca, "click", function() {  
			marca.openInfoWindowHtml(descripcion); } );  
  
			return marca;  
  
				}  
			var ubicacion = new GLatLng(38.821926,-0.600665);  
			var descripcion = '<b>Clinica Ontinyent</b><br/>Aqui esta mi hospital<br />';  
			var marca = informacion(ubicacion, descripcion);  
  
			map.addOverlay(marca);  
        }  
    }

function flow(){
$(document).ready(function(){
	    $("#myController").jFlow({
			controller: ".jFlowControl", 
			slideWrapper : "#jFlowSlider", 
			slides: "#mySlides",  
			selectedWrapper: "jFlowSelected",  
			width: "800px",  
			height: "350px",  
			duration: 400,  
			prev: ".jFlowPrev", 
			next: ".jFlowNext", 
			auto: true	
    });
});
}	
 