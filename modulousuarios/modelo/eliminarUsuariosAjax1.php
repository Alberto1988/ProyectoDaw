<?php
require '../../modelo/conexion.php';
$cadena="";

if (isset($_GET['txtSearch'])) {
	$txtSearch = addslashes($_GET['txtSearch']);
	$sql = "delete from usuarios where usuario='".$txtSearch."'";

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
		
		$sql = "SELECT * FROM usuarios";
		$resultado = $db->query($sql);
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
			
		$cadena.="<table>";
		$cadena.="<tr>";
			$cadena.="<th>ID</th>";
			$cadena.="<th>USUARIO</th>";
			$cadena.="<th>PASSWORD</th>";
			$cadena.="<th>TIPO</th>";
		$cadena.="</tr>";
		while ($obj = $resultado->fetch_object()){		
			LimpiaResultados($obj);
			$cadena.="<tr>";
				$cadena.="<td>".$obj->id_usuario.'</td>';
				$cadena.="<td>".$obj->usuario.'</td>';
				$cadena.="<td>".$obj->password.'</td>';
				$cadena.="<td>".$obj->tipo_usuario.'</td>';
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