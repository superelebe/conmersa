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
			
			$max_data=$mysql->consulta("SELECT MAX(id_galeria), MAX(orden) FROM galeria");
			
			$id=$max_data[0]["MAX(id_galeria)"];
			if ($id === NULL){$id=0;}
			$id=$id+1;
			
			$orden=$max_data[0]["MAX(orden)"];
			if ($orden === NULL){$orden=0;}
			$orden=$orden+1;

			if (!empty($id))
			{
				$name_dir="files/".$id."/";
				
				if(mkdir($name_dir, 0777, true))
				{
					$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"image",50000000,["id_galeria"=>$id],"imagenes_galeria");

					if ($valores_regreso["imagenes"][0]["respuesta"]) {
						
						
						$id_new=$_POST["tipo"];

						$tipo_data=$mysql->consulta("SELECT * FROM tipo_galeria");

						if (!is_numeric($id_new)) {

							// // echo "no es numerico";
							
							// $tipo_exist=multidimensional_search_array($tipo_data, ["nombre_tipo"=>$_POST["tipo"]]);
							// // var_dump($tipo_exist);
							
							// if (empty($tipo_exist)) {
								
							// 	$data= array(
							// 		"nombre_tipo"=>$_POST["tipo"],
							// 	);								
							// 	$id_new=$mysql->insert_individual("tipo_galeria",$data);
							// 	$valores_regreso["tipo_nombre"]=$_POST["tipo"];
							// }
							// else{
							// 	$id_new=$tipo_exist["id_tipo"];
							// 	$valores_regreso["tipo_nombre"]=$tipo_exist["nombre_tipo"];
							// }

						}
						else{
							$tipo_exist=multidimensional_search_array($tipo_data, ["id_tipo"=>$_POST["tipo"]]);
							// var_dump($tipo_exist);
							$valores_regreso["tipo_nombre"]=$tipo_exist["nombre_tipo"];
						}

						$data= array(
							"id_galeria"=>$id,
							"orden"=>$orden,
							"nombre"=>$_POST["nombre"],
							"tipo"=>$id_new
						);

						$id=$mysql->insert_individual("galeria",$data);

						$valores_regreso["respuesta"]=true;
						$valores_regreso["id"]=$id;
						$valores_regreso["id_galeria"]=$id;
						$valores_regreso["nombre"]=$_POST["nombre"];
						$valores_regreso["orden"]=$orden;
						$valores_regreso["tipo_id"]=$id_new;
						
					}
					else{
						$valores_regreso["respuesta"]=false;
						$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
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



		case 'nuevo_tipo':

		$valores_regreso=array();
		
		$max_data=$mysql->consulta("SELECT MAX(id_tipo) FROM tipo_galeria");
		
		$id=$max_data[0]["MAX(id_tipo)"];
		if ($id === NULL){$id=0;}
		$id=$id+1;

		if (!empty($id))
		{
			$name_dir="files/tipo/";
			
				// $valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"all",50000000,["id_tipo"=>$id],"tipo_galeria");

				// if ($valores_regreso["imagenes"][0]["respuesta"]) {
					
					// $data= array(
					// 	"nombre_tipo"=>$_POST["titulo"]
					// );
					$valores_regreso["imagenes"][0]["name"]=$name_dir.$valores_regreso["imagenes"][0]["name"];

					// $max_data=$mysql->consulta("SELECT MAX(id_tipo) FROM tipo_galeria");
					// $id_last_created=$max_data[0]["MAX(id_tipo)"];

					// $id=$mysql->update_individual("nombre_tipo","tipo_galeria",$_POST["titulo"],["id_tipo"=>$id_last_created]);


					$data= array(
						"nombre_tipo"=>$_POST["titulo"],
						"nombre_tipo_ingles"=>$_POST["titulo_ingles"]
					);

					// $id=$mysql->data_update($data, "tipo_galeria", ["id_tipo"=>$id]);	

					$id=$mysql->insert_individual("tipo_galeria",$data);

					$valores_regreso["respuesta"]=true;
					$valores_regreso["id"]=$id;
					$valores_regreso["nombre"]=$_POST["titulo"];
					$valores_regreso["nombre_ingles"]=$_POST["titulo_ingles"];

				// }
				// else{
				// 	$valores_regreso["respuesta"]=false;
				// 	$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
				// }
			
			
		}
		else
		{
			$valores_regreso["respuesta"]=false;
			$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema al obtener el último ID, no se ha cargado.</h3>';;
		}
		// echo "valores";
		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	
		
		break;



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// O R D E N A R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'fondo':	

			$id_galeria=$_POST['id'];

			$id_fondo=$mysql->consulta("SELECT id_galeria FROM galeria WHERE fondo=1");

			$id_fondo_up=$mysql->update_individual("fondo","galeria",0,["id_galeria"=>$id_fondo[0]['id_galeria']]);

			$id_galeria_up=$mysql->update_individual("fondo","galeria",1,["id_galeria"=>$id_galeria]);

			if (!empty($id_galeria_up)) {
				
				$valores_regreso["respuesta"]=TRUE;
				$valores_regreso["msj"]="Se ha cambiado  ".$id_galeria.".";
	
			}
			else{

				$valores_regreso["respuesta"]=FALSE;
				$valores_regreso["msj"]="No se pudo actuarizar el fondo.";
			}

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	
		
		break;



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---//  S L I D E   I T E M  //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'slide':	

			$id_galeria=$_POST['id'];

			
			if ($_POST['checked'] == 'true') {
				# code...
				$id_galeria_up=$mysql->update_individual("slide","galeria",0,["id_galeria"=>$id_galeria]);

				$valores_regreso["checked"]=false;

			}
			elseif ($_POST['checked'] == 'false') {
			
					
				$id_galeria_up=$mysql->update_individual("slide","galeria",1,["id_galeria"=>$id_galeria]);
				
				$valores_regreso["checked"]=true;
				
			}

				$valores_regreso["respuesta"]=TRUE;
				$valores_regreso["msj"]="Se ha cambiado  ".$id_galeria.".";

			

			

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	
		
		break;




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// O R D E N A R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'ordenar':	

			$id_existense=$mysql->consulta("SELECT orden FROM galeria WHERE orden=".$_POST["orden_id"]);
	
			if (!empty($id_existense)) {

				$id_existense= $id_existense[0]["orden"];

				$valores_regreso["respuesta"]=FALSE;
				$valores_regreso["msj"]="Ya existe el número".$id_existense.". Captura otro número.";

			}
			else{

				$id=$mysql->update_individual("orden","galeria",$_POST["orden_id"],["id_galeria"=>$_POST["id"]]);
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

				
	// echo "<pre>";
	// var_dump($_POST);
	// echo "</pre>";			

			$id=$_POST["id"];
			$name_dir="files/".$id."/";	
			$orden=$_POST["orden"];

			$valores_regreso=array();

			$valores_regreso["id"]=$id;

			$id_new=$_POST["tipo"];

			$tipo_data=$mysql->consulta("SELECT * FROM tipo_galeria");

			if (!is_numeric($id_new)) {

				// echo "no es numerico";
				
				// $tipo_exist=multidimensional_search_array($tipo_data, ["nombre_tipo"=>$_POST["tipo"]]);
				// // var_dump($tipo_exist);
				
				// if (empty($tipo_exist)) {
					
				// 	$data= array(
				// 		"nombre_tipo"=>$_POST["tipo"],
				// 	);								
				// 	$id_new=$mysql->insert_individual("tipo_galeria",$data);
				// 	$valores_regreso["tipo_nombre"]=$_POST["tipo"];
				// }
				// else{
				// 	$id_new=$tipo_exist["id_tipo"];
				// 	$valores_regreso["tipo_nombre"]=$tipo_exist["nombre_tipo"];
				// }

			}
			else{
				$tipo_exist=multidimensional_search_array($tipo_data, ["id_tipo"=>$_POST["tipo"]]);
				// var_dump($tipo_exist);
				$valores_regreso["tipo_nombre"]=$tipo_exist["nombre_tipo"];
			}


				$first_value = reset($_FILES);

			if (!empty($first_value["name"])) {
				# code...
				$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"image",50000000,["id_galeria"=>$id],"imagenes_galeria");

				if ($valores_regreso["imagenes"][0]["respuesta"]) {
					
					$data= array(
						"id_galeria"=>$id,
						"orden"=>$orden,
						"nombre"=>$_POST["nombre"],
						"tipo"=>$id_new
					);


					$id=$mysql->data_update($data, "galeria", ["id_galeria"=>$_POST["id"]]);	

						$valores_regreso["imagenes"][0]["file"]="files/".$_POST["id"]."/".$valores_regreso["imagenes"][0]["file"];
						$valores_regreso["respuesta"]=true;
						
						$valores_regreso["id_galeria"]=$id;
						$valores_regreso["nombre"]=$_POST["nombre"];
						$valores_regreso["orden"]=$orden;
						$valores_regreso["tipo_id"]=$id_new;

				}
				else{
					$valores_regreso["respuesta"]=false;
					$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
				}
			}
			else{
				$data= array(
					"id_galeria"=>$id,
					"orden"=>$orden,
					"nombre"=>$_POST["nombre"],
					"tipo"=>$id_new
				);

				$id=$mysql->data_update($data, "galeria", ["id_galeria"=>$_POST["id"]]);	

				$valores_regreso["imagenes"][0]["id_foto"]="";
					$valores_regreso["imagenes"][0]["file"]="";
					$valores_regreso["respuesta"]=true;
					$valores_regreso["id_galeria"]=$id;
					$valores_regreso["nombre"]=$_POST["nombre"];
					$valores_regreso["orden"]=$orden;
					$valores_regreso["tipo_id"]=$id_new;
	

			}			
			
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	case 'editar_tipo':	

				
	// echo "<pre>";
	// var_dump($_POST);
	// echo "</pre>";			

			$id=$_POST["id"];
			$name_dir="files/tipo/";	
			$nombre=$_POST["nombre"];
			$nombre_ingles=$_POST["nombre_ingles"];

			$valores_regreso=array();
			$valores_regreso["id"]=$id;

			$first_value = reset($_FILES);

			if (!empty($first_value["name"])) {
				# code...
				function calling($imagen_db,$data_insert){
						$mysql= new Con_mysqli;
                        $id_foto=$mysql->data_update($data_insert,$imagen_db, ["id_tipo"=>$data_insert["id_tipo"]]);                           
                        //insert_individual($imagen_db,$data_insert);
                    }
				$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"all",50000000,["id_tipo"=>$id],"tipo_galeria","calling");

				if ($valores_regreso["imagenes"][0]["respuesta"]) {
					
					$data= array(
						"nombre_tipo"=>$nombre,
						"nombre_tipo_ingles"=>$nombre_ingles
					);

					$id_update=$mysql->data_update($data, "tipo_galeria", ["id_tipo"=>$id]);	

						$valores_regreso["imagenes"][0]["file"]=$name_dir.$valores_regreso["imagenes"][0]["file"];
						$valores_regreso["respuesta"]=true;
						
						$valores_regreso["id_tipo"]=$id;
						$valores_regreso["nombre"]=$_POST["nombre"];
						$valores_regreso["nombre_ingles"]=$_POST["nombre_ingles"];
				}
				else{
					$valores_regreso["respuesta"]=false;
					$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
				}
			}
			else{
				$data= array(
					"nombre_tipo"=>$nombre,
					"nombre_tipo_ingles"=>$nombre_ingles
				);

				$id_update=$mysql->data_update($data, "tipo_galeria", ["id_tipo"=>$id]);	

				$valores_regreso["imagenes"][0]["id_foto"]="";
					$valores_regreso["imagenes"][0]["file"]="";
					$valores_regreso["respuesta"]=true;
					$valores_regreso["id_tipo"]=$id;
					$valores_regreso["nombre"]=$_POST["nombre"];
					$valores_regreso["nombre_ingles"]=$_POST["nombre_ingles"];
			}			
			
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	case 'add_data':	

				
	// echo "<pre>";
	// var_dump($_POST);
	// echo "</pre>";			

			$id=2;
			
			

			$valores_regreso=array();		


			$data= array(
				"titulo_principal"=>$_POST['titulo_principal'],
				"titulo_izq"=>$_POST['titulo'],
				"p_izq"=>$_POST['descripcion'],
				"titulo_principal_ingles"=>$_POST['titulo_principal_ingles'],
				"titulo_izq_ingles"=>$_POST['titulo_ingles'],
				"p_izq_ingles"=>$_POST['descripcion_ingles'],
			);
			
			$id_update=$mysql->data_update($data, "seccion_inicio", ["id_sinicio"=>$id]);

			$valores_regreso=$data;

			$valores_regreso["respuesta"]=true;
			
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;			



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		

		case 'borrar':	


			$id_doc=$_POST['id'];

			$dir_name = ''; 
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {

	        	$file_data=$mysql->consulta("SELECT * FROM imagenes_galeria WHERE id_galeria ='".$id_doc."'");

	        	if (!empty($file_data)) {	        	
	        		foreach ($file_data as $key => $value) {
		        		$del_advise=$mysql->delete_files_individual($value["file_name"],$dir_name);

		        		if ($del_advise["respuesta"]) {
		        			$id=$mysql->delete_individual("imagenes_galeria",["id_galeria"=>$id_doc]);
		        		}

		        		if ($id) {
		    				$ruta="files/".$id_doc;
							eliminarDir($ruta);
		        			$id=$mysql->delete_individual("galeria",["id_galeria"=>$id_doc]);

		        			if ($id) {
		        				$valores_regreso=array(
									'id' => $id_doc ,
									'respuesta' => true,
									'advise'=>"<h3>La galeria se ha borrado con éxito.</h3>"
								);
		        			}
		        		}
		        		else
			            {
			            	$valores_regreso=array(
								'id' => $id_doc ,
								'respuesta' => false,
								'advise'=>"<h3>hubo un problema al borrar la galeria, intentalo otra vez o comunicate con el administrador.</h3>"
							);
			            }	
	        		}

	    		}
	    		else{
	    			$ruta="files/".$id_doc;
					eliminarDir($ruta);
        			$id_noimg=$mysql->delete_individual("galeria",["id_galeria"=>$id_doc]);

        			if ($id_noimg) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La galeria se ha borrado con éxito.</h3>"
						);
        			}
        			else
        			{
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>hubo un problema al borrar la galeria, intentalo otra vez o comunicate con el administrador.</h3>"
						);
        			}

	    		}
        		
	            
            }
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		case 'borrar_tipo':	

			$id_doc=$_POST['id'];
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {
	        	$file_data=$mysql->consulta("SELECT file_name FROM tipo_galeria WHERE id_tipo ='".$id_doc."'");


	        	
	        	if ($file_data == '') {	  

		        		$del_advise=$mysql->delete_files_individual($file_data[0]["file_name"],$dir_name);

		        		if ($del_advise["respuesta"]) {
		      //   			$valores_regreso=array(
								// 	'id' => $id_doc ,
								// 	'respuesta' => true,
								// 	'advise'=>"<h3>La galeria se ha borrado con éxito.</h3>"
								// );
		        			$id_noimg=$mysql->delete_individual("tipo_galeria",["id_tipo"=>$id_doc]);

        			if ($id_noimg) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La galeria se ha borrado con éxito.</h3>"
						);
        			}
        			else
        			{
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>hubo un problema al borrar la galeria, intentalo otra vez o comunicate con el administrador.</h3>"
						);
        			}
		        			

		        		}

		        		else
			            {
			            	$valores_regreso=array(
								'id' => $id_doc ,
								'respuesta' => false,
								'advise'=>$del_advise["msj"]
							);
			            }	
	    		}
	    		else{

        			$id_noimg=$mysql->delete_individual("tipo_galeria",["id_tipo"=>$id_doc]);

        			if ($id_noimg) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La galeria se ha borrado con éxito.</h3>"
						);
        			}
        			else
        			{
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>hubo un problema al borrar la galeria, intentalo otra vez o comunicate con el administrador.</h3>"
						);
        			}

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

	        	$file_data=$mysql->consulta_global('imagenes_galeria',["id_imagen"=>$dato]);

	        
	            $del_advise=$mysql->delete_files_individual($file_data->thumb,$dir_name);

	            if ($del_advise["respuesta"]) {
	            	// var_dump($del_advise);

	            	$del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            	
	            	if ($del_advise["respuesta"]) {
	            		// echo "<br>del advise 2<br>";
	            		// var_dump($del_advise);
	            		$id=$mysql->delete_individual("imagenes_galeria",["id_imagen"=>$dato]);
	    
	            		$valores_regreso=array(
							'id_imagen' => $dato,
							'id'=>$file_data->id_galeria,
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

case 'borrar_foto_tipo':	

			$dato=$_POST['id'];
		    
		    $dir_name = ''; 

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('tipo_galeria',["id_tipo"=>$dato]);

	        
	            $del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);

	            if ($del_advise["respuesta"]) {
           
            		$id=$mysql->update_individual("file_name","tipo_galeria","",["id_tipo"=>$dato]);
    
            		$valores_regreso=array(
						'id_imagen' => $dato,
						'id'=>$file_data->id_tipo,
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


	}


?>










