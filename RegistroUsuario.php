<?PHP
$hostname_localhost ="localhost";
$database_localhost ="reunitebd";
$username_localhost ="root";
$password_localhost ="";

$json=array();
//http://localhost:8080/Reunite/RegistroUsuario.php?usuario=fer1&pass=root1&usuario_nombre=Fernando&usuario_apellido=De%20Armas&usuario_correo=ejemplo@gmail.com
	if(isset($_GET["usuario"]) && isset($_GET["pass"]) && isset($_GET["usuario_nombre"]) && isset($_GET["usuario_apellido"]) && isset($_GET["usuario_correo"])){
		$usuario		  = $_GET['usuario'];
		$pass             = $_GET['pass'];		
		$usuario_nombre   = $_GET['usuario_nombre'];
		$usuario_apellido = $_GET['usuario_apellido'];
		$usuario_correo   = $_GET['usuario_correo'];
		
		
		$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		
		//Veo si ya no existe el usuario:
		$consulta="SELECT * FROM usuario WHERE Usuario_ID = '{$usuario}'";
		$resultado=mysqli_query($conexion,$consulta);
		
		if($registro=mysqli_fetch_array($resultado)){
			$resultar["success"]=1;
			$resultar["message"]='Usuario  ya existe, intente otro';
			$json['registro'][]=$resultar;
			echo json_encode($json);
			mysqli_close($conexion);
		}else{			

					
			$insert="INSERT INTO usuario(Usuario_ID, Usuario_Pass,usuario_nombre, usuario_apellido, usuario_correo) 
			VALUES ('{$usuario}','{$pass}','{$usuario_nombre}','{$usuario_apellido}','{$usuario_correo}')";
			$resultado_insert=mysqli_query($conexion,$insert);
			
			if($resultado_insert){
				$consulta="SELECT * FROM usuario WHERE Usuario_ID = '{$usuario}'";
				$resultado=mysqli_query($conexion,$consulta);
				
				if($registro=mysqli_fetch_array($resultado)){
					$resultar["success"]=0;
					$resultar["message"]='Usuario creado correctamente';
					$json['registro'][]=$resultar;
				}
				mysqli_close($conexion);
				echo json_encode($json);
			}
			else{
				$resultar["success"]=1;
				$resultar["message"]='no se pudo crear el usuario intente nuevamente';
				$json['registro'][]=$resultar;
				mysqli_close($conexion);
				echo json_encode($json);
			}
				}	
				
		
	}
	else{
			$resulta["usuario"]=0;
			$resulta["pass"]='WS error en parámetros';
			$json['usuario'][]=$resulta;
			echo json_encode($json);
		}

?>