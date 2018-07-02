
      <!-- VALIDATOR -->
<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
<script src="js/validation/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>


<br/>
<br/>
<br/>
	<div class="col-xs-3">
	</div>
		
		<div class=" cont_form col-xs-6" style=" position:relative; display:block; width=50%;">

		<form id="form_one" name="form1" method="post" action="nuevo.php"  enctype="multipart/form-data">

			  <input name="seccion" type="text" value="<?echo $_GET["seccion"]?>" hidden/>
			<!-- <input name="id_admin" type="text" value="<?echo $id?>" hidden/> -->

			<div class="columna_1">
				
				 <h6>Título:</h6>
				<input name="titulo" class="validate[required]" type="text" maxlength="300"/>
			
			
				<label class="tdLabel "><h6>Puesto:</h6></label>
				<input name="puesto" class="validate[required]" type="text" maxlength="300" />
				

				<label class="tdLabel "><h6>Sueldo:</h6></label>
				<input name="sueldo" class="validate[required]" type="text" maxlength="300" />
				

				<label class="tdLabel "><h6>Descripción:</h6></label>
				<textarea name="descripcion" rows="10" cols="40"  class="validate[required]" maxlength="1000" ></textarea>


				<label><h6>Ciudad:</h6></label>
				<select id="tipo" class="validate[required]" name="tipo" style="float:left" >
					<option value="">Selecciona la ciudad vacante</option>
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

<br><br><br>
<h3> Vigencia de la vacante</h3>
				<label class="tdLabel "><h6>Fecha Inicial:</h6></label>
				
				<input name="fecha_ini" class="validate[required]" id="datepicker" type="date"  />

<br>
<br>
<br>
				<label class="tdLabel "><h6>Fecha Final: &nbsp</h6></label>
				
				<input name="fecha_fin" class="validate[required]" id="datepicker2" type="date"  />

<br>
			<br>
	<div class="border-bottom" id="content_img">

	</div>

<!-- 
 <h2 id="creado" class="color small" style="display:none;"> SE HA INSERTADO EL NUEVO CLIENTE</h2>
 -->
			<br>
			<br>
			
				<input name="enviar" type="submit" value="Guadar Vacante" id="enviar" class="btn btn-default"/>
		    
		</form>
	</div>

	<div class="col-xs-3">
	</div>



	
		
	<div class="col-xs-10" id="respuesta" style="">
		
		<h1> Se ha creado la nueva Vacante</h1>	
		<div class="respuesta_cont">
			
		</div>
		<br>
			<br>
		<a href="index.php?seccion=vacantes" class="btn btn-default">
			Ir a todas las Vacantes
		</a>

	</div>







