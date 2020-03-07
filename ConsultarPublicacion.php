<?php

require('conexionSql.php');

$json=array();

	if(isset($_GET["Pub_ID"])){
		$Pub_ID=$_GET["Pub_ID"];	
				


		//$consulta="select Pub_ID, Pub_Titulo, Pub_Desc, Pub_fecha, Pub_img, Pub_Contacto from publicacion where Pub_ID= '{$Pub_ID}'";
		$consulta="select * from publicacion where Pub_ID= '{$Pub_ID}'";
		$resultado=$conexion->query($consulta);
			
		if($registro=$resultado->fetch_array()){
			$result["Pub_ID"]=$registro['Pub_ID'];
			$result["Pub_Titulo"]=$registro['Pub_Titulo'];
			$result["Pub_Desc"]=$registro['Pub_Desc'];
			$result["Pub_img"]=$registro['Pub_img'];//base64_encode($registro['Pub_img']);
			$result["Pub_Contacto"]=$registro['Pub_Contacto']; 
			$json['publicacion'][]=$result;
		}else{			
			$resultar["success"]=$Pub_ID;
			$resultar["message"]='No existe 2';
			$json['publicacion'][]=$resultar;
		}
		
		mysqli_close($conexion);
		echo json_encode($json);
	 }
	else{
		$resultar["success"]=0;
		$resultar["message"]='No existe';
		$json['publicacion'][]=$resultar;
		echo json_encode($json);
	}
?>