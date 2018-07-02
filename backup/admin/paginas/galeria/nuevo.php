<?
	session_start();
	
	error_reporting(0);

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


	switch($_POST["seccion"]){


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// N - U - E - V - O //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'nueva_banner':	


		
			$valores_regreso=array();
			
			$max_data=$mysql->consulta("SELECT MAX(id_banner), MAX(orden) FROM banner");
			
			$id=$max_data[0]["MAX(id_banner)"];
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
					$valores_regreso["imagenes"]=$mysql->upload_files_general($name_dir,"all",50000000,["id_banner"=>$id],"imagenes_banner");

					if ($valores_regreso["imagenes"][0]["respuesta"]) {
						
						$data= array(
							"id_banner"=>$id,
							"orden"=>$orden,
							"nombre"=>$_POST["titulo"],
							// "url"=>$_POST["url"],
						);

						$id=$mysql->insert_individual("banner",$data);

						$valores_regreso["respuesta"]=true;
						$valores_regreso["id"]=$id;
						$valores_regreso["id_banner"]=$id;
						$valores_regreso["nombre"]=$_POST["titulo"];
						$valores_regreso["orden"]=$orden;
						// $valores_regreso["url"]=$url;
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








	}


?>










