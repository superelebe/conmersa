<?php

error_reporting(0);


 $path ="../../";

include($path."admin/incluir/config.php");
include($path."admin/incluir/class_mysqli.php");
include($path."admin/incluir/funciones.php");

$seccion = $_POST["seccion"];

$mysql= new Con_mysqli;

$id_clase=$_POST["id_clase"];
$id_categoria=$_POST["id_categoria"];
$id_producto=$_POST["id_producto"];

// var_dump($id_clase);


switch($seccion)
{

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// C _ L _ A _ S _ E //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
	case 'inicio':	
		
		
		$data_sector=$mysql->consulta("SELECT * FROM sector ORDER BY nombre ASC ");
  		$data_tipo=$mysql->consulta("SELECT * FROM tipo ORDER BY nombre ASC");
  		$data_ciudad=$mysql->consulta("SELECT * FROM municipio ORDER BY nombre ASC");
  		$data_marca=$mysql->consulta("SELECT * FROM marca");
  
		$data_img_logo=$mysql->consulta("SELECT * FROM imagenes_logotipo");	
  
      	$data_img_lifestyle=$mysql->consulta("SELECT * FROM imagenes_lifestyle");
  
      	$data_img_fondo=$mysql->consulta("SELECT * FROM imagenes_fondo");


      	foreach ($data_marca as $key => $value) {
      		// var_dump($value);
      		if ($value["id_concepto"] != 0) {

      			$img_logo_data =multidimensional_search_array($data_img_logo,["id_marca"=>$value["id_marca"]]);
          
	          	$img_lifestyle_data =multidimensional_search_array($data_img_lifestyle,["id_marca"=>$value["id_marca"]]);
	  
	         	$img_fondo_data =multidimensional_search_array($data_img_fondo,["id_marca"=>$value["id_marca"]]);
	  
	         	$tipo =multidimensional_search_array($data_tipo,["id_tipo"=>$value["id_tipo"]]);
	  
	          	$ciudad =multidimensional_search_array($data_ciudad,["id_ciudad"=>$value["id_ciudad"]]);
	  
	          	$sector=multidimensional_search_array($data_sector,["id_sector"=>$value["id_sector"]]);
	  
	  
	          
		        $data_inicio[$key]=$value;
		        $data_inicio[$key]["logotipo"]=$img_logo_data;
		        $data_inicio[$key]["lifestyle"]=$img_lifestyle_data;
		        $data_inicio[$key]["fondo"]=$img_fondo_data;
		        $data_inicio[$key]["tipo"]=$tipo;
		        $data_inicio[$key]["sector"]=$sector;
		        $data_inicio[$key]["ciudad"]=$ciudad;
      		}
        
          
          
    }
  
		$data["lista"]=$data_inicio;

		
	break;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// C _ L _ A _ S _ E //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
	case 'todos':	
		
		
		$data_sector=$mysql->consulta("SELECT * FROM sector ORDER BY nombre ASC ");
  		$data_tipo=$mysql->consulta("SELECT * FROM tipo ORDER BY nombre ASC");
  		$data_ciudad=$mysql->consulta("SELECT * FROM municipio ORDER BY nombre ASC");
  		$data_marca=$mysql->consulta("SELECT * FROM marca ORDER BY nombre");
  
		$data_img_logo=$mysql->consulta("SELECT * FROM imagenes_logotipo");	
  
      	$data_img_lifestyle=$mysql->consulta("SELECT * FROM imagenes_lifestyle");
  
      	$data_img_fondo=$mysql->consulta("SELECT * FROM imagenes_fondo");


      	foreach ($data_marca as $key => $value) {
      		

      			$img_logo_data =multidimensional_search_array($data_img_logo,["id_marca"=>$value["id_marca"]]);
          
	          	$img_lifestyle_data =multidimensional_search_array($data_img_lifestyle,["id_marca"=>$value["id_marca"]]);
	  
	         	$img_fondo_data =multidimensional_search_array($data_img_fondo,["id_marca"=>$value["id_marca"]]);
	  
	         	$tipo =multidimensional_search_array($data_tipo,["id_tipo"=>$value["id_tipo"]]);
	  
	          	$ciudad =multidimensional_search_array($data_ciudad,["id_ciudad"=>$value["id_ciudad"]]);
	  
	          	$sector=multidimensional_search_array($data_sector,["id_sector"=>$value["id_sector"]]);
	  
	  
	          
		        $data_inicio[$key]=$value;
		        $data_inicio[$key]["logotipo"]=$img_logo_data;
		        $data_inicio[$key]["lifestyle"]=$img_lifestyle_data;
		        $data_inicio[$key]["fondo"]=$img_fondo_data;
		        $data_inicio[$key]["tipo"]=$tipo;
		        $data_inicio[$key]["sector"]=$sector;
		        $data_inicio[$key]["ciudad"]=$ciudad;
          
    }
  
		$data["lista"]=$data_inicio;

		
	break;
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// C - A - T - E - G - O - R - I - A //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
	case 'sector':	
	// var_dump($_POST["id_clase"]);
		$sector=$_POST["id_clase"];

		$data_sector=$mysql->consulta("SELECT * FROM sector ORDER BY nombre ASC ");
  		$data_tipo=$mysql->consulta("SELECT * FROM tipo ORDER BY nombre ASC");
  		$data_ciudad=$mysql->consulta("SELECT * FROM municipio ORDER BY nombre ASC");
  		$data_marca=$mysql->consulta("SELECT * FROM marca WHERE id_sector='".$sector."' ORDER BY id_ciudad ");  
		$data_img_logo=$mysql->consulta("SELECT * FROM imagenes_logotipo");	
  
      	$data_img_lifestyle=$mysql->consulta("SELECT * FROM imagenes_lifestyle");
  
      	$data_img_fondo=$mysql->consulta("SELECT * FROM imagenes_fondo");


      	foreach ($data_marca as $key => $value) {
      		// var_dump($value);
      		


      			$img_logo_data =multidimensional_search_array($data_img_logo,["id_marca"=>$value["id_marca"]]);
          
	          	$img_lifestyle_data =multidimensional_search_array($data_img_lifestyle,["id_marca"=>$value["id_marca"]]);
	  
	         	$img_fondo_data =multidimensional_search_array($data_img_fondo,["id_marca"=>$value["id_marca"]]);
	  
	         	$tipo =multidimensional_search_array($data_tipo,["id_tipo"=>$value["id_tipo"]]);
	  
	          	$ciudad =multidimensional_search_array($data_ciudad,["id_ciudad"=>$value["id_ciudad"]]);
	  
	          	$sector=multidimensional_search_array($data_sector,["id_sector"=>$value["id_sector"]]);
	  
	  
	          
		        $data_inicio[$key]=$value;
		        $data_inicio[$key]["logotipo"]=$img_logo_data;
		        $data_inicio[$key]["lifestyle"]=$img_lifestyle_data;
		        $data_inicio[$key]["fondo"]=$img_fondo_data;
		        $data_inicio[$key]["tipo"]=$tipo;
		        $data_inicio[$key]["sector"]=$sector;
		        $data_inicio[$key]["ciudad"]=$ciudad;
      		

          
          
    }
  
		$data["lista"]=$data_inicio;

		
	break;

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// P - R - O - D - U - C - T - O - //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
	case 'tipo':
		$tipo=$_POST["id_categoria"];

		$data_sector=$mysql->consulta("SELECT * FROM sector ORDER BY nombre ASC ");
  		$data_tipo=$mysql->consulta("SELECT * FROM tipo ORDER BY nombre ASC");
  		$data_ciudad=$mysql->consulta("SELECT * FROM municipio ORDER BY nombre ASC");
  		$data_marca=$mysql->consulta("SELECT * FROM marca WHERE id_tipo='".$tipo."' ORDER BY id_ciudad ");  
		$data_img_logo=$mysql->consulta("SELECT * FROM imagenes_logotipo");	
  
      	$data_img_lifestyle=$mysql->consulta("SELECT * FROM imagenes_lifestyle");
  
      	$data_img_fondo=$mysql->consulta("SELECT * FROM imagenes_fondo");


      	foreach ($data_marca as $key => $value) {
      		// var_dump($value);
      		


      			$img_logo_data =multidimensional_search_array($data_img_logo,["id_marca"=>$value["id_marca"]]);
          
	          	$img_lifestyle_data =multidimensional_search_array($data_img_lifestyle,["id_marca"=>$value["id_marca"]]);
	  
	         	$img_fondo_data =multidimensional_search_array($data_img_fondo,["id_marca"=>$value["id_marca"]]);
	  
	         	$tipo =multidimensional_search_array($data_tipo,["id_tipo"=>$value["id_tipo"]]);
	  
	          	$ciudad =multidimensional_search_array($data_ciudad,["id_ciudad"=>$value["id_ciudad"]]);
	  
	          	$sector=multidimensional_search_array($data_sector,["id_sector"=>$value["id_sector"]]);
	  
	  
	          
		        $data_inicio[$key]=$value;
		        $data_inicio[$key]["logotipo"]=$img_logo_data;
		        $data_inicio[$key]["lifestyle"]=$img_lifestyle_data;
		        $data_inicio[$key]["fondo"]=$img_fondo_data;
		        $data_inicio[$key]["tipo"]=$tipo;
		        $data_inicio[$key]["sector"]=$sector;
		        $data_inicio[$key]["ciudad"]=$ciudad;
      		

          
          
    }
  
		$data["lista"]=$data_inicio;

		
	break;



	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// S - E - A - R - C - H -  I - N - G  - //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
	case 'marca':
		$tipo=$_POST["id_marca"];

		$data_sector=$mysql->consulta("SELECT * FROM sector ORDER BY nombre ASC ");
  		$data_tipo=$mysql->consulta("SELECT * FROM tipo ORDER BY nombre ASC");
  		$data_ciudad=$mysql->consulta("SELECT * FROM municipio ORDER BY nombre ASC");
  		$data_marca=$mysql->consulta("SELECT * FROM marca WHERE id_marca='".$tipo."' ORDER BY id_ciudad ");  

		$data_img_logo=$mysql->consulta("SELECT * FROM imagenes_logotipo");	
  
      	$data_img_lifestyle=$mysql->consulta("SELECT * FROM imagenes_lifestyle");
  
      	$data_img_fondo=$mysql->consulta("SELECT * FROM imagenes_fondo");


      	foreach ($data_marca as $key => $value) {
      		// var_dump($value);
      		


      			$img_logo_data =multidimensional_search_array($data_img_logo,["id_marca"=>$value["id_marca"]]);
          
	          	$img_lifestyle_data =multidimensional_search_array($data_img_lifestyle,["id_marca"=>$value["id_marca"]]);
	  
	         	$img_fondo_data =multidimensional_search_array($data_img_fondo,["id_marca"=>$value["id_marca"]]);
	  
	         	$tipo =multidimensional_search_array($data_tipo,["id_tipo"=>$value["id_tipo"]]);
	  
	          	$ciudad =multidimensional_search_array($data_ciudad,["id_ciudad"=>$value["id_ciudad"]]);
	  
	          	$sector=multidimensional_search_array($data_sector,["id_sector"=>$value["id_sector"]]);
	  
	  
	          
		        $data_inicio[$key]=$value;
		        $data_inicio[$key]["logotipo"]=$img_logo_data;
		        $data_inicio[$key]["lifestyle"]=$img_lifestyle_data;
		        $data_inicio[$key]["fondo"]=$img_fondo_data;
		        $data_inicio[$key]["tipo"]=$tipo;
		        $data_inicio[$key]["sector"]=$sector;
		        $data_inicio[$key]["ciudad"]=$ciudad;
      		

          
          
    }
  
		$data["lista"]=$data_inicio;

		
	break;


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// S - E - A - R - C - H -  I - N - G  - //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
	case 'ciudad':
		$tipo=$_POST["id_ciudad"];

		$data_sector=$mysql->consulta("SELECT * FROM sector ORDER BY nombre ASC ");
  		$data_tipo=$mysql->consulta("SELECT * FROM tipo ORDER BY nombre ASC");
  		$data_ciudad=$mysql->consulta("SELECT * FROM municipio ORDER BY nombre ASC");
  		$data_marca=$mysql->consulta("SELECT * FROM marca WHERE id_ciudad='".$tipo."' ORDER BY nombre ");  

		$data_img_logo=$mysql->consulta("SELECT * FROM imagenes_logotipo");	
  
      	$data_img_lifestyle=$mysql->consulta("SELECT * FROM imagenes_lifestyle");
  
      	$data_img_fondo=$mysql->consulta("SELECT * FROM imagenes_fondo");


      	foreach ($data_marca as $key => $value) {
      		// var_dump($value);
      		


      			$img_logo_data =multidimensional_search_array($data_img_logo,["id_marca"=>$value["id_marca"]]);
          
	          	$img_lifestyle_data =multidimensional_search_array($data_img_lifestyle,["id_marca"=>$value["id_marca"]]);
	  
	         	$img_fondo_data =multidimensional_search_array($data_img_fondo,["id_marca"=>$value["id_marca"]]);
	  
	         	$tipo =multidimensional_search_array($data_tipo,["id_tipo"=>$value["id_tipo"]]);
	  
	          	$ciudad =multidimensional_search_array($data_ciudad,["id_ciudad"=>$value["id_ciudad"]]);
	  
	          	$sector=multidimensional_search_array($data_sector,["id_sector"=>$value["id_sector"]]);
	  
	  
	          
		        $data_inicio[$key]=$value;
		        $data_inicio[$key]["logotipo"]=$img_logo_data;
		        $data_inicio[$key]["lifestyle"]=$img_lifestyle_data;
		        $data_inicio[$key]["fondo"]=$img_fondo_data;
		        $data_inicio[$key]["tipo"]=$tipo;
		        $data_inicio[$key]["sector"]=$sector;
		        $data_inicio[$key]["ciudad"]=$ciudad;
      		

          
          
    }
  
		$data["lista"]=$data_inicio;

		
	break;



	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// P - R - O - D - U - C - T - O - //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
	case 'producto':	

	

	break;
}
	
$valores_regreso = json_encode($data,JSON_UNESCAPED_SLASHES);
				
		echo $valores_regreso;


?>