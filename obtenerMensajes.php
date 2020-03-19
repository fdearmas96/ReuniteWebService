<?PHP
	require('conexionSql.php');

	// Función para debuggear
	function console_log( $data ){
	  echo '<script>';
	  echo 'console.log('. json_encode( $data ) .')';
	  echo '</script>';
	}

	$json=array();

	if ($conexion->connect_error) {
		die("Conexión fallida: " . $conexion->connect_error);
	}

	if($_GET["usuario"] != null){
		$usuario = $_GET["usuario"];	
		$consulta = "select Msg_ID, Msg_Mensaje, Usuario_ID1, Usuario_ID2 from mensajes inner join msguser on mensajes.Msg_ID = msguser.Msg_ID where Usuario_ID2 = '{$usuario}'";
	} else {
		$consulta = "select Msg_ID, Msg_Mensaje, Usuario_ID1, Usuario_ID2 from mensajes inner join msguser on mensajes.Msg_ID = msguser.Msg_ID";	
	}

	$resultado = $conexion->query($consulta);
	
	if ($resultado->num_rows > 0) {
		while($registro = $resultado->fetch_assoc()) {
			
			$result["Msg_ID"] = $registro['Msg_ID'];
			$result["Msg_texto"] = $registro['Msg_Mensaje'];
			$result["Msg_usersend"] = $registro['Usuario_ID1'];
			$result["Msg_userreceive"] = $registro['Usuario_ID2'];
			
			$json['mensajes'][] = $result;
		}
	} else {
		echo "0 results";
	}
	
	mysqli_close($conexion);
	echo json_encode($json);
?>