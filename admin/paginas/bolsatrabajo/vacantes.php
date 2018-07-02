
<?

  $data_tipo=$mysql->consulta("SELECT * FROM tipo_vacante");

?>

<br/>
<br/>

<a href="#" class="btn btn-default" id="ad_btn">Nueva Vacante</a>
<!-- FORM NEW vacante -->
<div  id="n_contenedor" class="col-xs-10 offset-xs-2">
  <a href="#" class="btn_close smaler_btn_close" id="close_nuevo"> X </a>
  <form id="form_one" method="post" action="paginas/bolsatrabajo/control.php">
    

    <h6>Título de la nueva vacante:</h6>
    <div class="col-xs-12">

    <input name="seccion" type="text" value="nuevo" hidden/>
    <input type="text" id="text_field" class="validate[required]"  name="titulo" value=""/>

    <h6>Puesto:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="puesto" value=""/>

    <h6>Sueldo:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="sueldo" value=""/>

    <h6>descripcion:</h6>
    <textarea id="text_field" class="validate[required] small" name="descripcion" rows="8" id="comment"></textarea>

    <h6>Años de experiencia:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="anos" value=""/>

    <div class="col-xs-6">
    <h6>Edad miníma:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="edad_min" value=""/>
    </div>

    <div class="col-xs-6">
    <h6>Edad máxima:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="edad_max" value=""/>
    </div>

    <h6>Estudios Mínimos:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="estudios" value=""/>

    <h6>Localidad:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="localidad" value=""/>

    <h6>Idiomas:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="idiomas" value=""/>


    <h6>Conocimientos Informáticos:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="informatica" value=""/>
<br>  <br>
    <h6>licencia de conducir</h6>
    <input type="radio" class="validate[required]" name="licencia" value="a"> A &nbsp;&nbsp;|&nbsp;&nbsp;
    <input type="radio" class="validate[required]" name="licencia" value="b"> B &nbsp;&nbsp;|&nbsp;&nbsp;
    <input type="radio" class="validate[required]"  name="licencia" value="c"> C &nbsp;&nbsp;|&nbsp;&nbsp;
    <input type="radio" class="validate[required]" name="licencia" value="d"> D &nbsp;&nbsp;|&nbsp;&nbsp;
    <input type="radio"  class="validate[required]" name="licencia" value="sin permiso"> Sin permiso
    <br>  <br>
    <h6>Disponibilidad para Viajar:</h6>
    <input type="radio" class="validate[required]" name="viajar" value="si"> Si &nbsp;&nbsp;|&nbsp;&nbsp;
    <input type="radio" class="validate[required]" name="viajar" value="no"> No 
    <br>  <br>
    <h6>Disponibilidad para Cambio de residencia:</h6>
    <input type="radio" class="validate[required]" name="cambio" value="si"> Si &nbsp;&nbsp;|&nbsp;&nbsp;
    <input type="radio" class="validate[required]" name="cambio" value="no"> No 
    <br>  <br>
      <h6>Personas con discapacidad:</h6>
    <input type="radio" class="validate[required]" name="discapacidad" value="si"> Si &nbsp;&nbsp;|&nbsp;&nbsp;
    <input type="radio" class="validate[required]" name="discapacidad" value="no"> No 
<br>  <br>




  </div>

    <div class="col-xs-5">

      <h6>Fecha de inicio:</h6>
      <input type="text" id="text_field" class="validate[required]"  id="fecha_ini" name="fecha_ini" value="" data-provide="datepicker" />

    </div>

    <div class="col-xs-5">
      <h6>Fecha de termino:</h6>
      <input type="text" id="text_field" class="validate[required]"  id="fecha_fin"name="fecha_fin" value="" data-provide="datepicker"/>

</div>
        <!-- /. POSITIVE ANOUNCE -->
    <div class="galeria_select_tipo col-xs-12">

      <br>
        <label><h6>Tipo de vacante:</h6></label>
      <div class="select_tipo_cont">
        <select class="validate[required]"  id="tipo_form" name="tipo" style="float:left"  >
           <option value="">Selecciona una tipo de vacante</option>
<?

        foreach ($data_tipo as $key => $value) 
        {
              $id_tipo= $value['id_tipo'];
              $tipo= $value['nombre_tipo'];
              echo '<option value= "'.$id_tipo.'" name_data="'.$tipo.'">'.$tipo.'  </option>';   
            }
?>  
        <!--   <option value="add">Agregar un tipo nuevo</option> -->
        </select>
      </div>
    </div> 

    <!-- <div class="border-bottom" id="content_img">
      <label><h6>Imagenes:</h6></label>
      <p class="small">Seleccione el archivo JPG:<span class="small"> <br> Las imagenes deben ser de 1360 x 400px</span>
      <input type="file" class="validate[required]" name="foto_1" id="foto_1"/> </p>
    </div> -->

    <div class="col-xs-5" style="margin-top: 10px;">
    <input class="btn btn-default small" type="submit" value="Crear">
     <div id="ya_existe" class="color small" style="color: red ! important;display:none;"> <h2> NO SE HA PODIDO CREAR TU vacante </h2></div>

   </div>
  </form>          
</div>
<!--/. FORM NEW vacante -->
<br>
<br>

<!-- POSITIVE ANOUNCE -->
<div class="col-xs-10" id="respuesta" style="">    
    <h1> Se ha cargado tu vacante</h1> 
    <div class="respuesta_cont"> </div>
    <br>
    <br>
</div>
<!--/. POSITIVE ANOUNCE -->
<br>
  

<!--/. TABLE DISPLAY -->
<table cellspacing="0" width="100%" id="example" class="hover">
	<thead>
      <tr>
          <!-- <th width="5%">ID</th> -->
          <th width="5%">Orden</th>
          <th width="20%">Titulo</th>
          <th width="10%">Puesto</th>
          <th width="15%">Sueldo</th>
          <th width="20%">Fecha caducidad</th>
          <th width="10%">Tipo</th>
          <th width="10%"></th>
          <th width="10%"></th>
          
    </tr>
  </thead>
  <tbody>
    <div id="content_img"></div>


<?
    // $data=$mysql->consulta("SELECT * FROM vacante INNER JOIN imagenes_vacante ON vacante.id_vacante=imagenes_vacante.id_vacante");

    $data_vacante=$mysql->consulta("SELECT * FROM vacante");

    

    if (!empty($data_vacante)) {
      # code...

      foreach ($data_vacante as $key => $value) {
          
            $tipo_vacante= multidimensional_search_array($data_tipo,["id_tipo"=>$value["id_tipo"]]);

            // $img_data =multidimensional_search_array($data_img,["id_vacante"=>$value["id_vacante"]]);
            // if (empty($img_data)) {
            //   $img_data=["id_imagen"=>NULL];              
            // }

            $data[$key]=array_merge($value,$tipo_vacante);

            
            
      }

            // echo "<pre>";
            // var_dump($data);
            // echo "</pre>"; 
    }


  echo '
    <script type="text/javascript" charset="utf-8">
      
      var list_vacante = '.json_encode($data).';
      console.log(list_vacante);
      if (list_vacante == null) {
        list_vacante=[];
      }

      var list_tipo_vacante = '.json_encode($data_tipo).';
      console.log(list_tipo_vacante);
      if (list_tipo_vacante == null) {
        list_tipo_vacante =[];
      }

    </script>';

    if (!empty($data)) {
     # code...

    


    foreach ($data as $key => $value) {

      // echo "<pre>";
      // var_dump($value);
      // echo "</pre>"; 
      
      $id=$value['id_vacante'];
      
      $orden=$value['orden_vacante'];
      $titulo=$value['titulo'];  
      $puesto=$value['puesto'];  
      $sueldo=$value['sueldo'];  
      $descripción=$value['descripción'];  
      $fecha_ini=$value['fecha_ini'];  
      $fecha_fin=$value['fecha_fin'];  
      $id_tipo=$value['id_tipo'];  
      $tipo=$value['nombre_tipo'];  

            $anos=$value["anos"];
            $edad_min=$value["edad_min"];
            $edad_max=$value["edad_max"];
            $estudios=$value["estudios"];
            $localidad=$value["localidad"];
            $idiomas=$value["idiomas"];
            $informatica=$value["informatica"];
            $licencia=$value["licencia"];
            $viajar=$value["viajar"];
            $cambio=$value["cambio"];
            $discapacidad=$value["discapacidad"];


      
      
      $enlace_detalle='index.php?seccion=catalogo_categoria&id_vacante='.$id;

?>
   <tr id="row<?=$id?>">
      <!-- <td id="" class="border_bottom_green bordesini" nowrap="nowrap" valign="top" style="padding_bottom:0;">
        <a href= "#" >
            <? echo $id;?> 
        </a>
      </td> -->
         
      <td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <p style="display:none;"><?=$orden?></p>
        <input  type="text" class="order_field" title="Cambia el orden" value="<?=$orden?>"  name="orden" id-data="<?=$id;?>" >
      </td>
    
      <td class="titulo_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a class="" href= "<?=$enlace_detalle?>" >
          <?echo $titulo?>
        </a>
      </td> 


      <td class="puesto_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a class="" href= "<?=$enlace_detalle?>" >
          <?echo $puesto?>
        </a>
      </td> 

      <td class="sueldo_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a class="" href= "<?=$enlace_detalle?>" >
          <?echo $sueldo?>
        </a>
      </td> 

      <td class="fecha_fin_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a class="" href= "<?=$enlace_detalle?>" >
          <?echo $fecha_fin?>
        </a>
      </td> 


      <td class="tipo_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a class="" href= "<?=$enlace_detalle?>" >
          <?echo $tipo?>
        </a>
      </td> 


          <td class="bordes editar_td" nowrap="nowrap" valign="top" align="center">
        <a href= "#" title="Ver el detalle" class="editar"  id-element="<?=$id;?>" >
          <img src="img/btn_ver.jpg" border="0"/>
        </a>
        </td>

      <td class="bordes borrar_cont" nowrap="nowrap" valign="top" align="center">
        <a class="borrar" id="noti_borrar" id-element="<?=$id;?>" href="#"  method="post" action="paginas/bolsatrabajo/control.php" seccion="borrar">
          <img src="img/btn_borrar.jpg" border="0"/>
        </a>
      </td>
    </tr>
<?
  }
}
?>  
  </tbody>
</table>

  



