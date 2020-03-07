<?PHP
//http://localhost:8080/Reunite/comentarios.php?accion=INS&usuario=Fernando&publicacion=1&comentario=magui2
//http://localhost:8080/Reunite/comentarios.php?accion=DSP&publicacion=1
require('conexionSql.php');


    $json=array();
    //Primero se mira la acción, "DSP"-"INS"
    //si me llegó una acción
    if(isset($_GET["accion"])&&isset($_GET["publicacion"])){
        $accion         = $_GET["accion"];

        $publicacion    = $_GET["publicacion"];
        
        if($accion == "INS"&&isset($_GET["comentario"])&&isset($_GET["usuario"])){
            $comentario     = $_GET["comentario"];
            $usuario        = $_GET["usuario"];
            //Consigo el último Id del mensaje
            $resultado_id = 0;
            $select_id = "Select * from comentario where Pub_ID  =  {$publicacion} order by comentario_id desc";//si uso el max me tira un error
            $resultado_id1 = $conexion->query($select_id);

            if($registro=$resultado_id1->fetch_array()){
                $resultado_id = $registro['comentario_Id'];
            }
            $resultado_id +=1;

            $insert_comentario = "insert into comentario (comentario_Id, Pub_ID, comentario_body, Usuario_ID)
                                                values({$resultado_id},{$publicacion},'{$comentario}','{$usuario}')";
            $insert_resultado =$conexion->query($insert_comentario);
            $resulta["success"]=$resultado_id ;//No vino el comentario
            //$resulta["descripcion"]=$insert_comentario;
            $json['comentario'][]=$resulta;
            echo json_encode($json);
            mysqli_close($conexion);

        }else{

            if($accion == "DSP"){
                    $select_comentarios = "Select * from comentario where Pub_ID  =  {$publicacion} order by comentario_id";
                    $resultado = $conexion->query($select_comentarios);

                    if ($resultado->num_rows > 0) {
                        while($registro = $resultado->fetch_assoc()) {
                
                        $result["Pub_ID"]=$registro['Pub_ID'];
                        $result["comentario_Id"]=$registro['comentario_Id'];
                        $result["comentario_body"]=$registro['comentario_body'];                   
                        $result["comentario_Id"]=$registro['comentario_Id'];
                        
                        
                        $json['comentarios'][]=$result;
                        //echo json_encode($json);
                        }
                    } else {
                        echo "0 results";
                    }
                    echo json_encode($json);
            }else{
                $resulta["success"]=2;//No vino el comentario
                $resulta["descripcion"]="El comentario no puede ser nulo";
                $json['comentario'][]=$resulta;
                echo json_encode($json);
                mysqli_close($conexion);
            }


        }
        

               
    
        
    }else{///No llegó acción
        $resulta["success"]=1;
        $json['comentario'][]=$resulta;
        echo json_encode($json);
        mysqli_close($conexion);
    }
    
        

?>