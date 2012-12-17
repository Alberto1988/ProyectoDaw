<?php

ComprobarAdministrador();
function listar(){
	//Incluye el modelo que corresponde
	require './modulomedicos/modelo/medicosModelo.php';

	//Le pide al modelo todos los medicos
	$medicos = buscarTodosLosMedicos();

	//Pasa a la vista toda la información que se desea representar
	require './modulomedicos/vistas/listar.html';
}
function alta(){
	require './modulomedicos/vistas/alta.html';
}
if( isset($_POST['cedula'])){
    require '../../modelo/conexion.php';
	require '../modelo/medicosModelo.php';
	altaMedicos($_POST['cedula'],$_POST['nombre'],$_POST['apellido1_medico'],$_POST['apellido2_medico'],$_POST['fecha_me'],$_POST['especialidad'],$_POST['usu'],$_POST['pass'] );
	$medicos = buscarTodosLosMedicos();
	header("Location: ../../index.php?controlador=medicos&accion=listar&val=ok");
}
function modificar2($id){
	require './modulomedicos/modelo/medicosModelo.php';
	$modifico=medicosModificar($id);
	require './modulomedicos/vistas/Modificar2.html';
	
}

if( isset($_POST['id2'])){
    require '../../modelo/conexion.php';
	require '../modelo/medicosModelo.php';
	actualizar($_POST['id2'],$_POST['cedula2'],$_POST['nombre2'],$_POST['apellido1_medico2'],$_POST['apellido2_medico2'],$_POST['fecha_me2'],$_POST['especialidad2'],$_POST['usu2'],$_POST['pass2']  );
	
	header("Location: ../../index.php?controlador=medicos&accion=listar&val=ok");
}
if( isset($_POST['login'])){
    require '../../modelo/conexion.php';
	require '../../Sesiones/valida_us.php';
	require '../../Aspecto/libreria.inc';
	InicializarSesion(0);
	$loginval=login($_POST['login'],$_POST['pass'],$_POST['tipousuario']);
	if($loginval===true){
		assert($tipoUsuario != null);
		$_SESSION['userId'] = $_POST['login'];
		$_SESSION['userType'] = $_POST['tipousuario'];
		header("Location: ../../index.php?val=ok");
	}else{
		header("Location: ../../index.php?val=");
	}
}
function logout(){
	if (isset ($_SESSION['userId'])){
		$_SESSION = array();
		session_destroy();
	}
	header("Location: index.php?val=");
}
function ComprobarAdministrador(){
		
		if (!isset($_SESSION['userId']))
			header("Location: index.php?val=");
		if ($_SESSION['userType'] != "A")
			header("Location: index.php?val=");
	}
function buscar(){
	require './datatable/datatable.html';
}
function eliminar(){
	require './modulomedicos/vistas/baja.html';
}
function modificar(){
	require './modulomedicos/vistas/Modificar.html';
}

?>