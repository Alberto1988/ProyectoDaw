<?php
require '../../modelo/conexion.php';


if (isset($_GET['txtSearch']) && $_GET['txtSearch'] != '') {
	$txtSearch = addslashes($_GET['txtSearch']);
	$clave="%".$txtSearch."%";
	$sql="SELECT clave FROM pacientes as suggest1 where (clave like '$clave')";
}
else if($_GET["txtSearch"]=="")//el us no introduce nada en el input text
	$sql = "select clave from pacientes as suggest1 where clave not LIKE '%'";

$cadena="";
try{
	@ $db = new mysqli($servidor, $usuario, $contrasenia);
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db($bd);
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$resultado = $db->query($sql);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
		
	if ($resultado->num_rows > 0){
		while ($obj = $resultado->fetch_object()){
			LimpiaResultados($obj);
			$suggest['suggest1']=$obj->clave;
				
			echo $suggest['suggest1'] . "\n";
		}
	}
	$resultado->free(); 
	$db->close(); 
}catch (Exception $e){
	echo $e->getMessage();
	if (mysqli_connect_errno() == 0)
		$db->close();
	exit();
}
?>