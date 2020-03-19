<?PHP
    require('conexionSql.php');

	$usersend   = $_POST["usersend"];
	$userreceive = $_POST["userreceive"];
	$messagebody = $_POST["messagebody"];
	
	//Saco el último ID
	$consulta = "SELECT Msg_ID FROM mensajes order by Msg_ID desc";
	$resultado = $conexion->query($consulta);
	$maximoencontrado = 0;
	if($registro = $resultado->fetch_array()){
		$maximoencontrado = $registro['Msg_ID'];		
	}
	$maximoencontrado = $maximoencontrado + 1;

	$nombreImg = $maximoencontrado;	
    $sqlinsert = "INSERT INTO mensajes(Msg_ID, Msg_Mensaje) 
    VALUES ('{$maximoencontrado}', '{$messagebody}')";
    $resultado_insert = $conexion->query($sqlinsert);

    $sqlinsert = "INSERT INTO msguser(Msg_ID, Usuario_ID1, Usuario_ID2) 
    VALUES ('{$maximoencontrado}', '{$usersend}', '{$userreceive}')";
    $resultado_insert = $conexion->query($sqlinsert);
    
    $sqlselect = "Select * from mensajes where Msg_ID = '{$maximoencontrado}'";
    $resultado = $conexion->query($sqlselect);
    
	if($registro = $resultado->fetch_array()) {
	    echo "registra";
		mysqli_close($conexion);
	} else {
	    mysqli_close($conexion);
        echo "noRegistra";
	}
?>