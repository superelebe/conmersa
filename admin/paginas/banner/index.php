<br/>
<br/>

<a href="#" class="btn btn-default" id="ad_btn">Nuevo banner</a>
<!-- FORM NEW BANNER -->
<div  id="n_contenedor" class="col-xs-10 offset-xs-2">
  <a href="#" class="btn_close smaler_btn_close" id="close_nuevo"> X </a>
  <form id="form_one" method="post" action="paginas/banner/control.php">
    <h6>Nombre del nuevo banner:</h6>

    <input name="seccion" type="text" value="nuevo" hidden/>
    <input type="text" id="text_field" class=""  name="titulo" value=""/>

    <h6>Enlace del nuevo banner:</h6>
    <input type="text" id="text_field" class=""  name="url" value=""/>
    
    <div class="border-bottom" id="content_img">
      <label><h6>Imagen:</h6></label>
      <p class="small">Seleccione el archivo JPG:<span class="small"> <br> Las imagenes deben ser de 1360 x 400px</span>
      <input type="file" class="validate[required]" name="foto_1" id="foto_1"/> </p>
    </div>


    <div class="border-bottom" id="content_img">
      <label><h6>Imagen INGLES:</h6></label>
      <p class="small">Seleccione el archivo JPG:<span class="small"> <br> Las imagenes deben ser de 1360 x 400px</span>
      <input type="file" class="validate[required]" name="foto_1_ingles" id="foto_1_ingles"/> </p>
    </div>


    
    <input class="btn btn-default small" type="submit" value="Crear">
     <div id="ya_existe" class="color small" style="color: red ! important;display:none;"> <h2> NO SE HA PODIDO CREAR TU banner </h2></div>
  </form>          
</div>
<!--/. FORM NEW BANNER -->
<br>
<br>

<!-- POSITIVE ANOUNCE -->
<div class="col-xs-10" id="respuesta" style="">    
    <h1> Se ha cargado tu banner</h1> 
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
          <th width="10%">Nombre</th>
          <th width="10%">url</th>
          <th width="10%">Imagen</th>
          <th width="5%"></th>
          <th width="5%"></th>
          
    </tr>
  </thead>
  <tbody>
    <div id="content_img"></div>
<?
    // $data=$mysql->consulta("SELECT * FROM banner INNER JOIN imagenes_banner ON banner.id_banner=imagenes_banner.id_banner");

$data_banner=$mysql->consulta("SELECT * FROM banner");

    $data_img=$mysql->consulta("SELECT * FROM imagenes_banner");

     // echo "<pre>";
     //        var_dump($data_banner);
     //        echo "</pre>";   

    if (!empty($data_banner)) {
      # code...
    

      foreach ($data_banner as $key => $value) {
          
            $img_data['imagenes'][0] =multidimensional_search_array($data_img,["id_banner"=>$value["id_banner"], 'ingles'=>0]);

            $img_data['imagenes'][1] =multidimensional_search_array($data_img,["id_banner"=>$value["id_banner"], 'ingles'=>1]);
            


            if (empty($img_data)) {
              $img_data=["id_imagen"=>NULL];              
            }

            $data[$key]=array_merge($value,$img_data);
            
      }
    }

     // echo "<pre>";
     //  var_dump($data);
     //  echo "</pre>"; 


  echo '
    <script type="text/javascript" charset="utf-8">
      var list_banner = '.json_encode($data).';
      console.log(list_banner);
      if (list_banner == null) {
        list_banner=[];
      }
    </script>';

    if (!empty($data)) {
     # code...

    


    foreach ($data as $key => $value) {

     
      
      $id=$value['id_banner'];
      $nombre=$value['nombre'];  
      $orden=$value['orden'];
      $url=$value['url'];
      $file_name=$value['imagenes'][0]['file_name'];
      $img_name=basename($file_name);

      $enlace_detalle="#";//'index.php?seccion=catalogo_categoria&id_banner='.$id;

?>
   <tr id="row<?=$id?>">
      <!-- <td id="" class="border_bottom_green bordesini" nowrap="nowrap" valign="top" style="padding_bottom:0;">
        <a href= "#" >
            <? echo $id;?> 
        </a>
      </td> -->
         
      <td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <p style="display:none;"><?=$orden?></p>
        <input  type="text" class="order_field" title="Cambia el orden" value="<?=$orden?>"  name="orden" id-data=" <?=$id;?> " >
      </td>
    
      <td class="nombre_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a class="" href= "<?=$enlace_detalle?>" >
          <?echo $nombre ?>
        </a>
      </td> 

      <td class="url_td border_bottom_green bordesini" nowrap="nowrap" valign="top" width="200px">
        <a href= "<?echo $url?>" class="small" id-element="<?=$id;?>" target="_blank">
          <p><?echo $url?></p>
        </a>
      </td> 

      <td class="imagen_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a href= "paginas/banner/<?=$file_name?>" target="blank" >
           <img src= "paginas/banner/<?=$file_name?>" alt="" style="height:70px;"/>
        </a>
      </td> 

          <td class="bordes editar_td" nowrap="nowrap" valign="top" align="center">
        <a href= "#" title="Ver el detalle" class="editar"  id-element="<?=$id;?>" >
          <img src="img/btn_ver.jpg" border="0"/>
        </a>
        </td>

      <td class="bordes borrar_cont" nowrap="nowrap" valign="top" align="center">
        <a class="borrar" id="noti_borrar" id-element="<?=$id;?>" href="#"  method="post" action="paginas/banner/control.php" seccion="borrar">
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

  



