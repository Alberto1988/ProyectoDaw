<?php 
require('../Aspecto/libreria.inc');
cabecera_login();
function LimpiaResultados(&$fila){
	foreach ($fila as $campo => $valor)
		if(is_string($valor) === true)
		$fila[$campo] = stripslashes($fila[$campo]);
}
function CompruebaErrorConexionMySQL($mensaje){
	if (mysqli_connect_errno() != 0){
		echo $mensaje.' :'.mysqli_connect_error();
		exit();
	}
}
function CompruebaErrorMySQL($mensaje, $conexion){
	if (mysqli_errno($conexion) != 0){
		echo $mensaje.' :'.mysqli_error($conexion);
		mysqli_close($conexion);
		exit();
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>LOGIN</title>
</head>
<body>
<?php
if (isset($_POST['aceptar'])===false) {
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<TABLE>
		<TR>
			<TD>Usuario:</TD>
			<TD><INPUT TYPE="text" NAME="login" SIZE="20" MAXLENGTH="30"></TD>
		</TR>
		<TR>
			<TD>Contrase&ntildea:</TD>
			<TD><INPUT TYPE="text" NAME="password" SIZE="20" MAXLENGTH="30"></TD>
		</TR>
		<TR>
			<TD>Tipousuario:</TD>
			<TD><select name="tipousuario">
					<option value="medico" selected="selected">Medico</option>
					<option value="administrador">Administrador</option>
					<option value="paciente">Pacientes</option>
				</select>
			</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="submit" NAME="aceptar" VALUE="Aceptar"></TD>
		</TR>
	</TABLE>
</FORM>
<?php
}else{
$login=$_POST['login'];
$password=$_POST['password'];  
$tipousuario=$_POST['tipousuario'];
echo $login. ' '.$password;

try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('clinica');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	$consulta = "select Usuario,Password from usuarios where Usuario='".$login."' AND Password='".$password."'";
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);

	if ($resultado->num_rows > 0){
	
			header("Location: principal.php");
		}
	else
		echo '<p>El Login no es valido</p>';
	?>
		<p>[<a href="<?php echo $_SERVER['PHP_SELF'] ?>">Nuevo Login</a>]</p>
	<?php
	$resultado->free(); 
	$db->close();
}catch (ExcepcionEnTransaccion $e){
	echo 'No se ha podido realizar el Login';
	$db->rollback();
	$db->close();
}catch (Exception $e){
	echo $e->getMessage();
	if (mysqli_connect_errno() == 0)
		$db->close();
	exit();
}
}
?>
</body>
</html>
