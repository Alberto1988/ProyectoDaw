<?php
require '../../modelo/conexion.php';
if($_GET["mas"]!=""){
	if($_GET["mas"]!="all")
		$mas="limit 0,".$_GET["mas"];
	else
		$mas="limit 0,100";
}else
	$mas="limit 0,10";

if($_GET["radio1"]=="true")
	$orden="desc";
else if($_GET["radio2"]=="true")
	$orden="asc";
else
	$orden="asc";
	
if($_GET["criterio_ord"]!="")
	$criterio_ord=$_GET['criterio_ord']; 
else
	$criterio_ord="tipo_usuario"; 
	
$sql="SELECT * FROM usuarios order by $criterio_ord ".$orden." ".$mas;
if($_GET["usuario1"]!=""){
	$usuario1="%".$_GET["usuario1"]."%";
	$sql="SELECT * FROM usuarios where tipo_usuario like '$usuario1' or usuario like '$usuario1' order by $criterio_ord ".$orden." ".$mas;
}
else if($_GET["usuario1"]=="")//el us no introduce nada en el input text
	$sql = "select * from usuarios where tipo_usuario not LIKE '%'";
	
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
		$cadena.= '<TABLE id="muestra">';
			$cadena.='<tr>';
				$cadena.='<th>ID</th>';
				$cadena.='<th>USUARIO</th>';
				$cadena.='<th>PASSWORD</th>';
				$cadena.='<th>TIPO USUARIO</th>';
			$cadena.='</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				$cadena.='<tr>';
					$cadena.='<td align="center">'.$obj->id_usuario.'</td>';
					$cadena.='<td align="center">'.$obj->usuario.'</td>';
					$cadena.='<td align="center">'.$obj->password.'</td>';
					$cadena.='<td align="center">'.$obj->tipo_usuario.'</td>';
					
				$cadena.='</tr>';
				
			}
		$cadena.='</TABLE>';
		
	}
	$resultado->free(); 
	$db->close(); 
}catch (Exception $e){
	echo $e->getMessage();
	if (mysqli_connect_errno() == 0)
		$db->close();
	exit();
}
echo utf8_encode($cadena);
?>
