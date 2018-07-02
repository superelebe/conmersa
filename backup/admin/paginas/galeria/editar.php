<?
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
	// // var_dump($_FILES);
	// // var_dump($_SESSION);
	// echo "</pre>";


	switch($_POST["seccion"]){


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// E _ D _ I _ T _ A _ R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		

		case 'editar_clase':	

		
	
		$id=$_POST["id"];
		$name_dir="files/clase/".$id."/";	

		$valores_regreso=array();

		if (!empty($_FILES)) {
			# code...
		
			$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"image",50000000,["id_clase"=>$id],"imagenes_clase");

			if ($valores_regreso["imagenes"][0]["respuesta"]) {
				
				$data= array(
					"id_clase"=>$id,
					"nombre"=>$_POST["nombre"],
				);

				$id=$mysql->data_update($data, "clase", ["id_clase"=>$_POST["id"]]);	

				

				// if (!empty($id)) {

					$valores_regreso["imagenes"][0]["file"]="files/clase/".$_POST["id"]."/".$valores_regreso["imagenes"][0]["file"];
					$valores_regreso["respuesta"]=true;
					$valores_regreso["id"]=$_POST["id"];;
					$valores_regreso["nombre"]=$_POST["nombre"];
					
				// }
				// else{
				// 	$valores_regreso["respuesta"]=false;
				// 	$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema durante la actualización de la clase, no se ha actualizado.</h3>';	
				// }

			}
			else{
				$valores_regreso["respuesta"]=false;
				$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
			}
		}
		else{


		// 	echo "<pre>";
		// var_dump($_POST);
		// var_dump($_FILES);
		// echo "</pre>";

			$data= array(
				"id_clase"=>$id,
				"nombre"=>$_POST["nombre"],
			);

			$id=$mysql->data_update($data, "clase", ["id_clase"=>$_POST["id"]]);	

			// var_dump($id);

			// if (!empty($id)) {
			$valores_regreso["imagenes"][0]["id_foto"]="";
				$valores_regreso["imagenes"][0]["file"]="";
				$valores_regreso["respuesta"]=true;
				$valores_regreso["id"]=$_POST["id"];
				$valores_regreso["id_clase"]=$_POST["id"];;
				$valores_regreso["nombre"]=$_POST["nombre"];
				
			// }
			// else{
			// 	$valores_regreso["respuesta"]=false;
			// 	$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema durante la actualización de la clase, no se ha actualizado.</h3>';	
			// }

		}			
		
		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	

		break;	




		//---////---////---////---////---////---////---////---////---////---////---//
//---////---// E _ D _ I _ T _ A _ R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		

		case 'editar_categoria':	

		
	
		$id=$_POST["id"];
		$name_dir="files/categoria/".$id."/";	

		$valores_regreso=array();

		if (!empty($_FILES)) {
			# code...
		
			$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"image",50000000,["id_categoria"=>$id],"imagenes_categoria");

			if ($valores_regreso["imagenes"][0]["respuesta"]) {
				
				$data= array(
					"id_categoria"=>$id,
					"nombre"=>$_POST["nombre"],
				);

				$id=$mysql->data_update($data, "categoria", ["id_categoria"=>$_POST["id"]]);	

				$id_clase=$mysql->consulta_individual("id_clase","categoria",["id_categoria"=>$_POST["id"]]);

				// if (!empty($id)) {

					$valores_regreso["imagenes"][0]["file"]="files/categoria/".$_POST["id"]."/".$valores_regreso["imagenes"][0]["file"];
					$valores_regreso["respuesta"]=true;
					$valores_regreso["id"]=$_POST["id"];
					$valores_regreso["id_clase"]=$id_clase;
					$valores_regreso["nombre"]=$_POST["nombre"];
					
				// }
				// else{
				// 	$valores_regreso["respuesta"]=false;
				// 	$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema durante la actualización de la categoria, no se ha actualizado.</h3>';	
				// }

			}
			else{
				$valores_regreso["respuesta"]=false;
				$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
			}
		}
		else{


		// 	echo "<pre>";
		// var_dump($_POST);
		// var_dump($_FILES);
		// echo "</pre>";

			$data= array(
				"id_categoria"=>$id,
				"nombre"=>$_POST["nombre"],
			);

			$id=$mysql->data_update($data, "categoria", ["id_categoria"=>$_POST["id"]]);	

			$id_clase=$mysql->consulta_individual("id_clase","categoria",["id_categoria"=>$_POST["id"]]);

			// var_dump($id);

			// if (!empty($id)) {

				$valores_regreso["imagenes"][0]["id_foto"]="";
				$valores_regreso["imagenes"][0]["file"]="";
				$valores_regreso["respuesta"]=true;
				$valores_regreso["id"]=$_POST["id"];
				$valores_regreso["id_clase"]=$id_clase;
				$valores_regreso["nombre"]=$_POST["nombre"];
				
			// }
			// else{
			// 	$valores_regreso["respuesta"]=false;
			// 	$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema durante la actualización de la clase, no se ha actualizado.</h3>';	
			// }

		}			
		
		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	

		break;	




		//---////---////---////---////---////---////---////---////---////---////---//
//---////---// E _ D _ I _ T _ A _ R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		

		case 'editar_suela':	

		
	
		$id=$_POST["id"];
		$name_dir="files/suela/".$id."/";	

		$valores_regreso=array();

		if (!empty($_FILES)) {
			# code...
		
			$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"image",50000000,["id_suela"=>$id],"imagenes_suela");

			if ($valores_regreso["imagenes"][0]["respuesta"]) {
				
				$data= array(
					"id_suela"=>$id,
					"nombre"=>$_POST["nombre"],
				);

				$id=$mysql->data_update($data, "suela", ["id_suela"=>$_POST["id"]]);	

				

				// if (!empty($id)) {

					$valores_regreso["imagenes"][0]["file"]="files/suela/".$_POST["id"]."/".$valores_regreso["imagenes"][0]["file"];
					$valores_regreso["respuesta"]=true;
					$valores_regreso["id"]=$_POST["id"];;
					$valores_regreso["nombre"]=$_POST["nombre"];
					
				// }
				// else{
				// 	$valores_regreso["respuesta"]=false;
				// 	$valores_regreso["msj"]='<h3 style="text-align: center;color: red;">Lo sentimos, ha ocurrido un problema durante la actualización de la suela, no se ha actualizado.</h3>';	
				// }

			}
			else{
				$valores_regreso["respuesta"]=false;
				$valores_regreso["msj"]=$valores_regreso["imagenes"][0]["msj"];
			}
		}
		else{


		// 	echo "<pre>";
		// var_dump($_POST);
		// var_dump($_FILES);
		// echo "</pre>";

			$data= array(
				"id_suela"=>$id,
				"nombre"=>$_POST["nombre"],
			);

			$id=$mysql->data_update($data, "suela", ["id_suela"=>$_POST["id"]]);	

				$valores_regreso["imagenes"][0]["id_foto"]="";
				$valores_regreso["imagenes"][0]["file"]="";
				$valores_regreso["respuesta"]=true;
				$valores_regreso["id"]=$_POST["id"];
				$valores_regreso["id_suela"]=$_POST["id"];
				$valores_regreso["nombre"]=$_POST["nombre"];
		}		
		
		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	

		break;	



	//---////---////---////---////---////---////---////---////---////---////---//
//---////---// E _ D _ I _ T _ A _ R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		



		case 'editar_producto':


			// // echo 'mmmmmm';
			// // echo "<pre>";
			// // var_dump($_POST);
			// // var_dump($_FILES);
			// // echo "</pre>";


			$id=$_POST['id_producto'];

			$suela=$_POST["suela"];

			$name_dir="files/producto/".$id."/";	

			$valores_regreso=array();

			$data= array(
				"nombre"=>$_POST["nombre"],
				"corrida"=>$_POST["corrida"],
				"piel"=>$_POST["piel"],
				"color"=>$_POST["color"],
				"manufactura"=>$_POST["manufactura"],
				"id_clase"=>$_POST["clase"],
				"id_categoria"=>$_POST["categoria"],
			);

			$mysql->data_update($data, "producto", ["id_producto"=>$_POST["id_producto"]]);	

			

			if (!empty($suela)) {
				
				$list_suela=$mysql->consulta("SELECT * FROM suela_producto WHERE id_producto=".$id);

				foreach ($suela as $key => $value) {
					
					$exist=multidimensional_search_array($list_suela,["id_suela"=>$value]);

					// echo "<pre>";
					// var_dump($exist);
					// echo "</pre>";

					if (empty($exist)) {
						$data= array(
							"id_suela"=>$value,
							"id_producto"=>$id,
						);

						$id_suela=$mysql->insert_individual("suela_producto",$data);
						if (!empty($id_suela)) {
								$valores_regreso["suelas"][$key]["respuesta"]=true;
								$valores_regreso["suelas"][$key]["id_suela"]=$value;
								$valores_regreso["suelas"][$key]["msj"]="las suelas se hanc argado con éxito";
						}
						else
						{
							$valores_regreso["suelas"][$key]["respuesta"]=false;
							$valores_regreso["suelas"][$key]["id_suela"]=$value;
							$valores_regreso["suelas"][$key]["msj"]="Hubo un problema al hacer el registro de la nueva suela";
						}
					}
					else{
						$valores_regreso["suelas"][$key]["respuesta"]=false;
						$valores_regreso["suelas"][$key]["id_suela"]=$exist["id_suela"];
						$valores_regreso["suelas"][$key]["msj"]="Esta suela ya existe";
					}
					
				}
				
			}
			
			

			

			if (!empty($_FILES)) {
				$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"image",50000000,["id_producto"=>$id],"imagenes_producto");
			}
			else{

				$valores_regreso["imagenes"][0]["id_foto"]="";
				$valores_regreso["imagenes"][0]["file"]="";

			}


			$data_producto=$mysql->consulta("SELECT * FROM producto WHERE id_producto='".$id."'");

			foreach ($data_producto[0] as $key => $value) {
				// var_dump($key);
				$valores_regreso[$key]=$value;	
			}
			$valores_regreso["respuesta"]=true;
					
			
			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	
		


	}

		
?>










