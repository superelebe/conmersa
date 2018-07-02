<?

  // $data_categoria=$mysql->consulta("SELECT categoria.* , imagenes_categoria.file_name FROM categoria INNER JOIN imagenes_categoria ON imagenes_categoria.id_categoria=categoria.id_categoria ORDER BY nombre ASC ");
  // $data_clase=$mysql->consulta("SELECT clase.* , imagenes_clase.file_name FROM clase INNER JOIN imagenes_clase ON imagenes_clase.id_clase=clase.id_clase ORDER BY nombre ASC");

$data_categoria = array( 0 => array('id_categoria' => 1, 'nombre' => 'Servicios Generales') , 1 => array('id_categoria' => 2, 'nombre' => 'Servicios de Mercadotecnia') );

    echo '
    <script type="text/javascript" charset="utf-8">
      var GLOBAL_CATEGORIA_DATA = '.json_encode($data_categoria).';
      // console.log(GLOBAL_CLASE_DATA);
    </script>';

?>


<br/>
<br/>





<a href="#" class="btn btn-default" id="ad_btn">Nuevo servicio</a>
<!-- FORM NEW servicio -->
<div  id="n_contenedor" class="col-xs-10 offset-xs-2 ficha_original">
  <a href="#" class="btn_close smaler_btn_close" id="close_nuevo"> X </a>
  <h2>Crea un nuevo servicio</h2>
  <br>
  <form id="form_one"  method="post" action="paginas/secciones/control_servicios.php">

  <div class="row">

    <div class="form-group col-md-12">
      <h6>Nombre del nuevo servicio:</h6>
      <input id="seccion" name="seccion" type="text" value="nuevo" hidden/>
      <input type="text" id="nombre" class="validate[required]" placeholder="" name="nombre" value=""/>
    </div>

     <div class="form-group col-md-12">
      <h6>Service Name:</h6>
      <input type="text" id="nombre_ingles" class="validate[required]" placeholder="" name="nombre_ingles" value=""/>
    </div>

    <div class="form-group col-md-12">
      <h6>Descripción del nuevo servicio:</h6>
      <textarea type="text" id="descripcion" class="validate[required]"  name="descripcion" value=""/></textarea>
    </div>

    <div class="form-group col-md-12">
      <h6>Service description:</h6>
      <textarea type="text" id="descripcion_ingles" class="validate[required]"  name="descripcion_ingles" value=""/></textarea>
    </div>

    <div class="form-group col-md-12">
      <h6>URL del servicio</h6>
       <input type="text" id="url" class="" placeholder="URL" name="url" value=""/>
    </div>

        
        <br><br>

<div class="col-sm-12">
            <label><h6>Categoría:</h6></label><br>
        <select class="validate[required] select_categoria"  id="categoria" name="categoria" style="float:left"  >
          <option value="">Selecciona una categoría</option>
          <option value= "1" >Servicios Generales</option>   
          <option value= "2" >Servicios de Marketing</option>   
      
        </select> 
        
        <br>
      </div>


<!-- <div class="col-sm-12 clase_target">
                  <label><h6>clase:</h6></label><br>
        <select class="validate[required] select_clase"  id="clase" name="clase" style="float:left"  >
          <option value="">Primero debes seleccionar una categoría</option>
<?
          // foreach ($data_clase as $key => $value) 
          // {
          //       $id_clase= $value['id_clase'];
          //       $clase= $value['nombre'];
          //       echo '<option value= "'.$id_clase.'" >'.$clase.'</option>';   
          // }
?>  
        </select> 

        </div>
 -->
        
        

<div class="clear"></div>
<br>

    <div class="clear"></div>
    <br>
    <div id="parent_content_img">
        <div class="border-bottom cont_img_form row" id="content_img">

        <div class="img_load_principal">
          <label><h6>Icono principal: </h6><span class="small color" style="font-size:13px;">La imagen debe tener una medida de 130px x 130px </span></label>
          <p class="small">Seleccione el archivo PNG:
          <input type="file" class="" name="principal" id="principal"/> </p>
        </div>   
        
        <div class="img_load_file1">
          <label><h6>Imagenes de la Galería:</h6></label>
            <p class="small">Seleccione la Imagen: <span class="small color">La imagen deberá ser de 2048px x 1152px y en formato JPG</span>

              <input type="file" class="validate[required]" name="foto1" id="foto1"/> </p>    
        </div>

        </div>

    </div>
      
      <a id="ad_btn_img" class="btn btn-link small" href="#">Añadir otra Imagen</a>
      
      <br>
      <br>

    
    <input id="sumit_form" class="btn btn-default small" type="submit" value="Crear">
     <div id="ya_existe" class="color small" style="color: red ! important;display:none;"></div>


  </div> 
  </form>          
</div>
<!--/. FORM NEW servicio -->
<br>
<br>

<!-- POSITIVE ANOUNCE -->
<div class="col-xs-10" id="respuesta" style="">    
    <h1> Se ha cargado tu servicio</h1> 
    <div class="respuesta_cont"> </div>
    <br>
    <br>
</div>
<!--/. POSITIVE ANOUNCE -->
<br>
  

<!--/. TABLE DISPLAY -->
<table cellspacing="0" width="100%" id="example" class="hover ">
  <thead>
      <tr>
          
          <th width="3%">Orden</th>
          <th width="40%">Nombre</th>
          <th width="20%">Categoria</th>
     <!--      <th width="20%">Clase</th> -->
          <th width="10%">Imagen</th>
          <th width="2%"></th>
          <th width="2%"></th>
    </tr>
  </thead>
  <div id="content_img"></div>
  <?
  // $data=$mysql->consulta("SELECT * FROM servicio INNER JOIN imagenes_servicio ON servicio.id_servicio=imagenes_servicio.id_servicio");
  
  $data_servicio=$mysql->consulta("SELECT * FROM servicio");
  
  $data_img_prin=$mysql->consulta("SELECT * FROM imagenes_principal");
  
      $data_img_prod=$mysql->consulta("SELECT * FROM imagenes_servicio ORDER BY id_imagen");
  
      // $data_img_fondo=$mysql->consulta("SELECT * FROM imagenes_clase");
      // $data_img_fondo=$mysql->consulta("SELECT * FROM imagenes_categoria");
  
   // echo "<pre>";
   //        var_dump($data_servicio);
   //        echo "</pre>";   
  
  if (!empty($data_servicio)) {
    # code...
  
  
    foreach ($data_servicio as $key => $value) {
        
          $img_prin_data =multidimensional_search_array($data_img_prin,["id_servicio"=>$value["id_servicio"]]);
          
          $img_servicio_data =multidimensional_search_multiarray($data_img_prod,["id_servicio"=>$value["id_servicio"]]);
  
  
          $clase =multidimensional_search_array($data_clase,["id_clase"=>$value["id_clase"]]);
  
          $categoria=multidimensional_search_array($data_categoria,["id_categoria"=>$value["id_categoria"]]);
  
          
          $data[$key]=$value;
          $data[$key]["principal"]=$img_prin_data;
          $data[$key]["images"]=$img_servicio_data;
          
          
          $data[$key]["clase"]=$clase;
          $data[$key]["categoria"]=$categoria;
          
    }
  }
    
            $img_prin_mkt[0]=multidimensional_search_array($data_img_prin,["id_servicio"=>0,'ingles'=>0]);
          // $img_prin_mkt =multidimensional_search_array($data_img_prin,["id_servicio"=>0,'ingles'=>0]);
          $img_prin_mkt[1] =multidimensional_search_array($data_img_prin,["id_servicio"=>0,'ingles'=>1]);

          // var_dump($img_prin_mkt);

          // $img_prin_mkt['principal']=$img_prin_mkt[0];



    // echo "<pre>";
    //       var_dump($img_prin_mkt);
    //       echo "</pre>";
          // echo "<pre>";
          // var_dump($img_prin_mkt_ingles);
          // echo "</pre>"; 
         
  
    echo '
  <script type="text/javascript" charset="utf-8">
    var list_servicio = '.json_encode($data).';
    var list_clase = '.json_encode($data_clase).';
    var list_categoria = '.json_encode($data_categoria).';
    var img_prin_mkt = '.json_encode($img_prin_mkt).';
    var img_prin_mkt_ingles = '.json_encode($img_prin_mkt_ingles).';
    
    if (list_servicio == null) {
      list_servicio=[];
    }
    if (list_clase == null) {
      list_clase=[];
    }
    if (list_categoria == null) {
      list_categoria=[];
    }
    if (img_prin_mkt == null) {
      img_prin_mkt=[];
    }
    //  if (img_prin_mkt_ingles== null) {
    //   img_prin_mkt_ingles=[];
    // }
  </script>';
  
  if (!empty($data)) {
   # code...
  
  
  
  
  foreach ($data as $key => $value) {
  
    // echo "<pre>";
    // var_dump($value);
    // echo "</pre>"; 

    $id=$value['id_servicio'];
    $nombre=$value['nombre'];  
    $orden=$value['orden'];
    $categoria=$value['categoria']["nombre"];
    $clase=$value['clase']["nombre"];
    $file_name=$value['principal']['file_name'];
    $img_name=basename($file_name);
  
    $enlace_detalle="#";//'index.php?seccion=catalogo_categoria&id_servicio='.$id;
  
  ?>
     <tr id="row<?=$id?>">
       
    <td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">
      <p style="display:none;"><?=$orden?></p>
      <input  type="text" class="order_field" title="Cambia el orden" value="<?=$orden?>"  name="orden" id-data=" <?=$id;?> " >
    </td>
  
    <td class="nombre_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
      <a class="" href= "<?=$enlace_detalle?>" >
        <?echo $nombre ?>
      </a>
    </td> 
  

    <td class="sector_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
      <a href= "" class="small" id-element="<?=$id;?>" target="_blank">
        <p><?echo $categoria?></p>
      </a>
    </td> 

<!--     <td class="tipo_td border_bottom_green bordesini" nowrap="nowrap" valign="top" >
      <a href= "" class="small" id-element="<?=$id;?>" target="_blank">
        <p><?echo $clase?></p>
      </a>
    </td>  -->

  
    <td class="imagen_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
      <a href= "paginas/secciones/<?=$file_name?>" target="blank" >
         <img src= "paginas/secciones/<?=$file_name?>" alt="" style="height:70px;"/>
      </a>
    </td> 

        <td class="bordes editar_td" nowrap="nowrap" valign="top" align="center">
      <a href= "#" title="Ver el detalle" class="editar"  id-element="<?=$id;?>" >
        <img src="img/btn_ver.jpg" border="0"/>
      </a>
      </td>
  
    <td class="bordes borrar_cont" nowrap="nowrap" valign="top" align="center">
      <a class="borrar" id="noti_borrar" id-element="<?=$id;?>" href="#"  method="post" action="paginas/secciones/control_servicios.php" seccion="borrar">
        <img src="img/btn_borrar.jpg" border="0"/>
      </a>
    </td>
  </tr>
  <?
    }
  }
  ?>
</table>



<form id="form_img"  method="post" action="paginas/secciones/control_servicios.php">
  <br><br><br>

  <div class="row">

    <div class="form-group col-md-12">
      <h2>Imagen principal de Servicios de Marketing:</h2>
      <input id="seccion" name="seccion" type="text" value="control_img_principal" hidden/>
      
        <div class="img_mkt_principal" style="background: grey">
        <!--   <label><h6>Imagen principal: </h6><span class="small " style="font-size:13px;">La imagen debe tener una medida de 2000px x 1333px </span></label>
          <p class="small">Seleccione el archivo JPG:
          <input type="file" class="" name="principal" id="imagen_mkt"/> </p> -->
        </div>  

         <input id="sumit_form" class="btn btn-default small btn_send_img" type="submit" value="Crear">


  <!--   <div class="form-group col-md-12">
      <h2>Principal image from marketing services:</h2>
      
        <div class="img_mkt_principal_ingles" style="background: grey">
          <label><h6>Imagen principal: </h6><span class="small " style="font-size:13px;">La imagen debe tener una medida de 2000px x 1333px </span></label>
          <p class="small">Seleccione el archivo JPG:
          <input type="file" class="" name="principal" id="imagen_mkt"/> </p>
        </div>   

      
 

    </div> -->

     
    </div>

  </div>
</form>

  



