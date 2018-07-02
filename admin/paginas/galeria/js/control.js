// // JavaScript Document


var seccion_anterior;




///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////


var galeria_page_tipo_template= function(idval, seccion)
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

			            	//console.log(data);
			            	if (data != "null")
			            	{
			            		var data=JSON.parse(data);	
			            		if (data.respuesta) 
			            		{

									var value_tipo={};
									value_tipo["id_tipo"]=data.id;
									value_tipo["nombre_tipo"]=data.nombre;
									value_tipo["nombre_tipo_ingles"]=data.nombre_ingles;
									value_tipo["file_name"]=data.imagenes[0].name;

									// //console.log("-----------list_tipo_galeria");
									// //console.log(list_tipo_galeria);

									

									// list_galeria.push(value);
									list_tipo_galeria.push(value_tipo);
									

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
									        '<a href= "#" >'+data.nombre+'</a>'+
									      '</td> ',


									   ' <td class="imagen_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<a href= "paginas/galeria/'+value_tipo["file_name"]+'" target="blank" >'+
									           '<img src= "paginas/galeria/'+value_tipo["file_name"]+'" alt="" style="height:70px;"/>'+
									        '</a>'+
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

					               	hacer_detalle_galeria("#editar"+data.id, idval, seccion);
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
				
				borrar_element(".borrar",list_tipo_galeria);

				hacer_detalle_galeria_tipo(".editar", idval, seccion);

				//console.log("hacer_detalle");
				//console.log(idval);
};

///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////


////////////////////////////////////////////
/////////////// /*ORDENAR*/

var hacer_detalle_galeria_tipo = function(btn, idval, seccion){//--Begin


	// var btn = $(btn);
	var seccion=seccion;

	// btn.click(function(event)
	$(document).on("click",btn,function(event)
	{
		event.preventDefault();
		var current =$(this);
		var id= current.attr("id-element");
		var key_data_element="";						
		var data_element = $.grep(list_tipo_galeria, function(value,key){
			//console.log(value[idval]);
			if (value[idval] == id) {
				key_data_element=key;
				return value;
			}
		}, false);



		$(document).bind("keypress.key27", function(event) {
					
				    if (event.keyCode == 27) {
						//console.log(event);
						//console.log(event.keyCode);
						$("#detalles_contenedor").fadeOut(1000,"easeOutQuint",function(){
							$(this).remove();	
						});
						$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
						$(document).unbind("keypress.key27");

				    }
				});


	data_element=data_element[0];

	//console.log("hacer_detalle");
	//console.log("data_element tipo");
	//console.log(data_element);

		$("body").append('<div class="overlay"></div>');
		
		$("body").append(


			'<div class="col-sm-10 col-sm-offset-1" id="detalles_contenedor">'+
			  
			  '<a href="#" class="btn_close smaler_btn_close " id=""> X </a>'+

			  '<form class="" id="form_two" name="form_two" method="post" action="paginas/galeria/control.php"  enctype="multipart/form-data">'+
			  '<input name="seccion" type="text" value="editar_tipo" hidden/>'+
			  '<input name="id" type="text" value="'+id+'" hidden/>'+

			  '<div class="col-sm-12" style="background:none; ">'+
			    '<h1 style="">detalles del tipo:</h1>'+
			  '</div>'+
			  
			  '<div id="nombre" class="col-sm-12">'+
			    '<span class="label label-primary col-sm-2">Nombre:</span>'+
			    '<p><input name="nombre" class="validate[required]" type="text" maxlength="100" value="'+data_element.nombre_tipo+'"/></p>'+
			  '</div>'+

			  '<div id="nombre" class="col-sm-12">'+
			    '<span class="label label-primary col-sm-2">Nombre:</span>'+
			    '<p><input name="nombre_ingles" class="validate[required]" type="text" maxlength="100" value="'+data_element.nombre_tipo_ingles+'"/></p>'+
			  '</div>'+
			
			   // '<div id="imagenes" class="col-sm-12 border-bottom">'+

			   //  '<span class="label label-primary col-sm-2">imágenes :</span>'+
			   //  '<div class="clear"></div>'+
			   //  '</div>'+
			    '<div class="clear"></div>'+
			'<input name="enviar" type="submit" value="Actualizar Proyecto" id="enviar_window" class="btn btn-default"/>'+

			'</form>'+

			'</div>'
			);

		var cont=$("#detalles_contenedor");

		
		cont.css("height",$( window ).height()-100);


		$(".btn_close, .overlay").click(function(){
			$("#detalles_contenedor").fadeOut(1000,"easeOutQuint",function(){
				$(this).remove();	
			});
			$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
			$(document).unbind("keypress.key27");
		});

		if (data_element.file_name !="") {

			$("#imagenes").append(
				'<div id="row_image'+data_element.id_tipo+'" class="col-md-3 col-sm-12 image_item">'+
					'<div id="img_preview_cont">'+
					'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data_element.id_tipo+'" href= "#"  method="post" action="paginas/galeria/control.php" seccion="borrar_foto_tipo">'+
			        		'X</a>'+
					'<img id="img_preview"src="paginas/galeria/'+data_element.file_name+'" alt="foto">'+
					'</div>'+
					    
				'</div>'
				);

			borrar_imagen(".borrar_img", list_tipo_galeria, key_data_element,"image/png","tipo_galeria");

		}
		//_------/* FIN BORRAR
		else{
				$("#imagenes").append(
				' <br><div class="" id="content_img_detalle">'+
			      '<label><h6>Imagen principal: </h6><span class="small color" style="font-size:13px;">La imagen debe tener una medida de 2048px x 1152px de preferencia en positivo y con transparencia.</span></label>'+
     				' <p class="small">Seleccione el archivo PNG:'+
			      '<input type="file" class="validate[required]" name="foto_2" id="foto_2"/> </p>'+
			    '</div>'
				);

				file_filter("#foto_2",5,"image/png");

		}

		cont.hide().fadeIn(1000,"easeInOutExpo");
		$(".overlay").hide().fadeIn(1000,"easeOutExpo");


///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////----------- SUMIT ACTUALIZAR

		var frm2 = $('#form_two');
		// //console.log(frm2);

		frm2.submit(function (ev) {
			ev.preventDefault();
			//console.log($(this));
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
		            	
		            	if (data != "null")
		            	{
		            		var data=JSON.parse(data);	
		            		//console.log("data ajax response");
		            		//console.log(data);
		            		if (data.respuesta) 
		            		{
	    						//console.log($("#content_img_detalle"));

	    						$("#content_img_detalle").slideUp(1000,"easeOutQuint",function(){
									$(this).remove();	
								});

								$("#imagenes").append('<div class="col-xs-10" id="respuesta_window" style="">'+
								    '<h3 class="small color"> Se ha actualizado la información</h3> '+
								'</div>');


								$("#respuesta_window").hide().fadeIn(1000, "swing").delay(2000).slideUp(1000, "swing", function(){
				                	$(this).remove();
				                });
				                
				                
					             if (data.imagenes[0].id_foto !="") {
				                	$("#imagenes").append
				                	(
										'<div id="row_image'+data.imagenes[0].id_foto+'" class="col-md-3 col-sm-12 image_item">'+
											'<div id="img_preview_cont">'+
											'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data.imagenes[0].id_foto+'" href= "#"  method="post" action="paginas/galeria/control.php" seccion="borrar_foto">'+
									        		'X</a>'+
											'<img id="img_preview"src="paginas/galeria/'+data.imagenes[0].file+'" alt="foto">'+
											'</div>'+
											    
										'</div>'
									);

				                	var img_name= data.imagenes[0].file.substring(data.imagenes[0].file.lastIndexOf('/') + 1);

				                	// $("#row"+data.id).find('.imagen_td a').attr("id-element",data.id);
				                	// $("#row"+data.id).find('.imagen_td a').text(img_name);

				                	//console.log(data.id);

				                	$("#row"+data.id).find('.imagen_td a').remove();
			                		$("#row"+data.id).find('.imagen_td').append(
			                		' <a href= "paginas/galeria/'+data.imagenes[0].file+'" target="blank" >'+
							           '<img src= "paginas/galeria/'+data.imagenes[0].file+'" alt="'+data.nombre+'" style="height:70px;"/>'+
							        '</a>'
							        );
				                }

			                	$("#row"+data.id).find('.nombre_td a').remove();
			                	$("#row"+data.id).find('.nombre_td').append(
			                		'<a class="" href= "#" >'+data.nombre+'</a>');

			                	// $("#row"+data.id).find('.tipo_td a').remove();
			                	// $("#row"+data.id).find('.tipo_td').append(
			                	// 	'<a class="" href= "#" >'+data.nombre+'</a>');


			                	
			     //            	//console.log("data"); 
			     //            	//console.log(data);
			     //            	//console.log("data_element"); 
		      //           		//console.log(data_element);
		                		//console.log("key_data_element"); 
								// //console.log(key_data_element); 
								// //console.log("data.imagenes[0].file");         
								// //console.log(data.imagenes[0].file); 

								$.each(list_tipo_galeria, function(key, value){


									if (key==key_data_element) {
										if (data.imagenes[0].id_foto!="") {
											value["thumb"]=data.imagenes[0].file;
											value["file_name"]=data.imagenes[0].file;
											value["id_imagen"]=data.imagenes[0].id_foto;

										}
										value["nombre"]=data.nombre;
										value["nombre_tipo"]=data.nombre;
										value["nombre_tipo_ingles"]=data.nombre_ingles;
										// value["id_tipo"]=data.tipo_id;
										// //console.log("PUSH DATA");
										// //console.log(value);  
									}
								});
											            
					            // //console.log("new liust");
					            // //console.log(list_productos); 											     
			            
							 }
			          
				            else{
				            	$("#ya_existe").fadeIn(1000, "swing").delay(1000).fadeOut(500, "swing");
				            	$("#imagenes").append('<div id="msj_response">'+data.msj+'</div>');
				            	$("#msj_response").hide().fadeIn(600,"easeOutQuint").delay(2000).fadeOut(500,'easeInOutExpo',function(){
				            		$('input[type=file]').val("");
				            		$(this).remove();
				            	});
				            	$("#foto_1").val("");

				            	;
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




/////////////////////////////////////////////
/////////////// /*ORDENAR*/

var hacer_detalle_galeria = function(btn, idval, seccion){//--Begin

	// //console.log("hacer_detalle");

	// var btn = $(btn);
	var seccion=seccion;

	// btn.click(function(event)
	$(document).on("click",btn,function(event)
	{
		event.preventDefault();
		var current =$(this);
		var id= current.attr("id-element");
		var key_data_element="";						
		var data_element = $.grep(list_galeria, function(value,key){
			// //console.log(value[idval]);
			if (value[idval] == id) {
				key_data_element=key;
				return value;
			}
		}, false);

		$(document).bind("keypress.key27", function(event) {
					
				    if (event.keyCode == 27) {
						//console.log(event);
						//console.log(event.keyCode);
						$("#detalles_contenedor").fadeOut(1000,"easeOutQuint",function(){
							$(this).remove();	
						});
						$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
						$(document).unbind("keypress.key27");

				    }
				});


		if(data_element[0].nombre_tipo == undefined){
			data_element[0].nombre_tipo="Asigna un tipo";
		}
		// //console.log("data_element");
		// 	//console.log(data_element);

		$("body").append('<div class="overlay"></div>');
	
		$("body").append(
			'<div class="col-sm-10 col-sm-offset-1" id="detalles_contenedor">'+
			  
			  '<a href="#" class="btn_close smaler_btn_close" id=""> X </a>'+

			  '<form id="form_two" name="form_two" method="post" action="paginas/galeria/control.php"  enctype="multipart/form-data">'+
			  '<input name="seccion" type="text" value="editar" hidden/>'+
			  '<input name="id" type="text" value="'+id+'" hidden/>'+
			   '<input name="orden" type="text" value="'+data_element[0].orden+'" hidden/>'+

			  '<div class="col-sm-12" style="background:none; ">'+
			    '<h1 style="color:dodgerblue; ">detalles de la clase:</h1>'+
			  '</div>'+
			  
			  '<div id="nombre" class="col-sm-12">'+
			    '<span class="label label-primary col-sm-2">Nombre:</span>'+
			    '<p><input name="nombre" class="validate[required]" type="text" maxlength="100" value="'+data_element[0].nombre+'"/></p>'+
			  '</div>'+

			  // '<div id="tipo_dinamic" class="col-sm-12">'+
			  //   '<span class="label label-primary col-sm-2">Tipo:</span>'+
			  //   // '<p><input name="url" class="validate[required]" type="text" maxlength="100" value="'+data_element[0].nombre_tipo+'"/></p>'+
			  // '</div>'+

			 '<div class="actualizar_select_tipo col-sm-12">'+

		
			        '<label><h6>Tipo de foto:</h6></label>'+
			      '<div class="select_tipo_dinamico">'+

			        '<select class="validate[required]"  id="tipo_form_dinamic" name="tipo" title="'+data_element[0].nombre_tipo+'">'+

			           '<option value="'+data_element[0].id_tipo+'">'+data_element[0].nombre_tipo+'</option>'+
			        '</select>'+
			      '</div>'+
			    '</div> '+
			    '<div class="clear"></div><br> '+

			   '<div id="imagenes" class="col-sm-12 border-bottom">'+
			    '<span class="label label-primary col-sm-2">imágenes :</span>'+
			    '<div class="clear"></div>'+
			    '</div>'+
			    '<div class="clear"></div>'+
			'<input name="enviar" type="submit" value="Actualizar Proyecto" id="enviar_window" class="btn btn-default"/>'+

			'</form>'+

			'</div>'
			);
		
		$.each(list_tipo_galeria,function(key,value){
			// //console.log(key);
			// //console.log(value);
			if (value.id_tipo!==data_element[0].id_tipo) {
				$("#tipo_form_dinamic").append('<option value= "'+value.id_tipo+'" name_data="'+value.nombre_tipo+'">'+value.nombre_tipo+'  </option>');
			};

		})

		// $("#tipo_form_dinamic").append('<option value="add">Agregar un tipo nuevo</option>');


	$("#tipo_form_dinamic").selectpicker({
                style: 'chosen-container',
                showIcon:true,
  				size: 4,
  				width: "50%",
  				showTick:false,
  				actionsBox:false,
            });


		var select_origen=$("#tipo_form_dinamic");

		select_origen.on("change", function(){

			var current=$(this);
			var current_val=current.val();
			// //console.log(current_val);

			if (current_val === "add") {
				//console.log(current);

				$(".select_tipo_dinamico").fadeOut(1000);
				
				$("#tipo_form_dinamic").attr("name","" );	

				$(".actualizar_select_tipo").append('<br> <div class="tipo_item"> <input id="tipo" class="validate[required]" name="tipo" value="Nuevo tipo de imagen"/><a href="#" class="borrar_tipo btn_close list_btn_close">X</a></div>');

				// $('suela'+suela_count).prop( "disabled", true );


				var btn_borrar=$(".borrar_tipo");
				btn_borrar.click(function(event){
					event.preventDefault();
					$(this).parent().remove();
					$(".select_tipo_dinamico").fadeIn(1000);
					select_origen.attr("name","tipo" );	
				});

			};	

		});

		var cont=$("#detalles_contenedor");

		cont.css("height",$( window ).height()-50);



		$(".btn_close, .overlay").click(function(){
			$("#detalles_contenedor").fadeOut(1000,"easeOutQuint",function(){
				$(this).remove();	
			});
			$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
			$(document).unbind("keypress.key27");

		});

			// 	//console.log("list prodº");
			// //console.log(list_productos);
		
		if (data_element[0].file_name !="" && data_element[0].id_imagen != null) {

			// //console.log("data_element.file_name");
			// //console.log(data_element);

			$("#imagenes").append(
				'<div id="row_image'+data_element[0].id_imagen+'" class="col-md-3 col-sm-12 image_item">'+
					'<div id="img_preview_cont">'+
					'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data_element[0].id_imagen+'" href= "#"  method="post" action="paginas/galeria/control.php" seccion="borrar_foto">'+
			        		'X</a>'+
					'<img id="img_preview"src="paginas/galeria/'+data_element[0].thumb+'" alt="foto">'+
					'</div>'+
					    
				'</div>'
				);



		borrar_imagen(".borrar_img", list_galeria, key_data_element,"image/jpeg","galeria");


		}
		//_------/* FIN BORRAR
		else{

			// //console.log("ESTA VACIO");

				$("#imagenes").append(
				' <br><div class="" id="content_img_detalle">'+
			      '<label><h6>Carga tu Imagen:</h6></label>'+
			      '<p class="small">Seleccione el archivo JPG:'+
			      '<input type="file" class="validate[required]" name="foto_2" id="foto_2"/> </p>'+
			    '</div>'
				);

				file_filter("#foto_2",5,"image/jpeg");

		}

		cont.hide().fadeIn(1000,"easeInOutExpo");
		$(".overlay").hide().fadeIn(1000,"easeOutExpo");


///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////----------- SUMIT ACTUALIZAR

		var frm2 = $('#form_two');
		// //console.log(frm2);

		frm2.submit(function (ev) {
			ev.preventDefault();
			//console.log($(this));
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
		            	
		            	if (data != "null")
		            	{
		            		var data=JSON.parse(data);	
		            		//console.log("data ajax response");
		            		//console.log(data);
		            		if (data.respuesta) 
		            		{
	    						// //console.log($("#content_img_detalle"));

	    						

							

								$("#imagenes").append('<div class="col-xs-10" id="respuesta_window" style="">'+
								    '<h3 class="small"> Se ha actualizado la información</h3> '+
								'</div>');


								$("#respuesta_window").hide().fadeIn(1000, "swing").delay(2000).slideUp(1000, "swing", function(){
				                	$(this).remove();
				                });
				                
				                
					             if (data.imagenes[0].id_foto !="") {
					             	$("#content_img_detalle").slideUp(1000,"easeOutQuint",function(){
									$(this).remove();	
								});

				                	$("#imagenes").append
				                	(
										'<div id="row_image'+data.imagenes[0].id_foto+'" class="col-md-3 col-sm-12 image_item">'+
											'<div id="img_preview_cont">'+
											'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data.imagenes[0].id_foto+'" href= "#"  method="post" action="paginas/galeria/control.php" seccion="borrar_foto">'+
									        		'X</a>'+
											'<img id="img_preview"src="paginas/galeria/'+data.imagenes[0].file+'" alt="foto">'+
											'</div>'+
											    
										'</div>'
									);

				                	var img_name= data.imagenes[0].file.substring(data.imagenes[0].file.lastIndexOf('/') + 1);

				                	// $("#row"+data.id).find('.imagen_td a').attr("id-element",data.id);
				                	// $("#row"+data.id).find('.imagen_td a').text(img_name);

				                	//console.log(data.id);

				                	$("#row"+data.id).find('.imagen_td a').remove();
			                		$("#row"+data.id).find('.imagen_td').append(
			                		' <a href= "paginas/galeria/'+data.imagenes[0].file+'" target="blank" >'+
							           '<img src= "paginas/galeria/'+data.imagenes[0].file+'" alt="'+data.nombre+'" style="height:70px;"/>'+
							        '</a>'
							        );
				                }

			                	$("#row"+data.id).find('.nombre_td a').remove();
			                	$("#row"+data.id).find('.nombre_td').append(
			                		'<a class="" href= "#" >'+data.nombre+'</a>');

			                	$("#row"+data.id).find('.tipo_td a').remove();
			                	$("#row"+data.id).find('.tipo_td').append(
			                		'<a class="" href= "#" >'+data.tipo_nombre+'</a>');


			                	
			     //            	//console.log("data"); 
			     //            	//console.log(data);
			     //            	//console.log("data_element"); 
		      //           		//console.log(data_element);
		      //           		//console.log("key_data_element"); 
								// //console.log(key_data_element); 
								// //console.log("data.imagenes[0].file");         
								// //console.log(data.imagenes[0].file); 

								$.each(list_galeria, function(key, value){


									if (key==key_data_element) {
										if (data.imagenes[0].id_foto!="") {
											value["thumb"]=data.imagenes[0].file;
											value["file_name"]=data.imagenes[0].file;
											value["id_imagen"]=data.imagenes[0].id_foto;

										}
										value["nombre"]=data.nombre;
										value["nombre_tipo"]=data.tipo_nombre;
										value["id_tipo"]=data.tipo_id;
										// //console.log("PUSH DATA");
										// //console.log(value);  
									}
								});
											            
					            // //console.log("new liust");
					            // //console.log(list_productos); 											     
			            
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


var galeria_page_template= function(idval, seccion)
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

			$(".imagen_td a").fancybox({
				    padding    : 0,
			        margin     : 0,
				});

			// $(".imagen_td img").dialog();
			// $( ".imagen_td img" ).dialog({
   //    autoOpen: false,
   //    show: {
   //      effect: "blind",
   //      duration: 1000
   //    },
   //    hide: {
   //      effect: "explode",
   //      duration: 1000
   //    }
   //  });
			// var list_galeria_json=JSON.parse(list_galeria);

			// var list_galeria_json=[];
			// list_galeria_json["data"]=[];

			// $.each(list_galeria, function(key,value){
			// 	//console.log(key);
			// 	list_galeria_json["data"][key]={};
			// 	list_galeria_json["data"][key]["id"]=value.id_galeria;
			// 	list_galeria_json["data"][key]["orden"]=value.orden;
			// 	list_galeria_json["data"][key]["nombre"]=value.nombre_tipo;
			// 	list_galeria_json["data"][key]["imagen"]="files/"+value.id_galeria+"/"+value.thumb;
			// 	list_galeria_json["data"][key]["ver"]=value.nombre_tipo;
			// 	list_galeria_json["data"][key]["borrar"]="files/"+value.id_galeria+"/"+value.thumb;
			// });

			// //console.log(list_galeria_json);




			// //console.log("--------______----BKG control----_____--------");

			// var rows= table_obj.rows().nodes().to$();

			var clear_bkg_td = function(rows){

					// //console.log(rows.find('.bkg_td>label>input'));

				 rows.find('.bkg_td>label>input').each(function(index){

					

					if ($(this).attr('value') == 1) {
						// //console.log("--------______----value is = 1----_____--------");
						// //console.log($(this).attr('checked'));
						$(this).attr('checked',"");
						$(this).parent().addClass('active');
					}
					else{
						// //console.log("--------______----VALUE NO ES IGUAL A 1----_____--------");
						// //console.log();
						$(this).attr('checked',"");
						$(this).parent().removeClass('active');
					}


				});	

				// //console.log(rows.find('.bkg_td>label>input'));


				rows.find('.bkg_td>label>input').on('change',function(ev){
				
				// //console.log("change");
				// //console.log(ev.target);

				ev.preventDefault();

				var self=$(ev.target);//$(this);
				var id=$(ev.target).attr('id-element');
				var seccion=$(ev.target).attr('seccion');
				var data_attr="";

				loader_add("img/loader.gif");

				$.ajax({
		            type: $(ev.target).attr('method'),
		            url: $(ev.target).attr('action'),
		            data: {id:id,seccion:seccion},
		            success: function (data) {	
		            	var data=JSON.parse(data);	

						
		            	loader_del();
		    //         	//console.log("----------------data");
						// //console.log(rows.find('.bkg_td>label>input').attr("value"));
		            	
		            	rows.find('.bkg_td>label>input').attr("value",0);
						rows.find('.bkg_td>label>input').attr('checked',"");
						rows.find('.bkg_td>label>input').parent().removeClass('active');;


		            	if (data.respuesta) {

		            		self.attr('checked',"");
		            		self.attr('value',1);
							self.parent().addClass('active');

		            	};
		            	
		            }
		        });
			});



				};





				var slide_item_method = function(rows){

					// //console.log("-------$(document).find('.slide_td>label>input')");
					// //console.log($(document).find('.slide_td>label>input'));

					rows.find('.slide_td>label>input').each(function(index){

						//console.log($(this).attr('value'));

						if ($(this).attr('value') == 1) {
							//console.log("--------______----value is = 1----_____--------");
							//console.log($(this).attr('checked'));
							$(this).prop('checked','');
							$(this).parent().addClass('active');
						}
						else{
							//console.log("--------______----VALUE NO ES IGUAL A 1----_____--------");
							// //console.log();
							
							$(this).prop('checked','checked');
							$(this).parent().removeClass('active');
						}

					});	

								// //console.log(rows.find('.slide_td>label>input'));

								
								rows.find('.slide_td>label>input').on('change',function(ev){

								ev.preventDefault();

								var self=$(ev.target);//$(this);
								var checked=self.prop( "checked" );

							

								var id=$(ev.target).attr('id-element');
								var seccion=$(ev.target).attr('seccion');
								var data_attr="";

								loader_add("img/loader.gif");

								// if (checked) {

								// 	//console.log("change");
								// 	//console.log(checked);

								// }
								// else{


									//console.log("change-----falseseerer");
									//console.log(checked);

								// }

								$.ajax({
						            type: $(ev.target).attr('method'),
						            url: $(ev.target).attr('action'),
						            data: {id:id,seccion:seccion,checked:checked},
						            success: function (data) {	
						            	var data=JSON.parse(data);	

						            	loader_del();
						            	//console.log("----------------data");
										//console.log(data);
						            	



						            	if (data.checked) {

						            		self.attr('checked',"");
						            		self.attr('value',1);
											self.parent().addClass('active');

						            	}else{

							            	self.attr("value",0);
											self.attr('checked',"");
											self.parent().removeClass('active');;

						            	}
						            	
						            }
						        });
							});



				};






				var table_obj=$('#example').DataTable( 
			{
				"order": [[1,"asc"]],
				"sScrollX": "100%",
				"bScrollCollapse": true,
				"lengthMenu": [5, 10, 50],
				 fnDrawCallback: function( oSettings ) {
				 	//console.log('--+-+-+-+-+--+--+-+TBODY');
				 	// //console.log($(oSettings.nTBody).find('.bkg_td>label>input'));
				 	var rows = $(oSettings.nTBody);
				 	slide_item_method(rows);
					clear_bkg_td(rows);
				 	// oSettings.TBody.hide();
      				// //console.log("in to teh data table");
      				
    			}
			});



		// 	slide_item_method(rows);

		// 	clear_bkg_td(rows);

		// $('#example').on( 'draw.dt', function () {
		//     // var info = table_obj.page.info();
		//      //console.log('Showing page:____Redrawing' );

		//     clear_bkg_td(rows);

		//     slide_item_method(rows);


		// });
		
			
			

			// rows.find('.bkg_td>label>input').css("width","200px");

			


			// $("tr").each(function( index ) {
			//   var id_tipo=$(this).attr("data-tipo");
			//   if (id_tipo!=4) {
			//   	$(this).hide();
			//   	//console.log(id_tipo);
			//   };
			  
			// });
			// var table_obj=$('#example').DataTable();
			var selector_tipo=$("#selector_tipo");
			selector_tipo.change(function(){
	
				var self=$(this);
				var tipo_name=self.val();
				//console.log(tipo_name);

				table_obj.search(tipo_name);
				table_obj.draw(true);

				$(".dataTables_filter input").val("");
	
			});
			
			
			// var tipo_count=0;
			var select_origen=$("#tipo_form");

			select_origen.on("change", function(){

				var current=$(this);
				var current_val=current.val();
				//console.log(current_val);

				if (current_val === "add") {
					//console.log(current);

					$(".select_tipo_cont").fadeOut(1000);
					
					$("#tipo_form").attr("name","" );	

					$(".galeria_select_tipo").append('<br> <div class="tipo_item"> <input id="tipo" class="validate[required]" name="tipo" value="Nuevo tipo de imagen"/><a href="#" class="borrar_tipo btn_close list_btn_close">X</a></div>');

					// $('suela'+suela_count).prop( "disabled", true );


					var btn_borrar=$(".borrar_tipo");
					btn_borrar.click(function(event){
						event.preventDefault();
						$(this).parent().remove();
						$(".select_tipo_cont").fadeIn(1000);
						$("#tipo_form").attr("name","tipo" );	
					});

				};	
		
				

				// var data_element = $.grep(list_tipo, function(value,key){
				// 	return value["id_suela"] == current_val;
				// }, false);


				// var name_data=data_element[0].nombre;
				

				// suela_count++;
				
			});

			

			var frm = $('#form_one');
			
			file_filter("#foto_1",5,"image/jpeg");

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

			            	//console.log(data);
			            	if (data != "null")
			            	{
			            		var data=JSON.parse(data);	
			            		if (data.respuesta) 
			            		{
			            			var value={};
			            			value["file_name"]="files/"+data.id+"/"+data.imagenes[0].file;
									value["id_imagen"]=data.imagenes[0].id_foto;
									value[idval]=data.id;
									value["nombre"]=data.nombre;
									value["orden"]=data.orden;
									value["id_tipo"]=data.tipo_id;
									value["nombre_tipo"]=data.tipo_nombre;
									value["thumb"]="files/"+data.id+"/"+data.imagenes[0].file;

									//console.log("PUSH DATA");
									//console.log(data);

			            			//console.log("list_galeria antes");
									//console.log(list_galeria);

									// if (typeof list_productos === 'undefined') {
									// 	var list_productos={};
									// };

									var value_tipo={};
									value_tipo["id_tipo"]=data.tipo_id;
									value_tipo["nombre_tipo"]=data.tipo_nombre;


									list_galeria.push(value);
									list_tipo_galeria.push(value_tipo);

			            			//console.log("data.nombre");
									//console.log(data.nombre);				            		
					                
					             //    $("#n_contenedor").fadeOut(1000,
					             //    	"easeOutExpo");
						            // $(".overlay").fadeOut(500,"easeOutQuint",function(){$(this).remove();});
						            // $("#ad_btn").show();

						            	cerrar_ventana_nuevo();



					                $("#respuesta").fadeIn(1000, "swing");
					                $(".respuesta_cont").append('<h3 class=""> Nombre:&nbsp;'+data.nombre+'</h3>');
					                $("#respuesta").delay(1500).fadeOut(500, "swing", function(){
					                	$(".respuesta_cont").find("h3").remove();
					                });
					                

					                var jRow = $("<tr>").append(
						                // ' <tr id="row'+data.id+'">'+
											'<td id="" class="border_bottom_green bordesini" nowrap="nowrap" valign="top" style="padding_bottom:0;">'+        
											'<a href= "#" >'+data.id+'</a>'+
	      								'</td>',
	         
									     '<td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<div style="display:none;">'+data.orden+'</div>'+
									        '<input  type="text" class="order_field" value="'+data.orden+'"  name="orden" id-data="'+data.id+'" >'+
									      '</td>',
	    
									      '<td class="nombre_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<a href= "#" >'+data.nombre+'</a>'+
									      '</td> ',

									      '<td class="url_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
       											' <a href= "#" class="editar small" id-element="'+data.id+'" >'+
									          data.tipo_nombre+
									        '</a>'+
									      '</td> ',


									   ' <td class="imagen_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<a href= "paginas/galeria/'+value["file_name"]+'" target="blank" >'+
									           '<img src= "paginas/galeria/'+value["file_name"]+'" alt="" style="height:70px;"/>'+
									        '</a>'+
								       '</td> ',


									       '<td class="editar_td bordes" nowrap="nowrap" valign="top" align="center">'+
        										'<a href= "#" class="editar" id="editar'+data.id+'" id-element="'+data.id+'"  title="Ver el detalle" >'+
          											'<img src="img/btn_ver.jpg" border="0"/>'+
										       	'</a>'+
										     '</td>',

										     '<td class="bordes bkg_td" nowrap="nowrap" valign="top" align="center">'+
										      ' <label class="btn btn-secondary">'+
										          '<input type="radio" name="bkg"  id-element="'+data.id+'" autocomplete="off" <?echo $fondo?> method="post" action="paginas/galeria/control.php" seccion="fondo">'+
										     '  </label>'+

										     ' </td>',




										      '<td class="bordes slide_td" nowrap="nowrap" valign="top" align="center">'+
										        '<label class="btn btn-secondary">'+
										          '<input type="checkbox" name="slide_item" id-element="'+data.id+'" a checked="checked" value="0" method="post" action="paginas/galeria/control.php" seccion="slide">'+
										       '</label>'+
										      '</td>',




									      '<td class="bordes" nowrap="nowrap" valign="top" align="center">'+
									        '<a class="borrar" id="noti_borrar" id-element="'+data.id+'" href= "#"  method="post" action="paginas/galeria/control.php" seccion="borrar"><img src="img/btn_borrar.jpg" border="0"/></a>'+
									      '</td>'
									      //+
									    // '</tr>'


					               	);
									


									// var jRow = $("<tr>").append("<td>Cell 1</td>", "<td>Cell 2</td>", "<td>Cell 2</td>", "<td>Cell 2</td>", "<td>Cell 2</td>", "<td>Cell 2</td>", "<td>Cell 2</td>");
									table_obj.row.add(jRow).draw();

									var last_row=$("tr:last");
									last_row.attr("id","row"+data.id);
									//console.log(last_row);


									$('#example').on( 'draw.dt', function () {
									    // var info = table_obj.page.info();
									     //console.log('Showing page:____Redrawing' );

									    clear_bkg_td(rows);

									    slide_item_method(rows);


									});
									



					               	// hacer_detalle_galeria("#editar"+data.id, idval, seccion);
					               	// table_obj.draw();

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
				
				borrar_element(".borrar", list_galeria);

				hacer_detalle_galeria(".editar", idval, seccion);

					//console.log("hacer_detalle");
					//console.log(idval);



			var frm_data = $('#form_add_data');
		

    		frm_data.submit(function (ev)
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

			            	//console.log(data);
			            	if (data != "null")
			            	{
			            		var data=JSON.parse(data);	
			            		if (data.respuesta) 
			            		{
									$("#data_response").fadeIn(1000, "swing");
					                $("#data_response").append('<h3 class="">SE HA ACTUALIZADO LA INFORMACIÓN</h3>');
					                $("#data_response").delay(1500).fadeOut(500, "swing", function(){
					                	$(this).find("h3").remove();
					                });
					                

				            	}
				            	else{
				            		$("#data_response").append(data.msj);
				            		$("#data_response").append('<h3 class="">NO SE PUDO ACTUALIZAR</h3>');
				            		$("#data_response").fadeIn(1000, "swing").delay(3000).fadeOut(500, "swing", function(){
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



			
};
///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////



var load_page_galeria=function(seccion){

	//console.log("load_page_galeria");
	
	$('body,html').animate({'scrollTop':0},0);	

	var load_content=$(".load_content");
	seccion_anterior=seccion;
	var btn;

	switch(seccion)
	{


//////////////////////////////////////////////////////////////////////
//---------------------------------- C L A S E -----------------
//////////////////////////////////////////////////////////////////////			

		case "inicio":

		galeria_page_template("id_galeria","editar_galeria");

		break;

		case "galeria":
		//console.log(list_galeria);

		galeria_page_template("id_galeria","editar_galeria");


		break;

		case "tipos_galeria":

		galeria_page_tipo_template("id_tipo","editar_tipo");

		break;


		default:
			// //console.log("test___");
		break;			






	}

}

/////////////////////////////////////////////
/////////////// /*  TODO  */
////////////////////////////////////////////
$ (document).ready(function(){

	load_page_galeria(GLOBAL_GET_DATA.seccion);

});


