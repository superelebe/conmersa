// // JavaScript Document


var seccion_anterior;





var vacante_page_tipo_template= function(idval, seccion)
{				


			var idval_name=idval.substring(3);
			//console.log(idval_name);

			$( "a, input" ).tooltip({
		      position: {
		        my: "left top-1000",
		        at: "left top-1000",
		        using: function( position, feedback ) {
		        	//console.log("tooltip");
		        	//console.log(position);
		        	//console.log(feedback);
		          $( this ).css( position );
		          $( "<div>" )
		            .addClass( "arrow" )
		            .addClass( feedback.vertical )
		            .addClass( feedback.horizontal )
		            .appendTo( this );
		        }
		      }
		    });
			
			$("#n_contenedor").hide();

			$("#respuesta").hide(0);

			var cerrar_ventana_nuevo=function(){
					$("#n_contenedor").fadeOut(500);
					frm.fadeOut(500);
					$(".overlay").fadeOut(500,"easeOutQuint",function(){
						$(this).remove();
					});
					$("#ad_btn").show();
					$(document).unbind("keypress.key27");
				};

			$("#ad_btn").click(function(event)
			{
				$(this).hide();
				btn=$(this);
				
				$("body").append('<div class="overlay"></div>');
				$(".overlay").hide().fadeIn(700,"easeOutQuint");
				$("#n_contenedor").hide().fadeIn(1100,"easeInOutExpo");
				frm.appendTo("#n_contenedor");
				frm.show();
				frm.find("#text_field, #galeria_text_area, #foto_1").val("");

				$(document).bind("keypress.key27", function(event) {
					
				    if (event.keyCode == 27) {
						//console.log(event);
						//console.log(event.keyCode);
						cerrar_ventana_nuevo();
				    }
				});


				$("#close_nuevo, .overlay").click(function(){
					cerrar_ventana_nuevo();
				});
			});

			var table_obj=$('#example').DataTable( 
			{
				"order": [[1,"asc"]],
				"sScrollX": "100%",
				"bScrollCollapse": true,
				"lengthMenu": [5, 10, 50],
				 fnDrawCallback: function( oSettings ) {
      				// //console.log("in to teh data table");
      				// //console.log(oSettings);
    			}
			});


			$(".imagen_td a").fancybox({
				    padding    : 0,
			        margin     : 0,
				});


			var frm = $('#form_one');
			
			file_filter("#foto_1",5,"image/png");

    		frm.submit(function (ev)
    		{
    			ev.preventDefault();
    			// //console.log(this);
    			if ($(this).validationEngine('validate'))
    			{
    				loader_add("img/loader.gif");
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
			            	loader_del();

			            	console.log(data);

			            	if (data != "null")
			            	{


			            		var data=JSON.parse(data);	
			            		if (data.respuesta) 
			            		{

									var value_tipo={};
									value_tipo["id_tipo"]=data.id;
									value_tipo["nombre_tipo"]=data.nombre_tipo;
									
									

									// //console.log("-----------list_tipo_vacante");
									// //console.log(list_tipo_vacante);

									

									// list_galeria.push(value);
									list_tipo_vacante.push(value_tipo);
									

			            			//console.log("data.nombre");
									//console.log(data.nombre);				            		
		
						            cerrar_ventana_nuevo();

					                $("#respuesta").fadeIn(1000, "swing");
					                $(".respuesta_cont").append('<h3 class="color"> Nombre:&nbsp;'+data.nombre+'</h3>');
					                $("#respuesta").delay(1500).fadeOut(500, "swing", function(){
					                	$(".respuesta_cont").find("h3").remove();
					                });
					                

					                var jRow=$("<tr>").append(
						                // ' <tr id="row'+data.id+'">'+
											'<td id="" class="border_bottom_green bordesini" nowrap="nowrap" valign="top" style="padding_bottom:0;">'+        
											'<a href= "#" >'+data.id+'</a>'+
	      								'</td>',
	    
									      '<td class="nombre_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<a href= "#" >'+data.nombre_tipo+'</a>'+
									      '</td> ',



									       '<td class="editar_td bordes" nowrap="nowrap" valign="top" align="center">'+
        										'<a href= "#" class="editar" id="editar'+data.id+'" id-element="'+data.id+'"  title="Ver el detalle" >'+
          											'<img src="img/btn_ver.jpg" border="0"/>'+
										       	'</a>'+
										     '</td>',


									      '<td class="bordes" nowrap="nowrap" valign="top" align="center">'+
									        '<a class="borrar" id="noti_borrar" id-element="'+data.id+'" href= "#"  method="post" action="paginas/galeria/control.php" seccion="borrar"><img src="img/btn_borrar.jpg" border="0"/></a>'+
									      '</td>'
									      //+
									    // '</tr>'


					               	);

									table_obj.row.add(jRow).draw();
									var last_row=$("tr:last");
									last_row.attr("id","row"+data.id);
									//console.log(last_row);

					               	hacer_detalle_vacante_tipo("#editar"+data.id, idval, seccion);
				            	}
				            	else{
				            		$("#ya_existe").append(data.msj);
				            		$("#ya_existe").fadeIn(1000, "swing").delay(3000).fadeOut(500, "swing", function(){
				            			$(this).find("h3").remove();
				            		});
				            		// $("#ad_btn").show();
				            	}	
			            	}
			            }
			        });
					// /////<------ /* END ajax
                   
                }
                else{
                	    			// //console.log("NO its not");
                }

    		});

    			ordenar(".order_field", "ordenar", "paginas/galeria/control.php" )
				
				borrar_element(".borrar",list_tipo_vacante);

				hacer_detalle_vacante_tipo(".editar", idval, seccion);

				//console.log("hacer_detalle");
				//console.log(idval);
};

///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////


////////////////////////////////////////////
/////////////// /*ORDENAR*/

var hacer_detalle_vacante_tipo = function(btn, idval, seccion){//--Begin


// 	// var btn = $(btn);
// 	var seccion=seccion;

// 	// btn.click(function(event)
// 	$(document).on("click",btn,function(event)
// 	{
// 		event.preventDefault();
// 		var current =$(this);
// 		var id= current.attr("id-element");
// 		var key_data_element="";						
// 		var data_element = $.grep(list_tipo_vacante, function(value,key){
// 			//console.log(value[idval]);
// 			if (value[idval] == id) {
// 				key_data_element=key;
// 				return value;
// 			}
// 		}, false);



// 		$(document).bind("keypress.key27", function(event) {
					
// 				    if (event.keyCode == 27) {
// 						//console.log(event);
// 						//console.log(event.keyCode);
// 						$("#detalles_contenedor").fadeOut(1000,"easeOutQuint",function(){
// 							$(this).remove();	
// 						});
// 						$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
// 						$(document).unbind("keypress.key27");

// 				    }
// 				});


// 	data_element=data_element[0];

// 	//console.log("hacer_detalle");
// 	//console.log("data_element tipo");
// 	//console.log(data_element);

// 		$("body").append('<div class="overlay"></div>');
		
// 		$("body").append(


// 			'<div class="col-sm-10 col-sm-offset-1" id="detalles_contenedor">'+
			  
// 			  '<a href="#" class="btn_close smaler_btn_close " id=""> X </a>'+

// 			  '<form class="" id="form_two" name="form_two" method="post" action="paginas/galeria/control.php"  enctype="multipart/form-data">'+
// 			  '<input name="seccion" type="text" value="editar_tipo" hidden/>'+
// 			  '<input name="id" type="text" value="'+id+'" hidden/>'+

// 			  '<div class="col-sm-12" style="background:none; ">'+
// 			    '<h1 style="">detalles del tipo:</h1>'+
// 			  '</div>'+
			  
// 			  '<div id="nombre" class="col-sm-12">'+
// 			    '<span class="label label-primary col-sm-2">Nombre:</span>'+
// 			    '<p><input name="nombre" class="validate[required]" type="text" maxlength="100" value="'+data_element.nombre_tipo+'"/></p>'+
// 			  '</div>'+

// 			  '<div id="nombre" class="col-sm-12">'+
// 			    '<span class="label label-primary col-sm-2">Nombre:</span>'+
// 			    '<p><input name="nombre_ingles" class="validate[required]" type="text" maxlength="100" value="'+data_element.nombre_tipo_ingles+'"/></p>'+
// 			  '</div>'+
			
// 			   // '<div id="imagenes" class="col-sm-12 border-bottom">'+

// 			   //  '<span class="label label-primary col-sm-2">imágenes :</span>'+
// 			   //  '<div class="clear"></div>'+
// 			   //  '</div>'+
// 			    '<div class="clear"></div>'+
// 			'<input name="enviar" type="submit" value="Actualizar Proyecto" id="enviar_window" class="btn btn-default"/>'+

// 			'</form>'+

// 			'</div>'
// 			);

// 		var cont=$("#detalles_contenedor");

		
// 		cont.css("height",$( window ).height()-100);


// 		$(".btn_close, .overlay").click(function(){
// 			$("#detalles_contenedor").fadeOut(1000,"easeOutQuint",function(){
// 				$(this).remove();	
// 			});
// 			$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
// 			$(document).unbind("keypress.key27");
// 		});

// 		if (data_element.file_name !="") {

// 			$("#imagenes").append(
// 				'<div id="row_image'+data_element.id_tipo+'" class="col-md-3 col-sm-12 image_item">'+
// 					'<div id="img_preview_cont">'+
// 					'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data_element.id_tipo+'" href= "#"  method="post" action="paginas/galeria/control.php" seccion="borrar_foto_tipo">'+
// 			        		'X</a>'+
// 					'<img id="img_preview"src="paginas/galeria/'+data_element.file_name+'" alt="foto">'+
// 					'</div>'+
					    
// 				'</div>'
// 				);

// 			borrar_imagen(".borrar_img", list_tipo_vacante, key_data_element,"image/png","tipo_galeria");

// 		}
// 		//_------/* FIN BORRAR
// 		else{
// 				$("#imagenes").append(
// 				' <br><div class="" id="content_img_detalle">'+
// 			      '<label><h6>Imagen principal: </h6><span class="small color" style="font-size:13px;">La imagen debe tener una medida de 2048px x 1152px de preferencia en positivo y con transparencia.</span></label>'+
//      				' <p class="small">Seleccione el archivo PNG:'+
// 			      '<input type="file" class="validate[required]" name="foto_2" id="foto_2"/> </p>'+
// 			    '</div>'
// 				);

// 				file_filter("#foto_2",5,"image/png");

// 		}

// 		cont.hide().fadeIn(1000,"easeInOutExpo");
// 		$(".overlay").hide().fadeIn(1000,"easeOutExpo");


// ///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////----------- SUMIT ACTUALIZAR

// 		var frm2 = $('#form_two');
// 		// //console.log(frm2);

// 		frm2.submit(function (ev) {
// 			ev.preventDefault();
// 			//console.log($(this));
// 			loader_add("img/loader.gif");

//     			$.ajax({
// 		            cache: false,
// 		            contentType: false,
// 		            processData: false,
// 		            type: frm2.attr('method'),
// 		            url: frm2.attr('action'),
// 		            data: new FormData(this),
// 		            success: function (data) {	

// 		            	loader_del();
		            	
// 		            	if (data != "null")
// 		            	{
// 		            		var data=JSON.parse(data);	
// 		            		//console.log("data ajax response");
// 		            		//console.log(data);
// 		            		if (data.respuesta) 
// 		            		{
// 	    						//console.log($("#content_img_detalle"));

// 	    						$("#content_img_detalle").slideUp(1000,"easeOutQuint",function(){
// 									$(this).remove();	
// 								});

// 								$("#imagenes").append('<div class="col-xs-10" id="respuesta_window" style="">'+
// 								    '<h3 class="small color"> Se ha actualizado la información</h3> '+
// 								'</div>');


// 								$("#respuesta_window").hide().fadeIn(1000, "swing").delay(2000).slideUp(1000, "swing", function(){
// 				                	$(this).remove();
// 				                });
				                
				                
// 					             if (data.imagenes[0].id_foto !="") {
// 				                	$("#imagenes").append
// 				                	(
// 										'<div id="row_image'+data.imagenes[0].id_foto+'" class="col-md-3 col-sm-12 image_item">'+
// 											'<div id="img_preview_cont">'+
// 											'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data.imagenes[0].id_foto+'" href= "#"  method="post" action="paginas/galeria/control.php" seccion="borrar_foto">'+
// 									        		'X</a>'+
// 											'<img id="img_preview"src="paginas/galeria/'+data.imagenes[0].file+'" alt="foto">'+
// 											'</div>'+
											    
// 										'</div>'
// 									);

// 				                	var img_name= data.imagenes[0].file.substring(data.imagenes[0].file.lastIndexOf('/') + 1);

// 				                	// $("#row"+data.id).find('.imagen_td a').attr("id-element",data.id);
// 				                	// $("#row"+data.id).find('.imagen_td a').text(img_name);

// 				                	//console.log(data.id);

// 				                	$("#row"+data.id).find('.imagen_td a').remove();
// 			                		$("#row"+data.id).find('.imagen_td').append(
// 			                		' <a href= "paginas/galeria/'+data.imagenes[0].file+'" target="blank" >'+
// 							           '<img src= "paginas/galeria/'+data.imagenes[0].file+'" alt="'+data.nombre+'" style="height:70px;"/>'+
// 							        '</a>'
// 							        );
// 				                }

// 			                	$("#row"+data.id).find('.nombre_td a').remove();
// 			                	$("#row"+data.id).find('.nombre_td').append(
// 			                		'<a class="" href= "#" >'+data.nombre+'</a>');

// 			                	// $("#row"+data.id).find('.tipo_td a').remove();
// 			                	// $("#row"+data.id).find('.tipo_td').append(
// 			                	// 	'<a class="" href= "#" >'+data.nombre+'</a>');


			                	
// 			     //            	//console.log("data"); 
// 			     //            	//console.log(data);
// 			     //            	//console.log("data_element"); 
// 		      //           		//console.log(data_element);
// 		                		//console.log("key_data_element"); 
// 								// //console.log(key_data_element); 
// 								// //console.log("data.imagenes[0].file");         
// 								// //console.log(data.imagenes[0].file); 

// 								$.each(list_tipo_vacante, function(key, value){


// 									if (key==key_data_element) {
// 										if (data.imagenes[0].id_foto!="") {
// 											value["thumb"]=data.imagenes[0].file;
// 											value["file_name"]=data.imagenes[0].file;
// 											value["id_imagen"]=data.imagenes[0].id_foto;

// 										}
// 										value["nombre"]=data.nombre;
// 										value["nombre_tipo"]=data.nombre;
// 										value["nombre_tipo_ingles"]=data.nombre_ingles;
// 										// value["id_tipo"]=data.tipo_id;
// 										// //console.log("PUSH DATA");
// 										// //console.log(value);  
// 									}
// 								});
											            
// 					            // //console.log("new liust");
// 					            // //console.log(list_productos); 											     
			            
// 							 }
			          
// 				            else{
// 				            	$("#ya_existe").fadeIn(1000, "swing").delay(1000).fadeOut(500, "swing");
// 				            	$("#imagenes").append('<div id="msj_response">'+data.msj+'</div>');
// 				            	$("#msj_response").hide().fadeIn(600,"easeOutQuint").delay(2000).fadeOut(500,'easeInOutExpo',function(){
// 				            		$('input[type=file]').val("");
// 				            		$(this).remove();
// 				            	});
// 				            	$("#foto_1").val("");

// 				            	;
// 				            }	
// 			            }
// 			            else{

// 			            }
// 		        }
// 		    });
// 	});
// });
}//---/*end








/////////////////////////////////////////////
/////////////// /*ORDENAR*/

var hacer_detalle_vacante = function(btn, idval, seccion){//--Begin

	// console.log("hacer_detalle");

	// var btn = $(btn);
	var seccion=seccion;

	// btn.click(function(event)
	$(document).on("click",btn,function(event)
	{
		event.preventDefault();
		var current =$(this);
		var id= current.attr("id-element");
		var key_data_element="";						
		var data_element = $.grep(list_vacante, function(value,key){
			console.log(value[idval]);
			if (value[idval] == id) {
				key_data_element=key;
				return value;
			}
		}, false);

		console.log("data_element");
			console.log(data_element);

		$("body").append('<div class="overlay"></div>');
	
		$("body").append(
			'<div class="col-sm-10 col-sm-offset-1" id="detalles_contenedor">'+
			  
			  '<a href="#" class="btn_close smaler_btn_close" id=""> X </a>'+

			  '<form id="form_two" name="form_two" method="post" action="paginas/bolsatrabajo/control.php"  enctype="multipart/form-data">'+

			  '<input name="seccion" type="text" value="editar" hidden/>'+

			  '<input name="id" type="text" value="'+id+'" hidden/>'+

			  '<input name="orden" type="text" value="'+data_element[0].orden_vacante+'" hidden/>'+

			  '<div class="col-sm-12" style="background:none; ">'+
			    '<h1 style="">detalles del vacante:</h1>'+
			  '</div>'+

		    
		    '<div class="col-xs-12">'+
		    '<h6>Título de la nueva vacante:</h6>'+

		    '<input type="text" id="text_field" class="validate[required]"  name="titulo" value="'+data_element[0].titulo+'"/>'+

		'    <h6>Puesto:</h6>'+
		    '<input type="text" id="text_field" class="validate[required]"  name="puesto" value="'+data_element[0].puesto+'"/>'+

		'    <h6>Sueldo:</h6>'+
		    '<input type="text" id="text_field" class="validate[required]"  name="sueldo" value="'+data_element[0].sueldo+'"/>'+

		    '<h6>descripcion:</h6>'+
		    '<input type="text" id="text_field" class="validate[required]"  name="descripcion" value="'+data_element[0].descripcion+'"/>'+



		   ' <h6>Años de experiencia:</h6>'+
   ' <input type="text" id="text_field" class="validate[required]"  name="anos" value="'+data_element[0].anos+'"/>'+

   ' <div class="col-xs-6">'+
   ' <h6>Edad miníma:</h6>'+
   ' <input type="text" id="text_field" class="validate[required]"  name="edad_min" value="'+data_element[0].edad_min+'"/>'+
  '  </div>'+

    '<div class="col-xs-6">'+
    '<h6>Edad máxima:</h6>'+
    '<input type="text" id="text_field" class="validate[required]"  name="edad_max" value="'+data_element[0].edad_max+'"/>'+
   ' </div>'+

    '<h6>Estudios Mínimos:</h6>'+
    '<input type="text" id="text_field" class="validate[required]"  name="estudios" value="'+data_element[0].estudios+'"/>'+

   ' <h6>Localidad:</h6>'+
    '<input type="text" id="text_field" class="validate[required]"  name="localidad" value="'+data_element[0].localidad+'"/>'+

   ' <h6>Idiomas:</h6>'+
   ' <input type="text" id="text_field" class="validate[required]"  name="idiomas" value="'+data_element[0].idiomas+'"/>'+


    '<h6>Conocimientos Informáticos:</h6>'+
    '<input type="text" id="text_field" class="validate[required]"  name="informatica" value="'+data_element[0].informatica+'"/>'+
'<br>  <br>'+
    '<h6>licencia de conducir</h6>'+
    '<input type="radio" class="validate[required]" name="licencia" value="a"> A &nbsp;&nbsp;|&nbsp;&nbsp;'+
    '<input type="radio" class="validate[required]" name="licencia" value="b"> B &nbsp;&nbsp;|&nbsp;&nbsp;'+
    '<input type="radio" class="validate[required]"  name="licencia" value="c"> C &nbsp;&nbsp;|&nbsp;&nbsp;'+
    '<input type="radio" class="validate[required]" name="licencia" value="d"> D &nbsp;&nbsp;|&nbsp;&nbsp;'+
    '<input type="radio"  class="validate[required]" name="licencia" value="sin permiso"> Sin permiso'+
    '<br>  <br>'+
    '<h6>Disponibilidad para Viajar:</h6>'+
   ' <input type="radio" class="validate[required]" name="viajar" value="si"> Si &nbsp;&nbsp;|&nbsp;&nbsp;'+
    '<input type="radio" class="validate[required]" name="viajar" value="no"> No '+
   ' <br>  <br>'+
   ' <h6>Disponibilidad para Cambio de residencia:</h6>'+
    '<input type="radio" class="validate[required]" name="cambio" value="si"> Si &nbsp;&nbsp;|&nbsp;&nbsp;'+
   ' <input type="radio" class="validate[required]" name="cambio" value="no"> No '+
    '<br>  <br>'+
     ' <h6>Personas con discapacidad:</h6>'+
   ' <input type="radio" class="validate[required]" name="discapacidad" value="si"> Si &nbsp;&nbsp;|&nbsp;&nbsp;'+
 '   <input type="radio" class="validate[required]" name="discapacidad" value="no"> No '+
'<br>  <br>'+


















		'  </div>'+

		'    <div class="col-xs-5">'+

		'      <h6>Fecha de inicio:</h6>'+
		      '<input type="text" id="text_field" class="validate[required]"  id="fecha_ini" name="fecha_ini" value="'+data_element[0].fecha_ini+'" data-provide="datepicker" />'+

		'    </div>'+

		'    <div class="col-xs-5">'+
		'      <h6>Fecha de termino:</h6>'+
		'      <input type="text" id="text_field" class="validate[required]"  id="fecha_fin"name="fecha_fin" value="'+data_element[0].fecha_fin+'" data-provide="datepicker"/>'+

		'</div>'+

			 '<div class="galeria_select_tipo col-xs-12">'+

			'      <br>'+
			'        <label><h6>Tipo de vacante:</h6></label>'+
			'      <div class="select_tipo_cont">'+


			'        <select class="validate[required]"  id="tipo_form_dinamic" name="tipo" style="float:left" value="'+data_element[0].id_tipo+'"  title="'+data_element[0].nombre_tipo+'">'+

			 			'<option value="'+data_element[0].id_tipo+'">'+data_element[0].nombre_tipo+'</option>'+


			'        </select>'+
			'      </div>'+
			'    </div> '+


			    '<div class="clear"></div>'+
			    '<div class="col-xs-12">'+
			'<input name="enviar" type="submit" value="Actualizar Proyecto" id="enviar_window" class="btn btn-default"/>'+
			'</div>'+

			'</form>'+

			'</div>'
			);



		$.each(list_tipo_vacante,function(key,value){
			// //console.log(key);
			// //console.log(value);
			if (value.id_tipo!==data_element[0].id_tipo) {
				$("#tipo_form_dinamic").append('<option value= "'+value.id_tipo+'" name_data="'+value.nombre_tipo+'">'+value.nombre_tipo+'  </option>');
			};

		})


		$("#tipo_form_dinamic").selectpicker({
                style: 'chosen-container',
                showIcon:true,
  				size: 4,
  				width: "50%",
  				showTick:false,
  				actionsBox:false,
            });

		$('#tipo_form_dinamic option[value="'+data_element[0].id_tipo+'"]').attr("selected",true);

		var select_origen=$("#tipo_form_dinamic");




		select_origen.on("change", function(){

			var current=$(this);
			var current_val=current.val();
			console.log(current_val);

			// if (current_val === "add") {
			// 	//console.log(current);

			// 	$(".select_tipo_dinamico").fadeOut(1000);
				
			// 	$("#tipo_form_dinamic").attr("name","" );	

			// 	$(".actualizar_select_tipo").append('<br> <div class="tipo_item"> <input id="tipo" class="validate[required]" name="tipo" value="Nuevo tipo de imagen"/><a href="#" class="borrar_tipo btn_close list_btn_close">X</a></div>');

			// 	// $('suela'+suela_count).prop( "disabled", true );


			// 	var btn_borrar=$(".borrar_tipo");
			// 	btn_borrar.click(function(event){
			// 		event.preventDefault();
			// 		$(this).parent().remove();
			// 		$(".select_tipo_dinamico").fadeIn(1000);
			// 		select_origen.attr("name","tipo" );	
			// 	});

			// };	

		});





		var cont=$("#detalles_contenedor");

		
		cont.css("height",$( window ).height()-100);


		$(".btn_close, .overlay").click(function(){
			cont.fadeOut(1000,"easeOutQuint",function(){
				$(this).remove();	
			});
			$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
		});


		cont.hide().fadeIn(1000,"easeInOutExpo");
		$(".overlay").hide().fadeIn(1000,"easeOutExpo");


///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////----------- SUMIT ACTUALIZAR

		var frm2 = $('#form_two');
		// console.log(frm2);

		frm2.submit(function (ev) {
			ev.preventDefault();
			console.log($(this));
			loader_add("img/loader.gif");

    			$.ajax({
		            cache: false,
		            contentType: false,
		            processData: false,
		            type: frm2.attr('method'),
		            url: frm2.attr('action'),
		            data: new FormData(this),
		            success: function (data) {	
		            	
		            	loader_del();
		            	console.log(data);

		            	if (data != "null")
		            	{
		            		var data=JSON.parse(data);	
		            		if (data.respuesta) 
		            		{
	    						console.log(data);

	    			// 			$("#content_img_detalle").slideUp(1000,"easeOutQuint",function(){
								// 	$(this).remove();	
								// });

								$("#respuesta_window").hide().fadeIn(1000, "swing").delay(2000).slideUp(1000, "swing", function(){
				                	$(this).remove();
				                });
							
			               

			                	$("#row"+data.id).find('.titulo_td a').remove();
			                	$("#row"+data.id).find('.titulo_td').append(
			                		'<a class="small" href= "#" target="_blank">'+data.titulo+'</a>');

			                	$("#row"+data.id).find('.puesto_td a').remove();
			                	$("#row"+data.id).find('.puesto_td').append(
			                		'<a class="small" href= "#" target="_blank">'+data.puesto+'</a>');


			                	$("#row"+data.id).find('.sueldo_td a').remove();
			                	$("#row"+data.id).find('.sueldo_td').append(
			                		'<a class="small" href= "#" target="_blank">'+data.sueldo+'</a>');


			                	$("#row"+data.id).find('.fecha_fin_td a').remove();
			                	$("#row"+data.id).find('.fecha_fin_td').append(
			                		'<a class="small" href= "#" target="_blank">'+data.fecha_fin+'</a>');

			                	console.log(list_tipo_vacante);
			                	console.log("	data_tipo_vacante");
			                	

			                	var data_tipo_vacante = $.grep(list_tipo_vacante, function(value,key){
									
									if (value["id_tipo"] == data.tipo) {
									// 	// key_data_element=key;
										return value;
									 }
								}, false);

								console.log(data_tipo_vacante[0]["nombre_tipo"]);



								$("#row"+data.id).find('.tipo_td a').remove();
			                	$("#row"+data.id).find('.tipo_td').append(
			                		'<a class="small" href= "#" target="_blank">'+data_tipo_vacante[0]["nombre_tipo"]+'</a>');


			                	
			     // //            	console.log("data"); 
			     // //            	console.log(data);
			     // //            	console.log("data_element"); 
		      // //           		console.log(data_element);
		      // //           		console.log("key_data_element"); 
								// // console.log(key_data_element); 
								// // console.log("data.imagenes[0].file");         
								// // console.log(data.imagenes[0].file); 

								$.each(list_vacante, function(key, value){


									if (key==key_data_element) {
										
										value["titulo"]=data.titulo;
										value["id_tipo"]=data.tipo;
										value["id_tipo"]=data.tipo;
										value["nombre_tipo"]=data_tipo_vacante[0]["nombre_tipo"];
										value["descripcion"]=data.descripcion;
										value["sueldo"]=data.sueldo;
										value["puesto"]=data.puesto;
										value["fecha_ini"]=data.fecha_ini;
										value["fecha_fin"]=data.fecha_fin;

						value["anos"]=data.anos;
						value["edad_min"]=data.edad_min;
						value["edad_max"]=data.edad_max;
						value["estudios"]=data.estudios;
						value["localidad"]=data.localidad;
						value["idiomas"]=data.idiomas;
						value["informatica"]=data.informatica;
						value["licencia"]=data.licencia;
						value["viajar"]=data.viajar;
						value["cambio"]=data.cambio;
						value["discapacidad"]=data.discapacidad;
				




										// console.log("PUSH DATA");
										// console.log(value);  
									}
								});
											            
					   //          // console.log("new liust");
					   //          // console.log(list_productos); 											     
			            
							 }
			          
				            else{
				            	$("#ya_existe").fadeIn(1000, "swing").delay(1000).fadeOut(500, "swing");
				            }	
			            }
			            else{

			            }
		        }
		    });
	});
});
}//---/*end






///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////


var vacante_page_template= function(idval, seccion)
{				

			var idval_name=idval.substring(3);
			console.log(idval_name);

			var frm = $('#form_one');
			

			$( "a, input" ).tooltip({
		      position: {
		        my: "left top-1000",
		        at: "left top-1000",
		        using: function( position, feedback ) {
		        	console.log("tooltip");
		        	console.log(position);
		        	console.log(feedback);
		          $( this ).css( position );
		          $( "<div>" )
		            .addClass( "arrow" )
		            .addClass( feedback.vertical )
		            .addClass( feedback.horizontal )
		            .appendTo( this );
		        }
		      }
		    });
			
			$("#n_contenedor").hide();

			$("#respuesta").hide(0);

			$(".imagen_td a").fancybox({
				    padding    : 0,
			        margin     : 0,
				});

			
			
			abrir_ventana_nuevo("#ad_btn",frm,"#text_field, #vacante_text_area, #foto_1");
		
			$(".imagen_td a").fancybox({
				    padding    : 0,
			        margin     : 0,
				});

			

			var table_obj=$('#example').DataTable({
				"order": [[0,"asc"]],
				"sScrollX": "25%",
				"bScrollCollapse": false,
				"autoWidth": false,
				"lengthMenu": [10, 25, 50],
				
			});




			$('#fecha_ini, #fecha_fin').datepicker({
				format: 'yyyy-mm-dd',
    			startDate: '-3d'
			});


			
			file_filter("#foto_1",5,"image/jpeg");

    		frm.submit(function (ev)
    		{
    			ev.preventDefault();
    			
    			// console.log(this);
    			if ($(this).validationEngine('validate'))
    			{
    				loader_add("img/loader.gif");
	    			console.log("its validate yuju");

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
			            	loader_del();

			            	console.log(data);
			            	if (data != "null")
			            	{
			            		var data=JSON.parse(data);	
			            		

			            		if (data.respuesta) 
			            		{ 

			            			console.log(data);
			            			var value={};
			            			
									
									value[idval]=data.id;
									value["titulo"]=data.titulo;
									value["orden"]=data.orden;
									value["puesto"]=data.puesto;
									value["sueldo"]=data.sueldo;
									value["tipo"]=data.tipo;
									value["fecha_fin"]=data.fecha_fin;

									value["anos"]=data.anos;
						value["edad_min"]=data.edad_min;
						value["edad_max"]=data.edad_max;
						value["estudios"]=data.estudios;
						value["localidad"]=data.localidad;
						value["idiomas"]=data.idiomas;
						value["informatica"]=data.informatica;
						value["licencia"]=data.licencia;
						value["viajar"]=data.viajar;
						value["cambio"]=data.cambio;
						value["discapacidad"]=data.discapacidad;
									
									console.log("PUSH DATA");
									console.log(value);

			            			
									// // if (typeof list_vacante === undefined) {
									// // 	var list_vacante={};
									// // };

									// console.log("list_vacante antes");
									// console.log(list_vacante);


									list_vacante.push(value);


			      //       			console.log("list_productos_despues");
									// console.log(list_vacante);				            		
					                
					                cerrar_ventana_nuevo(frm);
									

									console.log("------z---z---z----");
									console.log(data.fecha_fin);	


										var data_tipo_vacante = $.grep(list_tipo_vacante, function(value,key){
									
									if (value["id_tipo"] == data.tipo) {
									// 	// key_data_element=key;
										return value;
									 }
								}, false);

								console.log(data_tipo_vacante[0]["nombre_tipo"]);






					                $("#respuesta").fadeIn(1000, "swing");
					                $(".respuesta_cont").append('<h3 class="color"> Nombre:&nbsp;'+data.nombre+'</h3>');
					                $("#respuesta").delay(1500).fadeOut(500, "swing", function(){
					                	$(".respuesta_cont").find("h3").remove();
					                });

					                $("#ad_btn").show();

					                var jRow = $("<tr>").append(

										  '<td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									       ' <input  type="text" class="order_field" title="Cambia el orden" value="'+data.orden+'"  name="orden" id-data=" <?=$id;?> " >'+
									      '</td>',
									    
									      '<td class="titulo_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									       ' <a class="" href= "#" >'
									        +data.titulo+
									        '</a>'+
									      '</td>',


									      '<td class="puesto_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									       ' <a class="" href= "#" >'
									        +data.puesto+
									        '</a>'+
									      '</td>',

									      '<td class="sueldo_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									       ' <a class="" href= "#" >'
									        +data.sueldo+
									        '</a>'+
									      '</td> ',

									      '<td class="fecha_fin_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									       ' <a class="" href= "#" >'
									        +data.fecha_fin+
									        '</a>'+
									      '</td> ',


									      '<td class="tipo_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									       ' <a class="" href= "#" >'
									        +data_tipo_vacante[0]["nombre_tipo"]+
									        '</a>'+
									      '</td> ',


									       '<td class="bordes editar_td" nowrap="nowrap" valign="top" align="center">'+
									        '<a href= "#" title="Ver el detalle" class="editar"  id-element="'+data.id+'" >'+
									         ' <img src="img/btn_ver.jpg" border="0"/>'+
									        '</a>'+
									        '</td>',

									      '<td class="bordes borrar_cont" nowrap="nowrap" valign="top" align="center">'+
									       ' <a class="borrar" id="noti_borrar" id-element="'+data.id+'" href="#"  method="post" action="paginas/bolsatrabajo/control.php" seccion="borrar">'+
									        '  <img src="img/btn_borrar.jpg" border="0"/>'+
									        '</a>'+
									      '</td>',


					               	);
									
									table_obj.row.add(jRow).draw();
									var last_row=$("tr:last");
									last_row.attr("id","row"+data.id);
									console.log(last_row);
		

					               	hacer_detalle_vacante("#editar"+data.id, idval, seccion);
				            	}
				            	else{[]
				            		$("#ya_existe").append(data.msj);
				            		$("#ya_existe").fadeIn(1000, "swing").delay(3000).fadeOut(500, "swing", function(){
				            			$(this).find("h3").remove();
				            		});
				            		// $("#ad_btn").show();
				            	}	
			            	}
			            }
			        });
					// /////<------ /* END ajax
                   
                }
                else{
                	    			// console.log("NO its not");
                }

    		});

    			ordenar(".order_field", "ordenar", "paginas/vacante/control.php" )
				
				borrar_element(".borrar", list_vacante);

				
				console.log("hacer_detalle");
				console.log(idval);

				hacer_detalle_vacante(".editar", idval, seccion);
};
///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////



var load_page_vacante=function(seccion){
	
	$('body,html').animate({'scrollTop':0},0);	

	var load_content=$(".load_content");
	seccion_anterior=seccion;
	var btn;

	switch(seccion)
	{


//////////////////////////////////////////////////////////////////////
//---------------------------------- C L A S E -----------------
//////////////////////////////////////////////////////////////////////			

		case "vacantes":	

		console.log("load_page_vacante");

		vacante_page_template("id_vacante","editar_vacante");

		break;


		case "tipos_vacante":	

		console.log("TIPOS DE VANCATE");


		vacante_page_tipo_template("id_tipo","editar_tipo");

		break;




			default:
				// console.log("test___");
			break;			






	}

}

/////////////////////////////////////////////
/////////////// /*  TODO  */
////////////////////////////////////////////
$ (document).ready(function(){


	console.log(GLOBAL_GET_DATA.seccion);
	load_page_vacante(GLOBAL_GET_DATA.seccion);

});


