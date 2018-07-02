<?php
	
	// error_reporting(0);

	include("../../admin/incluir/config.php");
	include("../../admin/incluir/class_mysqli.php");
	include("../../admin/incluir/funciones.php");

	$mysql= new Con_mysqli;





	// $valores_regreso["info"]=$mysql->consulta("SELECT * FROM servicios");
	// $valores_regreso["info"]=$valores_regreso["info"][0];
	// $valores_regreso["imagenes"]=$mysql->consulta("SELECT * FROM imagenes_sinicio");

	
  		
  		
  		$data_servicios=$mysql->consulta("SELECT * FROM servicio ORDER BY orden");
  
		$data_img_prin=$mysql->consulta("SELECT * FROM imagenes_principal");	
  
      	$data_img_servicios=$mysql->consulta("SELECT * FROM imagenes_servicio");


      	$data_categoria = array( 
      		0 => array('id_categoria' => 1, 'nombre' => 'Servicios Generales') , 
      		1 => array('id_categoria' => 2, 'nombre' => 'Servicios de Mercadotecnia') 
      	);



      	foreach ($data_servicios as $key => $value) {
      		

      			$img_prin_data =multidimensional_search_array($data_img_prin,["id_servicio"=>$value["id_servicio"]]);

      			$img_data =multidimensional_search_multiarray($data_img_servicios,["id_servicio"=>$value["id_servicio"]]);
          

	          	$categoria=multidimensional_search_array($data_categoria,["id_categoria"=>$value["id_categoria"]]);
	    
		        $data_inicio['servicios'][$key]=$value;
		        $data_inicio['servicios'][$key]["principal"]=$img_prin_data;
		        $data_inicio['servicios'][$key]["imagenes"]=$img_data;
		        $data_inicio['servicios'][$key]["categoria"]=$categoria['nombre'];
    }
  		
  		$img_prin =multidimensional_search_array($data_img_prin,["id_servicio"=>0, 'ingles'=>0]);
  		$img_prin_ingles=multidimensional_search_array($data_img_prin,["id_servicio"=>0, 'ingles'=>1]);

  		$data_inicio['principal_servicio']=$img_prin;
  		$data_inicio['principal_servicio_ingles']=$img_prin_ingles;
    	


		$valores_regreso=$data_inicio;



		$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
			
		echo $valores_regreso;	
		



?>