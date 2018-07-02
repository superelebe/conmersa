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
//---////---// B _ O _ R _ R _ A _ R //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//		

		case 'borrar_clase':	


			$id_doc=$_POST['id'];
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {

	        	$file_data=$mysql->consulta("SELECT * FROM imagenes_clase WHERE id_clase ='".$id_doc."'");

	        	if (!empty($file_data)) {	        	
	        		foreach ($file_data as $key => $value) {
		        		$del_advise=$mysql->delete_files_individual($value["file_name"],$dir_name);

		        		if ($del_advise["respuesta"]) {
		        			$id=$mysql->delete_individual("imagenes_clase",["id_imagen"=>$value["id_imagen"]]);
		        		}

		        		if ($id) {
		    				$ruta="files/clase/".$id_doc;
							eliminarDir($ruta);
		        			$id=$mysql->delete_individual("clase",["id_clase"=>$id_doc]);

		        			if ($id) {
		        				$valores_regreso=array(
									'id' => $id_doc ,
									'respuesta' => true,
									'advise'=>"<h3>La Clase se ha borrado con éxito.</h3>"
								);
		        			}
		        		}
		        		else
			            {
			            	$valores_regreso=array(
								'id' => $id_doc ,
								'respuesta' => false,
								'advise'=>"<h3>hubo un problema al borrar la clase, intentalo otra vez o comunicate con el administrador.</h3>"
							);
			            }	
	        		}

	    		}
	    		else{
	    			$ruta="files/clase/".$id_doc;
					eliminarDir($ruta);
        			$id_noimg=$mysql->delete_individual("clase",["id_clase"=>$id_doc]);

        			if ($id_noimg) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La Clase se ha borrado con éxito.</h3>"
						);
        			}
        			else
        			{
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>hubo un problema al borrar la clase, intentalo otra vez o comunicate con el administrador.</h3>"
						);
        			}

	    		}
        		
	            
            }
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	

///////////////////////////////////////////////////////////////////////////////////////// B O R R A R -- C A T E G O R I A - /////////	
	case 'editar_clase_foto':	

			$dato=$_POST['id'];
		    
		    $dir_name = ''; 

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('imagenes_clase',["id_imagen"=>$dato]);

	        
	            $del_advise=$mysql->delete_files_individual($file_data->thumb,$dir_name);

	            if ($del_advise["respuesta"]) {
	            	// var_dump($del_advise);

	            	$del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            	
	            	if ($del_advise["respuesta"]) {
	            		// echo "<br>del advise 2<br>";
	            		// var_dump($del_advise);
	            		$id=$mysql->delete_individual("imagenes_clase",["id_imagen"=>$dato]);
	    
	            		$valores_regreso=array(
							'id_imagen' => $dato,
							'id'=>$file_data->id_clase,
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

///////////////////////////////////////////////////////////////////////////////////////// B O R R A R -- C A T E G O R I A - /////////		
		case 'borrar_categoria':	

			$id_doc=$_POST['id'];
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {

	        	$file_data=$mysql->consulta("SELECT * FROM imagenes_categoria WHERE id_categoria ='".$id_doc."'");

	        	if (!empty($file_data)) 
	        	{	        	
	        		foreach ($file_data as $key => $value) {
		        		$del_advise=$mysql->delete_files_individual($value["file_name"],$dir_name);

		        		if ($del_advise["respuesta"]) {
		        			$id=$mysql->delete_individual("imagenes_categoria",["id_imagen"=>$value["id_imagen"]]);
		        		}	
	        		}
	        		if ($id) {
	    				$ruta="files/categoria/".$id_doc;
						eliminarDir($ruta);
	        			$id=$mysql->delete_individual("categoria",["id_categoria"=>$id_doc]);

	        			if ($id) {
	        				$valores_regreso=array(
								'id' => $id_doc ,
								'respuesta' => true,
								'advise'=>"<h3>La Clase se ha borrado con éxito.</h3>"
							);
	        			}
	        		}
	        		else
		            {
		            	$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>hubo un problema al borrar la clase, intentalo otra vez o comunicate con el administrador.</h3>"
						);
		            }
		            

		    	}
		    	else
		    	{
		    		$ruta="files/suela/".$id_doc;
					eliminarDir($ruta);
        			$id=$mysql->delete_individual("suela",["id_suela"=>$id_doc]);

        			if ($id) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La Clase se ha borrado con éxito.</h3>"
						);
        			}
		    	}
        		
            }
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	





			// $id_doc=$_POST['id'];
		   
	  //       if($id_doc!='' || $id_doc!=NULL)
	  //       {

	  //       	$file_data=$mysql->consulta("SELECT * FROM imagenes_categoria WHERE id_categoria ='".$id_doc."'");

	  //       	if (!empty($file_data)) {	        	
	  //       		foreach ($file_data as $key => $value) {
		 //        		$del_advise=$mysql->delete_files_individual($value["file_name"],$dir_name);

		 //        		if ($del_advise["respuesta"]) {
		 //        			$id=$mysql->delete_individual("imagenes_categoria",["id_imagen"=>$value["id_imagen"]]);
		 //        		}

		 //        		if ($id) {
		 //    				$ruta="files/categoria/".$id_doc;
			// 				eliminarDir($ruta);
		 //        			$id=$mysql->delete_individual("categoria",["id_categoria"=>$id_doc]);

		 //        			if ($id) {
		 //        				$valores_regreso=array(
			// 						'id' => $id_doc ,
			// 						'respuesta' => true,
			// 						'advise'=>"<h3>La Categoría se ha borrado con éxito.</h3>"
			// 					);
		 //        			}
		 //        		}
		 //        		else
			//             {
			//             	$valores_regreso=array(
			// 					'id' => $id_doc ,
			// 					'respuesta' => false,
			// 					'advise'=>"<h3>hubo un problema al borrar la categoría, intentalo otra vez o comunicate con el administrador.</h3>"
			// 				);
			//             }	
	  //       		}

	  //   		}
	  //   		else{
	  //   			$ruta="files/categoria/".$id_doc;
			// 		eliminarDir($ruta);		
   //      			$id_noimg=$mysql->delete_individual("categoria",["id_categoria"=>$id_doc]);

   //      			if ($id_noimg) {
   //      				$valores_regreso=array(
			// 				'id' => $id_doc ,
			// 				'respuesta' => true,
			// 				'advise'=>"<h3>La Categoría se ha borrado con éxito.</h3>"
			// 			);
   //      			}
   //      			else
   //      			{
   //      				$valores_regreso=array(
			// 				'id' => $id_doc ,
			// 				'respuesta' => false,
			// 				'advise'=>"<h3>hubo un problema al borrar la categoría, intentalo otra vez o comunicate con el administrador.</h3>"
			// 			);
   //      			}

	  //   		}
        		
	            
   //          }
            

			// $valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			// echo $valores_regreso;	

		break;	


///////////////////////////////////////////////////////////////////////////////////////// B O R R A R -- F O T O  - C A T E G O R I A - /////////	
	case 'editar_categoria_foto':	


	// echo 'mmmmmm';
	// echo "<pre>";
	// var_dump($_POST);
	// // var_dump($_FILES);
	// // var_dump($_SESSION);
	// echo "</pre>";


			$dato=$_POST['id'];
		    
		    $dir_name = ''; 

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('imagenes_categoria',["id_imagen"=>$dato]);

	        
	            $del_advise=$mysql->delete_files_individual($file_data->thumb,$dir_name);

	            if ($del_advise["respuesta"]) {
	            	// var_dump($del_advise);

	            	$del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            	
	            	if ($del_advise["respuesta"]) {
	            		// echo "<br>del advise 2<br>";
	            		// var_dump($del_advise);
	            		$id=$mysql->delete_individual("imagenes_categoria",["id_imagen"=>$dato]);
	    
	            		$valores_regreso=array(
							'id_imagen' => $dato,
							'id'=>$file_data->id_categoria,
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

///////////////////////////////////////////////////////////////////////////////////////// B O R R A R -- C A T E G O R I A - /////////		
			case 'borrar_suela':	


			$id_doc=$_POST['id'];
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {

	        	$file_data=$mysql->consulta("SELECT * FROM imagenes_suela WHERE id_suela ='".$id_doc."'");

	        	if (!empty($file_data)) 
	        	{	        	
	        		foreach ($file_data as $key => $value) {
		        		$del_advise=$mysql->delete_files_individual($value["file_name"],$dir_name);

		        		if ($del_advise["respuesta"]) {
		        			$id=$mysql->delete_individual("imagenes_suela",["id_imagen"=>$value["id_imagen"]]);
		        		}	
	        		}
	        		if ($id) {
	    				$ruta="files/suela/".$id_doc;
						eliminarDir($ruta);
	        			$id=$mysql->delete_individual("suela",["id_suela"=>$id_doc]);

	        			if ($id) {
	        				$valores_regreso=array(
								'id' => $id_doc ,
								'respuesta' => true,
								'advise'=>"<h3>La Clase se ha borrado con éxito.</h3>"
							);
	        			}
	        		}
	        		else
		            {
		            	$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>hubo un problema al borrar la clase, intentalo otra vez o comunicate con el administrador.</h3>"
						);
		            }
		            

		    	}
		    	else
		    	{
		    		$ruta="files/suela/".$id_doc;
					eliminarDir($ruta);
        			$id=$mysql->delete_individual("suela",["id_suela"=>$id_doc]);

        			if ($id) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>La Clase se ha borrado con éxito.</h3>"
						);
        			}
		    	}
        		
            }
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	


///////////////////////////////////////////////////////////////////////////////////////// B O R R A R -- F O T O  - C A T E G O R I A - /////////	
	case 'editar_suela_foto':	

			$dato=$_POST['id'];
		    
		    $dir_name = ''; 

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('imagenes_suela',["id_imagen"=>$dato]);

	//         	echo "<pre>";
	// var_dump($file_data->id_suela);
	// // var_dump($_FILES);
	// // var_dump($_SESSION);
	// echo "</pre>";

	        
	            $del_advise=$mysql->delete_files_individual($file_data->thumb,$dir_name);

	            if ($del_advise["respuesta"]) {
	            	// var_dump($del_advise);

	            	$del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            	
	            	if ($del_advise["respuesta"]) {
	            		// echo "<br>del advise 2<br>";
	            		// var_dump($del_advise);
	            		$id=$mysql->delete_individual("imagenes_suela",["id_imagen"=>$dato]);
	    
	            		$valores_regreso=array(
							'id_imagen' => $dato,
							'id'=>$file_data->id_suela,
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



///////////////////////////////////////////////////////////////////////////////////////// B O R R A R -- C A T E G O R I A - /////////		
		case 'borrar_producto':	

			$id_doc=$_POST['id'];
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {

	        	$file_data=$mysql->consulta("SELECT * FROM imagenes_producto WHERE id_producto ='".$id_doc."'");

	        	if (!empty($file_data)) {	        	

	        		foreach ($file_data as $key => $value) {
		        		
		        		$del_advise=$mysql->delete_files_individual($value["file_name"],$dir_name);

		        		if ($del_advise["respuesta"]) {
		        			$id=$mysql->delete_individual("imagenes_producto",["id_imagen"=>$value["id_imagen"]]);
		        		}
		        		else{
		        			$valores_regreso=array(
									'id' => $id_doc ,
									'respuesta' => false,
									'advise'=>"<h3>Hubo un problema en el proceso de borrado de imagenes.</h3>"
								);
		        		}

		        		if ($id) {
		    				$ruta="files/producto/".$id_doc;
							eliminarDir($ruta);
		        			$id=$mysql->delete_individual("producto",["id_producto"=>$id_doc]);

		        			if ($id) {
		        				$id_del_suela=$mysql->delete_individual("suela_producto",["id_producto"=>$id_doc]);
		        				if($id_del_suela)
		        				{
		        					$valores_regreso=array(
										'id' => $id_doc ,
										'respuesta' => true,
										'advise'=>"<h3>El Producto se ha borrado con éxito.</h3>"
									);
		        				}
		        				else
		        				{
		        					$valores_regreso=array(
										'id' => $id_doc ,
										'respuesta' => false,
										'advise'=>"<h3>hubo un problema al borrar el registro de las suelas del producto, intentalo otra vez o comunicate con el administrador.</h3>"
									);
		        				}
		        			}
		        			else
		        			{
		        				$valores_regreso=array(
									'id' => $id_doc ,
									'respuesta' => false,
									'advise'=>"<h3>hubo un problema al borrar el registro del producto, intentalo otra vez o comunicate con el administrador.</h3>"
								);
		        			}
		        		}
		        		else
			            {
			            	$valores_regreso=array(
								'id' => $id_doc ,
								'respuesta' => false,
								'advise'=>"<h3>hubo un problema al borrar el producto, intentalo otra vez o comunicate con el administrador.</h3>"
							);
			            }	
	        		}

	    		}
	    		else{
	    			$ruta="files/producto/".$id_doc;
					eliminarDir($ruta);
        			$id_noimg=$mysql->delete_individual("producto",["id_producto"=>$id_doc]);

        			if ($id_noimg) {
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => true,
							'advise'=>"<h3>El Producto no tenia imagenes y se ha borrado con éxito.</h3>"
						);
        			}
        			else
        			{
        				$valores_regreso=array(
							'id' => $id_doc ,
							'respuesta' => false,
							'advise'=>"<h3>Hubo un problema al borrar el producto sin imagenes, intentalo otra vez o comunicate con el administrador.</h3>"
						);
        			}

	    		}
        		
	            
            }
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	




///////////////////////////////////////////////////////////////////////////////////////// B O R R A R -- F O T O  - C A T E G O R I A - /////////	
	case 'borrar_producto_foto':	


	// echo 'mmmmmm';
	// echo "<pre>";
	// var_dump($_POST);
	// // var_dump($_FILES);
	// // var_dump($_SESSION);
	// echo "</pre>";


			$dato=$_POST['id'];
		    
		    $dir_name = ''; 

	        if($dato!='' || $dato!=NULL){

	        	$file_data=$mysql->consulta_global('imagenes_producto',["id_imagen"=>$dato]);

	        
	            $del_advise=$mysql->delete_files_individual($file_data->thumb,$dir_name);

	            if ($del_advise["respuesta"]) {
	            	// var_dump($del_advise);

	            	$del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
	            	
	            	if ($del_advise["respuesta"]) {
	            		// echo "<br>del advise 2<br>";
	            		// var_dump($del_advise);
	            		$id=$mysql->delete_individual("imagenes_producto",["id_imagen"=>$dato]);
	    
	            		$valores_regreso=array(
							'id' => $dato,
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

///////////////////////////////////////////////////////////////////////////////////////// B O R R A R -- F O T O  - C A T E G O R I A - /////////	

		case 'borrar_suela_producto':	


			$id_doc=$_POST['id'];
		   
	        if($id_doc!='' || $id_doc!=NULL)
	        {

    			$id_noimg=$mysql->delete_individual("suela_producto",["id_suela"=>$id_doc]);

    			if ($id_noimg) {
    				$valores_regreso=array(
						'id' => $id_doc ,
						'respuesta' => true,
						'advise'=>"<h3>La Clase se ha borrado con éxito.</h3>"
					);
    			}
    			else
    			{
    				$valores_regreso=array(
						'id' => $id_doc ,
						'respuesta' => false,
						'advise'=>"<h3>hubo un problema al borrar la clase, intentalo otra vez o comunicate con el administrador.</h3>"
					);
    			}

	    		
        		
	            
            }
            

			$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
			echo $valores_regreso;	

		break;	





	}


?>










