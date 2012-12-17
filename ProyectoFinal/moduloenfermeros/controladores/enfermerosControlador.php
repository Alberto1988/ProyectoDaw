<?php

ComprobarAdministrador();

function listar(){
	//Incluye el modelo que corresponde
	require './moduloenfermeros/modelo/enfermerosModelo.php';

	//Le pide al modelo todos los medicos
	$enfermeros = buscarTodosLosEnfermeros();

	//Pasa a la vista toda la información que se desea representar
	require './moduloenfermeros/vistas/listar.html';
}
function alta(){
	require './moduloenfermeros/vistas/alta.html';
}
if( isset($_POST['cedula1'])){
    require '../../modelo/conexion.php';
	require '../modelo/enfermerosModelo.php';
	altaEnfermeros($_POST['cedula1'],$_POST['nombre'],$_POST['apellido1_enfer'],$_POST['apellido2_enfer'],$_POST['fecha_en'],$_POST['especialidad'],$_POST['usu'],$_POST['pass'] );
	$enfermeros = buscarTodosLosEnfermeros();
	header("Location: ../../index.php?controlador=enfermeros&accion=listar&val=ok");
}
function modificar2($id){
	require './moduloenfermeros/modelo/enfermerosModelo.php';
	$modifico=enfermerosModificar($id);
	require './moduloenfermeros/vistas/Modificar2.html';
	
}

function ComprobarAdministrador(){
		
		if (!isset($_SESSION['userId']))
			header("Location: index.php?val=");
		if ($_SESSION['userType'] != "A")
			header("Location: index.php?val=");
	}

if( isset($_POST['id2'])){
    require '../../modelo/conexion.php';
	require '../modelo/enfermerosModelo.php';
	actualizar($_POST['id2'],$_POST['cedula2'],$_POST['nombre2'],$_POST['apellido1_medico2'],$_POST['apellido2_medico2'],$_POST['fecha_enf2'],$_POST['especialidad2'],$_POST['usu2'],$_POST['pass2']  );
	
	header("Location: ../../index.php?controlador=enfermeros&accion=listar&val=ok");
}

function buscar(){
	require './moduloenfermeros/vistas/Buscar.html';
}
function eliminar(){
	require './moduloenfermeros/vistas/baja.html';
}
function modificar(){
	require './moduloenfermeros/vistas/Modificar.html';
}

?>