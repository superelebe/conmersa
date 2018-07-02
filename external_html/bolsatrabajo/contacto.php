<script src="js/pagination.js" type="text/javascript" charset="utf-8"></script>

<?php 

	
// //-------> Sección control------->
$seccion=$_GET['seccion'];

include("admin/incluir/config.php");
include("admin/incluir/class_mysqli.php");
include("admin/incluir/funciones.php");

$mysql= new Con_mysqli;






?>

<script  type='text/javascript' charset='utf-8'>
	$(document).ready(function(){


		$("#leon").click(function(){
			$("#departamentos_leon").fadeIn(1000);			
			$("#departamentos_lagos").hide(1000);	
				scroll_from_object(500, 1000);


<?
	
	$data_proyectos=$mysql->consulta("SELECT * FROM vacante INNER JOIN tipo_vacante ON vacante.tipo=tipo_vacante.id WHERE tipo_vacante.nombre ='Leon'");

	// echo "<pre>";
// var_dump($data_proyectos);
// echo "</pre>";

	$data_proyectos_json = json_encode($data_proyectos,JSON_UNESCAPED_SLASHES);

	
	echo "var data_proyectos= ".$data_proyectos_json.";";
?>
			
			console.log(data_proyectos);

				paginatoneitor(data_proyectos);
			$("#recipiente_trabajo").val("adireccion@mapeqpapeleria.com");

			$("#recipiente_ventas").val("ventas@mapeqpapeleria.com");

			$("#recipiente_marca").val("compras@mapeqpapeleria.com,mflores@mapeqpapeleria.com");


			// $("#recipiente_trabajo").val("benjamin.gomez@elebegraph.com");

			// $("#recipiente_ventas").val("benjamin.gomez@elebegraph.com");

			// $("#recipiente_marca").val("benjamin.gomez@elebegraph.com");

			$(".emisor").val("leon");




			$("#form1").hide();
			$("#form2").hide();
			$("#form3").hide();

			$(".tienda_leon").fadeIn(1000);
	    	$(".tienda_lagos").hide();

		});







		$("#lagos").click(function(){
			$("#departamentos_lagos").fadeIn(1000);			
			$("#departamentos_leon").hide(1000);	

			scroll_from_object(500, 1000);



<?
	
	$data_proyectos=$mysql->consulta("SELECT * FROM vacante INNER JOIN tipo_vacante ON vacante.tipo=tipo_vacante.id WHERE tipo_vacante.nombre ='Lagos'");
	$data_proyectos_json = json_encode($data_proyectos,JSON_UNESCAPED_SLASHES);
// echo "<pre>";
// var_dump($data_proyectos);
// echo "</pre>";
	
	echo "var data_proyectos= ".$data_proyectos_json.";";
?>
			
			console.log(data_proyectos);

				paginatoneitor(data_proyectos);



			$("#recipiente_trabajo").val("fabir@mapeqpapeleria.com");

			$("#recipiente_ventas").val("ventas1lagos@mapeqpapeleria.com");

			$("#recipiente_marca").val("mauricioflores@mapeqpapeleria.com");

			// $("#recipiente_trabajo").val("benjamin.gomez@elebegraph.com");

			// $("#recipiente_ventas").val("benjamin.gomez@elebegraph.com");

			// $("#recipiente_marca").val("benjamin.gomez@elebegraph.com");

			$(".emisor").val("lagos");


			$("#form1").hide();
			$("#form2").hide();
			$("#form3").hide();

			$(".tienda_lagos").fadeIn(1000);
	    	$(".tienda_leon").hide();
		});








var paginatoneitor= function(data_proyectos){


		var dataContainer=$('#lista_vacante');

		$('#paginacion_content').pagination({
		    dataSource:data_proyectos,
		    pageSize: 3,
		    // formatResult: function(data) {
		    //     var result = [];
		    //     for (var i = 0, len = data.length; i < len; i++) {
		    //         result.push(data[i] + ' - good guys');
		    //     }
		    //     return result;
		    // },
		    callback: function(data, pagination) {
		        // template method of yourself
		        template_vacantes(data);
		        // dataContainer.html(html);
		        // console.log('data');
		        // console.log(data);
		        // console.log('pagination');
		        // console.log(dataContainer);


		    }
		});


};





	});

</script>



        <!-- /*/////////////////////////////////////////////////////////////////////*/-->

    <div class="bkg_secc"><img src="images/triangulos_empresa.png" alt="triangulos"></div>

         <!-- /*/////////////////////////////////////////////////////////////////////*/-->

		<div class="contenedor_contacto" id="contacto">
		      <div id="contacto_header"><img src="images/post-sticks-contacto.png" alt="image"></div>

		        <div class="contenedor_contacto1">
		              <h1>¡Quieres saber más o comprar algo!</br>
		                <span>¡Contáctanos! </span>
		              </h1>

					<div class="lista_articulos" id="tiendas">
		              <ul>
		                  <li id="lagos" style="margin-left:-70px;"><img alt="icono" src="images/icon_jalisco.png" class="logo hvr-push"></a>
		                  <h2>LAGOS DE MORENO, JALISCO.</br><span>DA CLICK AQUÍ</span></h2></li>
		                  <li id="leon" ><img alt="icono" src="images/icon_gto.png" class="logo hvr-push">
		                  <h2>LEÓN, GUANAJUATO.</br><span>DA CLICK AQUÍ</span></h2></li>
		              </ul>
		            </div>


		            <div class="lista_articulos" id="departamentos_leon">
		              <ul>
		                  <li class="formulario1"><img alt="icono" src="images/iconos/icono-carro.png" class="logo hvr-push"></a>
		                  <h2>Quieres comprar algo en León</br><span>Ingresa aquí</span></h2></li>
		                  <li class="formulario2"><img alt="icono" src="images/iconos/icono_equipo.png" class="logo hvr-push">
		                  <h2>Únete a nuestro equipo de trabajo en León</br><span>Ingresa aquí</span></h2></li>
		                  <li class="formulario3"><img alt="icono" src="images/iconos/icono_exito.png" class="logo hvr-push">
		                  <h2>Quieres que tu marca tenga éxito en León</br><span>Ingresa aquí</span></h2></li>
		              </ul>
		            </div>


		            <div class="lista_articulos" id="departamentos_lagos">
		              <ul>
		                  <li class="formulario1"><img alt="icono" src="images/iconos/icono-carro.png" class="logo hvr-push"></a>
		                  <h2>Quieres comprar algo en Lagos de Moreno</br><span>Ingresa aquí</span></h2></li>
		                  <li class="formulario2"><img alt="icono" src="images/iconos/icono_equipo.png" class="logo hvr-push">
		                  <h2>Únete a nuestro equipo de trabajo en Lagos de Moreno</br><span>Ingresa aquí</span></h2></li>
		                  <li class="formulario3"><img alt="icono" src="images/iconos/icono_exito.png" class="logo hvr-push">
		                  <h2>Quieres que tu marca tenga éxito en Lagos de Moreno</br><span>Ingresa aquí</span></h2></li>
		              </ul>
		            </div>
		        </div>

		       <!--  <div><img src="images/img_pluma.png" alt="pluma" id="pluma"></div> -->

		        <div class="form_contacto" id="form1">
		            <form id="formID" method="post" action="mail.php"  name="contact_form">
		            
		            <input type="hidden" class="emisor" name="emisor" value=""/> 	
					
					<input type="hidden" id="recipiente_ventas" name="Recipiente" value="ventas@mapeqpapeleria.com"/><br><br>


		            
		               <!--  <h1>SELECCIONA ALGUNO DE LOS CORREOS</h1>
		                  <div class="opciones">
		                    <label><input type="radio" name="Recipiente" value="ventas1@mapeqpapeleria.com" id="ventas1">ventas1@mapeqpapeleria.com</label>
		                    <label><input type="radio" name="Recipiente" value="ventas2@mapeqpapeleria.com" id="ventas2">ventas2@mapeqpapeleria.com</label>
		                  </div> -->
		                              

		                <div class="ficha">
		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label for="name">NOMBRE</label><input type="text" placeholder="Escribe tu nombre" class="validate[required,custom[nombre]]" name="nombre" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label>MAIL</label><input type="text" placeholder="Escribe tu Correo" class="validate[required,custom[mail]]" name="email" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <label>MENSAJE</label><textarea type="text" class="validate[required]" placeholder="Escribe tu mensaje" name="msj"  rows="8" style="width:50%;"/></textarea>
		                  <br><br>
		                  
		                  <div class="col twelve tablet-twelve mobile-full btn_enviar">
		                    <input type="image" src="images/btn_enviar.png" alt="Submit Form" />
		                  </div>
		                </div>

		            </form>  
		        </div>


		        <div class="form_contacto" id="form2">
		           <h1>Lista de Vacantes</h1>
 					<ul id="lista_vacante"></ul>
 					<div class="clear"></div>
 					 <ul id="paginacion_content"></ul>

		            <form id="form_vacante" method="post" action="mail.php"  name="contact_form">

		            <input type="hidden" class="emisor" name="emisor" value=""/> 	
       			    <input type="hidden" id="recipiente_trabajo" name="Recipiente" value="adireccion@mapeqpapeleria.com"/><br><br>
		             		            
		                <h1>UNETE A NUESTRO EQUIPO DE TRABAJO</h1>
		                  
		                <div class="ficha">
		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label for="name">NOMBRE</label><input type="text" placeholder="Escribe tu Nombre" class="validate[required,custom[nombre]]" name="nombre" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label>MAIL</label><input type="text" placeholder="Escribe tu Mail" class="validate[required,custom[mail]]" name="email" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label>TEL.</label><input type="text" placeholder="Escribe tu teléfono" class="validate[required]" name="tel" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <label>MENSAJE</label><textarea type="text" id="mensaje_vacante" class="validate[required]" placeholder="Escribe tu mensaje" name="msj" rows='8'style="width:50%;"/></textarea>
		                  <br><br>
		                  
		                  <div class="col twelve tablet-twelve mobile-full btn_enviar">
		                    <input type="image" src="images/btn_enviar.png" alt="Submit Form" />
		                  </div>
		                </div>

		            </form>  


		           


		            
		        </div>


		          <div class="form_contacto" id="form3">
		             <form id="formID" method="post" action="mail.php"  name="contact_form">
		             <input type="hidden" class="emisor" name="emisor" value=""/> 	
       			     <input type="hidden" id="recipiente_marca" name="Recipiente" value="compras@mapeqpapeleria.com, mflores@mapeqpapeleria.com"/><br><br>
		             		            
		                <h1>QUIERES QUE TU MARCA TENGA ÉXITO VEN NOSOTROS PODEMOS VENDERLA</h1>
		              
		                              

		                <div class="ficha">
		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label for="name">NOMBRE</label><input type="text" placeholder="Escribe tu Nombre" class="validate[required,custom[nombre]]" name="nombre" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label>MAIL</label><input type="text" placeholder="Escribe tu Mail" class="validate[required,custom[mail]]" name="email" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label>EMPRESA</label><input type="text" placeholder="Escribe el nombre de tu Empresa" class="validate[required,custom[empresa]]" name="empresa" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <div class="col twelve tablet-twelve mobile-full">
		                    <label>TEL.</label><input type="text" placeholder="Escribe tu Teléfono" class="validate[required,custom[tel]]" name="tel" style="width:50%;"/>
		                    <br><br>
		                  </div>

		                  <label>MENSAJE</label><textarea type="text" class="validate[required]" placeholder="Escribe tu mensaje" name="msj" rows='8'style="width:50%;"/></textarea>
		                  <br><br>
		                  
		                  <div class="col twelve tablet-twelve mobile-full btn_enviar">
		                    <input type="image" src="images/btn_enviar.png" alt="Submit Form" />
		                  </div>
		                </div>

		            </form>  
		        </div>

		        <div class="tienda_leon">
		          <div class="izquierdo_horario">
		            <h1>HORARIO</h1>
		              <p>LUNES A VIERNES </br> <span>9:00am a 7:30pm</span></p>
		               <p>
		              SÁBADO </br><span> 9:00am-2:00pm </span></p>
		          </div>

		          <div class="derecho_telefono">
		            <p>Comunícate con nosotros a nuestros teléfonos: </p>
		            <h2> 01 (477) 3114080 con 5 líneas</h2>
		          </div> 

		          <br><br><br>
		        </div>

<div class="clear"></div>
		        <div class="tienda_lagos">
		         <div class="izquierdo_horario">
		            <h1>HORARIO</h1>
		              <p>LUNES A VIERNES </br> <span>9:00am - 9:00pm</span></p>
		               <p>SÁBADO </br><span> 9:00am - 8:00pm </span></p>
		               <p>DOMINGO </br><span>10:00 am - 2:00 pm </span></p>
		          </div>

		          <div class="derecho_telefono">
		            <p>Comunícate con nosotros a nuestros teléfonos: </p>
		            <h2> (474) 7421760 y (474) 742 6030 </h2>
		          </div> 

		          <br><br><br>
          		</div>




		</div>
        <!-- /*/////////////////////////////////////////////////////////////////////*/-->

    </div>

        </div>




