<?php

ComprobarAdministrador();

function listar(){
	//Incluye el modelo que corresponde
	require './modulousuarios/modelo/usuariosModelo.php';

	//Le pide al modelo todos los medicos
	$usuarios = buscarTodosLosUsuarios();

	//Pasa a la vista toda la información que se desea representar
	require './modulousuarios/vistas/listar.html';
}
function alta(){
	require './modulousuarios/vistas/alta.html';
}
if( isset($_POST['user'])){
    require '../../modelo/conexion.php';
	require '../modelo/usuariosModelo.php';
	altaUsuarios($_POST['user'],$_POST['password'],$_POST['tipouser']);
	$usuarios = buscarTodosLosUsuarios();
	header("Location: ../../index.php?controlador=usuarios&accion=listar&val=ok");
}
function modificar2($id){
	require './modulousuarios/modelo/usuariosModelo.php';
	$modifico=usuariosModificar($id);
	require './modulousuarios/vistas/Modificar2.html';
	
}

function ComprobarAdministrador(){
		
		if (!isset($_SESSION['userId']))
			header("Location: index.php?val=");
		if ($_SESSION['userType'] != "A")
			header("Location: index.php?val=");
	}

if( isset($_GET['usuario'])){

	header("Location: ../../index.php?controlador=usuarios&accion=modificar2&val=ok");
}
if( isset($_POST['id2'])){
    require '../../modelo/conexion.php';
	require '../modelo/usuariosModelo.php';
	actualizar($_POST['id2'],$_POST['usuario2'],$_POST['pass2'],$_POST['tipo2']);
	header("Location: ../../index.php?controlador=usuarios&accion=listar&val=ok");
}

function buscar(){
	require './modulousuarios/vistas/Buscar.html';
}
function eliminar(){
	require './modulousuarios/vistas/baja.html';
}
function modificar(){
	require './modulousuarios/vistas/Modificar.html';
}

?>