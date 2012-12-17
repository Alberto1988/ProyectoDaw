<?php
require './modelo/conexion.php';
if(!empty($_GET['val'])){
require_once './Vistas/Principal.html';
}else{
require_once './Vistas/Login.html';
}


?>
<div align='center'>
<?php
	$accionPredefinida = "listar";
	if(!empty($_GET['controlador'])){
			$controlador = $_GET['controlador'];
			if(! empty($_GET['accion']))
				  $accion = $_GET['accion'];
			else
				  $accion = $accionPredefinida;
			if(! empty($_GET['mod']))
				  $mod = $_GET['mod'];

			//Ya tenemos el controlador y la accion
			//La carpeta donde buscaremos los controladores
			$carpetaControladores = "./modulo".$controlador."/controladores/";
			//Formamos el nombre del fichero que contiene nuestro controlador
			$controlador = $carpetaControladores . $controlador . 'Controlador.php';

			//Incluimos el controlador o detenemos todo si no existe
			if(is_file($controlador))
				  require_once $controlador;
			else
				  die('El controlador no existe - 404 not found');

			//Llamamos la accion o detenemos todo si no existe
			if(is_callable($accion)&&(!(isset($mod))))
				  $accion();
			else if(is_callable($accion)&&(isset($mod)))
				$accion($mod);
			else
				  die('La accion no existe - 404 not found');
	}
	/*if(!empty($_GET['val'])){
		 header("Location: ./Vistas/Principal.html");
	}*/
	?>
</div>