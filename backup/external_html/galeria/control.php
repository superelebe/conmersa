<?php
	
	error_reporting(0);

	include("../../admin/incluir/config.php");
	include("../../admin/incluir/class_mysqli.php");
	include("../../admin/incluir/funciones.php");

	$mysql= new Con_mysqli;






	$valores_regreso["lista_tipos"]=$mysql->consulta("SELECT * FROM tipo_galeria ORDER BY orden");
	$valores_regreso["lista_fotos"]=$mysql->consulta("SELECT * FROM galeria ORDER BY tipo");

	$valores_regreso["lista_fotos"]=$mysql->consulta("SELECT * FROM galeria INNER JOIN imagenes_galeria ON galeria.id_galeria=imagenes_galeria.id_galeria ORDER BY galeria.orden");


	
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