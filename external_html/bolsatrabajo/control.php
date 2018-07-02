<?php
	
	//error_reporting(0);

	include("../../admin/incluir/config.php");
	include("../../admin/incluir/class_mysqli.php");
	include("../../admin/incluir/funciones.php");

	$mysql= new Con_mysqli;



	switch($_POST["seccion"])
	{


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// N - U - E - V - O //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'cargar':


	
		$valores_regreso=$mysql->consulta("SELECT * FROM vacante INNER JOIN tipo_vacante ON vacante.id_tipo =tipo_vacante.id_tipo");



			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// N - U - E - V - O //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'crear_solicitud':


	


			$valores_regreso=array();
			
			$max_data=$mysql->consulta("SELECT MAX(id_solicitante) FROM solicitante");
			
			$id=$max_data[0]["MAX(id_solicitante)"];
			if ($id === NULL){$id=0;}
			$id=$id+1;
			

		
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




	};


	

?>