<?PHP
/*$hostname_localhost ="localhost";
$database_localhost ="reunitebd";
$username_localhost ="root";
$password_localhost ="";*/

require('conexionSql.php');

// Función para debuggear
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

$json=array();
				
	//$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
	
	if ($conexion->connect_error) {
		die("Conexión fallida: " . $conexion->connect_error);
	}
	if($_GET["usuario"]!=null){
		$usuario=$_GET["usuario"];	
		$consulta="select Pub_ID, Pub_Titulo, Pub_Desc, Pub_img, Pub_Contacto from publicacion where Usuario_ID = '{$usuario}'";}
	else{
		$consulta="select Pub_ID, Pub_Titulo, Pub_Desc, Pub_img, Pub_Contacto from publicacion";	
	}
	//$consulta="select Pub_ID, Pub_Titulo, Pub_Desc, Pub_img, Pub_Contacto from publicacion";
	$resultado= $conexion->query($consulta); // mysqli_query($conexion,$consulta);
	
	if ($resultado->num_rows > 0) {
		while($registro = $resultado->fetch_assoc()) {
			
			$result["Pub_ID"]=$registro['Pub_ID'];
			$result["Pub_Titulo"]=$registro['Pub_Titulo'];
			$result["Pub_Desc"]=$registro['Pub_Desc'];
			// $result["Pub_img"]=base64_encode($registro['Pub_img']);
			$result["Pub_img"]=$registro['Pub_img'];
			$result["Pub_Contacto"]=$registro['Pub_Contacto']; 
			
			$json['publicacion'][]=$result;
		}
	} else {
		echo "0 results";
	}
	
	mysqli_close($conexion);
	echo json_encode($json);
?>