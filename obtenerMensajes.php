<?php

	$hostname_localhost ="localhost";
	$database_localhost ="reunitebd";
	$username_localhost ="root";
	$password_localhost ="";
     //require "conexion.php";
    
     $accion   = $_POST['accion'];
     $mensaje  = $_POST['mensaje'];
	 $usuario1 = $_POST['usuario1'];
	 $usuario2 = $_POST['usuario2'];
    //$accion = "nuevo";
    //$mensaje = "Bien y tu";
	$mysqli = new mysqli($hostname_localhost, $username_localhost, $password_localhost, $database_localhost);
    //$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
    if($accion == "nuevo") {
		
		//Miro si existe el chat y obtengo el ID
		$sql_select = "Select Chat_Id from chat where Usuario_ID = '{$usuario1}' and Usuario_ID2 = '{$usuario2}'"
		

		if(($result = mysqli_fetch_array($mysqli->query($sql))){
			$Chat_Id = $result->'Chat_Id';		
			
		}else{
			$sql_select = "Select max(Chat_Id) from chat"
			$resultado=mysqli_query($conexion,$sql_select);
			}	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        $sql_insert = "INSERT INTO mensajes VALUES('', '$mensaje')";
        $query = $mysqli->query($sql_insert);

        $sql_consult = "SELECT * FROM mensajes";
        $query = $mysqli->query($sql_consult);
        
        $data = array();
        
        $num = $query->num_rows;
        
        if($num > 0) {
            while($resultado = $query->fetch_assoc()) {
                $data[] = $resultado;
            }
            echo json_encode(array("mensajes" => $data));
        }
        
        $mysqli->close();

        
    } else {
        $sql_consult = "SELECT * FROM mensajes";
        $query = $mysqli->query($sql_consult);
        
        $data = array();
        
        $num = $query->num_rows;
        
        if($num > 0) {
            while($resultado = $query->fetch_assoc()) {
                $data[] = $resultado;
            }
            echo json_encode(array("mensajes" => $data));
        }
        
        $mysqli->close();
    }
    
	mysqli_close($conexion);
     ?>