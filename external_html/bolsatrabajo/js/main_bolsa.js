// JavaScript Document

var ruta_files_servicios='admin/paginas/secciones/';






var scroll_from_object=function(distancia, tiempo){
	
	var top_actual_pos=$(document).scrollTop();

	var position_final= top_actual_pos + distancia;

	console.log(position_final);

	$('html, body').animate({'scrollTop':position_final},tiempo);	
}


	/*BOTONES CONTACTO*/

	var botoncomprar=function(){
		
		$("#form1").show(1500);
		$("#form2").hide();
		$("#form3").hide();

		scroll_from_object(300, 1000);
		
	};

	var botontrabajo=function(){
		
		$("#form2").show(1500);
		$("#form1").hide();
		$("#form3").hide();
		$("#form_vacante").hide();

		scroll_from_object(600, 1000);
		
	};

	var botonmarca=function(){
	
	$("#form3").show(1500);
	$("#form1, #form2").hide();

	scroll_from_object(300, 1000);
	};


	/*BOTONES MAPA*/

	var boton_mapa1=function(){
		
		$("#mapa1").show(1500);
		$("#mapa2").slideUp();

$("#contacto").fadeIn(1000);
$("#contacto_header").hide();
$(".contenedor_contacto1").hide();
		
$(".conten_gral").css("height","1060px");

			
$(".tienda_leon").fadeIn(1000);
	    	$(".tienda_lagos").hide();

	    scroll_from_object(600, 1000);
		
	};

	var boton_mapa2=function(){
		
		$("#mapa2").show(1500);
		$("#mapa1").slideUp();

			$(".tienda_leon").fadeIn(1000);
	    	$(".tienda_lagos").hide();


$("#contacto").fadeIn(1000);
$("#contacto_header").hide();
$(".contenedor_contacto1").hide();
		
$(".conten_gral").css("height","1060px");

			
		$(".tienda_leon").hide();
	    	$(".tienda_lagos").fadeIn(1000);

	    	scroll_from_object(600, 1000);
	};



	var template= function(data) {
           
        	var html="";
            console.log("data");
            console.log(data);

             // '<li><a href="'+ item.file_name +'"><img src="'+item.file_name +'" alt="'+item.nombre+'">	</a></li>';
          	$.each(data, function(index, item) {

     			console.log(item.fecha_ini);
         		html+=' <li><img alt="'+item.nombre+'" class="shadow" src="admin/'+item.file_name+'" class="banner_empresa"><p class="small mapeq_blue"><span style="font-size:14px;"> Vigencia : '+item.fecha_ini+'</span> - <span style="font-size:14px;">'+item.fecha_fin+'</span> </span> || <span style="font-size:14px;">Detalles: '+item.descripcion+'</span></p></li>';
			 });
          
            return html;


        };





	var template_vacantes= function(data) {
           
          var dataContainer=$('#lista_vacante');

          dataContainer.children().remove();


                	var html="";
            // console.log("data");
            // console.log(data);

             // '<li><a href="'+ item.file_name +'"><img src="'+item.file_name +'" alt="'+item.nombre+'">	</a></li>';
          	$.each(data, function(index, item) {

				var fecha_ini= new Date(item.fecha_ini);
				var fecha_fin= new Date(item.fecha_fin);

				// console.log("VACANTES");
    //      		console.log(item);

         		dataContainer.append(' <li class="'+item.nombre+'">'+
         		'<h2>'+item.titulo+'</h2>'+
         		'<h5><strong>Puesto:</strong>'+item.puesto+'</h5>'+
         		// '<h5><strong>Sueldo:</strong>'+item.sueldo+'</h5>'+
         		'<h6><strong>Tipo:</strong>'+item.nombre_tipo+'</h6>'+
         		// '<br/><h6>'+item.descripcion+'</h6>'+
         		'<p><strong>Publicado:</strong>'+item.fecha_ini+'</p>'+
         		// '<p><strong>Vigencia:</strong>'+item.fecha_fin+'</p>'+
         		'<a href="#" id="vacante_btn'+index+'" class="contacto_vacante">Más Información</a>'+
         		'</li>');

         			

         		$('#vacante_btn'+index).click(function(event){
         			event.preventDefault();

         			console.log(this);

         			$('body').append('<div id="detalle_vacante" >'+

         				'<div class="cerrar_vacante"> X </div>'+
         				'<div class="detalle_vac_in col-md-10 col-md-offset-2">'+
	         				'<h2>'+item.titulo+'</h2>'+
			         		'<h5><strong>Puesto:</strong>'+item.puesto+'</h5>'+
			         		'<h5><strong>Sueldo:</strong>'+item.sueldo+'</h5>'+
			         		'<h6><strong>Tipo:</strong>'+item.nombre_tipo+'</h6>'+
			         		'<br/><h6>'+item.descripcion+'</h6>'+
			         		
			         		'<h5><strong>Edad mínima:</strong>'+item.edad_min+'</h5>'+
			         		'<h5><strong>Edad máxima:</strong>'+item.edad_max+'</h5>'+

			         		'<h5><strong>Años de Experiencia:</strong>'+item.anos+'</h5>'+

'<h5><strong>Estudios mínimos:</strong>'+item.estudios+'</h5>'+

'<h5><strong>Localidad:</strong>'+item.localidad+'</h5>'+

'<h5><strong>Idiomas:</strong>'+item.idiomas+'</h5>'+

'<h5><strong>Conocimientos informáticos:</strong>'+item.informatica+'</h5>'+

'<h5><strong>licencia de manejo:</strong>'+item.licencia+'</h5>'+

'<h5><strong>Disponibilidad para viajar:</strong>'+item.viajar+'</h5>'+

'<h5><strong>Personas con discapacidad:</strong>'+item.discapacidad+'</h5>'+

			         		'<p><strong>Publicado:</strong>'+item.fecha_ini+'</p>'+
			         		'<p><strong>Vigencia:</strong>'+item.fecha_fin+'</p>'+
			         		'<a href="#" id="vacante_btn'+index+'" class="contacto_vacante">enviar solicitud</a>'+
		         		' </div>'
					);
         			// console.log("CLICK");


         			$('.cerrar_vacante').click(function(event){
         				event.preventDefault();
         				console.log("CERRAR--------> X <----");
         				$("#detalle_vacante").remove();
         			});
         			// $("#form_vacante").show(1000);
         			// $("#mensaje_vacante").val('Está solicitud es para la vacante: '+item.titulo+', Puesto:'+item.puesto+'.  Sueldo:'+item.sueldo+'.   Tipo de vacante:'+item.nombre+'.  Vigencia:'+item.fecha_fin);
         			// scroll_from_object(1700, 1000);
         		});

         		// html+=' <li><img alt="'+item.nombre+'" class="shadow" src="admin/'+item.file_name+'" class="banner_empresa"><p class="small mapeq_blue">'+item.descripcion+'</p></li>';
			 });
          
            return html;
        };



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
		        console.log('pagination');
		        console.log(pagination);


		    }
		});


};






	$(document).ready(function(){


		console.log("________BOLSA DE TRABAJO-----");



	$.ajax({
      method: "POST",
      url: "external_html/bolsatrabajo/control.php",
      data: { seccion:'cargar'
      }
    })
      .done(function( data ) {


        var data=JSON.parse(data);  

        console.log("---------data");
      	console.log(data);


        paginatoneitor(data);



    });









     		var frm = $('#form_vacante');
			
			// file_filter("#foto_1",5,"image/png");

    		frm.submit(function (ev)
    		{
    			ev.preventDefault();
    			console.log(this);
    			// if ($(this).validationEngine('validate'))
    			// {
    				// loader_add("img/loader.gif");
	    			//console.log("its validate yuju");

	    			$.ajax(
	    			{
			            cache: false,
			            contentType: false,
			            processData: false,
			            type: frm.attr('method'),
			            url: frm.attr('action'),
			            data: new FormData(this),
			            success: function (data) 
			            {	
			            	// loader_del();

			            	console.log(data);

			            	if (data != "null")
			            	{

			            	}
			            }
			        });

			      // }
			 });







	    // $(".ajax").colorbox({
	    // 	overlayClose: true,
	    // 	initialWidth: "80%",
	    // 	maxHeight: "100%",
	    // 	maxWidth: "80%",
	    	
	    // 	fixed:"true"

	    // });









	    	// $(".contenedor_inicio2").stop(true,true).hide(0);
	    	// $(".contenedor_contacto").stop(true,true).hide(0);
	    	// $(".tiendas_cont").stop(true,true).hide(0);
	    	$("#back").stop(true, true).hide();
	    	$('body,html').animate({'scrollTop':"0px"},1000);
	    	


	    // $("#contacto_btn").click(function(){
	    // 	console.log("contacto_btn");
	    // 	$(".contenedor_inicio2").stop(true,true).fadeOut(1000);
	    // 	$(".contenedor_contacto").stop(true,true).fadeIn(1000);
	    // 	$(".tiendas_cont").stop(true,true).fadeOut(1000);http://localhost/mapeqpapeleria/images/art_escolares.png
	    // 	$(".tienda_leon").hide();
	    // 	$(".tienda_lagos").hide();
	    // 	$('body,html').animate({'scrollTop':"600px"},1000);
	    // });


	    // $("#tiendas_btn").click(function(){
	    	
	    // 	$(".contenedor_inicio2").stop(true,true).fadeOut(1000);
	    // 	$(".contenedor_contacto").stop(true,true).fadeOut(1000);
	    // 	$(".tiendas_cont").stop(true,true).fadeIn(1000);
	    // 	$('body,html').animate({'scrollTop':"600px"},1000);
	    // });



	    // $("#home_btn").click(function(){
	    	
	    // 	// $(".contenedor_inicio2").stop(true,true).fadeOut(1000);
	    // 	// $(".contenedor_contacto").stop(true,true).fadeOut(1000);
	    // 	// $(".tiendas_cont").stop(true,true).fadeOut(1000);

	    // 	$(".contenedor_inicio2").stop(true,true).hide(0);
	    // 	$(".contenedor_contacto").stop(true,true).hide(0);
	    // 	$(".tiendas_cont").stop(true,true).hide(0);
	    // 	$("#back").stop(true, true).hide();
	    	

	    // });




	 
	 //    /*formulario_comprar*/
	 // 	$(".formulario1").click(function(){
		// botoncomprar();
		// });

	 //    /*formulario_equipo_trabajo*/
	 // 	$(".formulario2").click(function(){
		// botontrabajo();
		// });

	 // 	/*formulario_marca_exito*/
		// $(".formulario3").click(function(){
		// botonmarca();
		// });

		// /*boton_mapa_leon*/
		// $("#boton_mapa1").click(function(){
		// boton_mapa1();
		// });

		// /*boton_mapa_atalo*/
		// $("#boton_mapa2").click(function(){
		// boton_mapa2();
		// });


		// $("#form_vacante").hide();

		// // $(".contenedor_contacto1").hide();
		// $(".form_contacto").hide();

		// $("#departamentos_lagos").hide();
		// $("#departamentos_leon").hide();


		// $(".tienda_leon").hide();
	 //    $(".tienda_lagos").hide();

});





