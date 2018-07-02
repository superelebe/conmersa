<?
	error_reporting(0);

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
	// // var_dump($_POST);
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
			
			$max_data=$mysql->consulta("SELECT MAX(id_servicio), MAX(orden) FROM servicio");
			
			$id=$max_data[0]["MAX(id_servicio)"];
			if ($id === NULL){$id=0;}
			$id=$id+1;
			
			$orden=$max_data[0]["MAX(orden)"];
			if ($orden === NULL){$orden=0;}
			$orden=$orden+1;

			

			if (!empty($id))
			{
				$name_dir="files/seccion_servicios/".$id."/";

		
				
				if(mkdir($name_dir, 0777, true))
				{

					

					foreach ($_FILES as $key => $value) {

						$base_img="imagenes_servicio";
						$tipe_file="image";
						

						if ($key=="principal") {
							$base_img="imagenes_principal";
							$tipe_file="all";

						}

						if ($value["name"] != "") {

							if ($key=="principal") {
								$valores_regreso[$key][0]=$mysql->upload_files_individual($value,$name_dir,$tipe_file, 50000000, ["id_servicio"=>$id], $base_img);
								// $valores_regreso[$key][0]['file_name']=$valores_regreso[$key][0]['file'];
								// $valores_regreso[$key][0]['id_imagen']=$valores_regreso[$key][0]['id_foto'];

							}
							else{

								$valores_regreso['images'][$key][0]=$mysql->upload_files_individual($value,$name_dir,$tipe_file, 50000000, ["id_servicio"=>$id], $base_img);//, $callback

								// $valores_regreso['imagenes'][$key][0]['file_name']=$valores_regreso['imagenes'][$key][0]['file'];
								// $valores_regreso['imagenes'][$key][0]['id_imagen']=$valores_regreso['imagenes'][$key][0]['id_foto'];

							}

							

						}

						
					};
					
	// var_dump($value);
	// 					var_dump($key);
					

					// // $valores_regreso["fondo"][0]=$mysql->upload_files_individual($_FILES["fondo"],$name_dir,"image", 50000000, ["id_servicio"=>$id], "imagenes_fondo");//, $callback

					if ($valores_regreso["principal"][0]["respuesta"] && $valores_regreso['images']["foto1"][0]["respuesta"]) {
						
						$data= array(
							"id_servicio"=>$id,
							"orden"=>$orden,
							"nombre"=>$_POST["nombre"],
							"nombre_ingles"=>$_POST["nombre_ingles"],
							"url"=>$_POST["url"],
							"descripcion"=>$_POST["descripcion"],
							"descripcion_ingles"=>$_POST["descripcion_ingles"],
							"ingredientes"=>$_POST["ingredientes"],
							"id_categoria"=>$_POST["categoria"],
							"id_clase"=>$_POST["clase"]
						);

						$id_insert=$mysql->insert_individual("servicio",$data);

						$valores_regreso["respuesta"]=true;
						$valores_regreso["id"]=$id;
						$valores_regreso["id_servicio"]=$id;
						$valores_regreso["nombre"]=$_POST["nombre"];
						$valores_regreso["nombre_ingles"]=$_POST["nombre_ingles"];
						$valores_regreso["url"]=$_POST["url"];
						$valores_regreso["descripcion"]=$_POST["descripcion"];
						$valores_regreso["descripcion_ingles"]=$_POST["descripcion_ingles"];
						$valores_regreso["ingredientes"]=$_POST["ingredientes"];
						$valores_regreso["orden"]=$orden;
						$valores_regreso["id_clase"]=$_POST["clase"];
						$valores_regreso["id_categoria"]=$_POST["categoria"];
						
					}
					else{
						$valores_regreso["respuesta"]=false;
						$valores_regreso["msj"]=$valores_regreso["principal"][0]["msj"];
					}
				}
				else
				{
					$valores_regreso["respuesta"]=false;
					$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema durante la creacion del directorio, no se ha cargado.</h3>';;
				}
			}
			else
			{
				$valores_regreso["respuesta"]=false;
				$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema al obtener el último ID, no se ha cargado.</h3>';;
			}

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// O R D E N A R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'ordenar':	

			$id_existense=$mysql->consulta("SELECT orden FROM servicio WHERE orden=".$_POST["orden_id"]);
	
			if (!empty($id_existense)) {

				$id_existense= $id_existense[0]["orden"];

				$valores_regreso["respuesta"]=FALSE;
				$valores_regreso["msj"]="Ya existe el número".$id_existense.". Captura otro número.";

			}
			else{

				$id=$mysql->update_individual("orden","servicio",$_POST["orden_id"],["id_servicio"=>$_POST["id"]]);
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
			$name_dir="files/seccion_servicios/".$id."/";	

			$valores_regreso=array();

			$first_value = reset($_FILES);

		

			foreach ($_FILES as $key => $value) {

				$base_img="imagenes_servicio";
				$tipe_file="image";
				

				if ($key=="principal") {
					$base_img="imagenes_principal";
					$tipe_file="all";

				}

				if ($value["name"] != "") {

					$valores_regreso["images"][$key][0]=$mysql->upload_files_individual($value,$name_dir,$tipe_file, 50000000, ["id_servicio"=>$id], $base_img);//, $callback
				}
			
			};

					
					$data= array(

							"nombre"=>$_POST["nombre"],
							"descripcion"=>$_POST["descripcion"],
							"nombre_ingles"=>$_POST["nombre_ingles"],
							"descripcion_ingles"=>$_POST["descripcion_ingles"],
							"ingredientes"=>$_POST["ingredientes"],
							
							"id_categoria"=>$_POST["categoria"],
							"id_clase"=>$_POST["clase"],
							"url"=>$_POST["url"]
						);

					 // echo
					  $ok=$mysql->data_update($data, "servicio", ["id_servicio"=>$_POST["id"]]);

			// 		 	echo "<pre>";
			// var_dump($ok);
			// echo "</pre>";


				// if ($ok!=false) {


						// $valores_regreso["imagenes"][0]["file"]="files/seccion_servicios/".$_POST["id"]."/".$valores_regreso["imagenes"][0]["file"];
					$valores_regreso["respuesta"]=true;
					$valores_regreso["id"]=$id;
					$valores_regreso["id_servicio"]=$id;
					$valores_regreso["nombre"]=$_POST["nombre"];
					$valores_regreso["url"]=$_POST["url"];
					$valores_regreso["descripcion"]=$_POST["descripcion"];
					// $valores_regreso["ingredientes"]=$_POST["ingredientes"];
					// $valores_regreso["orden"]=$orden;
					// $valores_regreso["id_clase"]=$_POST["clase"];
					$valores_regreso["id_categoria"]=$_POST["categoria"];
					$valores_regreso["msj"]="<h3 style='color:skyblue;'>se ha cambiado la información del servicio.</h3>";

				// }
				// else{
				// 	$valores_regreso["id"]=$id;
				// 	$valores_regreso["nombre"]=$_POST["nombre"];
				// 	$valores_regreso["url"]=$_POST["url"];
				// 	$valores_regreso["respuesta"]=false;
				// 	$valores_regreso["msj"]="<h3 style='color:skyblue;'>se ha cambiado la información del servicio.</h3>";
				// }		
			
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	


		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// E D I T A R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//

		case 'control_img_principal':	

			$name_dir="files/imagen_principal/";	

			$valores_regreso=array();

			$first_value = reset($_FILES);

			
				
				if ($first_value["name"] != "") {


					$base_img="imagenes_principal";
					$tipe_file="all";

					$valores_regreso["images"][0]=$mysql->upload_files_individual($_FILES['img_mkt'],$name_dir,$tipe_file, 50000000, ["id_servicio"=>0,"ingles"=>0], $base_img);//, $callback

					$valores_regreso["images"][0]['file_name']='files/imagen_principal/'.$valores_regreso["images"][0]['file'];


					$valores_regreso["images"][1]=$mysql->upload_files_individual($_FILES['img_mkt_ingles'],$name_dir,$tipe_file, 50000000, ["id_servicio"=>0, "ingles"=>1], $base_img);//, $callback

					$valores_regreso["images"][1]['file_name']='files/imagen_principal/'.$valores_regreso["images"][1]['file'];



					$valores_regreso["images"][0]['id_imagen']=$valores_regreso["images"][0]['id_foto'];
					$valores_regreso["images"][1]['id_imagen']=$valores_regreso["images"][1]['id_foto'];

					$valores_regreso["respuesta"]=true;

					// var_dump($valores_regreso["imagenes"][0]);
				}		
			
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

	        	
	        	$file_principal_data=$mysql->consulta("SELECT * FROM imagenes_principal WHERE id_servicio ='".$id_doc."'");
	        	
	        	$file_img_data=$mysql->consulta("SELECT * FROM imagenes_servicio WHERE id_servicio ='".$id_doc."'");
	        
	        	

	        	if (!empty($file_principal_data)) {	

	        	       	$del_advise_principal=$mysql->delete_files_individual($file_principal_data[0]["file_name"],$dir_name);

	        	       	// var_dump($file_principal_data);



	        	       	$id_principal=$mysql->delete_individual("imagenes_principal",["id_imagen"=>$file_principal_data[0]["id_imagen"]]);
	        	}


	        	if(!empty($file_img_data)) {	 

	        		foreach ($file_img_data as $key => $value) {
	        			$del_advise_images[$key]=$mysql->delete_files_individual($value["file_name"],$dir_name);	
	        			$del_advise_images[$key]["id"]=$mysql->delete_individual("imagenes_servicio",["id_imagen"=>$value["id_imagen"]]);
	        		}
	        	}      	
		        	
					$dir_name="files/seccion_servicios/".$id_doc;
        			$id_noimg=$mysql->delete_individual("servicio",["id_servicio"=>$id_doc]);

        			if ($id_noimg) {
        				eliminarDir($dir_name);

        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La servicio se ha borrado con éxito.</h3>"
						);
        			}
        			else
        			{
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>hubo un problema al borrar la servicio, intentalo otra vez o comunicate con el administrador.</h3>"
						);
        			}

	    		
        		
	            
            }
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R  ++++  FONDO//---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//	
		case 'borrar_img':	

			$dato=$_POST['id'];
		    
		    $dir_name = ''; 

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('imagenes_servicio',["id_imagen"=>$dato]);
	        
	            $del_advise=$mysql->delete_files_individual($file_data->thumb,$dir_name);

	            if ($del_advise["respuesta"]) {

	            	$del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            	
	            	if ($del_advise["respuesta"]) {
	            		// echo "<br>del advise 2<br>";
	            		// var_dump($del_advise);
	            		$id=$mysql->delete_individual("imagenes_servicio",["id_imagen"=>$dato]);
	    
	            		$valores_regreso=array(
							'id_imagen' => $dato,
							'id'=>$file_data->id_servicio,
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
	            }
	            else
	            {

	            	$valores_regreso=array(
						'id' => $dato ,
						'respuesta' => $del_advise["respuesta"],
						'advise'=>$del_advise["msj"]
					);
	            }
	        }	
		
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;			

		break;	

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R  ++++  Logo//---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//	
		case 'borrar_img_prin':	

			$dato=$_POST['id'];

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('imagenes_principal',["id_imagen"=>$dato]);
	        	// $file_data_ingles=$mysql->consulta_global('imagenes_principal',["id_servicio"=>0,"ingles"=>1]);

	        	// var_dump($dato);

	        	// var_dump($file_data);

	        	$dir_name = ''; 

	        
	            $del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            // $del_advise_ingles=$mysql->delete_files_individual($file_data_ingles->file_name,$dir_name);

	            if ($del_advise["respuesta"]) {
	            	// var_dump($del_advise);
	            	
	            		$id=$mysql->delete_individual("imagenes_principal",["id_imagen"=>$dato]);
	            		// $id_ingles=$mysql->delete_individual("imagenes_principal",["id_servicio"=>0,"ingles"=>1]);
	    
	            		$valores_regreso=array(
							'id_imagen' => $dato,
							'id'=>$file_data->id_servicio,
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
	        }	
		
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;			

		break;	


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R  ++++  Logo//---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//	
		case 'borrar_img_prin_servicios':	

			$dato=$_POST['id'];

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('imagenes_principal',["id_servicio"=>0,"ingles"=>0]);
	        	$file_data_ingles=$mysql->consulta_global('imagenes_principal',["id_servicio"=>0,"ingles"=>1]);

	        	// var_dump($dato);

	        	// var_dump($file_data);

	        	$dir_name = ''; 

	        
	            $del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            $del_advise_ingles=$mysql->delete_files_individual($file_data_ingles->file_name,$dir_name);

	            if ($del_advise["respuesta"]) {
	            	// var_dump($del_advise);
	            	
	            		$id=$mysql->delete_individual("imagenes_principal",["id_servicio"=>0,"ingles"=>0]);
	            		$id_ingles=$mysql->delete_individual("imagenes_principal",["id_servicio"=>0,"ingles"=>1]);
	    
	            		$valores_regreso=array(
							'id_imagen' => $dato,
							'id'=>$file_data->id_servicio,
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
	        }	
		
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;			

		break;	




		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R  ++++  LIFESTYLE//---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//	
	// 	case 'borrar_img_lifestyle':	

	// 		$dato=$_POST['id'];
		    
	// 	   	$dir_name = ''; 

	//         if($dato!='' || $dato!=NULL){

	//         	$file_data=$mysql->consulta_global('imagenes_lifestyle',["id_imagen"=>$dato]);

	//             $del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);

	//             if ($del_advise["respuesta"]) {
	//             	// var_dump($del_advise);

	            	
	//             		$id=$mysql->delete_individual("imagenes_lifestyle",["id_imagen"=>$dato]);
	    
	//             		$valores_regreso=array(
	// 						'id_imagen' => $dato,
	// 						'id'=>$file_data->id_servicio,
	// 						'respuesta' => $del_advise["respuesta"],
	// 						'advise'=>$del_advise["msj"]
	// 					);
	// 						// echo "<pre>";
	//       //   	var_dump($file_data);
	//       //   	echo "</pre>";
	//             }
	//             else
	//             {

	//             	$valores_regreso=array(
	// 					'id' => $dato ,
	// 					'respuesta' => $del_advise["respuesta"],
	// 					'advise'=>$del_advise["msj"]
	// 				);
	//             }
	//         }	
		
	// 		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
	// 		echo $valores_regreso;			

	// 	break;	



	}


?>










