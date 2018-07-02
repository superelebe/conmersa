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
//---////---// O - R -  D  - E  - N -  A -  R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		

		case 'editar_clase_ordenar':	

		 $id_existense=$mysql->consulta("SELECT orden FROM clase WHERE orden=".$_POST["orden_id"]);
	
		if (!empty($id_existense)) {

			$id_existense= $id_existense[0]["orden"];

			$valores_regreso["respuesta"]=FALSE;
			$valores_regreso["msj"]="Ya existe el número".$id_existense.". Captura otro número.";

		}
		else{

			$id=$mysql->update_individual("orden","clase",$_POST["orden_id"],["id_clase"=>$_POST["id"]]);
			$valores_regreso["respuesta"]=TRUE;
			$valores_regreso["msj"]="Se ha cambiado  ".$_POST["orden_id"].".";
		}

		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	
		
		break;

//////////////////////////////////////////////////////////////////////////////////////////- C A T E  G O R I A -/////////////////////////////////////////////////////////////////////////////////////////////////////
		case 'editar_categoria_ordenar':	

		 $id_existense=$mysql->consulta("SELECT orden_categoria FROM categoria WHERE orden_categoria='".$_POST["orden_id"]."' AND id_clase='".$_POST["id_clase"]."'");

		if (!empty($id_existense)) {

			$id_existense= $id_existense[0]["orden"];

			$valores_regreso["respuesta"]=FALSE;
			$valores_regreso["msj"]="Ya existe el número".$id_existense.". Captura otro número.";

		}
		else{

			$id=$mysql->update_individual("orden_categoria","categoria",$_POST["orden_id"],["id_clase"=>$_POST["id_clase"],"id_categoria"=>$_POST["id"]]);
			$valores_regreso["respuesta"]=TRUE;
			$valores_regreso["msj"]="Se ha cambiado  ".$_POST["orden_id"].".";
		}

		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	
		
		break;


//////////////////////////////////////////////////////////////////////////////////////////- C A T E  G O R I A -/////////////////////////////////////////////////////////////////////////////////////////////////////
		case 'editar_suela_ordenar':	

		 $id_existense=$mysql->consulta("SELECT orden FROM suela WHERE orden=".$_POST["orden_id"]);
	
		if (!empty($id_existense)) {

			$id_existense= $id_existense[0]["orden"];

			$valores_regreso["respuesta"]=FALSE;
			$valores_regreso["msj"]="Ya existe el número".$id_existense.". Captura otro número.";

		}
		else{

			$id=$mysql->update_individual("orden","suela",$_POST["orden_id"],["id_suela"=>$_POST["id"]]);
			$valores_regreso["respuesta"]=TRUE;
			$valores_regreso["msj"]="Se ha cambiado  ".$_POST["orden_id"].".";
		}

		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	
		
		break;




////////////////////////////////////////////////////////////////////////////////////////
//- P R O D  U C T O -/////////////////////////////////////////////////////////////////////////////////////////////////////
		case 'ordenar_producto':	

		 $id_existense=$mysql->consulta("SELECT orden FROM producto WHERE orden='".$_POST["orden_id"]."' AND id_categoria='".$_POST["id_categoria"]."' AND id_clase='".$_POST["id_clase"]."'");

		if (!empty($id_existense)) {

			$id_existense= $id_existense[0]["orden"];

			$valores_regreso["respuesta"]=FALSE;
			$valores_regreso["msj"]="Ya existe el número".$id_existense.". Captura otro número.";

		}
		else{

			$id=$mysql->update_individual("orden","producto",$_POST["orden_id"],["id_categoria"=>$_POST["id_categoria"],"id_clase"=>$_POST["id_clase"],"id_producto"=>$_POST["id"]]);
			$valores_regreso["respuesta"]=TRUE;
			$valores_regreso["msj"]="Se ha cambiado  ".$_POST["orden_id"].".";
		}

		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	
		
		break;


	}


?>










