<?php
require '../../modelo/conexion.php';
$cadena="";

if (isset($_GET['txtSearch'])) {
	$txtSearch = addslashes($_GET['txtSearch']);
	$sql = "delete from enfermeros where cedula='".$txtSearch."'";

	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);

		if ($db->query($sql) === false)
			throw new ExcepcionEnTransaccion();
		$db->commit();
		
		$sql = "SELECT * FROM enfermeros";
		$resultado = $db->query($sql);
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
			
		$cadena.="<table>";
		$cadena.="<tr>";
			$cadena.="<th>ID</th>";
			$cadena.="<th>CEDULA</th>";
			$cadena.="<th>NOMBRE</th>";
			$cadena.="<th>1erAPELLIDO</th>";
			$cadena.="<th>2doAPELLIDO</th>";
			$cadena.="<th>NACIMIENTO</th>";
			$cadena.="<th>ESPECIALIDAD</th>";
			$cadena.="<th>USUARIO</th>";
			$cadena.="<th>PASSWORD</th>";
		$cadena.="</tr>";
		while ($obj = $resultado->fetch_object()){		
			LimpiaResultados($obj);
			$cadena.="<tr>";
				$cadena.="<td>".$obj->id_enfermero.'</td>';
				$cadena.="<td>".$obj->cedula.'</td>';
				$cadena.="<td>".$obj->nombre_enf.'</td>';
				$cadena.="<td>".$obj->apellido_enf1.'</td>';
				$cadena.="<td>".$obj->apellido_enf2.'</td>';
				$cadena.="<td>".$obj->fecha_enfermero.'</td>';
				$cadena.="<td>".$obj->especialidad.'</td>';
				$cadena.="<td>".$obj->usu_enfermero.'</td>';
				$cadena.="<td>".$obj->pass_enfermero.'</td>';
			$cadena.="</tr>";
		} 
		$cadena.="</table>";
		$db->close(); 
	}catch (ExcepcionEnTransaccion $e){
		echo 'No se ha podido realizar la baja';
		$db->rollback();
		$db->close();
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}
}
echo $cadena;
?>