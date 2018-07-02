// // JavaScript Document

////////////////////////////////////////
////////////////////////////////////////
////////////////////////////////////////
var seccion_anterior;

// imagen_detalle(data_element,"principal","image/png","principal","borrar_img_prin", key_data_element);
	
var imagen_detalle=function(data_element,nombre_imagen,tipo_imagen,titulo,seccion,key_data_element){

		// //console.log("IMAGEN DETALLE");
		// //console.log(data_element[0]);
		// ////console.log(nombre_imagen);
		// ////console.log(data_element[0][nombre_imagen].file_name);
		$("#img_load_"+titulo).remove();
		$("#img_"+titulo).remove();
		
		if (data_element[0][nombre_imagen].file_name !="" && data_element[0][nombre_imagen].file_name != null ) {

			// ////console.log($("#content_img"));

			$('#nueva_ficha').find(".cont_img_form").append(
				'<div id="img_'+titulo+'" class="col-sm-4">'+
				
				'<div id="row_image'+data_element[0][nombre_imagen].id_imagen+'" class=" image_item">'+
				'<h6>'+titulo+'</h6>'+
					'<div id="img_preview_cont">'+
					'<a class="borrar_img btn_close smaller_btn_close" id="'+titulo+'_borrar" id-element="'+data_element[0][nombre_imagen].id_imagen+'" href= "#"  method="post" action="paginas/secciones/control_servicios.php" seccion="'+seccion+'" data="'+titulo+'">'+
			        		'X</a>'+
					'<img id="img_preview"src="paginas/secciones/'+data_element[0][nombre_imagen].file_name+'" alt="foto">'+
					'</div>'+
				'</div>'+
				'</div>'				
				);
			
			borrar_imagen('#'+titulo+'_borrar', list_servicio, key_data_element,tipo_imagen,titulo);
			
			//console.log("_____list_servicio");
			//console.log(list_servicio);


			// if (borrar_imagen) {
			// 	list_servicio[key_data_element][nombre_imagen]={
			// 			"file_name":"",
			// 			"id_imagen":null,
			// 			"thumb":""
			// 	}
			// };

		}
		//_------/* FIN BORRAR
		else{

			////console.log("nopasa nada");

				var nota="";
				switch(titulo){
					case"principal":
						nota='<span class="small color" style="font-size:11px; line-height:1px">La imagen debe tener una medida de 2000px x 1333px de preferencia en positivo y con transparencia.</span>';
					break;
					case"lifestyle":
						nota='<span class="small color" style="font-size:11px;">La imagen debe tener una medida de 1360px x 765px de preferencia con transparencia</span>';
					break;
					case"fondo":
						nota='<span class="small color" style="font-size:11px;">La imagen debe tener una medida de 1360px x 765px.</span>';
					break;
				}
				$('#nueva_ficha').find(".cont_img_form").append(
				' <div class="content_img_detalle col-sm-4" id="img_load_'+titulo+'">'+
			      '<label><h6>Carga tu '+titulo+':</h6>'+nota+'</label>'+
			      '<p class="small">Seleccione el archivo '+tipo_imagen+':'+
			      '<input type="file" class="validate[required]" name="'+titulo+'" id="'+titulo+'_pop"/> </p>'+
			    '</div>'
				);

				file_list=[];
				file_filter("#"+titulo+'_pop',5,tipo_imagen);
		}//_------/* FIN LOGO

		}











///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////


var marca_page_template= function(idval, seccion)
{				

			var idval_name=idval.substring(3);
			////////console.log(idval_name);

			var frm = $('#form_one');
			

			$( "a, input" ).tooltip({
		      position: {
		        my: "left top-1000",
		        at: "left top-1000",
		        using: function( position, feedback ) {
		        	////////console.log("tooltip");
		        	////////console.log(position);
		        	////////console.log(feedback);
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

			
			
			abrir_ventana_nuevo("#ad_btn",frm,"#nombre,#nombre_ingles, #descripcion,#descripcion_ingles, #ingredientes, #categoria, #clase, #principal, #foto1");

			// select_clase(GLOBAL_CLASE_DATA,".select_categoria",".select_clase");

			$("#ad_btn_img").click(function(event){
				event.preventDefault();
				ad_file_area("#content_img");	

			});
			// $("#ad_btn").click(function(event)
			// {
			// 	$(this).hide();
			// 	btn=$(this);
			// 	$("#n_contenedor").show();
			// 	frm.show();
			// 	frm.find("#text_field, #marca_text_area, #foto_1").val("");
			// });

			// $(".imagen_td a").fancybox({
			// 	    padding    : 0,
			//         margin     : 0,
			// 	});


			var table_obj=$('#example').DataTable({
				"order": [[0,"asc"]],
				"sScrollX": "25%",
				"bScrollCollapse": false,
				"autoWidth": false,
				"lengthMenu": [10, 25, 50],
				
			});

			
			
			file_filter("#principal",5,"image/png");
			file_filter("#foto1",5,"image/jpeg");
			

			frm.unbind("submit");

    		frm.submit(function (ev)
    		{
    			ev.preventDefault();
    			////console.log("FORM ONE")
    			////console.log(this);


    			if ($(this).validationEngine('validate'))
    			{
    				loader_add("img/loader.gif");

	    			////////console.log("its validate yuju");

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

			            	

			            	if (data != "null")
			            	{
			            		var data=JSON.parse(data);	

			            		////console.log(data);

			            		if (data.respuesta) 
			            		{

			            			

									// var clase= $.grep(list_clase, function(value,key){
									// 	////////console.log(data.id_clase);
									// 	if (value["id_clase"] == data.id_clase) {
									// 		key_data_element=key;
									// 		return value;
									// 	}
									// }, false);

									var categoria= $.grep(GLOBAL_CATEGORIA_DATA, function(value,key){
										////////console.log(data.id_categoria);
										if (value["id_categoria"] == data.id_categoria) {
											key_data_element=key;
											return value;
										}
									}, false);


			            			var value={};

			            			if (data.principal != undefined){
				            			value["principal"]={
				            				"file_name":"files/seccion_servicios/"+data.id+"/"+data.principal[0].file,
				            				"id_imagen":data.principal[0].id_foto
				            			};
			            			}else{
			            				value["principal"]={"file_name":""};
			            			};



			            			//////console.log("------------data.lifestyle[0]");
			            			//////console.log(data.lifestyle[0]);

			            			value["images"]={};
			            			var idex_im=0;
			            			$.each(data.images,function(key_im,value_im){

			            				value["images"][idex_im]={
				            				"file_name":"files/seccion_servicios/"+data.id+"/"+value_im[0].file,
				            				"id_imagen":value_im[0].id_foto
				            			};

				            			idex_im++;

			            			});

			            			// value["lifestyle"]={
			            			// 	"file_name":"files/seccion_servicios/"+data.id+"/"+data.lifestyle[0].file,
			            			// 	"id_imagen":data.lifestyle[0].id_foto};

			            			// value["fondo"]={
			            			// 	"file_name":"files/seccion_servicios/"+data.id+"/"+data.fondo[0].file,
			            			// 	"id_imagen":data.fondo[0].id_foto
			            			// };

									// value["id_imagen"]=data.logotipo[0].id_foto;

									value[idval]=data.id;
									value["nombre"]=data.nombre;
									value["nombre_ingles"]=data.nombre_ingles;
									value["url"]=data.url;
									value["descripcion"]=data.descripcion;
									value["descripcion_ingles"]=data.descripcion_ingles;
									// value["ingredientes"]=data.ingredientes;
									value["orden"]=data.orden;
									
									value["categoria"]=categoria[0]['nombre'];
									// value["clase"]=clase[0];
									// value["id_ciudad"]=data.id_ciudad;
									value["id_categoria"]=data.id_categoria;
									// value["id_clase"]=data.id_clase;
									
									// value["thumb"]="files/seccion_servicios/"+data.id+"/"+data.logotipo[0].file;

									////////console.log("PUSH DATA");
									////////console.log(value);

			            			
									// if (typeof list_servicio === undefined) {
									// 	var list_servicio={};
									// };

									////////console.log("list_servicio antes");
									////////console.log(list_servicio);


									list_servicio.push(value);


			            			////////console.log("list_servicios_despues");
									////////console.log(list_servicio);				            		
					                
					                cerrar_ventana_nuevo(frm);



					                $("#respuesta").fadeIn(1000, "swing");
					                $(".respuesta_cont").append('<h3 class="color"> Nombre:&nbsp;'+data.nombre+'</h3>');
					                $("#respuesta").delay(1500).fadeOut(500, "swing", function(){
					                	$(".respuesta_cont").find("h3").remove();
					                });

					                $("#ad_btn").show();

					                var jRow = $("<tr>").attr("id","row"+data.id).append(
						                // ' <tr id="row'+data.id+'">'+
											// '<td id="" class="border_bottom_green bordesini" nowrap="nowrap" valign="top" style="padding_bottom:0;">'+        
											// '<a href= "#" >'+data.id+'</a>'+
	      				// 				'</td>',
	         
									     '<td class="border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<div style="display:none;">'+data.orden+'</div>'+
									        '<input  type="text" class="order_field" value="'+data.orden+'"  name="orden" id-data="'+data.id+'" >'+
									      '</td>',
	    
									      '<td class="nombre_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<a href= "#" >'+data.nombre+'</a>'+
									      '</td> ',


									      '<td class="categoria_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
       											' <a href= "#" class=" small" id-element="<?=$id;?>" target="_blank">'+value["categoria"]+
									        '</a>'+
									      '</td> ',

									      // '<td class="tipo_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
       								// 			' <a href= "#" class=" small" id-element="<?=$id;?>" target="_blank">'+
									      //     "nombre"+
									      //   '</a>'+
									      // '</td> ',


									   ' <td class="imagen_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<a href= "paginas/secciones/'+value["principal"]["file_name"]+'" target="blank" >'+
									           '<img src= "paginas/secciones/'+value["principal"]["file_name"]+'" alt="" style="height:70px;"/>'+
									        '</a>'+
								       '</td> ',


									       '<td class="editar_td bordes" nowrap="nowrap" valign="top" align="center">'+
        										'<a href= "#" class="editar" id="editar'+data.id+'" id-element="'+data.id+'"  title="Ver el detalle" >'+
          											'<img src="img/btn_ver.jpg" border="0"/>'+
										       	'</a>'+
										     '</td>',


									      '<td class="bordes" nowrap="nowrap" valign="top" align="center">'+
									        '<a class="borrar" id="noti_borrar" id-element="'+data.id+'" href= "#"  method="post" action="paginas/secciones/control_servicios.php" seccion="borrar"><img src="img/btn_borrar.jpg" border="0"/></a>'+
									      '</td>'
									    //   +
									    // '</tr>'


					               	);
									
									table_obj.row.add(jRow).draw();
									// var last_row=$("tr:last");
									// //////console.log(last_row);
									// last_row.attr("id","row"+data.id);
									
		

					               	// hacer_detalle_marca("#editar"+data.id, idval, seccion);
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
                	    			// ////////console.log("NO its not");
                }

    		});

    			ordenar(".order_field", {"seccion":"ordenar"}, "paginas/secciones/control_servicios.php" )
				
				borrar_element(".borrar", list_servicio);

				
					////////console.log("hacer_detalle");
					////////console.log(idval);
				hacer_detalle_marca(".editar", idval, seccion);
};












/////////////////////////////////////////////
/////////////// /*ORDENAR*/	

var hacer_detalle_marca = function(btn, idval, seccion){//--Begin

// 	//////console.log("list_servicio");
// 	//////console.log(list_servicio);


	// var btn = $(btn);
	var seccion=seccion;

	// btn.click(function(event)
	$(document).on("click",btn,function(event)
	{
		event.preventDefault();
		var current =$(this);
		var id= current.attr("id-element");
	
		var key_data_element;
		 

		$.each(list_servicio,function(key, value){

			////console.log("-------List servicio each");
			////console.log(key);
			////console.log(value);
			if (value["id_servicio"]==id) {
				key_data_element =key;	
				////console.log(key_data_element);
			};
		});

		
		var data_element = $.grep(list_servicio, function(value,key){
			return value[idval]== id
		}, false);


		//console.log('--------data_element--------');
		//console.log(data_element[0].url);


		$("body").append('<div class="overlay"></div>');

		$(".ficha_original").removeClass("ficha_original").attr({"id":"nueva_ficha"}).fadeIn(1000).css("z-index","99999999999");

		var nficha=$("#nueva_ficha");

		nficha.find("#seccion").attr("value","editar");
		nficha.find("#nombre").attr("value",data_element[0].nombre);
		nficha.find("#nombre_ingles").attr("value",data_element[0].nombre_ingles);
		
		nficha.find("#url").attr("value",data_element[0].url);

		nficha.find("#descripcion").html(data_element[0].descripcion);
		nficha.find("#descripcion_ingles").html(data_element[0].descripcion_ingles);
		// nficha.find("#ingredientes").html(data_element[0].ingredientes);
		nficha.find("#form_one").prepend('<input id="id" name="id" type="text" value="'+data_element[0].id_servicio+'" hidden/>');
		// nficha.find("#clase").attr("value",data_element[0].id_clase);

		nficha.find("#clase").children().remove();

		// $.each(list_clase,function(key,value){
		// 		// ////console.log(key);
		// 		// ////console.log(value);
		// 		if (value.id_categoria==data_element[0].id_categoria) {
		// 			nficha.find("#clase").append('<option value="'+value.id_clase+'">'+value["nombre"]+'</option>');
		// 		};

		// 	});

		// nficha.find("#clase").prepend('<option value="'+data_element[0].id_clase+'">'+data_element[0].clase["nombre"]+'</option>');

		

		nficha.find(".select_categoria").selectpicker('val', data_element[0].id_categoria);

		nficha.find(".select_categoria").selectpicker('refresh');
		
		// nficha.find(".select_clase").selectpicker('val', data_element[0].id_clase);
		
		nficha.find("#sumit_form").attr('value','Modificar' );
		
		nficha.css("height",$( window ).height()-100);

		var btn_close=nficha.find(".btn_close");

		nficha.find(".cont_img_form").clone().appendTo("body").removeClass("cont_img_form").addClass("img_tmp").hide();

		$("#nueva_ficha > .btn_close ,  .overlay").click(function(){
			nficha.fadeOut(1000,"easeOutQuint",function(){
				// $(this).remove();	
				$(this).addClass("ficha_original");	
				$(this).attr("id","n_contenedor");	
				$("#id").remove();
				nficha.find(".cont_img_form").remove();
				$('.img_tmp').appendTo('#parent_content_img').removeClass('img_tmp').addClass('cont_img_form').stop(true,true).show();

			});
			$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
			
			$("#nueva_ficha > .btn_close ,  .overlay").unbind("click");
			$(document).unbind("keypress.key27");
			////console.log($(document));
		});

		$(document).unbind("keypress.key27");

		// $(document).bind("keypress", function(event) {
			
		//     if (event.keyCode == 27) {
		// 		////console.log(event);
		// 		////console.log(event.keyCode);
		// 		nficha.fadeOut(1000,"easeOutQuint",function(){
		// 		// $(this).remove();	
		// 		$(this).addClass("ficha_original");	
		// 		$(this).attr("id","n_contenedor");	
		// 		nficha.find(".cont_img_form").remove();
		// 		$('.img_tmp').appendTo('#parent_content_img').removeClass('img_tmp').addClass('cont_img_form').stop(true,true).show();
					
		// 		});
		// 			$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
		// 			$("#id").remove();

		// 			$(document).unbind("keypress.key27");
		// 			$("#nueva_ficha > .btn_close ,  .overlay").unbind("click");
		//     }
		// });

// 		///////////////////////////////////////
// 		///////////////////LOGOTIPO////////////////////
// 		///////////////////////////////////////
		

		$('#nueva_ficha').find(".cont_img_form").children().remove();

		////console.log(data_element[0]["images"]);

		var images={0:data_element[0]["images"]};

		imagen_detalle(data_element,"principal","image/png","principal","borrar_img_prin", key_data_element);
		
		var index=1;

		$.each(data_element[0]["images"],function(key, value){
			// ////console.log("ke________________++++++++++++++y");
			// ////console.log(key);
			imagen_detalle(images,key,"image/jpeg","foto"+index,"borrar_img", key_data_element);
			// ////console.log(value);
			index++;
		});



		// nficha.find("#ad_btn_img").click(function(event){
		// 		event.preventDefault();
		// 		ad_file_area(nficha.find("#content_img"));	

		// 	});
		// imagen_detalle(images,0,"image/jpeg",0,"borrar_img_fondo",key_data_element);
// 		imagen_detalle(data_element,"lifestyle","image/png","lifestyle","borrar_img_lifestyle",key_data_element);


// 		cont.hide().fadeIn(1000,"easeInOutExpo");
// 		$(".overlay").hide().fadeIn(1000,"easeOutExpo");


///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////-----------///////----------- SUMIT ACTUALIZAR

		var frm2 = nficha.find('#form_one');
		////console.log(frm2);

		frm2.scrollTop(0);
		frm2.parent().scrollTop(0);



		frm2.unbind("submit");
		frm2.submit(function (ev) {
			ev.preventDefault();
			////console.log("SIMMNI TWO");
			////console.log($(this));

			var self=$(this);
			
			loader_add("img/loader.gif");

    			$.ajax({
		            cache: false,
		            contentType: false,
		            processData: false,
		            type: frm2.attr('method'),
		            url: frm2.attr('action'),
		            data: new FormData(this),

		            success: function (data) {	
		            	// ////console.log(data);
		            	loader_del();

		            	if (data != "null")
		            	{


		            		var data=JSON.parse(data);	


		            		if (data.images!= undefined) {

		            			var n_data_images={};




		            			$.each(data.images, function(key, value){


		            					////console.log("images________+++++++__");
									////console.log(value)	;	
									////console.log(key)	;
									n_data_images[key]={
			            					'file_name':'files/seccion_servicios/'+id+'/'+value[0]['file'],
			            					'thumb':'files/seccion_servicios/'+id+'/'+value[0]['file'],
			            					'id_imagen':value[0]['id_foto'],
			            					'id_servicio':id
			            			};

									if (key == "principal") {
										
			            				list_servicio[key_data_element]["principal"]={
			            					'file_name':'files/seccion_servicios/'+id+'/'+value[0]['file'],
			            					'thumb':'files/seccion_servicios/'+id+'/'+value[0]['file'],
			            					'id_imagen':value[0]['id_foto'],
			            					'id_servicio':id
			            				};	;								
									}
									else
									{
										list_servicio[key_data_element]["images"][key]=n_data_images[key];
									}
								});
										
								
								

								data.images={0:n_data_images};	
								
								

								////console.log("list_servicio______");
								////console.log(list_servicio);							

								$.each(data.images[0],function(key, value){

									//console.log("images______");
									//console.log(value)	;	
									//console.log(value["file_name"])	;



									self.find("#content_img").find('.input_img').remove();
									self.find("#content_img").find('.input_img_div').remove();
									

									if (key == "principal") {
										imagen_detalle(data.images,"principal","image/png","principal","borrar_img_prin", key_data_element);	
										$("#row"+data.id).find('.imagen_td a').remove();
					                		
					                		$("#row"+data.id).find('.imagen_td').append(
					                		' <a href= "paginas/secciones/'+value["file_name"]+'" target="_blank" >'+
									           '<img src= "paginas/secciones/'+value["file_name"]+'" alt="'+data.nombre+'" style="height:70px;"/>'+
									        '</a>'
								        );
									}
									else
									{
										imagen_detalle(data.images,key,"image/jpeg","foto"+index,"borrar_img", key_data_element);
									}

								});


							};


		// 				





		            		if (data.respuesta) 
		            		{

	    						////console.log(data);

								self.prepend('<div class="col-xs-10" id="respuesta_window" style="">'+
								    '<h2 class="" style="color:green;"> Se ha actualizado la información</h2> '+
								'</div>').find("h2").delay(1000).fadeOut(1000, function(){
									$(this).remove();
								});

								$("#respuesta_window").hide().fadeIn(1000, "swing").delay(2000).slideUp(1000, "swing", function(){
				                	// $(this).remove();
				                });
				                

								$.each(list_servicio, function(key, value){


									if (key==key_data_element) {



										////////console.log("ciudad");
										////////console.log(data);

										var clase= $.grep(list_clase, function(value_grep,key){
											////////console.log(data.id_clase);
											if (value_grep["id_clase"] == data.id_clase) {
												
												return value_grep;
											}
										}, false);

										////////console.log("tipo");
										////////console.log(tipo);

										var categoria= $.grep(list_categoria, function(value_grep,key){
											////////console.log(data.id_categoria);
											if (value_grep["id_categoria"] == data.id_categoria) {
												
												return value_grep;
											}
										}, false);

										////////console.log("categoria");
										////////console.log(categoria);

							
										

				      //       			if (data.lifestyle != undefined) {

				      //       				//////console.log("lifestyle");
										// //////console.log(data.lifestyle[0]["name"]);

				      //       				 list_servicio[key]["lifestyle"]={
				      //       				"file_name":"files/seccion_servicios/"+data.id+"/"+data.lifestyle[0]["file"],

				      //       				"id_imagen":data.lifestyle[0]["id_foto"]
				      //       				}
				      //       			}


				      //       			if (data.fondo != undefined) {

				      //       				//////console.log("fondo----------");
										// //////console.log(data.fondo);
										// //////console.log(value["fondo"]);

				      //       				 list_servicio[key]["fondo"]={
				      //       				"file_name":"files/seccion_servicios/"+data.id+"/"+data.fondo[0]["file"],
				      //       				"id_imagen":data.fondo[0]["id_foto"]
				      //       				}
				      //       			}

				            			//
				            			// 


										// value["id_imagen"]=data.logotipo[0].id_foto;

										list_servicio[key]["id_servicio"]=data.id;
										list_servicio[key]["nombre"]=data.nombre;
										
										list_servicio[key]["descripcion"]=data.descripcion;
										list_servicio[key]["ingredientes"]=data.ingredientes;										
										list_servicio[key]["categoria"]=categoria[0];
										list_servicio[key]["clase"]=clase[0];
										list_servicio[key]["id_categoria"]=data.id_categoria;
										list_servicio[key]["id_clase"]=data.id_clase;

									
										

					                	$("#row"+data.id).find('.nombre_td a').remove();
					                	$("#row"+data.id).find('.nombre_td').append(
					                		'<a class="" href= "#">'+data.nombre+'  </a>');


					                	// $("#row"+data.id).find('.ciudad_td a').remove();
					                	// $("#row"+data.id).find('.ciudad_td').append(
					                	// 	'<a class="" href= "#">'+ciudad[0]["nombre"]+'  </a>');

					                	$("#row"+data.id).find('.categoria_td a').remove();
					                	$("#row"+data.id).find('.categoria_td').append(
					                		'<a class="" href= "#">'+categoria[0]["nombre"]+'  </a>');

					                	// $("#row"+data.id).find('.clase_td a').remove();
					                	// $("#row"+data.id).find('.clase_td').append(
					                	// 	'<a class="" href= "#">'+clase[0]["nombre"]+'  </a>');
										
									}
								});

								
								// imagen_detalle(data_element,"fondo","image/jpeg","fondo","borrar_img_fondo",key_data_element);

								// imagen_detalle(data_element,"lifestyle","image/png","lifestyle","borrar_img_lifestyle",key_data_element);


											            
					            ////console.log("ne¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡´´´´´´.´.´.´.´.´.´.´.´.´.´´´.w liust");
					            ////console.log(list_servicio); 											     
			            
							 }
			          
				            else{
				            	$("#ya_existe").append(data.msj);
				            	$("#ya_existe").fadeIn(1000, "swing").delay(3000).fadeOut(500, "swing", function(){
				            			$(this).find("h3").remove();
				            		});
				            }	
			            }
			            else{

			            }




		        		
		    		}
				});
		});

	}); //---/*onclick	

}//---/*end



///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////


var send_img_mkt= function()
{		
			var img_prin_mkt_ingles=[];
		

			img_prin_mkt[0]['nombre_imagen']="Imagen Principal";
			img_prin_mkt[1]['nombre_imagen']="Imagen Principal Inglés";

			if (img_prin_mkt[0]['file_name'] !='') {
				//console.log('------- NO TRAE NADA  ----- ');
				//console.log(img_prin_mkt);

			};
			if (img_prin_mkt[1]['file_name'] !='') {
				//console.log('------- NO TRAE NADA INGLES ----- ');
				//console.log(img_prin_mkt_ingles);

			};

			img_prin_mkt={0:img_prin_mkt[0],1:img_prin_mkt[1]};

			// img_prin_mkt_ingles={0:img_prin_mkt_ingles};

			//console.log('------- VARIABLES ----- ');
			//console.log(img_prin_mkt);


			// img_prin_mkt_ingles['nombre_imagen']="Imagen ingles";

			// if (img_prin_mkt_ingles['file_name'] !='') {
			// 	//console.log('------- NO TRAE NADA  ----- ');
			// //console.log(img_prin_mkt_ingles);

				  
			// };

			// img_prin_mkt_ingles={0:img_prin_mkt_ingles};




			

			// var idval_name=idval.substring(3);
			// ////console.log(idval_name);

			var form_img = $('#form_img');




			// imagen_detalle(img_prin_mkt,"img_mkt","image/png","img_mkt","borrar_img_mkt",0);

			var img_detail=imagen_detalle_ultra({
				target:$(".img_mkt_principal"),
		        data_element:img_prin_mkt,
		        nombre_imagen:'img_mkt',
		        tipo_imagen:'image/png',
		        titulo:'img_mkt',
		        seccion:'control_img_principal',
		        del_seccion:'borrar_img_prin_servicios',
		        action_target:'paginas/secciones/control_servicios.php',
		        key_data_element:0,
		        del_data:'borrar_img_prin',
		        ruta:'paginas/secciones/',
		        btn_name:'.btn_send_img'
			});

			var img_detail_ingles=imagen_detalle_ultra({
				target:$(".img_mkt_principal"),
		        data_element:img_prin_mkt,
		        nombre_imagen:'img_mkt_ingles',
		        tipo_imagen:'image/png',
		        titulo:'img_mkt_ingles',
		        seccion:'control_img_principal',
		        del_seccion:'borrar_img_prin_servicios',
		        action_target:'paginas/secciones/control_servicios.php',
		        key_data_element:1,
		        del_data:'borrar_img_prin_ingles',
		        ruta:'paginas/secciones/',
		        btn_name:'.btn_send_img'
			});


			// var img_detail_ingles=imagen_detalle_ultra({
			// 	target:$(".img_mkt_principal_ingles"),
		 //        data_element:img_prin_mkt_ingles,
		 //        nombre_imagen:'img_mkt_ingles',
		 //        tipo_imagen:'image/png',
		 //        titulo:'principal_marketing_ingles',
		 //        seccion:'control_img_principal_ingles',
		 //        del_seccion:'borrar_img_prin_ingles',
		 //        action_target:'paginas/secciones/control_servicios.php',
		 //        key_data_element:0,
		 //        del_data:'borrar_img_prin_ingles',
		 //        ruta:'paginas/secciones/',
		 //        btn_name:'.btn_send_img'
			// });

			// //console.log("--------img_detail--------");
			// //console.log(img_detail.img_flag);
			

			// $( "a, input" ).tooltip({
		 //      position: {
		 //        my: "left top-1000",
		 //        at: "left top-1000",
		 //        using: function( position, feedback ) {
		 //        	////console.log("tooltip");
		 //        	////console.log(position);
		 //        	////console.log(feedback);
		 //          $( this ).css( position );
		 //          $( "<div>" )
		 //            .addClass( "arrow" )
		 //            .addClass( feedback.vertical )
		 //            .addClass( feedback.horizontal )
		 //            .appendTo( this );
		 //        }
		 //      }
		 //    });
			
			// $("#seccion_contenedor").show();

			// $("#respuesta").hide(0);

			// imagen_detalle_secciones(
			// {
			// 	target:$("#content_img"),
		 //        data_element:list_sinicio['images'],
		 //        nombre_imagen:'principal',
		 //        tipo_imagen:'image/png',
		 //        titulo:'principal',
		 //        seccion:'borrar_img',
		 //        action_target:'paginas/secciones/control.php',
		 //        key_data_element:0,
		 //        del_data:'images_sinicio',
		 //        ruta:'paginas/secciones/'
			// });
			

			// imagen_detalle_secciones(
			// {
			// 	target:$("#content_img_youtube"),
		 //        data_element:list_sinicio['images'],
		 //        nombre_imagen:'youtube',
		 //        tipo_imagen:'image/png',
		 //        titulo:'youtube',
		 //        seccion:'borrar_img',
		 //        action_target:'paginas/secciones/control.php',
		 //        key_data_element:1,
		 //        del_data:'images_sinicio',
		 //        ruta:'paginas/secciones/'
			// });
			


    		form_img.submit(function (ev)
    		{
    			ev.preventDefault();
    			
    			// ////console.log(this);
    			if ($(this).validationEngine('validate'))
    			{
    				loader_add("img/loader.gif");
	    			////console.log("its validate yuju");

	    			$.ajax(
	    			{
			            cache: false,
			            contentType: false,
			            processData: false,
			            type: form_img.attr('method'),
			            url: form_img.attr('action'),
			            data: new FormData(this),
			            success: function (data) 
			            {	
			            	loader_del();

			            	



			            	if (data != "null")
			            	{
			            		var data=JSON.parse(data);	
			            		
			            		
			            		
			            		if (data.respuesta) 
			            		{
			            			var value={};
									
									//console.log("PUSH DATA");
									//console.log(data);
									
									//console.log(data.images);

									if (data.images[0].respuesta != undefined && data.images[0].respuesta == true) {

										img_prin_mkt[0]=data.images[0];
										img_prin_mkt[1]=data.images[1];

										$(".img_mkt_principal").children().remove();
										$(".img_mkt_principal_ingles").children().remove();


										$('.btn_send_img').hide();

										//console.log("++++++++++++++++PUSH DATA");
										//console.log(img_prin_mkt);
									
										

										var img_detail=imagen_detalle_ultra({
												target:$(".img_mkt_principal"),
										        data_element:img_prin_mkt,
										        nombre_imagen:'img_mkt',
										        tipo_imagen:'image/png',
										        titulo:'img_mkt',
										        seccion:'control_img_principal',
										        del_seccion:'borrar_img_prin_servicios',
										        action_target:'paginas/secciones/control_servicios.php',
										        key_data_element:0,
										        del_data:'borrar_img_prin',
										        ruta:'paginas/secciones/',
										        btn_name:'.btn_send_img'
											});


										var img_detail_ingles=imagen_detalle_ultra({
												target:$(".img_mkt_principal"),
										        data_element:img_prin_mkt,
										        nombre_imagen:'img_mkt_ingles',
										        tipo_imagen:'image/png',
										        titulo:'img_mkt_ingles',
										        seccion:'control_img_principal',
										        del_seccion:'borrar_img_prin_servicios',
										        action_target:'paginas/secciones/control_servicios.php',
										        key_data_element:1,
										        del_data:'borrar_img_prin_ingles',
										        ruta:'paginas/secciones/',
										        btn_name:'.btn_send_img'
											});

									};



									
									// if (data.images[1].respuesta != undefined && data.images[1].respuesta == true) {


									// 	list_sinicio['images'][1]=data.images[1];

									// 	$("#content_img_youtube").children().remove();

									// 	imagen_detalle_secciones(
									// 	{
									// 		target:$("#content_img_youtube"),
									//         data_element:list_sinicio['images'],
									//         nombre_imagen:'youtube',
									//         tipo_imagen:'image/png',
									//         titulo:'youtube',
									//         seccion:'borrar_img',
									//         action_target:'paginas/secciones/control.php',
									//         key_data_element:1,
									//         del_data:'images_sinicio',
									//         ruta:'paginas/secciones/'
									// 	});

									// };

			            	
				            	}
				            	else{


				            		$("#respuesta").append(data.msj);
				            		$("#respuesta").fadeIn(1000, "swing").delay(3000).fadeOut(500, "swing", function(){
				            			$(this).find("h3").remove();
				            		});
				            
				            	}	
			            	}
			            }
			        });
					// /////<------ /* END ajax
                   
                }
                else{
                	    			// ////console.log("NO its not");
                }

    		});
			
};






///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////



var load_page_marca=function(seccion){

	////////console.log("load_page_marca");
	
	$('body,html').animate({'scrollTop':0},0);	

	var load_content=$(".load_content");
	seccion_anterior=seccion;
	var btn;

	switch(seccion)
	{

//////////////////////////////////////////////////////////////////////
//---------------------------------- C L A S E -----------------
//////////////////////////////////////////////////////////////////////			

		case "seccion_servicios":

		marca_page_template("id_servicio","editar_servicio");

		send_img_mkt();

		break;	


		// case "inicio":

		// marca_page_template("id_servicio","editar_marca");

		// break;




			default:
				// ////////console.log("test___");
			break;			

	}

}

/////////////////////////////////////////////
/////////////// /*  TODO  */
////////////////////////////////////////////
$ (document).ready(function(){

	load_page_marca(GLOBAL_GET_DATA.seccion);
	////console.log($("select"));

	$("select").selectpicker({
                style: 'chosen-container',
                showIcon:true,
  				size: 4,
  				width: "50%",
  				showTick:false,
  				actionsBox:false,
            });

});
