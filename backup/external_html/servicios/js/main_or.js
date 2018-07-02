
// console.log("________idioma DESDE GET__________");
// console.log(idioma);




var ruta_files_servicios='admin/paginas/secciones/';



$(document).ready(function(){

// console.log('________jQuery.browser//////////////////////////');
//   console.log(jQuery.browser.mobile);


  //////console.log("-------.-.-.-.-.-.-.-.-.-.-.-.-.-.-.iniciamos EL SERVICIOS---------");

  $.ajax({
      method: "POST",
      url: "external_html/servicios/control.php",
      data: { 
      }
    })
      .done(function( data ) {

        var data=JSON.parse(data);  


        var servicios_mkt=$.grep(data['servicios'],function(value,key){
          return (value['id_categoria'] == 2);
        });

        var servicios_gral=$.grep(data['servicios'],function(value,key){
          return (value['id_categoria'] == 1);
        });

        //console.log('------------');
        //console.log(data['principal_servicio']['file_name']);


        $('#milky_bottle').attr('src', 'admin/paginas/secciones/'+data['principal_servicio']['file_name']);

        var contenedor=$('#contenedor_servicio_icon');
        var icon_template=$('#servicio_icon_template');
        var template_panel=$('#template_panel');
        var template_collapse=$('#template_collapse');
        var accordion=$('#accordion');
        var template_panel_slide=$('#template_panel_slide');   
        var template_item_img=$('#template_item_img');

        template_item_img.hide();
        template_panel.hide();
        icon_template.hide();



        $.each(servicios_gral,function(key, value){


               console.log('data______INICIO');
            console.log(value);

               if (idioma == 'EN') {

                nombre= value.nombre_ingles;
                descripcion=value.descripcion_ingles;

              }
              else{
                nombre= value.nombre;
                descripcion=value.descripcion;

              };




            icon_template.clone().appendTo(contenedor).show().attr('id',"icon_service"+key); // clonamos 

            var el_actual = $("#icon_service"+key);

            el_actual.find('.template_titulo').html(nombre);

            el_actual.find('.template_imagen').attr('src',ruta_files_servicios+value.principal.file_name);

            el_actual.find('.template_bnt').attr('href','#collapse'+key);


            template_panel.clone().appendTo(accordion).show().removeClass('template_panel').attr({'id':'panel'+key});

            var panel_actual=$('#panel'+key);

            panel_actual.find('.panel-collapse').attr('id','collapse'+key);

            panel_actual.find('.template_panel_tit').html(nombre);
            panel_actual.find('.template_panel_p').html(descripcion);
            panel_actual.find('.template_panel_slide').attr('id','slide_mini'+key);
            panel_actual.find('.carousel').attr('id','mini_slide'+key);

            panel_actual.find('.carousel-control').attr('href','#mini_slide'+key);

            // panel_actual.find('.panel-collapse').attr('id','collapse'+key);


            var img_index=0;

             ////console.log('------key_img');
              ////console.log(value.imagenes);
            

            $.each(value.imagenes,function(key_img, value_img){

              template_item_img.clone().appendTo(panel_actual.find('.template_panel_carousel')).show().attr('id',"imagen_"+key+"_"+img_index);

              $("#imagen_"+key+"_"+img_index).find('img').attr('src',ruta_files_servicios+value_img.file_name)

              ////console.log('------key_img');
              ////console.log(img_index);
              ////console.log(value_img);


              if (img_index!=0) {
                $("#imagen_"+key+"_"+img_index).removeClass('active');
              };

              img_index++;


            });

            panel_actual.find('#template_item_img').remove();

           

            if (key!=0) {
              panel_actual.find('.panel-collapse').removeClass('in');
            };
            



        });



      
        var contenedor_mkt=$('#contenedor_servicio_icon_mkt');
        var icon_template_mkt=$('#servicio_icon_template_mkt');
        var template_panel_mkt=$('#template_panel_mkt');
        var template_collapse_mkt=$('#template_collapse_mkt');
        var accordion_mkt=$('#accordion_mkt');
        var template_panel_slide_mkt=$('#template_panel_slide_mkt');   
        var template_item_img_mkt=$('#template_item_img_mkt');

        
        template_item_img_mkt.hide();
        template_panel_mkt.hide();
        icon_template_mkt.hide();



        $.each(servicios_mkt,function(key, value){

          //console.log("-----____VALUE___-------");
          //console.log(value);


               if (idioma == 'EN') {

                nombre= value.nombre_ingles;
                descripcion=value.descripcion_ingles;

              }
              else{
                nombre= value.nombre;
                descripcion=value.descripcion;

              };
              
            icon_template_mkt.clone().appendTo(contenedor_mkt).show().attr('id',"icon_service_mkt"+key); // clonamos 

            var el_actual = $("#icon_service_mkt"+key);

            el_actual.find('.template_titulo').html(nombre);

             el_actual.find('.template_parrafo').html(descripcion);

             el_actual.find('.template_parrafo').css({'text-aling':'left', 'color':'white'});
            
            el_actual.find('.template_bnt').attr('src',value.url);
            
            el_actual.find('.template_imagen').attr('src',ruta_files_servicios+value.principal.file_name);

            el_actual.find('.template_bnt').attr('href','#collapse'+key);


            // template_panel_mkt.clone().appendTo(accordion_mkt).show().removeClass('template_panel').attr({'id':'panel_mkt'+key});

            // var panel_actual_mkt=$('#panel_mkt'+key);

            // panel_actual_mkt.find('.panel-collapse').attr('id','collapse'+key);

            // panel_actual_mkt.find('.template_panel_tit').html(value.nombre);
            // panel_actual_mkt.find('.template_panel_p').html(value.descripcion);
            // panel_actual_mkt.find('.template_panel_slide').attr('id','slide_mini_mkt'+key);
            // panel_actual_mkt.find('.carousel').attr('id','mini_slide_mkt'+key);

            // panel_actual_mkt.find('.carousel-control').attr('href','#mini_slide_mkt'+key);

            // panel_actual_mkt.find('.panel-collapse').attr('id','collapse'+key);


            // var img_index=0;

             ////console.log('------key_img');
              ////console.log(value.imagenes);
            

            // $.each(value.imagenes,function(key_img, value_img){

            //   template_item_img_mkt.clone().appendTo(panel_actual_mkt.find('.template_panel_carousel')).show().attr('id',"imagen_mkt_"+key+"_"+img_index);

            //   $("#imagen_mkt_"+key+"_"+img_index).find('img').attr('src',ruta_files_servicios+value_img.file_name)

            //   ////console.log('------key_img');
            //   ////console.log(img_index);
            //   ////console.log(value_img);


            //   if (img_index!=0) {
            //     $("#imagen_mkt"+key+"_"+img_index).removeClass('active');
            //   };

            //   img_index++;


            // });

            // panel_actual_mkt.find('#template_item_img').remove();

           

            // if (key!=0) {
            //   panel_actual_mkt.find('.panel-collapse').removeClass('in');
            // };
            



        });



      
    });

// $("#accordion").collapse();


   // $("#accordion").on('slide.bs.carousel', function(){
   //      alert('The collapsible content is about to be shown.');

   //      // $(window).scrollTop($('#accordion').offset().top+700);
   //  });


   
    //fin del método ajax


    $("#accordion").on('show.bs.collapse', function(){
        alert('The collapsible content is about to be shown.');

        // if (jQuery.browser.mobile) {
        //   console.log(700);
        //   $(window).scrollTop($('#accordion').offset().top+700);
        // }else{
        //   console.log(300);
        //   $(window).scrollTop($('#accordion').offset().top+300);
        // };

           $(window).scrollTop($('#accordion').offset().top+700);

        
    });
    
    
});
//fin del document ready
