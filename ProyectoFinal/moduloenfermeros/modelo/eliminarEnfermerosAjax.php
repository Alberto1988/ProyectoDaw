<?php
require '../../modelo/conexion.php';
if (isset($_GET['txtSearch']) && $_GET['txtSearch'] != '') {
	$txtSearch = addslashes($_GET['txtSearch']);
	$cedula="%".$txtSearch."%";
	$sql="SELECT cedula FROM enfermeros as suggest1 where (cedula like '$cedula')";
}
else if($_GET["txtSearch"]=="")//el us no introduce nada en el input text
	$sql = "select cedula from enfermeros as suggest1 where cedula not LIKE '%'";

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
			$suggest['suggest1']=$obj->cedula;
				
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