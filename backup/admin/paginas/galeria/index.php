<?

        $data_tipos=$mysql->consulta("SELECT * FROM tipo_galeria ORDER BY orden ");

?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<br>
<a href="#" class="btn btn-default" id="ad_btn">Nueva foto</a>

<div class="border-bottom"></div>
<!-- FORM NEW galeria -->
<div  id="n_contenedor" class="col-xs-10 offset-xs-2">
  <a href="#" class="btn_close smaler_btn_close" id="close_nuevo"> X </a>

  <form id="form_one" method="post" action="paginas/galeria/control.php">
    <h6>Nombre de la nueva foto:</h6>

    <input name="seccion" type="text" value="nuevo" hidden/>
    <input type="text" id="text_field" class="validate[required]"  name="nombre" value=""/>

    <!-- /. POSITIVE ANOUNCE -->
    <div class="galeria_select_tipo">

      <br>
        <label><h6>Tipo de foto:</h6></label>
      <div class="select_tipo_cont">
        <select class="validate[required]"  id="tipo_form" name="tipo" style="float:left"  >
           <option value="">Selecciona una tipo de foto</option>
<?

        foreach ($data_tipos as $key => $value) 
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
    <br>
<div class="clear"></div>
    <div class="border-bottom" id="content_img">
      <label><h6>Imagenes:</h6></label>
      <p class="small">Seleccione el archivo JPG:
      <input type="file" class="validate[required]" name="foto_1" id="foto_1"/> </p>
    </div>
    
    <input class="btn btn-default small" type="submit" value="Crear">
     <div id="ya_existe" class="color small" style="color: red ! important;display:none;"> <h2> NO SE HA PODIDO CREAR TU galeria </h2></div>
  </form>          
</div>
<!--/. FORM NEW galeria -->
<br>
<br>

<!-- POSITIVE ANOUNCE -->
<div class="col-xs-10" id="respuesta" style="">    
    <h1> Se ha cargado tu Foto</h1> 
    <div class="respuesta_cont"> </div>
    <br>
    <br>
</div>
    <!-- /. POSITIVE ANOUNCE -->
    <div class="col-xs-12"><h1 class="color"></h1></div>
    <div class="galeria_select col-xs-6">
        <label><h6>Selecciona el Tipo de foto:</h6></label>

        <?
        //  echo "<pre>";
        // var_dump($data_tipos);
        // echo "</pre>";
        ?>

        <select class="validate[required]"  id="selector_tipo" name="tipo" style="float:left"  >

           <option value="">Selecciona un tipo de foto</option>
<?

        foreach ($data_tipos as $key => $value) 
        {
              $id_tipo= $value['id_tipo'];
              $tipo= $value['nombre_tipo'];
              echo '<option value= "'.$tipo.'" name_data="'.$tipo.'">'.$tipo.'  </option>';   
            }
            
?>  
          <!-- <option value="add">Agregar una tipo nuevo</option> -->
        </select>
    </div> 
    

  
      <br>
      <br>
       <br>
      <br>  <br>
      
  

<!--/. TABLE DISPLAY -->
<table cellspacing="0" width="100%" id="example" class="hover">
	<thead>
      <tr>
          <th width="5%">ID</th>
          <th width="5%">Orden</th>
          <th width="30%">Nombre</th>
          <th width="30%">tipo</th>
          <th width="15%">Imagen</th>
          <th width="5%"></th>
           <th width="5%">Fondo</th>
           <th width="5%">Slide</th>
          <th width="5%"></th>

          
    </tr>
  </thead>
  <tbody>
    <div id="content_img"></div>
<?
    // $data=$mysql->consulta("SELECT * FROM galeria INNER JOIN imagenes_galeria ON galeria.id_galeria=imagenes_galeria.id_galeria");

  $data_galeria=$mysql->consulta("SELECT * FROM galeria");

  $data_img=$mysql->consulta("SELECT * FROM imagenes_galeria");

 


    if (!empty($data_galeria)) {
      # code...
    

      foreach ($data_galeria as $key => $value){
          
            $img_data =multidimensional_search_array($data_img,["id_galeria"=>$value["id_galeria"]]);
            $tipo_data =multidimensional_search_array($data_tipos,["id_tipo"=>$value["tipo"]]);
           
            if (empty($img_data)) {
              $img_data=["id_imagen"=>NULL];              
            }
            if (empty($tipo_data)) {
              // echo "empty tipo data";
              $tipo_data_res=["id_tipo"=>NULL];              
            }
            else{
      //          echo "<pre>";
      // var_dump($tipo_data);
      // echo "</pre>"; 
              $tipo_data_res["id_tipo"]=$tipo_data["id_tipo"];
              $tipo_data_res["nombre_tipo"]=$tipo_data["nombre_tipo"];
              $tipo_data_res["file_name_tipo"]=$tipo_data["file_name"];
            }

            $data[$key]=array_merge($value,$img_data,$tipo_data_res);
            
      }
    }

 
     echo '
    <script type="text/javascript" charset="utf-8">
      var list_galeria='.json_encode($data,JSON_UNESCAPED_SLASHES).';
      var list_tipo_galeria='.json_encode($data_tipos,JSON_UNESCAPED_SLASHES).';
      console.log("list_galeria");
      console.log(list_galeria);

      if (list_galeria == null) {
        list_galeria=[];
      }
      if (list_tipo_galeria == null) {
        list_tipo_galeria=[];
      }
    </script>';



    if (!empty($data)) {
     # code...

     

    foreach ($data as $key => $value) {

     
      
      $id=$value['id_galeria'];
      $nombre=$value['nombre'];  
      $orden=$value['orden'];
      $tipo_id=$value['id_tipo'];
      $tipo=$value['nombre_tipo'];
      $file_name=$value['file_name'];
      $img_name=basename($file_name);

      $enlace_detalle="#";//'index.php?seccion=catalogo_categoria&id_galeria='.$id;

      if ($value['fondo'] == 1) {
          $fondo='checked="checked" value="1" ' ;
            // echo "<pre> SI TIENE UN FONDO";
            // var_dump($value);
            // echo "</pre>"; 
      }
      else{
        $fondo='checked="checked" value="0"';
      }



      if ($value['slide'] == 1) {
          $slide_item='checked="checked" value="1" ' ;
            // echo "<pre> SI TIENE UN FONDO";
            // var_dump($value);
            // echo "</pre>"; 
      }
      else{
        $slide_item='checked="checked" value="0"';
      }
      
// var_dump($fondo);
?>
   <tr id="row<?=$id?>" data-tipo="<?=$tipo_id?>">
      <td id="" class="border_bottom_green bordesini" nowrap="nowrap" valign="top" style="padding_bottom:0;">
        <a href= "#" >
            <? echo $id;?> 
        </a>
      </td>
         
      <td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <p style="display:none;"><?=$orden?></p>
        <input  type="text" class="order_field" title="Cambia el orden" value="<?=$orden?>"  name="orden" id-data=" <?=$id;?> " >
      </td>
    
      <td class="nombre_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a class="" href= "<?=$enlace_detalle?>" >
          <?echo $nombre ?>
        </a>
      </td> 

      <td class="tipo_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a href= "#" class="editar small" id-element="<?=$id;?>" >
          <?echo $tipo?>
        </a>
      </td> 

      <td class="imagen_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a href= "paginas/galeria/<?=$file_name?>" target="blank" >
           <img src= "paginas/galeria/<?=$file_name?>" alt="" style="height:70px;"/>
        </a>
      </td> 


          <td class="bordes editar_td" nowrap="nowrap" valign="top" align="center">
        <a href= "#" title="Ver el detalle" class="editar"  id-element="<?=$id;?>" >
          <img src="img/btn_ver.jpg" border="0"/>
        </a>
        </td>

      <td class="bordes bkg_td" nowrap="nowrap" valign="top" align="center">
        <label class="btn btn-secondary">
          <input type="radio" name="bkg" id-element="<?=$id;?>" autocomplete="off" <?echo $fondo?> method="post" action="paginas/galeria/control.php" seccion="fondo">
       </label>

      </td>


      <td class="bordes slide_td" nowrap="nowrap" valign="top" align="center">
        <label class="btn btn-secondary">
          <input type="checkbox" name="slide_item" id-element="<?=$id;?>" <?echo $slide_item?> method="post" action="paginas/galeria/control.php" seccion="slide">
       </label>
      </td>

       <!-- <input type="checkbox" name="vehicle" value="Bike" utocomplete="off"> -->



      <td class="bordes" nowrap="nowrap" valign="top" align="center">
        <a class="borrar" id="noti_borrar" id-element="<?=$id;?>" method="post" action="paginas/galeria/control.php" seccion="borrar" href="#"  >
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




<?

        $data_seccion=$mysql->consulta("SELECT * FROM seccion_inicio WHERE id_sinicio = 2 ");

        // var_dump( );
?>

<!-- FORM NEW galeria -->
<div  id="" class="col-xs-10 offset-xs-2">
  <br><br><br> <br><br><br>
  <h1 class="border-bottom">TEXTO COMPLEMENTARIO GALERÍA</h1>
  <form id="form_add_data" method="post" action="paginas/galeria/control.php">

    <input name="seccion" type="text" value="add_data" hidden/>
   
   <div class="form-group col-md-12">
      <h6>Titulo Principal:</h6>
      <input type="text" id="nombre" class="validate[required]" placeholder="" name="titulo_principal" value="<?echo $data_seccion[0]['titulo_principal']?>"/>
    </div>


     <div class="form-group col-md-12">
      <h6>Principal Title:</h6>
      <input type="text" id="nombre" class="validate[required]" placeholder="" name="titulo_principal_ingles" value="<?echo $data_seccion[0]['titulo_principal_ingles']?>"/>
    </div>


    <div class="form-group col-md-12">
      <h6>Titulo:</h6>
      <input type="text" id="nombre" class="validate[required]" placeholder="" name="titulo" value="<?echo $data_seccion[0]['titulo_izq']?>"/>
    </div>


    <div class="form-group col-md-12">
      <h6>Title:</h6>
      <input type="text" id="nombre" class="validate[required]" placeholder="" name="titulo_ingles" value="<?echo $data_seccion[0]['titulo_izq_ingles']?>"/>
    </div>

    <div class="form-group col-md-12">
      <h6>Descripción:</h6>
      <textarea type="text" id="descripcion" class="validate[required]"  name="descripcion" value=""/>
        <?echo $data_seccion[0]['p_izq']?>
      </textarea>
    </div>


    <div class="form-group col-md-12">
      <h6>Description:</h6>
      <textarea type="text" id="descripcion" class="validate[required]"  name="descripcion_ingles" value=""/>
        <?echo $data_seccion[0]['p_izq_ingles']?>
      </textarea>
    </div>



    <br>
<div class="clear"></div>
 
    <input class="btn btn-default small" type="submit" value="ACTUALIZAR">
     <div id="data_response" class="color small" style="color: red ! important;display:none;"> </div>
  </form>          
</div>
<!--/. FORM NEW galeria -->





  



