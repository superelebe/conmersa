<?php


    include("admin/incluir/config.php");
    include("admin/incluir/class_mysqli.php");
    include("admin/incluir/funciones.php");

    $mysql= new Con_mysqli;

    // $lista_categoria=$mysql->consulta("SELECT * FROM categoria INNER JOIN imagenes_categoria ON categoria.id_categoria=imagenes_categoria.id_categoria ORDER BY nombre");

    // $lista_clase=$mysql->consulta("SELECT * FROM clase INNER JOIN imagenes_clase ON clase.id_clase=imagenes_clase.id_clase ORDER BY nombre");
    

//-------> Sección control------->
  $seccion=$_GET['seccion'];

  $destino = array(
      '' =>'inicio',
      'inicio' => 'inicio'
    );

   echo '
    <script type="text/javascript" charset="utf-8">
      var GLOBAL_POST_DATA = '.json_encode($_POST).';
      console.log(GLOBAL_POST_DATA);
      var GLOBAL_GET_DATA = '.json_encode($_GET).';
      var GLOBAL_CATEGORIA = '.json_encode($lista_categoria).';
      var GLOBAL_CLASE = '.json_encode($lista_clase).';
    </script>';


?>
<!DOCTYPE html>
<html>
<head>
    <title>CONMERSA</title>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Enlaces a hojas de estilo -->
            <link href="css/main.css" rel="stylesheet">
            <link href="css/spin_object.css" rel="stylesheet">
            <link href="css/boton_avion.css" rel="stylesheet">
            <!-- <link href="css/btns_estilos.css" rel="stylesheet"> -->
            <link href="css/pulse.css" rel="stylesheet">
             <link rel="stylesheet" href="css/Hover_circulo/dist/styles/main.css"/>
            <link href="bootstrap3.3.7/dist/css/bootstrap.css" rel="stylesheet">

            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" type="text/css" href="css/Hover/css/normalize.css" />
            <link rel="stylesheet" type="text/css" href="css/Hover/css/set2.css" />

            <!-- Enlaces a scripts -->
            <script src="js/jquery3.1.1.js"></script>
            <script src="bootstrap3.3.7/dist/js/bootstrap.js"></script>
            <script src="css/Hover_circulo/dist/scripts/app.js"></script>

            <script>
              (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

              ga('create', 'UA-87253518-1', 'auto');
              ga('send', 'pageview');
            </script>



</head>
<body>

            <!-- header con menu, dropdowns y barra de búsqueda -->
        <nav class="navbar navbar-default navbar-fixed-top" id="menu">
         <div class="col-lg-offset-2 col-lg-9" id="el_menu">
            <div class="container-fluid" >
                            <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="" href="#inicio" id="el_logo">
                                    <img id="logo" src="images/logotipo.jpg" alt="logo_conmersa">
                            </a>
                        </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right" id="header_menu">
                        <li><a href="#inicio" class="menu_choice">INICIO&nbsp;&nbsp;|</a></li>
                        <li><a href="#empresa" class="menu_choice">EMPRESA&nbsp;&nbsp;|</a></li>
                        <li><a href="#servicios_conmersa" class="menu_choice">SERVICIOS&nbsp;&nbsp;|</a></li>
                        <li><a href="#info_gale" class="menu_choice">GALERIA&nbsp;&nbsp;|</a></li>
                        <li><a href="#cert" class="menu_choice">CERTIFICACIONES&nbsp;&nbsp;|</a></li>
                        <li><a href="#contacto" class="menu_choice">CONTACTO</a></li>
                        <li><a class=""><img src="images/iso_logo.png" id="iso_img" alt="logo_iso"></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
            </div>
        </nav>









       <!--  <section class="row" id="videos">
            <div class="col-xs-12" id="el_wrapper">
                <div id="modulo_1" class="col-md-offset-3 col-md-6">
                    <div class="col-sm-6">
                        <img src="images/logo_blanco.png" id="logo_bl">
                        <h2 id="tit_bl_light">SOMOS UNA EMPRESA</h2>
                        <h2 class="tit_bl_strong">100% COMPROMETIDA</h2>
                        <h2 class="tit_bl_strong">CON NUESTROS CLIENTES</h2>
                        <p id="parr_video">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate.</p>
                        <a id="cono_btn_vid" href="#cert">
                            <div id="con_mas">CONOCER MÁS</div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                            <img src="images/video_icon.png" class="al_cien" id="el_vid_icon">
                    </div>
                </div>
            </div>
        </section> -->
<div id="inicio">
    <section id="videos_home">
        <div class="row">
                <div id="modulo_1" class="col-md-offset-3 col-md-6">
                    <div class="col-sm-6">
                        <img src="images/logo_blanco.png" id="logo_bl" alt="logo_conmersa_blanco">
                        <h2 id="tit_bl_light">SOMOS UNA EMPRESA<br><span class="tit_bl_strong">100% COMPROMETIDA<br>CON NUESTROS CLIENTES</span></h2>
                        <!-- <h2 class="tit_bl_strong">100% COMPROMETIDA</h2>
                        <h2 class="tit_bl_strong">CON NUESTROS CLIENTES</h2> -->
                        <p id="parr_video">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate.</p>
                        <a id="cono_btn_vid" href="#cert">
                            <div id="con_mas">CONOCER MÁS</div>
                        </a>
                    </div>
                    <div class="col-sm-offset-3 col-sm-3 col-lg-offset-1 col-lg-5">
                        <a href="#" class="launch-modal" data-modal-id="modal-video_uno">
                            <img src="images/video_icon.png" class="" id="el_vid_icon" alt="icono_video">
                        </a>
                    </div>
                </div>
        </div>
    </section>

<?php
      include "$destino[$seccion].php"
      ?> 

        <div class="modal fade" id="modal-video_uno" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="modal-video">
                  <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/84910153?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=e89a3e" 
                             allowfullscreen></iframe>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal-video_dos" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="modal-video">
                  <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/84910153?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=e89a3e" 
                             allowfullscreen></iframe>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>





        <section class="row" id="empresa">
            <div class="row" id="elemen_1">
                <div class="col-md-offset-3 col-md-6" id="info_empresa">
                    <div id="modulo_2">
                        <h2 class="derecha bl_text light">UN SERVICIO<br>DE<span id="alta">ALTA CALIDAD</span></h2>
                        <!-- <h2 class="derecha bl_text light">DE <span id="alta">ALTA CALIDAD</span></h2> -->
                        <div class="col-md-offset-1 col-md-7">
                            <div class="col-sm-6">
                                <h3 class="bl_text" id="servi">SERVICIOS</h3>
                                <div class="pleca_mini"></div>
                                <p class="bl_parr">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate </p>
                                    <div class="col-md-offset-5 col-md-7" id="conocer_mas">
                                        <a href="#texto_infografia">
                                            <h6 class="cono_mas">CONOCER MÁS</h6>
                                            <div class="pleca_mas_bl"></div>
                                        </a>
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                <img alt="img_bolsa_papel" src="images/paper_bag2.png" class="centrado" id="bolsa">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-sm-6 col-md-8">
                                <h3 class="bl_text">TERMOFORMADO</h3>
                                <div class="pleca_mini"></div>
                                <p class="bl_parr">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate </p>
                                <div class="col-md-offset-5 col-md-7" id="conocer_mas2">
                                        <a href="#servicios">
                                            <h6 class="cono_mas">CONOCER MÁS</h6>
                                            <div class="pleca_mas_bl"></div>
                                        </a>
                                    </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                        <a href="#" class="launch-modal" data-modal-id="modal-video_uno">
                            <img alt="logo_icono_video" src="images/icon_video.png" class="centrado grow" id="logo_vi">
                        </a>
                    </div>
                        </div>
                    </div>
                    <div class="row" id="modulo_3">
                        <div class="col-sm-6">
                            <h3 class="sub">Altamente confiables, ellos lo avalan</h3>
                            <img alt="logos_grises" class="" src="images/fila_logos_grises.png" id="logos_grises">
                            <div class="col-md-8" id="parr_li">
                                <p class="sub_parr">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate</p>
                            </div>
                            <div class="col-md-12" id="parr_stro">
                                <p class="sub_parr_strong">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img alt="logos_minis" src="images/logos_minis.png" id="log_minis">
                        </div>
                    </div>
                </div>
            </div>










                    <div class="row" id="modulo_4">
                        <div class="col-md-offset-3 col-md-6">
                            <div class="col-xs-offset-3 col-xs-9 col-sm-offset-5 col-sm-6 col-md-offset-3 col-md-9 col-lg-offset-6 col-lg-6 derecha">
                                <h2 class="azul" id="somos">SOMOS UNA EMPRESA<br><span class="azul strongs">ALTAMENTE<br>CAPACITADA PARA<br>TRABAJAR CONTIGO</span></h2>
                                <h4 class="sub_gris">EMPRESA</h4>
                                <P class="parrafo_empresa">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore.</P>
                                <H4 class="sub_gris">MISIÓN</H4>
                                <P class="parrafo_empresa">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate.</P>
                                <H4 class="sub_gris">VISIÓN</H4>
                                <p class="parrafo_empresa">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate.</p>
                            </div>
                        </div>
                    </div>

        </section> <!-- fin seccion empresa -->













        <section class="row" id="servicios">
            <div id="servicios_conmersa"></div>



                    <div class="col-xs-12 col-sm-offset-1 col-sm-8 col-md-offset-3 col-md-6" id="modulo_6">
                        <div class="col-sm-4 topi" id="servicio_uno">
                            <!-- normal -->
                                <div class="ih-item circle effect3 right_to_left"><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                    <div class="img" id="empa_div"><img id="empa" class="centrado" src="images/aramado_icoon.png" alt="img"></div>
                                    <div class="info">
                                      <h3 class="centro texto_servin" id="arma">EMPACADADO Y<br>ARMADO DE<br>PROMOCIONES</h3>
                                     <!--  <p class="list_azul min">·CONTRATACIÓN DE PERSONAL</p> -->
                                    </div></a></div>
                            <!-- end normal -->
                                <div id="text_serv_uno">
                                    <h4 class="centro texto_servi">EMPACADADO Y<br>ARMADO DE<br>PROMOCIONES</h4>
                                      <div class="pleca_mini_mini centrado"></div>
                                </div>
                        </div>
                        <div class="col-sm-4 topi" id="servicio_dos">
                            <!-- normal -->
                                <div class="ih-item circle effect3 right_to_left"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                    <div class="img" id="out_div"><img class="centrado" src="images/empacado_icon2.png" alt="img"></div>
                                    <div class="info">
                                      <h3 class="centro texto_servin">OUTSOURCING<br>MANEJO DE<br>LINEA DE<br>EMPACADO</h3>
                                      <!-- <p class="list_azul min">·MANEJO DE NÓMINAS</p> -->
                                    </div></a></div>
                            <!-- end normal -->
                                <div id="text_serv_dos">
                                    <h4 class="centro texto_servi">OUTSOURCING<br>MANEJO DE LINEA<br> DE &nbsp;EMPACADO</h4>
                                      <div class="pleca_mini_mini centrado"></div>
                                </div>
                        </div>
                        <div class="col-sm-4 topi" id="servicio_tres">
                            <!-- normal -->
                                <div class="ih-item circle effect3 right_to_left"><a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                    <div class="img" id="eti_div"><img class="centrado" src="images/etiquetado_icon.png" alt="img"></div>
                                    <div class="info">
                                      <h3 class="centro texto_servin">ETIQUETADO</h3>
                                      <!-- <p class="list_azul min">·CAPACITACIÓNES</p> -->
                                    </div></a></div>
                            <!-- end normal -->
                                <div id="text_serv_tres">
                                    <h4 class="centro texto_servi">ETIQUETADO</h4>
                                      <div class="pleca_mini_mini centrado"></div>
                                </div>
                        </div>



                        <!-- <div class="col-sm-4 topi">
                            <img class="centrado" src="images/empacado_icon2.png">
                            <h4 class="centro texto_servi">OUTSOURCING<br>MANEJO DE LINEA DE<br>EMPACADO</h4>
                              <div class="pleca_mini_mini centrado"></div>
                        </div> -->
                        <!-- <div class="col-sm-4 topi centrado" id="empacado_info">
                            <div id="info_empa" class="centrado">
                                <h2 class="texto_servi min">OUTSOURCING<br> MANEJO DE LINEA DE<br> EMPACADO.<span><img id="cargador" src="images/empacado_icon.png"></span></h2>
                                <div id="mini_pleca_azul"></div>
                                <h4 class="list_azul min">·CONTRATACIÓN DE PERSONAL</h4>
                                <h4 class="list_azul min">·MANEJO DE NOMINAS</h4>
                                <h4 class="list_azul min">·CAPACITACIONES</h4>
                                <h4 class="list_azul min">·MANEJO DE LINEAS DE<br> EMPACADO</h4>
                            </div>
                            <img src="images/img_empacado.png" class="centrado" id="empacado">
                        </div> -->
                       <!--  <div class="col-sm-4 topi" id="eti">
                            <img class="centrado" src="images/etiquetado_icon.png">
                            <h4 class="centro texto_servi">ETIQUETADO</h4>
                              <div class="pleca_mini_mini centrado"></div>
                        </div>
                    </div> -->


                <div class="col-md-12" id="modulo_5">
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ///////////////////////////contenido de infografia//////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-sm-7" id="texto_infografia">
                          <div class="panel-group" id="accordion">
                            <div class="panel" id="panel_uno">
                              <!-- <div class="panel-heading" id="infografia_head">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" id="museos"><img src="images/botoncito.png"></a>
                                </h4>
                              </div> -->
                              <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                        <h2 class="titulo_light">ETIQUETADO DE<br>PRODUCTO<span class="titulo_strong">&nbsp;PARA</span><br><span class="titulo_strong">CUMPLIMIENTO<br>DE NOM.</span></h2>
                                        <!-- <h2 class="titulo_light">PRODUCTO<span class="titulo_strong">&nbsp;PARA</span></h2>
                                        <h2 class="titulo_strong">CUMPLIMIENTO</h2>
                                        <h2 class="titulo_strong">DE NOM.</h2> -->
                                        <img alt="separador_textos" src="images/punto_linea.png" class="linea al_cien">
                                        <p class="sub_parr" id="nom">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia</p>

                                        <div id="slide_mini1">
                                            <div id="mini_slide1" class="carousel slide" data-ride="carousel">

                                                <div class="carousel-inner" role="listbox">
                                                  <div class="item active">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>

                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>
                                                
                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>

                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>
                                                </div>


                                                <a class="carousel-control" href="#mini_slide1" role="button" data-slide="prev">
                                                  <span><img alt="flecha_der" id="left_arrow" src="images/left_arrow.png"></span>
                                                  <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control" href="#mini_slide1" role="button" data-slide="next">
                                                  <span><img alt="flecha_izq" id="right_arrow" src="images/right_arrow.png"></span>
                                                  <span class="sr-only">Next</span>
                                                </a>
                                              </div>
                                        </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel" id="panel_dos">
<!--                               <div class="panel-heading" id="recreacion_head">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" id="recreacion"><img src="images/botoncito.png"></a>
                                </h4>
                              </div> -->
                              <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <h2 class="titulo_light">EMPACADO Y<br>ARMADO<span class="titulo_strong">&nbsp;DE</span><br><span class="titulo_strong">PROMOCIONES</span></h2>
                                        <img alt="separador_textos" src="images/punto_linea.png" class="linea al_cien">
                                        <p class="sub_parr" id="nom2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia</p>
                                        <div id="slide_mini2">
                                            <div id="mini_slide2" class="carousel slide" data-ride="carousel">

                                                <div class="carousel-inner" role="listbox">
                                                  <div class="item active">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>

                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>
                                                
                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>

                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>
                                                </div>


                                                <a class="carousel-control" href="#mini_slide2" role="button" data-slide="prev">
                                                  <span><img alt="flechi_izq" id="left_arrow2" src="images/left_arrow.png"></span>
                                                  <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control" href="#mini_slide2" role="button" data-slide="next">
                                                  <span><img alt="flechi_der" id="right_arrow2" src="images/right_arrow.png"></span>
                                                  <span class="sr-only">Next</span>
                                                </a>
                                              </div>
                                        </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel" id="panel_tres">
                              <!-- <div class="panel-heading" id="rescate_head">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" id="rescate"><img src="images/botoncito.png"></a>
                                </h4>
                              </div> -->
                              <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <h2 class="titulo_light">OUTSOURCING<br>MANEJO<span class="titulo_strong">&nbsp;DE</span><br><span class="titulo_strong">LINEA DE<br>EMPACADO</span></h2>
                                        <img alt="separador_textos" src="images/punto_linea.png" class="linea al_cien">
                                        <p class="sub_parr" id="nom3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia</p>
                                        <div id="slide_mini3">
                                            <div id="mini_slide3" class="carousel slide" data-ride="carousel">

                                                <div class="carousel-inner" role="listbox">
                                                  <div class="item active">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>

                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>
                                                
                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>

                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>
                                                </div>


                                                <a class="carousel-control" href="#mini_slide3" role="button" data-slide="prev">
                                                  <span><img alt="la_flecha_izq" id="left_arrow3" src="images/left_arrow.png"></span>
                                                  <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control" href="#mini_slide3" role="button" data-slide="next">
                                                  <span><img alt="la_flecha_der" id="right_arrow3" src="images/right_arrow.png"></span>
                                                  <span class="sr-only">Next</span>
                                                </a>
                                              </div>
                                        </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel" id="panel_cuatro">
                              <!-- <div class="panel-heading" id="rescate_head">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" id="rescate"><img src="images/botoncito.png"></a>
                                </h4>
                              </div> -->
                              <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <h2><span class="titulo_strong">ETIQUETADO</span></h2>
                                        <img alt="separador_textos" src="images/punto_linea.png" class="linea al_cien">
                                        <p class="sub_parr" id="nom4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia</p>
                                        <div id="slide_mini4">
                                            <div id="mini_slide4" class="carousel slide" data-ride="carousel">

                                                <div class="carousel-inner" role="listbox">
                                                  <div class="item active">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>

                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>
                                                
                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>

                                                  <div class="item">
                                                    <img src="images/gal_circulo.png" alt="slide_item">
                                                  </div>
                                                </div>


                                                <a class="carousel-control" href="#mini_slide4" role="button" data-slide="prev">
                                                  <span><img alt="flecha_izquierda" id="left_arrow4" src="images/left_arrow.png"></span>
                                                  <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control" href="#mini_slide4" role="button" data-slide="next">
                                                  <span><img alt="flecha_derecha" id="right_arrow4" src="images/right_arrow.png"></span>
                                                  <span class="sr-only">Next</span>
                                                </a>
                                              </div>
                                        </div>
                                </div>
                              </div>
                            </div>
                          </div> 
                        
                </div>
                <div class="col-sm-5" id="el_rotador">
                        <img alt="c_conmersa" src="images/c_medio.png" id="c_medio">
                        <div class="col-md-12" id="info_conmersa">
                            <div class="panel-heading" id="plus_uno">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><img alt="boton_uno" class="grow pulse-button" src="images/botoncito1.png"></a>&nbsp;
                                </h4>
                            </div>
                            <div class="panel-heading" id="plus_dos">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><img alt="boton_dos" class="grow pulse-button" src="images/botoncito2.png"></a>&nbsp;
                                </h4>
                            </div>
                              <div class="panel-heading" id="plus_tres">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><img alt="boton_tres" class="grow pulse-button" src="images/botoncito2.png"></a>&nbsp;
                                </h4>
                              </div>
                              <div class="panel-heading" id="plus_cuatro">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><img alt="boton_cuatro" class="grow pulse-button" src="images/botoncito4.png"></a>&nbsp;
                                </h4>
                              </div>
                            <img alt="cuadro_azul_conmersa" src="images/rec_only3.png" id="el_rec">
                        </div>
                </div>
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////// fin contenido infografia ////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                <!-- ////////////////////////////////////////////////////////////////////////////////// -->

                    <!-- <div class="col-xs-12" id="modulo_6">
                        <div class="col-sm-4 topi">
                            <img class="centrado" src="images/aramado_icoon.png">
                            <h4 class="centro texto_servi">EMPACADADO Y<br>ARMADO DE<br>PROMOCIONES</h4>
                              <div class="pleca_mini_mini centrado"></div>
                        </div>
                        <div class="col-sm-4 topi centrado" id="empacado_info">
                            <div id="info_empa" class="centrado">
                                <h2 class="texto_servi min">OUTSOURCING<br> MANEJO DE LINEA DE<br> EMPACADO.<span><img id="cargador" src="images/empacado_icon.png"></span></h2>
                                <div id="mini_pleca_azul"></div>
                                <h4 class="list_azul min">·CONTRATACIÓN DE PERSONAL</h4>
                                <h4 class="list_azul min">·MANEJO DE NOMINAS</h4>
                                <h4 class="list_azul min">·CAPACITACIONES</h4>
                                <h4 class="list_azul min">·MANEJO DE LINEAS DE<br> EMPACADO</h4>
                            </div>
                            <img src="images/img_empacado.png" class="centrado" id="empacado">
                        </div>
                        <div class="col-sm-4 topi" id="eti">
                            <img class="centrado" src="images/etiquetado_icon.png">
                            <h4 class="centro texto_servi">ETIQUETADO</h4>
                              <div class="pleca_mini_mini centrado"></div>
                        </div>
                    </div> -->


                    <!-- <div>
                        <img class="centrado" src="images/marke_logo.png" id="milky_bottle">
                    </div>
 -->

<!-- 
                    <div class="col-xs-12" id="modulo_7">
                        <div class="col-sm-8" id="conectamos_est">
                            <h2 class="conectamos">CONECTAMOS TUS<span id="estra">&nbsp;ESTRATEGIAS DE</span></h2>
                            <h2 class="marketing">MARKE</h2>
                            <h2 class="marketing">TING</h2>
                            <h3 class="conectamos">Y LAS APLICAMOS A TUS PRODUCTOS</h3>
                        </div>
                        <div class="col-sm-4" id="milk_bottles">
                            <img src="images/milk_bottles.png">
                        </div>
                    </div> -->

                </div>
                <div class="col-xs-12">
                        <img alt="milk_slogan" class="centrado" src="images/marke_logo.png" id="milky_bottle">
                    </div>
            </div>
        </section> <!-- fin seccion servicios -->












    <div class="row" id="group_force">
    <img alt="fuerza_trabajo_conmersa" src="images/fondo_4.jpg" class="al_cien">
    </div>











        <section class="row" id="galeria">

                      

        </section> <!-- fin seccion galeria -->









      <!--   <section class="row" id="galeria_videos"> -->
            <!-- <div class="col-md-offset-3 col-md-6">
                <div class="col-md-offset-2 col-md-2">
                    <h2 class="sub_heavy">GALERÍA DE VIDEOS</h2>
                    <div id="pleca_negra"></div>
                    <a href="#"><h2 class="sub_heavy">LAGOS DE MORENO</h2></a>
                    <a href="#"><h2 class="sub_heavy">MONTERREY</h2></a>
                    <a href="#"><h2 class="sub_heavy">VIDEO 1</h2></a>
                    <a href="#"><h2 class="sub_heavy">VIDEO 2</h2></a>
                    <a href="#"><h2 class="sub_heavy">VIDEO 3</h2></a>
                </div>
                <div class="grid col-md-8">
                <figcaption>
                        <img src="images/icon_gal_vids.png" class="icon_vid">
                    </figcaption>
                    <figure class="effect-steve">
                        <img src="images/trailer_video.jpg" alt="video" class="centrado al_cien">        
                    </figure>
                </div>
            </div> -->
       <!--  </section> -->

        <!-- //////////////////////////////////////////////////////////////////////////////////// -->
        <section class="row" id="galeria_videos">
                        <div class="col-md-offset-3 col-md-6" id="modulo_9">
                        <h2 class="sub_heavy">GALERÍA DE VIDEOS</h2>
                        <div class="pleca_negra"></div>
                          <div class="panel-group" id="el_acordeon">
                            <div class="panel" id="panel_lagos">
                              <div class="panel-heading" id="lagos_head">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#el_acordeon" href="#lagos" class="sub_heavy">LAGOS DE MORENO</a>
                                </h4>
                              </div>
                              <div id="lagos" class="panel-collapse collapse in">
                                <div class="panel-body">
                                        <div class="col-md-4">
                                            <a href="#"><h2 class="sub_heavy_azul">VIDEO 1</h2></a>
                                            <a href="#"><h2 class="sub_heavy_azul">VIDEO 2</h2></a>
                                            <a href="#"><h2 class="sub_heavy_azul">VIDEO 3</h2></a>
                                        </div>
                                        <div class="grid col-md-8">
                                            <figure class="effect-steve">
                                                <img src="images/trailer_video.jpg" alt="video" class="centrado al_cien">
                                            <figcaption>
                                                <img alt="icono_gale_video" src="images/icon_gal_vids.png" class="icon_vid">
                                            </figcaption>        
                                            </figure>
                                        </div>
                                </div>
                              </div>
                            </div>
                            <div class="panel" id="panel_monterrey">
                              <div class="panel-heading" id="monterrey_head">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#el_acordeon" href="#monterrey" class="sub_heavy">MONTERREY</a>
                                </h4>
                              </div>
                              <div id="monterrey" class="panel-collapse collapse">
                                <div class="panel-body">
                                        <div class="col-md-4">
                                            <a href="#"><h2 class="sub_heavy_azul">VIDEO 1</h2></a>
                                            <a href="#"><h2 class="sub_heavy_azul">VIDEO 2</h2></a>
                                            <a href="#"><h2 class="sub_heavy_azul">VIDEO 3</h2></a>
                                        </div>
                                        <div class="grid col-md-8">
                                            <figure class="effect-steve">
                                                <img src="images/tarritos.jpg" alt="video" class="centrado al_cien">
                                                <figcaption>
                                                    <img alt="icono_play_video" src="images/icon_gal_vids.png" class="icon_vid">
                                                </figcaption>        
                                            </figure>
                                        </div>
                                </div>
                              </div>
                            </div>
                          </div> 
                        
                </div>
             </section>
        <!-- //////////////////////////////////////////////////////////////////////////////////// -->



        <section class="row" id="certificaciones">
            <div class="col-md-12" id="cert">
                    
                        <h4 class="centro azul">SOMOS UNA EMPRESA ALTAMENTE</h4>
                        <h2 class="centro azul" id="certificada_tit">CERTIFICADA</h2>
                        <h4 class="centro azul">PARA BRINDARTE EL MEJOR SERVICIO</h4>
                        <img alt="logos_certificaciones" class="centrado" src="images/fila_logotipos.png" id="fila_logos">
                    <div class="col-md-offset-4 col-md-4">
                        <p class="centro parr_negro">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiumdod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia</p>
                    </div>
            </div>
        </section>







        <section class="row" id="contacto">
            <div id="end_page"></div>
            <div class="col-sm-offset-3 col-sm-6" id="contacto_sec">
                <div class="col-md-6 col-md-6 col-md-6">
                        <div class="col-md-12 col-md-12 col-md-12" id="forma_ficha">
                            <form id="form_one" method="post" action="mail/mailer.php">
                                      <div class="res_contacto">
                                        <h3 id="whities">&nbsp;</h3>
                                        <p id="whities_yell"></p>
                                        </div>

                                        <div class="form-group">
                                          <label for="nombre">Nombre:</label>
                                          <input type="text" class="form-control validate[required]" id="nombre" name="nombre" placeholder="Nombre">
                                        </div>

                                        <div class="form-group">
                                          <label for="email">Correo:</label>
                                          <input type="email" class="form-control validate[required,custom[email]]" id="email" name="email" placeholder="Correo electrónico">
                                        </div>

                                        <div class="form-group">
                                          <label for="telefono">Teléfono:</label>
                                          <input type="tel" class="form-control validate[required,custom[number]]" id="telefono" name="telefono" placeholder="Teléfono">
                                        </div>

                                        <div class="form-group">
                                          <label for="mensaje">Mensaje:</label>
                                          <textarea  class="form-control validate[required]" rows="3" id="msj" name="msj" placeholder="Mensaje"></textarea>
                                        </div>
                                      <button type="submit" id="enviar_btn">
                                          Enviar
                                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                                            <path id="paper-plane-icon" d="M462,54.955L355.371,437.187l-135.92-128.842L353.388,167l-179.53,124.074L50,260.973L462,54.955z
                                        M202.992,332.528v124.517l58.738-67.927L202.992,332.528z"></path> 
                                          </svg>
                                        </button>
                            </form> 
                                    
                                        
                        </div>
                </div>
                <div class="col-md-6 col-md-6 col-md-6">
                        <img alt="logo_contacto" src="images/logo_cont_mini.png" id="logo_conta">
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <h2 class="parr">JALISCO<br>Parque Industrial s/n Antes Potrero de la Virgen Lote 3 y 3A CAF Nestlé. Int. Área de Maquilas. C.P. 47410. Lagos de Moreno, Jalisco. México</h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="parr">NUEVO LEÓN<br>Macro III: Fracc. Industrial Polytek. C.P. 466023 García, Nuevo León. México.</h2>
                    </div>
                </div>
            </div>
        </section>

</div>
<!-- fin cuerpo -->
















            <!-- footer fix bottom -->
                <nav class="navbar navbar-default navbar-fixed-bottom" id="el_footer">
                    <div class="container">
                    <p class="centro" id="parr_footer">TODOS LOS DERECHOS RESERVADOS SON PROPIEDAD DE CONMERSA, MÉXICO 2017 </p>
                    </div>
                </nav>
</body>
</html>




            <!-- Enlaces a  VALIDATOR -->
            <link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
            <script src="js/validation/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
            <script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzWwqvnHWA9TYtp62vbjIQMmv-XsyBnK4"></script>

            <!-- Enlaces a scripts -->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="js/detectmobilebrowser.js"></script>
            <script src="js/main.js"></script>




