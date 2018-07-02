// // JavaScript Document


var seccion_anterior;


/////////////////////////////////////////////
/////////////// /*ORDENAR*/

var hacer_detalle_banner = function(btn, idval, seccion){//--Begin

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
		var data_element = $.grep(list_banner, function(value,key){
			//console.log(value[idval]);
			if (value[idval] == id) {
				key_data_element=key;
				return value;
			}
		}, false);

		//console.log("data_element");
			//console.log(data_element);

		$("body").append('<div class="overlay"></div>');
	
		$("body").append(
			'<div class="col-sm-10 col-sm-offset-1" id="detalles_contenedor">'+
			  
			  '<a href="#" class="btn_close smaler_btn_close" id=""> X </a>'+

			  '<form id="form_two" name="form_two" method="post" action="paginas/banner/control.php"  enctype="multipart/form-data">'+
			  '<input name="seccion" type="text" value="editar" hidden/>'+
			  '<input name="id" type="text" value="'+id+'" hidden/>'+

			  '<div class="col-sm-12" style="background:none; ">'+
			    '<h1 style="">detalles del banner:</h1>'+
			  '</div>'+
			  
			  '<div id="nombre" class="col-sm-12">'+
			    '<span class="label label-primary col-sm-2">Nombre:</span>'+
			    '<p><input name="nombre" class="validate[required]" type="text" maxlength="100" value="'+data_element[0].nombre+'"/></p>'+
			  '</div>'+

			  '<div id="enlace" class="col-sm-12">'+
			    '<span class="label label-primary col-sm-2">Enlace:</span>'+
			    '<p><input name="url" class="validate[required]" type="text" maxlength="100" value="'+data_element[0].url+'"/></p>'+
			  '</div>'+
			
			   '<div id="imagenes" class="col-sm-12 border-bottom">'+
			    '<span class="label label-primary col-sm-2">imágen :</span>'+
			    '<div class="clear"></div>'+
			    '</div>'+


			    '<div id="imagenes_ingles" class="col-sm-12 border-bottom">'+
			    '<span class="label label-primary col-sm-2">imágen INGLéS :</span>'+
			    '<div class="clear"></div>'+
			    '</div>'+



			    '<div class="clear"></div>'+
			'<input name="enviar" type="submit" value="Actualizar Proyecto" id="enviar_window" class="btn btn-default"/>'+

			'</form>'+

			'</div>'
			);

		var cont=$("#detalles_contenedor");

		
		cont.css("height",$( window ).height()-100);


		$(".btn_close, .overlay").click(function(){
			cont.fadeOut(1000,"easeOutQuint",function(){
				$(this).remove();	
			});
			$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
		});


			

			// 	//console.log("list prodº");
			// //console.log(list_productos);
		

		if (data_element[0].imagenes[0].file_name !="" && data_element[0].imagenes[0].id_imagen != null) {

			// //console.log("data_element.file_name");
			// //console.log(data_element);


			$("#imagenes").append(
				'<div id="row_image'+data_element[0].imagenes[0].id_imagen+'" class="col-md-3 col-sm-12 image_item">'+
					'<div id="img_preview_cont">'+
					'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data_element[0].imagenes[0].id_imagen+'" href= "#"  method="post" action="paginas/banner/control.php" seccion="borrar_foto">'+
			        		'X</a>'+
					'<img id="img_preview"src="paginas/banner/'+data_element[0].imagenes[0].file_name+'" alt="foto">'+
					'</div>'+
					    
				'</div>'
				);



		borrar_imagen(".borrar_img", list_banner, key_data_element, 'image/jpeg','foto_a');

		}
		//_------/* FIN BORRAR
		else{

			// //console.log("ESTA VACIO");

				$("#imagenes").append(
				' <br><div class="" id="content_img_detalle">'+
			      '<label><h6>Carga tu Imagen:</h6></label>'+
			      '<p class="small">Seleccione el archivo JPG:'+
			      '<input type="file" class="validate[required]" name="foto_a" id="foto_a"/> </p>'+
			    '</div>'
				);

				file_filter("#foto_2",5,"image/jpeg");

		}



		if (data_element[0].imagenes[1].file_name !="" && data_element[0].imagenes[1].id_imagen != null) {

			// //console.log("data_element.file_name");
			// //console.log(data_element);


			$("#imagenes_ingles").append(
				'<div id="row_image'+data_element[0].imagenes[1].id_imagen+'" class="col-md-3 col-sm-12 image_item">'+
					'<div id="img_preview_cont">'+
					'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data_element[0].imagenes[1].id_imagen+'" href= "#"  method="post" action="paginas/banner/control.php" seccion="borrar_foto">'+
			        		'X</a>'+
					'<img id="img_preview"src="paginas/banner/'+data_element[0].imagenes[1].file_name+'" alt="foto">'+
					'</div>'+
					    
				'</div>'
				);



		borrar_imagen(".borrar_img", list_banner, key_data_element, 'image/jpeg','foto_a_ingles');

		}
		//_------/* FIN BORRAR
		else{

			// //console.log("ESTA VACIO");

				$("#imagenes_ingles").append(
				' <br><div class="" id="content_img_detalle">'+
			      '<label><h6>Carga tu Imagen:</h6></label>'+
			      '<p class="small">Seleccione el archivo JPG:'+
			      '<input type="file" class="validate[required]" name="foto_a_ingles" id="foto_a_ingles"/> </p>'+
			    '</div>'
				);

				file_filter("#foto_2_ingles",5,"image/jpeg");

		}



/////////////////////////////////////








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
		            	// //console.log(data);
		            	loader_del();

		            	if (data != "null")
		            	{
		            		var data=JSON.parse(data);	
		            		if (data.respuesta) 
		            		{
	    						// //console.log($("#content_img_detalle"));

	    						$("#content_img_detalle").slideUp(1000,"easeOutQuint",function(){
									$(this).remove();	
								});

								$("#respuesta_window").hide().fadeIn(1000, "swing").delay(2000).slideUp(1000, "swing", function(){
				                	$(this).remove();
				                });
							

				                
				                if (data.imagenes[0].id_foto !="" ) {


								$("#imagenes").append('<div class="col-xs-10" id="respuesta_window" style="">'+
								    '<h3 class="small color"> Se ha actualizado la información</h3> '+
								'</div>');


				                	$("#imagenes").append
				                	(
										'<div id="row_image'+data.imagenes[0].id_foto+'" class="col-md-3 col-sm-12 image_item">'+
											'<div id="img_preview_cont">'+
											'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data.imagenes[0].id_foto+'" href= "#"  method="post" action="paginas/banner/control.php" seccion="borrar_foto">'+
									        		'X</a>'+
											'<img id="img_preview"src="paginas/banner/files/'+data.imagenes[0].file+'" alt="foto">'+
											'</div>'+
											    
										'</div>'
									);


				                	var img_name= data.imagenes[0].file.substring(data.imagenes[0].file.lastIndexOf('/') + 1);

				                	// $("#row"+data.id).find('.imagen_td a').attr("id-element",data.id);
				                	// $("#row"+data.id).find('.imagen_td a').text(img_name);

				                	$("#row"+data.id).find('.imagen_td a').remove();
			                		$("#row"+data.id).find('.imagen_td').append(
			                		' <a href= "paginas/banner/'+data.imagenes[0].file+'" target="_blank" >'+
							           '<img src= "paginas/banner/'+data.imagenes[0].file+'" alt="'+data.nombre+'" style="height:70px;"/>'+
							        '</a>'
							        );
				                }




					             if (data.imagenes[1].id_foto !="" ) {


				                	$("#imagenes_ingles").append('<div class="col-xs-10" id="respuesta_window" style="">'+
								    '<h3 class="small color"> Se ha actualizado la información</h3> '+
								'</div>');



				                	$("#imagenes_ingles").append
				                	(
										'<div id="row_image'+data.imagenes[1].id_foto+'" class="col-md-3 col-sm-12 image_item">'+
											'<div id="img_preview_cont">'+
											'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data.imagenes[1].id_foto+'" href= "#"  method="post" action="paginas/banner/control.php" seccion="borrar_foto">'+
									        		'X</a>'+
											'<img id="img_preview"src="paginas/banner/'+data.imagenes[1].file+'" alt="foto">'+
											'</div>'+
											    
										'</div>'
									);



				                	$("#imagenes_ingles").append('<div class="col-xs-10" id="respuesta_window" style="">'+
								    '<h3 class="small color"> Se ha actualizado la información</h3> '+
								'</div>');


				                	$("#row"+data.id).find('.imagen_td a').remove();
			                		$("#row"+data.id).find('.imagen_td').append(
			                		' <a href= "paginas/banner/'+data.imagenes[0].file+'" target="_blank" >'+
							           '<img src= "paginas/banner/'+data.imagenes[0].file+'" alt="'+data.nombre+'" style="height:70px;"/>'+
							        '</a>'
							        );

							        

				                }

			               

			                	$("#row"+data.id).find('.nombre_td a').remove();
			                	$("#row"+data.id).find('.nombre_td').append(
			                		'<a class="" href= "#">'+data.nombre+'  </a>');

			                	$("#row"+data.id).find('.url_td a').remove();
			                	$("#row"+data.id).find('.url_td').append(
			                		'<a class="small" href= "'+data.url+'" target="_blank">'+data.url+'</a>');


			                	
			     //            	//console.log("data"); 
			     //            	//console.log(data);
			     //            	//console.log("data_element"); 
		      //           		//console.log(data_element);
		      //           		//console.log("key_data_element"); 
								// //console.log(key_data_element); 
								// //console.log("data.imagenes[0].file");         
								// //console.log(data.imagenes[0].file); 

								$.each(list_banner, function(key, value){


									if (key==key_data_element) {
										if (data.imagenes[0].id_foto!="") {
											value['imagenes'][0]["thumb"]=data.imagenes[0].file;
											value['imagenes'][0]["file_name"]=data.imagenes[0].file;
											value['imagenes'][0]["id_imagen"]=data.imagenes[0].id_foto;

										}

										if (data.imagenes[1].id_foto!="") {
											value['imagenes'][1]["thumb"]=data.imagenes[1].file;
											value['imagenes'][1]["file_name"]=data.imagenes[1].file;
											value['imagenes'][1]["id_imagen"]=data.imagenes[1].id_foto;

										}

										value["nombre"]=data.nombre;
										value["url"]=data.url;
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


var banner_page_template= function(idval, seccion)
{				

			var idval_name=idval.substring(3);
			//console.log(idval_name);

			var frm = $('#form_one');
			

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

			$(".imagen_td a").fancybox({
				    padding    : 0,
			        margin     : 0,
				});

			
			
			abrir_ventana_nuevo("#ad_btn",frm,"#text_field, #banner_text_area, #foto_1");
			// $("#ad_btn").click(function(event)
			// {
			// 	$(this).hide();
			// 	btn=$(this);
			// 	$("#n_contenedor").show();
			// 	frm.show();
			// 	frm.find("#text_field, #banner_text_area, #foto_1").val("");
			// });

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
			            			value['imagenes'][0]["file_name"]="files/"+data.id+"/"+data.imagenes[0].file;
									value['imagenes'][0]["id_imagen"]=data.imagenes[0].id_foto;
									value['imagenes'][0]["thumb"]="files/"+data.id+"/"+data.imagenes[0].file;


									value['imagenes'][1]["file_name"]="files/"+data.id+"/"+data.imagenes[1].file;
									value['imagenes'][1]["id_imagen"]=data.imagenes[1].id_foto;
									value['imagenes'][1]["thumb"]="files/"+data.id+"/"+data.imagenes[1].file;



									value[idval]=data.id;
									value["nombre"]=data.nombre;
									value["orden"]=data.orden;
									value["url"]=data.url;
									

									//console.log("PUSH DATA");
									//console.log(value);

			            			
									// if (typeof list_banner === undefined) {
									// 	var list_banner={};
									// };

									//console.log("list_banner antes");
									//console.log(list_banner);


									list_banner.push(value);


			            			//console.log("list_productos_despues");
									//console.log(list_banner);				            		
					                
					                cerrar_ventana_nuevo(frm);



					                $("#respuesta").fadeIn(1000, "swing");
					                $(".respuesta_cont").append('<h3 class="color"> Nombre:&nbsp;'+data.nombre+'</h3>');
					                $("#respuesta").delay(1500).fadeOut(500, "swing", function(){
					                	$(".respuesta_cont").find("h3").remove();
					                });

					                $("#ad_btn").show();

					                var jRow = $("<tr>").append(
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

									      '<td class="url_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
       											' <a href= "'+data.url+'" class=" small" id-element="<?=$id;?>" target="_blank">'+
									          data.url+
									        '</a>'+
									      '</td> ',


									   ' <td class="imagen_td border_bottom_green bordesini" nowrap="nowrap" valign="top">'+
									        '<a href= "paginas/banner/'+value["file_name"]+'" target="blank" >'+
									           '<img src= "paginas/banner/'+value["file_name"]+'" alt="" style="height:70px;"/>'+
									        '</a>'+
								       '</td> ',


									       '<td class="editar_td bordes" nowrap="nowrap" valign="top" align="center">'+
        										'<a href= "#" class="editar" id="editar'+data.id+'" id-element="'+data.id+'"  title="Ver el detalle" >'+
          											'<img src="img/btn_ver.jpg" border="0"/>'+
										       	'</a>'+
										     '</td>',


									      '<td class="bordes" nowrap="nowrap" valign="top" align="center">'+
									        '<a class="borrar" id="noti_borrar" id-element="'+data.id+'" href= "#"  method="post" action="paginas/banner/control.php" seccion="borrar"><img src="img/btn_borrar.jpg" border="0"/></a>'+
									      '</td>'
									    //   +
									    // '</tr>'


					               	);
									
									table_obj.row.add(jRow).draw();
									var last_row=$("tr:last");
									last_row.attr("id","row"+data.id);
									//console.log(last_row);
		

					               	// hacer_detalle_banner("#editar"+data.id, idval, seccion);
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
                	    			// //console.log("NO its not");
                }

    		});

    			ordenar(".order_field", "ordenar", "paginas/banner/control.php" )
				
				borrar_element(".borrar", list_banner);

				
					//console.log("hacer_detalle");
					//console.log(idval);
				hacer_detalle_banner(".editar", idval, seccion);
};
///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////



var load_page_banner=function(seccion){

	//console.log("load_page_banner");
	
	$('body,html').animate({'scrollTop':0},0);	

	var load_content=$(".load_content");
	seccion_anterior=seccion;
	var btn;

	switch(seccion)
	{


//////////////////////////////////////////////////////////////////////
//---------------------------------- C L A S E -----------------
//////////////////////////////////////////////////////////////////////			

		case "banner":	

		banner_page_template("id_banner","editar_banner");

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

	load_page_banner(GLOBAL_GET_DATA.seccion);

});


