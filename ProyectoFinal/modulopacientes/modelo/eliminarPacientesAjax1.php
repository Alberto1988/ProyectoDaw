<?php
require '../../modelo/conexion.php';
$cadena="";

if (isset($_GET['txtSearch'])) {
	$txtSearch = addslashes($_GET['txtSearch']);
	$sql = "delete from pacientes where clave='".$txtSearch."'";

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
		
		$sql = "SELECT * FROM pacientes";
		$resultado = $db->query($sql);
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
			
		$cadena.="<table>";
		$cadena.="<tr>";
			$cadena.="<th>ID</th>";
			$cadena.="<th>CLAVE</th>";
			$cadena.="<th>NOMBRE</th>";
			$cadena.="<th>APELLIDO PATERNO</th>";
			$cadena.="<th>APELLIDO MATERNO</th>";
			$cadena.="<th>SEXO</th>";
			$cadena.="<th>DOMICILIO</th>";
			$cadena.="<th>NACIMIENTO</th>";
			$cadena.="<th>CONSULTA</th>";
			$cadena.="<th>DIAGNOSTICO</th>";
			$cadena.="<th>USUARIO</th>";
			$cadena.="<th>PASSWORD</th>";
		$cadena.="</tr>";
		while ($obj = $resultado->fetch_object()){		
			LimpiaResultados($obj);
			$cadena.="<tr>";
				$cadena.="<td>".$obj->id_paciente.'</td>';
				$cadena.="<td>".$obj->clave.'</td>';
				$cadena.="<td>".$obj->nombre.'</td>';
				$cadena.="<td>".$obj->apellido_paterno.'</td>';
				$cadena.="<td>".$obj->apellido_materno.'</td>';
				$cadena.="<td>".$obj->sexo.'</td>';
				$cadena.="<td>".$obj->domicilio.'</td>';
				$cadena.="<td>".$obj->fecha_pa.'</td>';
				$cadena.="<td>".$obj->fecha_consulta.'</td>';
				$cadena.="<td>".$obj->diagnostico.'</td>';
				$cadena.="<td>".$obj->usu_paciente.'</td>';
				$cadena.="<td>".$obj->pass_paciente.'</td>';
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