
<br/>
<br/>


<a href="#" class="btn btn-default" id="ad_btn">Nuevo tipo de imagen</a>
<!-- FORM NEW BANNER -->
<div  id="n_contenedor">
   <a href="#" class="btn_close smaler_btn_close" id="close_nuevo"> X </a>

  <form id="form_one" method="post" action="paginas/galeria/control.php">
    <h6>Nombre del nuevo tipo de imagen:</h6>

    <input name="seccion" type="text" value="nuevo_tipo" hidden/>

    <input type="text" id="text_field" class="validate[required]"  name="titulo" value=""/>
    
    <h6>New image type name:</h6>
    <input type="text" id="text_field" class="validate[required]"  name="titulo_ingles" value=""/>

  <!--   <div class="border-bottom" id="content_img">
      <label><h6>Imagen principal: </h6><span class="small color" style="font-size:13px;">La imagen debe tener una medida de 2048px x 1152px de preferencia en positivo y con transparencia.</span></label>
      <p class="small">Seleccione el archivo PNG:
      <input type="file" class="" name="foto_1" id="foto_1"/> </p>
    </div> -->
    
    <input class="btn btn-default small" type="submit" value="Crear">
     <div id="ya_existe" class="color small" style="color: red ! important;display:none;"> <h2> NO SE HA PODIDO CREAR TU TIPO DE IMAGEN </h2></div>
  </form>          
</div>
<!--/. FORM NEW BANNER -->
<br>
<br>

<!-- POSITIVE ANOUNCE -->
<div class="col-xs-10" id="respuesta" style="">    
    <h1> Se ha cargado tu tipo de imagen</h1> 
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
          <th width="10%">ID</th>
          <th width="50%">Nombre</th>
          <th width="10%">IMagen</th>
          <th width="10%"></th>
          <th width="10%"></th>
    </tr>
  </thead>
  <tbody>
    <div id="content_img"></div>
<?

$data=$mysql->consulta("SELECT * FROM tipo_galeria");



// if (empty($data)) {
//   var_dump($data);
//   $data[0]=[

//     "respuesta"=>"",
//     "id"=>"",
//     "nombre"=>""

//   }
 

//   # code...
// }

    // $data_img=$mysql->consulta("SELECT * FROM imagenes_galeria");

    // if (!empty($data_img)) {
    //   # code...
    

    //   foreach ($data_suela as $key => $value) {
          
    //         $img_data =multidimensional_search_array($data_img,["id_suela"=>$value["id_suela"]]);
    //         // echo "<pre>";
    //         // var_dump($value);
    //         // echo "</pre>"; 
    //         if (empty($img_data)) {
    //           $img_data=["id_imagen"=>NULL];              
    //         }

    //         $data[$key]=array_merge($value,$img_data);
    //         // echo "<pre>";
    //         // var_dump($data);
    //         // echo "</pre>";   
    //   }
    // }




    

      echo '
    <script type="text/javascript" charset="utf-8">
      var list_tipo_galeria= '.json_encode($data).';
      console.log("+++++++++++++++list_tipo_galeria");
      console.log(list_tipo_galeria);

      if (list_tipo_galeria == null) {
        
        list_tipo_galeria=[];
        console.log("+-----------------list_tipo_galeria");
        console.log(list_tipo_galeria);
      };

    </script>';

if (!empty($data)) {
    //  # code...
    foreach ($data as $key => $value) {

      // echo "<pre>";
      // var_dump($value);
      // echo "</pre>"; 
      
      $id=$value['id_tipo'];
      $nombre=$value['nombre_tipo'];  
      // $orden=$value['orden'];
      $file_name=$value['file_name'];
      // $img_name=basename($file_name);

      $enlace_detalle="#";//'index.php?seccion=catalogo_categoria&id_suela='.$id;

?>
   <tr id="row<?=$id?>">
      <td id="" class="border_bottom_green bordesini" nowrap="nowrap" valign="top" style="padding_bottom:0;">
        <a href= "#" >
            <? echo $id;?> 
        </a>
      </td>
    
      <td class="nombre_td border_bottom_green bordesini" nowrap="nowrap" valign="top">
        <a class="" href= "<?=$enlace_detalle?>" >
          <?echo $nombre ?>
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

      <td class="bordes" nowrap="nowrap" valign="top" align="center">
        <a class="borrar" id="noti_borrar" id-element="<?=$id;?>" href="#"  method="post" action="paginas/galeria/control.php" seccion="borrar_tipo">
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

  



