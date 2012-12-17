<?php
ComprobarAdministrador();

function listar(){
	//Incluye el modelo que corresponde
	require './modulopacientes/modelo/pacientesModelo.php';

	//Le pide al modelo todos los medicos
	$pacientes = buscarTodosLosPacientes();

	//Pasa a la vista toda la información que se desea representar
	require './modulopacientes/vistas/listar.html';
}
function alta(){
	require './modulopacientes/vistas/alta.html';
}
if( isset($_POST['clave'])){
    require '../../modelo/conexion.php';
	require '../modelo/pacientesModelo.php';
	altaPaciente($_POST['clave'],$_POST['nombre'],$_POST['apellido_paterno'],$_POST['apellido_materno'],$_POST['tiposexo'],$_POST['domicilio'],$_POST['fecha_pa'],$_POST['fecha_co'],$_POST['texto'],$_POST['uspaciente'],$_POST['ctpaciente'] );
	$pacientes = buscarTodosLosPacientes();
	header("Location: ../../index.php?controlador=pacientes&accion=listar&val=ok");
}
function modificar2($id){
	require './modulopacientes/modelo/pacientesModelo.php';
	$modifico=pacientesModificar($id);
	require './modulopacientes/vistas/Modificar2.html';
	
}
if( isset($_POST['id2'])){
    require '../../modelo/conexion.php';
	require '../modelo/pacientesModelo.php';
	actualizar($_POST['id2'],$_POST['clave2'],$_POST['nombre2'],$_POST['apellido_paterno'],$_POST['apellido_materno'],$_POST['tiposexo'],$_POST['domicilio'],$_POST['fecha_pa'],$_POST['fecha_co'],$_POST['texto'],$_POST['uspaciente'],$_POST['ctpaciente'] );

	header("Location: ../../index.php?controlador=pacientes&accion=listar&val=ok");
}

if( isset($_GET['nombre'])){
	$nombre=$_GET['nombre'];
	header("Location: ../../index.php?controlador=pacientes&accion=modificar2");
}
if( isset($_POST['id'])){
    require '../../modelo/conexion.php';
	require '../modelo/pacientesModelo.php';
	actualizar($_POST['cedula'],$_POST['nombre'],$_POST['usuario'],$_POST['pass'] );
	header("Location: ../../index.php?controlador=pacientes&accion=modificar&val=ok");
}
function ComprobarAdministrador(){
		
		if (!isset($_SESSION['userId']))
			header("Location: index.php?val=");
		if ($_SESSION['userType'] != "A")
			header("Location: index.php?val=");
	}
function buscar(){
	require './modulopacientes/vistas/Buscar.html';
}
function eliminar(){
	require './modulopacientes/vistas/baja.html';
}
function modificar(){
	require './modulopacientes/vistas/Modificar.html';
}

?>