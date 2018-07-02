
    <br/>
    <br/>


<table cellspacing="0" width="100%" id="example" class="hover">
	<thead>
      <tr>
          <th width="5%">ID</th>
          <th width="50%">Título</th>
          <th width="20%">Ciudad</th>
          <th width="15%">Creado</th>
          <th width="15%">Vigencia</th>
          <th width="5%"></th>
          <th width="5%"></th>
    </tr>
  </thead>
  <tbody>

	<?


  
$data_proyectos=$mysql->consulta("SELECT * FROM vacante");

foreach ($data_proyectos as $key => $value) {

    $id_vacante=$value['id'];
    $titulo=$value['titulo'];
    $subtitulo=$value['puesto'];
    
    $enlace_detalle='index.php?seccion=vacante&id='.$id_vacante;

    // $cliente=$mysql->consulta_individual("nombre", "cliente",["id"=>$value['cliente']]); 

    $tipo=$mysql->consulta_individual("nombre", "tipo_vacante",["id"=>$value['tipo']]); 

    $fecha_ini=$value['fecha_ini'];
    $fecha_fin=$value['fecha_fin'];
    // echo "<pre>";
    // echo($cliente);
    // echo "</pre>";  
     
  ?>
  
  <tr id="row<?echo$id_vacante;?>">
    <td  class="border_bottom_green bordesini" nowrap="nowrap" valign="top" style="padding_bottom:0;">
      <a href= "<?=$enlace_detalle?>" >
          <? echo $id_vacante;?> 
      </a>
    </td>
  
    <td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">
      <a href= "<?=$enlace_detalle?>" >
        <?echo $titulo?>
      </a>
    </td>

    <td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">
      <a href= "<?=$enlace_detalle?>" >
        <?echo $tipo ?>
      </a>
    </td>

    <td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">
      <a href= "<?=$enlace_detalle?>" >
        <?echo $fecha_ini?>
      </a>
    </td>

    <td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">
      <a href= "<?=$enlace_detalle?>" >
        <?echo $fecha_fin?>
      </a>
    </td>

   
  
    <td class="bordes" nowrap="nowrap" valign="top" align="center">
      <a href= "<?=$enlace_detalle?>"   >
        <img src="img/btn_ver.jpg" border="0"/>
      </a>
    </td>

    <td class="bordes" nowrap="nowrap" valign="top" align="center">
      <a class="borrar" id-element="<?= $id_vacante;?> " href= "#"  method="post" action="borrar.php" seccion="<?= $_GET[seccion];?>">
        <img src="img/btn_borrar.jpg" border="0"/>
      </a>
    </td>
   
     
  </tr>
<?

   
  }

?>  
  </tbody>
  
</table>




