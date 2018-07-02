<?
	// @session_start();
	$id=$_GET["id"];
	if ($id!="" || $id!= NULL ) {
		
		 $proyecto_data=$mysql->consulta_global("vacante",["id"=>$id]);

		 // $imagen_data=$mysql->consulta("SELECT * FROM imagenes_noticia WHERE id_noticia='".$id."'");
	}

	$tipo=$mysql->consulta_individual("nombre","tipo_vacante",["id"=>$proyecto_data->tipo]);
	// echo "destacado".$proyecto_data->destacado;
	// echo "<pre>";
	// var_dump($tipo);
	// echo "</pre>";

?>
      <!-- VALIDATOR -->
<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
<script src="js/validation/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<br/>
<br/>
<br/>


	
		
	<div class="col-xs-10" id="respuesta" style="">
		
		<h1 class="color"> Tu noticia se ha actualizado</h1>	
		<br>
			<br>	

	</div>





	<div class="col-xs-3">
	</div>
		
		<div class=" cont_form col-xs-6" style=" position:relative; display:block; width=50%;">

		<form id="form_one" name="form1" method="post" action="nuevo.php"  enctype="multipart/form-data">
				
			  <input name="seccion" type="text" value="vacante" hidden/>

			<input name="id" type="text" value="<?=$id?>" hidden/>
			<div class="columna_1">
			

				 <h6>Título:</h6>
				<input name="titulo" class="validate[required]" type="text" maxlength="200" value="<?=$proyecto_data->titulo?>"/>
			
				<label class="tdLabel "><h6>Puesto:</h6></label>
				<input name="subtitulo" class="validate[required]" type="text" maxlength="200" value="<?=$proyecto_data->puesto?>"/>

				<label class="tdLabel "><h6>Sueldo:</h6></label>
				<input name="sueldo" class="validate[required]" type="text" maxlength="200" value="<?=$proyecto_data->sueldo?>"/>
				
				<label class="tdLabel "><h6>Descripción:</h6></label>
				<textarea name="descripcion" rows="10" cols="40"  class="validate[required]" ><?=$proyecto_data->descripcion?></textarea>

				<label><h6>Ciudad de la Vacante:</h6></label>

				<select id="tipo" name="tipo" style="float:left"  class="validate[required]" >
					<option value="<?=$proyecto_data->tipo?>">
							<?=$tipo?>
					</option>
<?
					$list_tipo=$mysql->consulta("SELECT * FROM tipo_vacante");

					foreach ($list_tipo as $key => $value) 
					{
	        			$id_tipo= $value['id'];
	        			$tipo= $value['nombre'];
	        			$logo_tipo= $value['logo'];
	        			
	        			echo '<option value= "'.$id_tipo.'" >'.$tipo.'</option>';		
	        		}
?>
				</select>

				<br>
				<br>

				<label class="tdLabel "><h6>Fecha de creación: &nbsp &nbsp &nbsp<span><?=$proyecto_data->fecha_ini?></span></h6></label>
				<br>
				<br>

				<input name="fecha_ini" type="text" value="<?=$proyecto_data->fecha_ini?>" hidden/>
				<label class="tdLabel "><h6>Nueva Vigencia: &nbsp&nbsp&nbsp&nbsp</h6> </label>
				
				<input name="fecha_fin" type="text" class="validate[required]" value="<?=$proyecto_data->fecha_fin?>" id="datepicker" type="date" placeholder="&nbsp <?=$proyecto_data->fecha_fin?>" />
<br>
			<br>


	<div class="col-xs-12"><p></p></div>
	<!--  -->

		<div class="col-xs-12">

		
			<!-- 
			 <h2 id="creado" class="color small" style="display:none;"> SE HA INSERTADO EL NUEVO CLIENTE</h2>
			 -->
			<br>
			<br>

			<input name="enviar" type="submit" value="Actualizar Vacante" id="enviar" class="btn btn-default"/>

		</div>
		    
		</form>
	</div>

	<div class="col-xs-3"><p></p>
	</div>












