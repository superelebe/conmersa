// // JavaScript Document


var seccion_anterior;



var imagen_detalle_secciones=function(opt)
{


	opt = $.extend({  
        target:'',
        data_element:'',
        nombre_imagen:'',
        tipo_imagen:'',
        titulo:'Principal',
        seccion:'',
        action_target:'pagina/proyecto/control.php',
        key_data_element:1,
        del_data:"",
        ruta:'pagina/proyecto/control.php',
        callback:function(){}
      }, opt);



		//console.log('+´+´+´+´+´+´+´+´+´+´+´+´+´+target');
		//console.log(opt.key_data_element);
		//console.log(opt.data_element);
		//console.log(opt.data_element[opt.key_data_element]);



		if (opt.data_element[opt.key_data_element].file_name !="" && opt.data_element[opt.key_data_element].file_name != null ) {

			
			
			opt.target.append(
				'<div id="img_'+opt.titulo+'" class="col-sm-4">'+
				
				'<div id="row_image'+opt.data_element[opt.key_data_element].id_imagen+'" class=" image_item">'+
				'<h6>'+opt.titulo+'</h6>'+
					'<div id="img_preview_cont">'+
					'<a class="borrar_img btn_close smaller_btn_close" id="'+opt.titulo+'_borrar" id-element="'+opt.data_element[opt.key_data_element].id_imagen+'" href= "#"  method="post" action="'+opt.action_target+'" seccion="'+opt.seccion+'" data="'+opt.del_data+'">'+
			        		'X</a>'+
					'<img id="img_preview"src="'+opt.ruta+opt.data_element[opt.key_data_element].file_name+'" alt="foto">'+
					'</div>'+
				'</div>'+
				'</div>'				
				);
			
			borrar_imagen('#'+opt.titulo+'_borrar', opt.list_producto, opt.key_data_element,opt.tipo_imagen,opt.titulo);
			
			

		}
		//_------/* FIN BORRAR
		else{

			//console.log("nopasa nada");

				var nota="";
				switch(opt.titulo){
					case"principal":
						nota='<span class="small" style="font-size:11px; line-height:1px">La imagen debe tener una medida de 2000px x 1333px de preferencia en positivo y con transparencia.<br /><br /></span>';
					break;

				}
				opt.target.append(
				' <div class="content_img_detalle col-sm-12" id="img_load_'+opt.titulo+'">'+
			      '<label><h6>Carga tu imagen '+opt.titulo+':</h6>'+nota+'</label>'+
			      '<p class="small">Seleccione el archivo '+opt.tipo_imagen+':'+
			      '<input type="file" class="validate[required]" name="'+opt.nombre_imagen+'" id="'+opt.titulo+'_pop"/> </p>'+
			    '</div>'
				);

				file_list=[];
				file_filter("#"+opt.titulo+'_pop',5,opt.tipo_imagen);
		}//_------/* FIN LOGO

}

/////////////////////////////////////////////
/////////////// /*ORDENAR*/

// var hacer_detalle_secciones = function(btn, idval, seccion){//--Begin

// 	// //console.log("hacer_detalle");

// 	// var btn = $(btn);
// 	var seccion=seccion;

// 	// btn.click(function(event)
// 	$(document).on("click",btn,function(event)
// 	{
// 		event.preventDefault();
// 		var current =$(this);
// 		var id= current.attr("id-element");
// 		var key_data_element="";						
// 		var data_element = $.grep(list_secciones, function(value,key){
// 			//console.log(value[idval]);
// 			if (value[idval] == id) {
// 				key_data_element=key;
// 				return value;
// 			}
// 		}, false);

// 		//console.log("data_element");
// 			//console.log(data_element);

// 		$("body").append('<div class="overlay"></div>');
	
// 		$("body").append(
// 			'<div class="col-sm-10 col-sm-offset-1" id="detalles_contenedor">'+
			  
// 			  '<a href="#" class="btn_close smaler_btn_close" id=""> X </a>'+

// 			  '<form id="form_two" name="form_two" method="post" action="paginas/secciones/control.php"  enctype="multipart/form-data">'+
// 			  '<input name="seccion" type="text" value="editar" hidden/>'+
// 			  '<input name="id" type="text" value="'+id+'" hidden/>'+

// 			  '<div class="col-sm-12" style="background:none; ">'+
// 			    '<h1 style="">detalles del secciones:</h1>'+
// 			  '</div>'+
			  
// 			  '<div id="nombre" class="col-sm-12">'+
// 			    '<span class="label label-primary col-sm-2">Nombre:</span>'+
// 			    '<p><input name="nombre" class="validate[required]" type="text" maxlength="100" value="'+data_element[0].nombre+'"/></p>'+
// 			  '</div>'+

// 			  '<div id="enlace" class="col-sm-12">'+
// 			    '<span class="label label-primary col-sm-2">Enlace:</span>'+
// 			    '<p><input name="url" class="validate[required]" type="text" maxlength="100" value="'+data_element[0].url+'"/></p>'+
// 			  '</div>'+
			
// 			   '<div id="imagenes" class="col-sm-12 border-bottom">'+
// 			    '<span class="label label-primary col-sm-2">imágenes :</span>'+
// 			    '<div class="clear"></div>'+
// 			    '</div>'+
// 			    '<div class="clear"></div>'+
// 			'<input name="enviar" type="submit" value="Actualizar Proyecto" id="enviar_window" class="btn btn-default"/>'+

// 			'</form>'+

// 			'</div>'
// 			);

// 		var cont=$("#detalles_contenedor");

		
// 		cont.css("height",$( window ).height()-100);


// 		$(".btn_close, .overlay").click(function(){
// 			cont.fadeOut(1000,"easeOutQuint",function(){
// 				$(this).remove();	
// 			});
// 			$(".overlay").fadeOut(1000,"easeInOutExpo", function(){$(this).remove();});
// 		});


			

// 			// 	//console.log("list prodº");
// 			// //console.log(list_productos);
		

// 		if (data_element[0].file_name !="" && data_element[0].id_imagen != null) {

// 			// //console.log("data_element.file_name");
// 			// //console.log(data_element);


// 			$("#imagenes").append(
// 				'<div id="row_image'+data_element[0].id_imagen+'" class="col-md-3 col-sm-12 image_item">'+
// 					'<div id="img_preview_cont">'+
// 					'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data_element[0].id_imagen+'" href= "#"  method="post" action="paginas/secciones/control.php" seccion="borrar_foto">'+
// 			        		'X</a>'+
// 					'<img id="img_preview"src="paginas/secciones/'+data_element[0].file_name+'" alt="foto">'+
// 					'</div>'+
					    
// 				'</div>'
// 				);



// 		borrar_imagen(".borrar_img", list_secciones, key_data_element, 'image/jpeg');

// 		}
// 		//_------/* FIN BORRAR
// 		else{

// 			// //console.log("ESTA VACIO");

// 				$("#imagenes").append(
// 				' <br><div class="" id="content_img_detalle">'+
// 			      '<label><h6>Carga tu Imagen:</h6></label>'+
// 			      '<p class="small">Seleccione el archivo JPG:'+
// 			      '<input type="file" class="validate[required]" name="foto_2" id="foto_2"/> </p>'+
// 			    '</div>'
// 				);

// 				file_filter("#foto_2",5,"image/jpeg");

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
// 		            	// //console.log(data);
// 		            	loader_del();

// 		            	if (data != "null")
// 		            	{
// 		            		var data=JSON.parse(data);	
// 		            		if (data.respuesta) 
// 		            		{
// 	    						// //console.log($("#content_img_detalle"));

// 	    						$("#content_img_detalle").slideUp(1000,"easeOutQuint",function(){
// 									$(this).remove();	
// 								});

// 								$("#respuesta_window").hide().fadeIn(1000, "swing").delay(2000).slideUp(1000, "swing", function(){
// 				                	$(this).remove();
// 				                });
							

// 								$("#imagenes").append('<div class="col-xs-10" id="respuesta_window" style="">'+
// 								    '<h3 class="small color"> Se ha actualizado la información</h3> '+
// 								'</div>');
				                
				                
// 					             if (data.imagenes[0].id_foto !="") {
// 				                	$("#imagenes").append
// 				                	(
// 										'<div id="row_image'+data.imagenes[0].id_foto+'" class="col-md-3 col-sm-12 image_item">'+
// 											'<div id="img_preview_cont">'+
// 											'<a class="borrar_img btn_close smaller_btn_close" id="noti_borrar" id-element="'+data.imagenes[0].id_foto+'" href= "#"  method="post" action="paginas/secciones/control.php" seccion="borrar_foto">'+
// 									        		'X</a>'+
// 											'<img id="img_preview"src="paginas/secciones/'+data.imagenes[0].file+'" alt="foto">'+
// 											'</div>'+
											    
// 										'</div>'
// 									);

// 				                	var img_name= data.imagenes[0].file.substring(data.imagenes[0].file.lastIndexOf('/') + 1);

// 				                	// $("#row"+data.id).find('.imagen_td a').attr("id-element",data.id);
// 				                	// $("#row"+data.id).find('.imagen_td a').text(img_name);

// 				                	$("#row"+data.id).find('.imagen_td a').remove();
// 			                		$("#row"+data.id).find('.imagen_td').append(
// 			                		' <a href= "paginas/secciones/'+data.imagenes[0].file+'" target="_blank" >'+
// 							           '<img src= "paginas/secciones/'+data.imagenes[0].file+'" alt="'+data.nombre+'" style="height:70px;"/>'+
// 							        '</a>'
// 							        );
// 				                }

			               

// 			                	$("#row"+data.id).find('.nombre_td a').remove();
// 			                	$("#row"+data.id).find('.nombre_td').append(
// 			                		'<a class="" href= "#">'+data.nombre+'  </a>');

// 			                	$("#row"+data.id).find('.url_td a').remove();
// 			                	$("#row"+data.id).find('.url_td').append(
// 			                		'<a class="small" href= "'+data.url+'" target="_blank">'+data.url+'</a>');


			                	
// 			     //            	//console.log("data"); 
// 			     //            	//console.log(data);
// 			     //            	//console.log("data_element"); 
// 		      //           		//console.log(data_element);
// 		      //           		//console.log("key_data_element"); 
// 								// //console.log(key_data_element); 
// 								// //console.log("data.imagenes[0].file");         
// 								// //console.log(data.imagenes[0].file); 

// 								$.each(list_secciones, function(key, value){


// 									if (key==key_data_element) {
// 										if (data.imagenes[0].id_foto!="") {
// 											value["thumb"]=data.imagenes[0].file;
// 											value["file_name"]=data.imagenes[0].file;
// 											value["id_imagen"]=data.imagenes[0].id_foto;

// 										}
// 										value["nombre"]=data.nombre;
// 										value["url"]=data.url;
// 										// //console.log("PUSH DATA");
// 										// //console.log(value);  
// 									}
// 								});
											            
// 					            // //console.log("new liust");
// 					            // //console.log(list_productos); 											     
			            
// 							 }
			          
// 				            else{
// 				            	$("#ya_existe").fadeIn(1000, "swing").delay(1000).fadeOut(500, "swing");
// 				            }	
// 			            }
// 			            else{

// 			            }
// 		        }
// 		    });
// 	});
// });
// }//---/*end






///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////


var secciones_page_template= function(idval, seccion)
{				

			//console.log('------- VARIABLES ----- ');
			//console.log(idval+'--+-- '+seccion);

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
			
			$("#seccion_contenedor").show();

			$("#respuesta").hide(0);

			imagen_detalle_secciones(
			{
				target:$("#content_img"),
		        data_element:list_sinicio['imagenes'],
		        nombre_imagen:'principal',
		        tipo_imagen:'image/png',
		        titulo:'principal',
		        seccion:'borrar_img',
		        action_target:'paginas/secciones/control.php',
		        key_data_element:0,
		        del_data:'imagenes_sinicio',
		        ruta:'paginas/secciones/'
			});
			

			imagen_detalle_secciones(
			{
				target:$("#content_img_youtube"),
		        data_element:list_sinicio['imagenes'],
		        nombre_imagen:'youtube',
		        tipo_imagen:'image/png',
		        titulo:'youtube',
		        seccion:'borrar_img',
		        action_target:'paginas/secciones/control.php',
		        key_data_element:1,
		        del_data:'imagenes_sinicio',
		        ruta:'paginas/secciones/'
			});
			


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
			            		//console.log(data);
			            		if (data.respuesta) 
			            		{
			            			var value={};

									//console.log("PUSH DATA");
									//console.log(data.imagenes);

									if (data.imagenes[0].respuesta != undefined && data.imagenes[0].respuesta == true) {

										list_sinicio['imagenes'][0]=data.imagenes[0];
										$("#content_img").children().remove();

										imagen_detalle_secciones(
										{
											target:$("#content_img"),
									        data_element:list_sinicio['imagenes'],
									        nombre_imagen:'principal',
									        tipo_imagen:'image/png',
									        titulo:'Principal',
									        seccion:'borrar_img',
									        action_target:'paginas/secciones/control.php',
									        key_data_element:0,
									        del_data:'imagenes_sinicio',
									        ruta:'paginas/secciones/'
										});

									};



									
									if (data.imagenes[1].respuesta != undefined && data.imagenes[1].respuesta == true) {


										list_sinicio['imagenes'][1]=data.imagenes[1];

										$("#content_img_youtube").children().remove();

										imagen_detalle_secciones(
										{
											target:$("#content_img_youtube"),
									        data_element:list_sinicio['imagenes'],
									        nombre_imagen:'youtube',
									        tipo_imagen:'image/png',
									        titulo:'youtube',
									        seccion:'borrar_img',
									        action_target:'paginas/secciones/control.php',
									        key_data_element:1,
									        del_data:'imagenes_sinicio',
									        ruta:'paginas/secciones/'
										});

									};

			            	
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
                	    			// //console.log("NO its not");
                }

    		});
			
};
///////////////////////////////////////////////////////////////////////////
//---------------------------------- LOAD PAGE CONTENT -----------------
//////////////////////////////////////////////////////////////////////



var load_page_secciones=function(seccion){

	//console.log("load_page_secciones");
	
	$('body,html').animate({'scrollTop':0},0);	

	var load_content=$(".load_content");
	seccion_anterior=seccion;
	var btn;

	switch(seccion)
	{


//////////////////////////////////////////////////////////////////////
//---------------------------------- C L A S E -----------------
//////////////////////////////////////////////////////////////////////			

		case "seccion_inicio":	


		secciones_page_template("id_secciones","editar_secciones");

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

	load_page_secciones(GLOBAL_GET_DATA.seccion);

});


