<?php
	
	// error_reporting(0);

	include("../../admin/incluir/config.php");
	include("../../admin/incluir/class_mysqli.php");
	include("../../admin/incluir/funciones.php");

	$mysql= new Con_mysqli;





	$valores_regreso["info"]=$mysql->consulta("SELECT * FROM seccion_inicio");
	$valores_regreso["info"]=$valores_regreso["info"][0];
	$valores_regreso["imagenes"]=$mysql->consulta("SELECT * FROM imagenes_sinicio");


	
	//$valores_regreso=array(
	//	'id_banner' => "1", 
	//	'nombre' => "hola",
	//	'url'=>"url",
	//	'file_name'=>"asldnasdjk.jpg"
	//);

	//	$valores_regreso=array(
    //   	'id_banner'=>"1",
    //    	'nombre'=>"banner1",
    //   	'url'=>"images/ba1.png",
    //   	'file_name'=>"banner1.png"
    //   	);




		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	
		



?>