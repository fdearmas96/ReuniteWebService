<?PHP
$hostname_localhost="localhost";
$database_localhost="reunitebd";
$username_localhost="root";
$password_localhost="";

$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

	$user   = $_POST["user"];
	$titulo = $_POST["titulo"];
	$descripcion = $_POST["descripcion"];
	$contacto = $_POST["contacto"];
	$imagen = $_POST["imagen"];
	$nombreImg="";
	$consulta="SELECT Pub_ID FROM publicacion order by Pub_Id desc";
	$resultado=mysqli_query($conexion,$consulta);
	$maximoencontrado = 0;
	if($registro=mysqli_fetch_array($resultado)){
		$maximoencontrado = $registro['Pub_ID'];

		//$resultar["success"]=1;
		//$resultar["message"]=$maximoencontrado;
		//$json['registro'][]=$resultar;
		
		//$resultar["success"]=1;
		//$resultar["message"]=$nombreImg;
		//$json['registro'][]=$resultar;
		//echo json_encode($json);			
		//	mysqli_close($conexion);
		
	}
	$maximoencontrado = $maximoencontrado + 1;
	$nombreImg = $maximoencontrado;
	if ($nombreImg==""){
		$nombreImg = "1";
		//$resultar["message"]=$nombreImg;
		//$json['registro'][]=$resultar;
		//echo json_encode($json);	
	}
	$path = "Imagenes/".$nombreImg.".jpg";

	$url = "http://$hostname_localhost".":8080"."/Reunite/$path";
	

	file_put_contents($path,base64_decode($imagen));
	$bytesArchivo=file_get_contents($path);

	$sql="INSERT INTO publicacion VALUES (?,?,?,?,?,?)";
	$stm=$conexion->prepare($sql);
	$stm->bind_param('isssss',$maximoencontrado,$titulo,$descripcion,$url/*$bytesArchivo*/,$contacto,$user);//$url);
	//echo "registra";	
	if($stm->execute()){
		echo "registra";
	}else{
		echo "noRegistra";
	}
	
	mysqli_close($conexion);
?>