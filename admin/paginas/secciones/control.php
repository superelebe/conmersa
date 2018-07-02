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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// R E M O V   I M A  G E//---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function remove_img($bd , $mysql){

				$dato=$_POST['id'];

			    $dir_name='';

		        if($dato!='' || $dato!=NULL){

		        	$file_data=$mysql->consulta_global($bd,["id_imagen"=>$dato]);

		            $del_advise=$mysql->delete_files_individual($file_data->file_name,$dir_name);
		            	
		            	if ($del_advise["respuesta"]) {

		            		$id=$mysql->delete_individual($bd,["id_imagen"=>$dato]);
		    
		            		$valores_regreso=array(
								'id_imagen' => $dato,
								'id'=>$file_data->id_categoria,
								'respuesta' => $del_advise["respuesta"],
								'advise'=>$del_advise["msj"]
							);
		            	}	
		            	else
		            	{
		            		$valores_regreso=array(			
							'id' => $dato ,
							'respuesta' => $del_advise["respuesta"],
							'advise'=>$del_advise["msj"]
							);

		            	}
		            	return $valores_regreso;

		        }	

	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	switch($_POST["seccion"])
	{


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// N - U - E - V - O //---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---////---//
		case 'inicio':

			$valores_regreso=array();

			$data=$mysql->consulta("SELECT * FROM seccion_inicio");
			

			$db_data='seccion_inicio';

			$name_dir="files/seccion_inicio/";	
					
			$first_value = reset($_FILES);


			$data_send= array(
				"id_sinicio"=>1,
				"titulo_principal"=>$_POST["titulo_principal"],
				"titulo_principal_ingles"=>$_POST["titulo_principal_ingles"],
				"titulo_izq"=>$_POST["titulo_izq"],
				"titulo_izq_ingles"=>$_POST["titulo_izq_ingles"],
				"p_izq"=>$_POST["p_izq"],
				"p_izq_ingles"=>$_POST["p_izq_ingles"],
				"titulo_der"=>$_POST["titulo_der"],
				"titulo_der_ingles"=>$_POST["titulo_der_ingles"],
				"p_der"=>$_POST["p_der"],
				"p_der_ingles"=>$_POST["p_der_ingles"],
				"youtube_link"=>$_POST["youtube_link"],
			);

			$id=$mysql->data_update($data_send, "seccion_inicio", ["id_sinicio"=>1]);	

			$valores_regreso=$data_send;
			$valores_regreso["respuesta"]=true;
			
			$dir_name="files/seccion_inicio/";




			if (!empty($_FILES['principal']['name'])) 
			{

				$valores_regreso["imagenes"][0]=$mysql->upload_files_individual($_FILES['principal'],$dir_name,"images", 50000000, ["id_sinicio"=>1,"id_imagen"=>1],"imagenes_sinicio");

				$valores_regreso["imagenes"][0]['file_name']=$dir_name.$valores_regreso["imagenes"][0]['file'];
				$valores_regreso["imagenes"][0]['id_imagen']=$valores_regreso["imagenes"][0]['id_foto'];
			}
			else{

				$valores_regreso["imagenes"][0]['respuesta']=false;	
			
			}

			if (!empty($_FILES['youtube']['name'])) 
			{


				$valores_regreso["imagenes"][1]=$mysql->upload_files_individual($_FILES['youtube'],$dir_name,"images", 50000000, ["id_sinicio"=>1,"id_imagen"=>2],"imagenes_sinicio");

				$valores_regreso["imagenes"][1]['file_name']=$dir_name.$valores_regreso["imagenes"][1]['file'];
				$valores_regreso["imagenes"][1]['id_imagen']=$valores_regreso["imagenes"][1]['id_foto'];

			
			}
			else{

				$valores_regreso["imagenes"][1]['respuesta']=false;	
			
			}

			
		break;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//---////---////---////---////---////---////---////---////---////---////---//
//---////---// B _ O _ R _ R _ A _ R  ++++  I - M - A - G - E - N//---////---////---////---////---////---//  categoria
//		--////---////---////---////---////---////---////---////---////---////---////---//	
//---////---////---////---////---////---////---////---////---////---////---//	
		case 'borrar_img':	
		
		
		$valores_regreso=remove_img($_POST["data"], $mysql);

		

		break;	



	}


	$valores_regreso = json_encode($valores_regreso,JSON_UNESCAPED_SLASHES);
				
	echo $valores_regreso;	


?>










