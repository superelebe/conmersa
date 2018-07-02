<br/>
<br/>
<?

$data_sinicio=$mysql->consulta("SELECT * FROM seccion_inicio WHERE id_sinicio = 1");

    $data_img=$mysql->consulta("SELECT * FROM imagenes_sinicio");

        

    if (!empty($data_sinicio)) {
      # code...
        // $data_sinicio=$data_sinicio[0];


       // $data_sinicio['imagenes'][0]=$data_img[0];

       // $data_sinicio['imagenes'][1]=$data_img[1];
      for ($i=0; $i < 2 ; $i++) { 
         # code...

        // echo "<pre>";
        //   var_dump($data_img[$i]);        
        //   echo "</pre>";  

        if (empty($data_img[$i])) { 
        

          
          $data_img[$i]=["id_imagen"=>'',"file_name"=>''];             
        
        }

          $data_sinicio['imagenes'][$i]=$data_img[$i];

       } 
      // foreach ($data_sinicio as $key => $value) {
          
      //       $img_data =multidimensional_search_array($data_img,["id_sinicio"=>$value["id_sinicio"]]);
            
      //       if (empty($img_data)) {
      //         $img_data=["id_imagen"=>NULL];              
      //       }

      //       $data_sinicio['imagenes'][$key]=$img_data;
            
      // }
    }


  echo '
    <script type="text/javascript" charset="utf-8">
      var list_sinicio = '.json_encode($data_sinicio).';
      console.log(list_sinicio);
      if (list_sinicio == null) {
        list_sinicio=[];
      }
    </script>';

    if (!empty($data_sinicio)) {
     # code...

 



    // foreach ($data as $key => $value) {

    //   // echo "<pre>";
    //   // var_dump($value);
    //   // echo "</pre>"; 
      
    //   $id=$value['id_sinicio'];
    //   $nombre=$value['nombre'];  
    //   $orden=$value['orden'];
    //   $url=$value['url'];
    //   $file_name=$value['file_name'];
    //   $img_name=basename($file_name);

    //   $enlace_detalle="#";//'index.php?seccion=catalogo_categoria&id_sinicio='.$id;

    // }

    }

  ?>
<!-- <a href="#" class="btn btn-default" id="ad_btn">Nuevo banner</a> -->
<!-- FORM NEW BANNER -->
<div  id="seccion_contenedor" class="col-sm-12 col-sm-offset-0">
  <!-- <a href="#" class="btn_close smaler_btn_close" id="close_nuevo"> X </a> -->
  <form id="form_one" method="post" action="paginas/secciones/control.php">
    

    <input name="seccion" type="text" value="inicio" hidden/>


    <div  id="" class="col-sm-12 col-sm-offset-0">

      <h6>Título principal:</h6>
      

      <input type="text" id="text_field" class="validate[required]"  name="titulo_principal" value="<?=$data_sinicio[0]['titulo_principal']?>"/>

      <br><br>
      
    
    </div>


 <div  id="" class="col-sm-12 col-sm-offset-0">

      <h6>Principal Title:</h6>
      

      <input type="text" id="text_field" class="validate[required]"  name="titulo_principal_ingles" value="<?=$data_sinicio[0]['titulo_principal_ingles']?>"/>

      <br><br>
      
    
    </div>




    <div  id="" class="col-sm-6 col-sm-offset-0 border-right">

      <h6>Título sección:</h6>

      <input type="text" id="text_field" class="validate[required]"  name="titulo_izq" value="<?=$data_sinicio[0]['titulo_izq']?>"/>


      <h6>Seccion title:</h6>

      <input type="text" id="text_field" class="validate[required]"  name="titulo_izq_ingles" value="<?=$data_sinicio[0]['titulo_izq_ingles']?>"/>

      <br><br>

      <h6>Contenido de la sección:</h6>
       <textarea id="text_field" class="validate[required] small" name="p_izq" rows="8" id="comment"><?=$data_sinicio[0]['p_izq']?></textarea>

      <!-- <input type="text" id="text_field" class="validate[required]"  name="url" value=""/> -->
      
      <br><br>
      
      <h6>Seccion content:</h6>
       <textarea id="text_field" class="validate[required] small" name="p_izq_ingles" rows="8" id="comment"><?=$data_sinicio[0]['p_izq_ingles']?></textarea>



      <div class="imagen_ficha" id="content_img">
    <!--     <label><h6>Imagenes:</h6></label>
        <p class="small">Seleccione el archivo JPG:<span class="small"> <br> Las imagenes deben ser de 1360 x 400px</span>
        <input type="file" class="validate[required]" name="foto_1" id="foto_1"/> </p> -->
      </div>
    
    </div>
    




  <div  id="" class="col-sm-6 col-sm-offset-0">

      <h6>Título sección:</h6>

      <input type="text" id="text_field" class="validate[required]"  name="titulo_der" value="<?=$data_sinicio[0]['titulo_der']?>"/>

      <br><br>


      <h6>Seccion Title:</h6>

      <input type="text" id="text_field" class="validate[required]"  name="titulo_der_ingles" value="<?=$data_sinicio[0]['titulo_der_ingles']?>"/>

      <br><br>

      



      <h6>Contenido de la sección:</h6>
       <textarea id="text_field" class="validate[required] small" name="p_der" rows="8" id="comment"><?=$data_sinicio[0]['p_der']?></textarea>
      
      <br><br>

      <h6>Seccion Content:</h6>
       <textarea id="text_field" class="validate[required] small" name="p_der_ingles" rows="8" id="comment"><?=$data_sinicio[0]['p_der_ingles']?></textarea>

      <br><br>



      <div class="" id="youtube_content">
        <label><h6>Video de youtube:</h6></label>
        <p class="small"><span class="small">Coloca aquí el código del video de youtube:</span></p>
        <!-- <p class="small">Seleccione el archivo JPG:<span class="small"> <br> Las imagenes deben ser de 1360 x 400px</span>
        <input type="file" class="validate[required]" name="foto_1" id="foto_1"/> </p>
 -->
       <input type="text" id="text_field" class="validate[required]"  name="youtube_link" value="<?=$data_sinicio[0]['youtube_link']?>"/>
      </div>


      <div class="imagen_ficha" id="content_img_youtube">

      </div>
    
    </div>





 <div  id="" class="col-sm-2 col-sm-offset-5">
  <br><br>
    <input class="btn btn-default small" type="submit" value="ACTUALIZAR">
</div>

  </form>          
  <br>

</div>
<!--/. FORM NEW BANNER -->


<!-- POSITIVE ANOUNCE -->
<div class="col-xs-10" id="respuesta" style="">   

     <!-- <div id="ya_existe" class="color small" style="color: red ! important;display:none;"> <h2> NO SE HA PODIDO CREAR TU banner </h2></div>
      --> 
    <h1> Se ha actualizado el contenido de sección</h1> 
    <div class="respuesta_cont"> </div>
    <br>
    <br>
</div>
<!--/. POSITIVE ANOUNCE -->
<br>
<br>
<br>
  

  



