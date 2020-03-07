<?PHP
/*
$hostname_localhost ="localhost";
$database_localhost ="reunitebd";
$username_localhost ="root";
$password_localhost ="";
*/
require('conexionSql.php');
$json=array();

	if(isset($_GET["usuario"]) && isset($_GET["pass"])){
		$usuario= $_GET['usuario'];
		$pass=    $_GET['pass'];	
		//$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		
		//Veo si ya no existe el usuario:
		$consulta="SELECT Usuario_ID, Usuario_Pass FROM usuario WHERE Usuario_ID = '{$usuario}'";
		//$resultado=mysqli_query($conexion,$consulta);
		$resultado=$conexion->query($consulta);
		

		
		if($registro=$resultado->fetch_array()){
			$contraseñaTabla = $registro['Usuario_Pass'];
			$usuarioTabla    = $registro['Usuario_ID'];
			if($contraseñaTabla==$pass){  //contraseña correcta
					
				$resultar["success"]=0;
				$resultar["message"]='Usuario  correcto';
				$json['loguin'][]=$resultar;
				echo json_encode($json);
				mysqli_close($conexion);			
			

			}else{	////contraseña icorrecta
				$resultar["success"]=1;
				$resultar["message"]='Contraseña incorrecta';
				$json['loguin'][]=$resultar;
				/*
				$resulta["usuario"]='ok';
				$resulta["pass"]="incorrecta";
				$json['usuario'][]=$resulta;*/
				
				echo json_encode($json);
				mysqli_close($conexion);
			

			}
		}else{
			$resultar["success"]=2;
			$resultar["message"]='Usuario no registrado';
			$json['loguin'][]=$resultar;
			echo json_encode($json);
			mysqli_close($conexion);
			}
	}
	else{
			$resulta["usuario"]=0;
			$resulta["pass"]='WS error en parámetros';
			$json['loguin'][]=$resulta;
			echo json_encode($json);
		}

?>