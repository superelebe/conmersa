<?php



  $idioma=$_GET['lgj'];
  // var_dump($idioma);
  if ($idioma== NULL) {
    $idioma="ES";
    $_GET['lgj']=$idioma;
  }






   echo '
    <script type="text/javascript" charset="utf-8">
      var GLOBAL_POST_DATA = '.json_encode($_POST).';
      // console.log(GLOBAL_POST_DATA);
      var GLOBAL_GET_DATA = '.json_encode($_GET).';
      
      console.log("////////////--------------***********");
      console.log(GLOBAL_GET_DATA);
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
            
            <link href="css/spin_object.css" rel="stylesheet">
            <link href="css/boton_avion.css" rel="stylesheet">
            <!-- <link href="css/btns_estilos.css" rel="stylesheet"> -->
            <link href="css/pulse.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="css/tooltip-line.css" />
             <link rel="stylesheet" href="css/Hover_circulo/dist/styles/main.css"/>
            <link href="bootstrap3.3.7/dist/css/bootstrap.css" rel="stylesheet">

            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" type="text/css" href="css/Hover/css/normalize.css" />
            <link rel="stylesheet" type="text/css" href="css/Hover/css/set2.css" />
            <link rel="stylesheet" type="text/css" href="css/tooltip.css"/>


            
            <!-- Enlaces a scripts -->
            <!-- <script src="bootstrap3.3.7/dist/js/bootstrap.js"></script> -->
            <script src="js/jquery3.1.1.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

            
            <script src="bootstrap3.3.7/dist/js/bootstrap.js"></script>
            <script src="css/Hover_circulo/dist/scripts/app.js"></script>

            <link href="css/main.css" rel="stylesheet">


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

           
        <nav class="navbar navbar-default navbar-fixed-top" id="menu">
         <div class="col-lg-offset-2 col-lg-9" id="el_menu">
            <div class="container-fluid" >
                          
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="" href="#inicio" id="el_logo">
                                    <img id="logo" src="images/logotipo.png" alt="logo_conmersa">
                            </a>
                        </div>

        
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    


                    <ul class="nav navbar-nav navbar-right" id="header_menu">
                      <li><a  href="#" class="col-xs-6 btn_idioma idioms" id="texto_header_idioma" data_idioma="EN"  data_key="idiomabtn" >ENGLISH</a></li>
                        <li><a href="#inicio" class="menu_choice idioms" data_key="menu_btn_1">INICIO&nbsp;&nbsp;|</a></li>
                        <li><a href="#empresa" class="menu_choice idioms" data_key="menu_btn_2">EMPRESA&nbsp;&nbsp;|</a></li> 
                        <li><a href="#servicios_conmersa" class="menu_choice idioms" data_key="menu_btn_3">SERVICIOS&nbsp;&nbsp;|</a></li>
                        <li><a href="#info_gale" class="menu_choice idioms" data_key="menu_btn_4">GALERIA&nbsp;&nbsp;|</a></li>
                        <li><a href="#cert" class="menu_choice idioms" data_key="menu_btn_5">CERTIFICACIONES&nbsp;&nbsp;|</a></li>
                        <li><a href="#contacto" class="menu_choice idioms" data_key="menu_btn_6">CONTACTO</a></li>
                        <li><a class=""><img src="images/iso_logo.png" id="iso_img" alt="logo_iso"></a></li>
                    </ul>
                </div>
            </div>
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
    <h2 class="hidden_all">video</h2>
        <div class="row" id="el_banner_home"></div>
    </section>


      <!--   <div class="modal fade" id="modal-video_uno" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h3 class="strong azul centro">SITIO EN CONSTRUCCIÓN</h3> -->
                <!-- <div class="modal-video">
                    <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/84910153?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=e89a3e" 
                             allowfullscreen></iframe>
                    </div>
                </div> -->
             <!--  </div>
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
        </div> -->




        <section>
            <div class="row" id="elemen_1">
                 <div id="empresacontent"></div>
            </div>








                    <div class="row" id="modulo_4">
                        <div id="empresa"></div>
                        <div class="col-sm-offset-3 col-sm-9 col-md-offset-2 col-md-9" id="el_div_servicios">
                            <div class="col-xs-offset-2 col-xs-10 col-sm-offset-2 col-sm-8 col-md-offset-7 col-md-7 col-lg-offset-6 col-lg-6 derecha">
                                <h2 class="azul idioms" id="somos" data_key="cont_h_somos">SOMOS UNA EMPRESA<br><span class="azul strongs">ALTAMENTE<br>CAPACITADA PARA<br>TRABAJAR CONTIGO</span></h2>
                                <h4 class="sub_gris idioms" data_key="cont_h_empresa" >EMPRESA</h4>
                                <P class="parrafo_empresa idioms" data_key="cont_p_empresa">En Conexión en Mecadotecnia hemos visto la necesidad de crear un servicio que ayude a nuestros clientes a deslindarse de la operación de ensamble en su proceso, de tal forma que puedan enfocar sus esfuerzos de la generación de utilidades de negocio.</P>
                                <p class="parrafo_empresa idioms" data_key="cont_p_2_empresa">Nuestra Política de calidad es proveer de empaque y embalaje mediante procesos de manufactura y administrativos cumpliendo con los requisitos del cliente, aplicando sistemas de mejora continua.</p>
                                <H4 class="sub_gris idioms" data_key="cont_h_mision">MISIÓN</H4>
                                <P class="parrafo_empresa idioms" data_key="cont_p_mision">Compromiso de mejora continua en la entrega de servicios de maquila y de promociones armadas para cualquier tipo de producto con la finalidad  de satisfacer las necesidades presentes y futuras de la industria y el comercio.</P>
                                <H4 class="sub_gris idioms" data_key="cont_h_vision">VISIÓN</H4>
                                <p class="parrafo_empresa idioms" data_key="cont_p_vision">Alcanzar servicios de calidad óptima para maquila de promociones armadas y cualquier tipo de producto con la finalidad de satisfacer las necesidades de la industria y el comercio.</p>
                                <H4 class="sub_gris idioms" data_key="cont_h_area">ÁREA DE OFRECIMIENTO</H4>
                                <p class="parrafo_empresa idioms" data_key="cont_h2_area" >SERVICIO, CALIDAD, IMAGEN Y PRECIO.</p>
                            </div>
                        </div>
                    </div>

        </section> <!-- fin seccion empresa -->













        <section class="row" id="servicios">
           
        </section> <!-- fin seccion servicios -->












    





        <section class="row" id="galeria">
            <h2 class="hidden_all">gal</h2>
                      

        </section> <!-- fin seccion galeria -->








        <section class="row" id="bolsatrabajo">
            <h2 class="hidden_all">gal</h2>
                      

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
        <!-- <section class="row" id="galeria_videos">
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
             </section> -->
        <!-- //////////////////////////////////////////////////////////////////////////////////// -->



        <section class="row" id="certificaciones">
            <div class="col-md-12" id="cert">
                    
                        <h4 class="centro azul idioms" data_key="cont_p1_cert">SOMOS UNA EMPRESA ALTAMENTE</h4>
                        <h2 class="centro azul idioms" id="certificada_tit" data_key="cont_p2_cert">CERTIFICADA</h2>
                        <h4 class="centro azul idioms" data_key="cont_p3_cert">PARA BRINDARTE EL MEJOR SERVICIO</h4>
                        <img alt="logos_certificaciones" class="centrado" src="images/fila_logotipos.png" id="fila_logos">
                    <div class="col-md-offset-4 col-md-4">
                        <!-- <p class="centro parr_negro">ISO 9001:2008 (CN: ATR065)<br>
                        Sedex Certificación (RESPONSABLE SOURCING)<br>
                        DUNS<br>
                        5’S<br>
                        SISTEMA DE GESTIÓN DE SEGURIDAD Y MEDIO AMBIENTE.
                        </p> -->
                        <ul class="centro parr_negro idioms" id="lista_cert" data_key="cont_p4_cert">
                            <li>ISO 9001:2015 (CN: ATR065)</li>
                            <li>Sedex Certificación (RESPONSABLE SOURCING)</li>
                            <li>DUNS</li>
                            <li>5’S</li>
                            <li>SISTEMA DE GESTIÓN DE SEGURIDAD Y MEDIO AMBIENTE</li>
                        </ul>
                    </div>
            </div>
        </section>







        <section class="row" id="contacto">
            <div id="end_page"></div>
            <div class="col-sm-offset-1 col-sm-11 col-md-offset-3 col-md-6" id="contacto_sec">
                <div class="col-sm-push-6 col-sm-6" id="logo_tels">
                        <img alt="logo_contacto" src="images/logo_cont_mini.png" id="logo_conta">
                      

                         <div class="col-md-12">
                            <h2 class="parr tele_cent idioms"  data_key="cont_p1_fot" style="color: white;font-weight: bolder;font-size: 20px;">01 800 439 0288</h2>
                        </div>


                        <div class="col-md-12">
                            <h2 class="parr tele_cent idioms"  data_key="cont_p0_fot" style="color:white;">Horario de atención:<br> 9:30 - 19:00 hrs. <br> Lunes a Viernes <br> +52 (477) 514 6666</h2>
                        </div>

                       

                        <!-- <div class="col-md-12">
                            <h2 class="parr tele_cent idioms"  data_key="cont_p1_fot">IRAPUATO<br>Teléfono: +52 (462) 624 2036 <br> +52 (462) 173 7692</h2>
                        </div>
                        <div class="col-md-12">
                            <h2 class="parr tele_cent idioms" data_key="cont_p2_fot">LEÓN<br>Teléfono: +52 (477) 514 6666</h2>
                        </div>
                        <div class="col-md-12">
                            <h2 class="parr tele_cent idioms" data_key="cont_p3_fot">LAGOS DE MORENO<br>Teléfono: +52 (474) 742 7398 <br> +52 (474) 118 0410</h2>
                        </div>
                        <div class="col-md-12">
                            <h2 class="parr tele_cent idioms" data_key="cont_p4_fot">NUEVO LEÓN<br>Teléfono: +52 (81) 8123 5031 <br> +52 (81) 8123 5034</h2>
                        </div>
                        <div class="col-md-12">
                            <h2 class="parr tele_cent idioms" data_key="cont_p5_fot">TOLUCA<br>Teléfono: +52 (722) 719 3495 y 96</h2>
                        </div> -->
                </div>
                <div class="col-sm-pull-6 col-sm-6" id="forma_contacto">
                        <div class="col-md-12 col-md-12 col-md-12" id="forma_ficha">
                            <form id="form_one" method="post" action="mail/mailer.php">
                                      <div class="res_contacto">
                                        <h3 id="whities">&nbsp;</h3>
                                        <p id="whities_yell"></p>
                                        </div>

                                        <div class="form-group">
                                          <label for="nombre" class="idioms" data_key="cont_h1_form">Nombre:</label>
                                          <input type="text" class="form-control validate[required]" id="nombre" name="nombre" placeholder="Nombre">
                                        </div>

                                        <div class="form-group">
                                          <label for="nombre" class="idioms" data_key="cont_h2_form">Empresa:</label>
                                          <input type="text" class="form-control validate[required]" id="nombre" name="empresa" placeholder="Empresa">
                                        </div>

                                        <div class="form-group">
                                          <label for="email" class="idioms" data_key="cont_h3_form">Correo:</label>
                                          <input type="email" class="form-control validate[required,custom[email]]" id="email" name="email" placeholder="Correo electrónico">
                                        </div>

                                        <div class="form-group">
                                          <label for="telefono" class="idioms" data_key="cont_h4_form">Teléfono:</label>
                                          <input type="tel" class="form-control validate[required,custom[number]]" id="telefono" name="telefono" placeholder="Teléfono">
                                        </div>

                                        <div class="form-group">
                                          <label for="mensaje" class="idioms" data_key="cont_h5_form">Mensaje:</label>
                                          <textarea  class="form-control validate[required]" rows="3" id="msj" name="msj" placeholder="Mensaje"></textarea>
                                        </div>
                                        <button type="submit" id="enviar_btn" class="idioms" data_key="cont_h6_form">
                                          Enviar
                                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                                            <path id="paper-plane-icon" d="M462,54.955L355.371,437.187l-135.92-128.842L353.388,167l-179.53,124.074L50,260.973L462,54.955z
                                            M202.992,332.528v124.517l58.738-67.927L202.992,332.528z"></path> 
                                          </svg>
                                        </button>
                            </form> 
                                    
                                        
                        </div>
                </div>
                <div class="col-md-12">
                    <!-- <div class="col-md-6">
                        <h2 class="parr">JALISCO<br>Parque Industrial s/n Antes Potrero de la Virgen Lote 3 y 3A CAF Nestlé. Int. Área de Maquilas. C.P. 47410. Lagos de Moreno, Jalisco. México</h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="parr">NUEVO LEÓN<br>Macro III: Fracc. Industrial Polytek. C.P. 466023 García, Nuevo León. México.</h2>
                    </div> -->
                    <!-- <div class="col-md-6">
                        <h2 class="parr">IRAPUATO<br>Teléfono: +52 (462) 824 2036</h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="parr">LEÓN<br>Teléfono: +52 (477) 514 6666</h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="parr">LAGOS DE MORENO<br>Teléfono: +52 (474) 742 7398</h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="parr">NUEVO LEÓN<br>Teléfono: +52 (81) 1098 0025</h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="parr">TOLUCA<br>Teléfono: +52 (722) 719 3495 y 96</h2>
                    </div> -->
                </div>
            </div>
        </section>

</div>
<!-- fin cuerpo -->
















            <!-- footer fix bottom -->
                <nav class="navbar navbar-default navbar-fixed-bottom" id="el_footer">
                    <div class="container">
                    <p class="centro idioms" id="parr_footer" data_key="cont_h_data" >TODOS LOS DERECHOS RESERVADOS SON PROPIEDAD DE CONMERSA, MÉXICO 2017<br><a href="/docs/AVISODEPRIVACIDADCONMERSA.pdf"> AVISO DE PRIVACIDAD</a> </p>

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
            
            <script src="js/detectmobilebrowser.js"></script>
            <script src="js/cambio_idiomas.js"></script>
            <script src="js/contenido_ES.js"></script>
            <script src="js/contenido_EN.js"></script>
            <script src="js/main.js"></script>




