<?
session_start();


// error_reporting(0);
// echo "<pre>";
// var_dump($_SESSION);
// echo "seccion".$seccion;  
// echo "</pre>";


$seccion=$_GET['seccion'];

$sesion_name="CONMERSA";

include("incluir/config.php");
include("incluir/class_mysqli.php");
include("incluir/class_usuario.php");
include("incluir/funciones.php");

$mysql= new Con_mysqli;

$usuario= new Usuario;

// $lista=$mysql->consulta("SELECT * FROM imagenes_producto ORDER BY id_imagen");

// foreach ($lista as $key => $value) {
//       $directory="files/proyecto/".$value["id_producto"]."/";
//       $new_name=$directory.$value["file_name"];
//       $new_thumb_name=$directory.$value["thumb"];
      
//       // echo "<pre>";
//       // var_dump($new_name);
//       // echo "</pre>";

//       $update_data=[
//         "file_name"=>$new_name,
//         "thumb"=>$new_thumb_name
//       ];


//       $data_limit=[
//         "id_imagen"=>$value["id_imagen"]
//       ];

//       $mysql->update_general("imagenes_producto", $update_data,$data_limit);


//  } 



if ($seccion=='' OR  $seccion=='login' ) {
  // echo "seccion".$seccion;  
  session_destroy();
  unset($_POST);
}

if ($seccion !='') {

  if( !isset($_SESSION[$sesion_name][email]) && !isset($_SESSION[$sesion_name][pass_usr]) ){
     // echo "
     //           <script language='javascript' type='text/javascript'>
     //          setTimeout ( function(){ 
     //          location.href='index.php'}
     //          ,0);
     //      </script>
     //      ";
  }
}

$destino = array(
  '' =>'login',
  'login' => 'login',
  'iniciarsesion' => 'iniciarsesion',
   'salir' => 'salir',
  'cambiar_contrasena' => 'cambiar_contrasena',
  'inicio' => 'paginas/galeria/index',

  'banner'=>'paginas/banner/index',

  'galeria' => 'paginas/galeria/index',
  'tipos_galeria' => 'paginas/galeria/tipos_galeria',

  'seccion_inicio' => 'paginas/secciones/inicio',

   'seccion_servicios' => 'paginas/secciones/servicios',


);


 // $password="123";
 // echo $hash = password_hash($password, PASSWORD_DEFAULT);
 //   // $2y$10$t4v76K34ivSM8Hf0cJr48OlpyfKsa7jXjFkFCznLeo7IK5DBTfAn. 

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <title>CONMERSA 1.1</title>

    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="robots" content="index,follow" />
    <meta name="location" content="Mexico"/>
    <meta name="rating" content=""/>
    <meta name="url" content=""/>
    <meta name="content-language" content="ES"/>
    <meta name="copyright" content="Elebegraph Copyright 2017, Todos los Derechos Reservados"/> 
    <meta name="author" content="ELEBEGRAPH">

    <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
    <link href="css/datatable/datatables.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />

    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css">




    <link href="css/style.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    


    <script type='text/javascript' src='http://code.jquery.com/jquery-latest.min.js'></script>
    <script type='text/javascript' src='js/jquery-2.1.3.min.js'></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
  
    <!-- FANCYBOX -->  
     <!-- Add jQuery library -->
    <script type="text/javascript" src="js/fancybox/jquery-1.10.1.min.js"></script>
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="css/fancybox/jquery.fancybox.js?v=2.1.5"></script>
    
    <link rel="stylesheet" type="text/css" href="css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="css/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
    <script type="text/javascript" src="css/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="css/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" /> 
     <script type="text/javascript" src="css/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <!-- Add Media helper (this is optional) -->
    <script type="text/javascript" src="css/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
  

    <!-- DATATABLE -->  
    <script type="text/javascript" src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/datatable/dataTables.js"></script>

  

<?php
    echo '
    <script type="text/javascript" charset="utf-8">
      var GLOBAL_POST_DATA = '.json_encode($_POST).';
      // console.log(GLOBAL_POST_DATA);
      var GLOBAL_GET_DATA = '.json_encode($_GET).';
      // console.log(GLOBAL_GET_DATA);
      // console.log("////////////--------------***********");
    </script>';
?>
<!-- 
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
       
    } );

</script> -->












</head>


<!-- B_O_D_Y -->
<body class="home">
  <!-- HEADER -->
  <header class="header row">
<?
    if ($destino[$seccion]=="login") {
        echo "
        <style type='text/css'>
        
         
        </style>
        ";
      }
?>

    <div class="logo_gto col-sm-2 col-sm-offset-0"><img src="img/logo.png" alt="CONMERSA"></div>

<? 
               
    if( isset($_SESSION[$sesion_name][email]) && isset($_SESSION[$sesion_name][pass_usr]) )
    {
?>
      <div class="col-sm-12">
        <!-- Mainmenu -->
        <nav class="navbar mainmenu">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
                <button type="button" class="pclose" data-toggle="collapse" data-target="#navbar-collapse"></button>

                <ul class="nav navbar-nav pull-right">


                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Secciones</a>
                      <ul class="dropdown-menu">
                        <li><a href="index.php?seccion=seccion_inicio" class="">Inicio</a></li>
                          <li><a href="index.php?seccion=seccion_servicios" class="">Servicios</a></li>
                        
                      </ul>
                    </li>



                <li class="">
                        <a href="index.php?seccion=banner" class="">Banner</a>
                     </li>
               

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Galería</a>
                      <ul class="dropdown-menu">
                        <li><a href="index.php?seccion=galeria" class="">IMÁGENES</a></li>
                        <li><a href="index.php?seccion=tipos_galeria" class="">Tipo de imágenes</a></li>
                      </ul>
                    </li>

<!-- 
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Proyectos</a>
                      <ul class="dropdown-menu">
                        <li><a href="index.php?seccion=proyecto" class="">proyectos</a></li>
                        <li><a href="index.php?seccion=clase_proyecto" class="">Clases de proyecto</a></li>
                         <li><a href="index.php?seccion=categoria_proyecto" class="">categoria de proyecto</a></li>
                      </ul>
                    </li>

 -->
  
  
                 

                <li class="dropdown" id='menu_user'> 
                        <a href="#" class="dropdown-toggle rounded-corners" id="user_name" data-toggle="dropdown"><p>Bienvenido</p>
                        <? 
                            if ($_SESSION[$sesion_name][user_data][nick]!='') {
                                echo $_SESSION[$sesion_name][user_data][nick];   
                            }
                            else{
                                echo $_SESSION[$sesion_name][user_data][email];   
                            }
                         ?>
                        </a>

                        <ul class="dropdown-menu">
                         <li><a href="index.php?seccion=cambiar_contrasena">Cambiar Contraseña</a></li>
                             <li><a href="index.php?seccion=salir">Cerrar sesión</a></li>
                           <!--  <li><a href="index.php?seccion=inicio&p=editar_presi_usr&id=<?= $_SESSION[$sesion_name][user_data][id_usuario]?>">Editar usuario</a></li> -->
                           
                        </ul>
                </li>    
              </ul>
            </div>
        </nav>

    <!-- NAVEGATION CONTROL -->
<?
    $re_text="REGRESAR &nbsp / &nbsp ";
    $seccion_actual=$seccion;
    $seccion_previa=$_SESSION[$sesion_name][seccion_previa];
    $_SESSION[$sesion_name][seccion_previa]=$seccion_actual;

    switch ($seccion_actual) {


   case 'inicio': 
        $seccion_actual="GALERIA";
       $_SESSION[$sesion_name][seccion_previa]="inicio";  
      break;
     
     case 'iniciarsesion':
            $seccion_actual="";
            $seccion_previa="";
            $re_text="";
            $_SESSION[$sesion_name][seccion_previa]="inicio";
          break;

     case 'cambiar_contrasena':
            $seccion_actual="Cambiar Contraseña";
          break;

    case 'salir':
        $_SESSION[$sesion_name][seccion_previa]="";
        $seccion_actual="";
        $seccion_previa="";
        $re_text="";
      break;
      

   case 'galeria':
        $seccion_actual="Galería de Imágenes";
       $_SESSION[$sesion_name][seccion_previa]="inicio";
      break;

      case 'tipos_galeria':
        $seccion_actual="Tipos de imágenes";
       $_SESSION[$sesion_name][seccion_previa]="galeria";
      break;


case 'banner':
        $seccion_actual="Banners";
       $_SESSION[$sesion_name][seccion_previa]="inicio";
      break;


case 'seccion_inicio':
    $seccion_actual="Sección Inicio";
   $_SESSION[$sesion_name][seccion_previa]="inicio";
  break;

   //    case 'tipo_galeria_videos':
   //      $seccion_actual="Tipos de imágenes";
   //     $_SESSION[$sesion_name][seccion_previa]="galeria";
   //    break;



    default:
      $re_text="";
       $seccion_actual="";
        $seccion_previa="";
      break;
    }
    echo '<h3 class="color"><a id="regreso_tit" href="index.php?seccion='.$_SESSION[$sesion_name][seccion_previa].'">'.$re_text.'</a> '.$seccion_actual.' </h3>';
?>        
</div>
<?
 }
?>    
</header>
    <!-- /.Navegation control -->
<!-- /.header -->





    <!-- WRAPPER -->
  <div class="row">
    <div class="wrapper col-xs-10 col-xs-offset-1">
    <?php
      include "$destino[$seccion].php"
    ?>
    </div>
  </div>






    <div id="footer" class="row">
     
        <h2>CONMERSA</h2>
        <h1>Empaque, embalaje y servicios de empaquetado.</h1>
        <h3>Todos los derechos Reservados, 2017-2018.</h3>
     
    </div>  
    <!-- /.footer -->



    <!-- ScrollTop Button -->
    <a href="#" class="scrolltop"><i></i></a>


</body>





<!-- JS -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>




<script type="text/javascript" src="js/jquery.plugins.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery.mockjax.js"></script>



<!-- 
<script type="text/javascript" src="paginas/proyecto/js/control.js"></script>    
<script type="text/javascript" src="paginas/proyecto/js/control_clase.js"></script>    
<script type="text/javascript" src="paginas/proyecto/js/control_categoria.js"></script>     -->

<script type="text/javascript" src="paginas/galeria/js/control.js"></script>    
<script type="text/javascript" src="paginas/banner/js/control.js"></script>    
<script type="text/javascript" src="paginas/secciones/js/control.js"></script>    

<script type="text/javascript" src="paginas/secciones/js/control_servicios.js"></script>    


<!-- <script type="text/javascript" src="paginas/galeria_videos/js/control.js"></script>     -->
<script type="text/javascript" src="js/main.js"></script>    
  

        <!-- VALIDATOR -->
    <link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
    <script src="js/validation/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>




</html>