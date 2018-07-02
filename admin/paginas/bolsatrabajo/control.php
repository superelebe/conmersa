<?
	// error_reporting(0);

	session_start();

	include("../../incluir/config.php");
	include("../../incluir/class_mysqli.php");
	include("../../incluir/class_usuario.php");
	include("../../incluir/funciones.php");

	$mysql= new Con_mysqli;

	$usuario= new Usuario;
	$usuario->check_sesion();

	// echo 'mmmmmm';
	// echo "<pre>";
	// var_dump($_POST);
	// var_dump($_FILES);
	// // var_dump($_SESSION);
	// echo "</pre>";


	switch($_POST["seccion"])
	{


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// N - U - E - V - O //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'nuevo':


	


			$valores_regreso=array();
			
			$max_data=$mysql->consulta("SELECT MAX(id_vacante), MAX(orden_vacante) FROM vacante");
			
			$id=$max_data[0]["MAX(id_vacante)"];
			if ($id === NULL){$id=0;}
			$id=$id+1;
			
			$orden=$max_data[0]["MAX(orden_vacante)"];
			if ($orden === NULL){$orden=0;}
			$orden=$orden+1;
			
			$date_ini = date("Y-m-d", strtotime($_POST["fecha_ini"]));

			$date_fin = date("Y-m-d", strtotime($_POST["fecha_fin"]));
			

		
			if (!empty($id))
			{
			// 	// $name_dir="files/".$id."/";
				
			// 	// if(mkdir($name_dir, 0777, true))
			// 	// {
			// 	// 	$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"images",50000000,["id_vacante"=>$id],"imagenes_vacante");

			// 	// 	if ($valores_regreso["imagenes"][0]["respuesta"]) {
						
						$data= array(
							"id_vacante"=>$id,
							"orden_vacante"=>$orden,
							"titulo"=>$_POST["titulo"],
							"puesto"=>$_POST["puesto"],
							"sueldo"=>$_POST["sueldo"],
							"descripcion"=>$_POST["descripcion"],
							"anos"=>$_POST["anos"],
							"edad_min"=>$_POST["edad_min"],	
							"edad_max"=>$_POST["edad_max"],	
							"estudios"=>$_POST["estudios"],	
"localidad"=>$_POST["localidad"],
"idiomas"=>$_POST["idiomas"],
"informatica"=>$_POST["informatica"],
"licencia"=>$_POST["licencia"],
"viajar"=>$_POST["viajar"],
"cambio"=>$_POST["cambio"],
"discapacidad"=>$_POST["discapacidad"],
							"fecha_ini"=>$date_ini,
							"fecha_fin"=>$date_fin,
							"id_tipo"=>$_POST["tipo"]
							
						);

						$id=$mysql->insert_individual("vacante",$data);


						
						

						// echo "nuevo-------";
						// 	echo "  <pre> ";
						// 	var_dump($id);
						// 	echo "<br/>";
						// 	// var_dump($data);
						// 	echo "  </pre> ";


						$valores_regreso["respuesta"]=true;
						$valores_regreso["id"]=$id;
						$valores_regreso["id_vacante"]=$id;
						$valores_regreso["titulo"]=$_POST["titulo"];
						$valores_regreso["orden"]=$orden;
							$valores_regreso["puesto"]=$_POST["puesto"];
						$valores_regreso["sueldo"]=$_POST["sueldo"];
						$valores_regreso["fecha_fin"]=$_POST["fecha_fin"];
						$valores_regreso["fecha_ini"]=$_POST["fecha_ini"];

						$valores_regreso["anos"]=$_POST["anos"];
						$valores_regreso["edad_min"]=$_POST["edad_min"];
						$valores_regreso["edad_max"]=$_POST["edad_max"];
						$valores_regreso["estudios"]=$_POST["estudios"];
						$valores_regreso["localidad"]=$_POST["localidad"];
						$valores_regreso["idiomas"]=$_POST["idiomas"];
						$valores_regreso["informatica"]=$_POST["informatica"];
						$valores_regreso["licencia"]=$_POST["licencia"];
						$valores_regreso["viajar"]=$_POST["viajar"];
						$valores_regreso["cambio"]=$_POST["cambio"];
						$valores_regreso["discapacidad"]=$_POST["discapacidad"];
				

						$valores_regreso["tipo"]=$_POST["tipo"];
						
			// 		// }
			// 		// else{
			// 		// 	$valores_regreso["respuesta"]=false;
			// 		// 	$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
			// 		// }
			// 	// }
			// 	// else
			// 	// {
			// 	// 	$valores_regreso["respuesta"]=false;
			// 	// 	$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema durante la creacion del directorio, no se ha cargado.</h3>';;
			// 	// }
			// }
			// else
			// {
			// 	$valores_regreso["respuesta"]=false;
			// 	$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema al obtener el último ID, no se ha cargado.</h3>';;
			}

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// O R D E N A R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'ordenar':	

			$id_existense=$mysql->consulta("SELECT orden FROM vacante WHERE orden=".$_POST["orden_id"]);
	
			if (!empty($id_existense)) {

				$id_existense= $id_existense[0]["orden"];

				$valores_regreso["respuesta"]=FALSE;
				$valores_regreso["msj"]="Ya existe el número".$id_existense.". Captura otro número.";

			}
			else{

				$id=$mysql->update_individual("orden","vacante",$_POST["orden_id"],["id_vacante"=>$_POST["id"]]);
				$valores_regreso["respuesta"]=TRUE;
				$valores_regreso["msj"]="Se ha cambiado  ".$_POST["orden_id"].".";
			}

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	
		
		break;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// E D I T A R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//

		case 'editar':	

			$id=$_POST["id"];
			$name_dir="files/".$id."/";	

			$valores_regreso=array();

			// if (!empty($_FILES)) {
			// 	# code...
			
			// 	$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"images",50000000,["id_vacante"=>$id],"imagenes_vacante");

			// 	if ($valores_regreso["imagenes"][0]["respuesta"]) {
					
			// 		$data= array(
			// 			"id_vacante"=>$id,
			// 			"nombre"=>$_POST["nombre"],
			// 		);

			// 		$id=$mysql->data_update($data, "vacante", ["id_vacante"=>$_POST["id"]]);	

		

			// 			$valores_regreso["imagenes"][0]["file"]="files/".$_POST["id"]."/".$valores_regreso["imagenes"][0]["file"];
			// 			$valores_regreso["respuesta"]=true;
			// 			$valores_regreso["id"]=$_POST["id"];;
			// 			$valores_regreso["nombre"]=$_POST["nombre"];
			// 			$valores_regreso["url"]=$_POST["url"];
		

			// 	}
			// 	else{
			// 		$valores_regreso["respuesta"]=false;
			// 		$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
			// 	}
			// }
			// else{


			$date_ini = date("Y-m-d", strtotime($_POST["fecha_ini"]));

			$date_fin = date("Y-m-d", strtotime($_POST["fecha_fin"]));




				$data= array(
							"id_vacante"=>$id,
							"orden_vacante"=>$_POST["orden"],
							"titulo"=>$_POST["titulo"],
							"puesto"=>$_POST["puesto"],
							"sueldo"=>$_POST["sueldo"],
							"descripcion"=>$_POST["descripcion"],
							"anos"=>$_POST["anos"],
							"edad_min"=>$_POST["edad_min"],	
							"edad_max"=>$_POST["edad_max"],	
							"estudios"=>$_POST["estudios"],	
"localidad"=>$_POST["localidad"],
"idiomas"=>$_POST["idiomas"],
"informatica"=>$_POST["informatica"],
"licencia"=>$_POST["licencia"],
"viajar"=>$_POST["viajar"],
"cambio"=>$_POST["cambio"],
"discapacidad"=>$_POST["discapacidad"],
							"fecha_ini"=>$date_ini,
							"fecha_fin"=>$date_fin,
							
							
						);

				if ($_POST["tipo"]!="") {
					$data["id_tipo"]=$_POST["tipo"];
				}


				// echo "<pre>";
				// var_dump($data);
				// echo "</pre>";


				$id_data=$mysql->data_update($data, "vacante", ["id_vacante"=>$_POST["id"]]);	

				// echo "<pre>";
				// var_dump($id);
				// echo "</pre>";

					$valores_regreso["respuesta"]=true;
						$valores_regreso["id"]=$id;
						$valores_regreso["id_vacante"]=$id;
						$valores_regreso["titulo"]=$_POST["titulo"];
						$valores_regreso["orden_vacante"]=$_POST["orden"];
						$valores_regreso["descripcion"]=$_POST["descripcion"];
						

						$valores_regreso["puesto"]=$_POST["puesto"];
						$valores_regreso["sueldo"]=$_POST["sueldo"];
						$valores_regreso["fecha_fin"]=$_POST["fecha_fin"];
						$valores_regreso["fecha_ini"]=$_POST["fecha_ini"];

						$valores_regreso["anos"]=$_POST["anos"];
						$valores_regreso["edad_min"]=$_POST["edad_min"];
						$valores_regreso["edad_max"]=$_POST["edad_max"];
						$valores_regreso["estudios"]=$_POST["estudios"];
						$valores_regreso["localidad"]=$_POST["localidad"];
						$valores_regreso["idiomas"]=$_POST["idiomas"];
						$valores_regreso["informatica"]=$_POST["informatica"];
						$valores_regreso["licencia"]=$_POST["licencia"];
						$valores_regreso["viajar"]=$_POST["viajar"];
						$valores_regreso["cambio"]=$_POST["cambio"];
						$valores_regreso["discapacidad"]=$_POST["discapacidad"];
				

				$id_tipo=$mysql->consulta("SELECT id_tipo FROM vacante WHERE id_vacante=".$_POST["id"]);

							

				
					$valores_regreso["tipo"]=$id_tipo[0]["id_tipo"];
				

			// }			
			
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		

		case 'borrar':	


			$id_doc=$_POST['id'];
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {

	        	
        			$id_noimg=$mysql->delete_individual("vacante",["id_vacante"=>$id_doc]);

        			if ($id_noimg) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La vacante se ha borrado con éxito.</h3>"
						);
        			}
        			else
        			{
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>hubo un problema al borrar la vacante, intentalo otra vez o comunicate con el administrador.</h3>"
						);
        			}

	    		}
        		
	            
            
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R  ++++  I - M - A - G - E - N//---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//	
		case 'borrar_foto':	

			$dato=$_POST['id'];
		    
		    $dir_name = ''; 

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('imagenes_vacante',["id_imagen"=>$dato]);

	        
	            // $del_advise=$mysql->delete_files_individual($file_data->thumb,$dir_name);

	            // if ($del_advise["respuesta"]) {
	            	// var_dump($del_advise);

	            	$del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            	
	            	if ($del_advise["respuesta"]) {
	            		// echo "<br>del advise 2<br>";
	            		// var_dump($del_advise);
	            		$id=$mysql->delete_individual("imagenes_vacante",["id_imagen"=>$dato]);
	    
	            		$valores_regreso=array(
							'id_imagen' => $dato,
							'id'=>$file_data->id_vacante,
							'respuesta' => $del_advise["respuesta"],
							'advise'=>$del_advise["msj"]
						);
							// echo "<pre>";
	      //   	var_dump($file_data);
	      //   	echo "</pre>";

	            	}	
	            	else
	   
         	{
	            		$valores_regreso=array(			
						'id' => $dato ,
						'respuesta' => $del_advise["respuesta"],
						'advise'=>$del_advise["msj"]
						);
	            	}
	            // }
	    //         else
	    //         {

	    //         	$valores_regreso=array(
					// 	'id' => $dato ,
					// 	'respuesta' => $del_advise["respuesta"],
					// 	'advise'=>$del_advise["msj"]
					// );
	    //         }
	        }	
		
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;			

		break;	





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// N - U - E - V - O //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'nuevo_tipo':


	


			$valores_regreso=array();
			
			$max_data=$mysql->consulta("SELECT MAX(id_tipo) FROM tipo_vacante");
			
			$id=$max_data[0]["MAX(id_tipo)"];
			if ($id === NULL){$id=0;}
			$id=$id+1;

			
		
			if (!empty($id))
			{
			


						
						$data= array(
							"id_tipo"=>$id,
							"nombre_tipo"=>$_POST["titulo"]
						);




						$id_return=$mysql->insert_individual("tipo_vacante",$data);


						$valores_regreso["respuesta"]=true;
						$valores_regreso["id"]=$id;
						$valores_regreso["id_tipo"]=$id;
						$valores_regreso["nombre_tipo"]=$_POST["titulo"];

						// var_dump($valores_regreso);


						
		
			}

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;






		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		

		case 'borrar_tipo':	


			$id_doc=$_POST['id'];
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {

	        	
	        

		        		
					// eliminarDir($ruta);
        			$id_noimg=$mysql->delete_individual("tipo_vacante",["id_tipo"=>$id_doc]);

        			// var_dump($id_noimg);

        			if ($id_noimg) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La vacante se ha borrado con éxito.</h3>"
						);
        			}
        			

	    		
        		
	            
            }
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	




	}


?>










