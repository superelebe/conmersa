

        // El brn de tipos creado al darle click deberá vaciar el contenedor de la galeria de fotos y volver a poblar dicha galeria solo con las fotos correspondientes al ID TIPO seccionado.

var ruta_files='admin/paginas/galeria/';

var funcion_click = function(btn_del_tipo,lista_fotos){

      
      var id_tipo=$(btn_del_tipo).attr('data-id-tipo');

      
      $('#tipos_cont').find('h2').css({'color':'black'});

      $(btn_del_tipo).css({'color':'darkblue'});


      $('.ele_galeria').hide().appendTo('body');


      $('#contenedor_thumbs').children().remove();


      // var arrray_galeria=$.grep(lista_fotos,function(value_f, key_f){   
      //               if (value_f['tipo']==id_tipo) {
      //                 return value_f;
      //               }
      // } );


  $('#pagination-container').pagination(
                  {
                      dataSource:lista_fotos,
                      autoHidePrevious:true,
                      autoHideNext: true,
                      showPageNumbers: false,
                      pageSize:6,
                      callback: function(lista, pagination)
                      { 

                        ////console.log('pagination');
                        ////console.log(pagination);

                        $('#contenedor_thumbs').children().remove();

                        var lista_limit = 5;
                        var lista_index = 0

                        $.each(lista_fotos, function(key, value){ 


                        
                        if (value.slide == 0) {

                            console.log('_____ :......EN EL CLIC. ..... :: .____');
                          console.log(value);

                          $('.ele_galeria').clone().removeClass('ele_galeria').appendTo('#contenedor_thumbs').attr(
                            {
                              'id':'foto'+key
                            });



                            $('#foto'+key+'>a').attr(
                            {
                              'href':ruta_files+value['file_name'],
                               'title': value['nombre'],
                               'data-fancybox':"gallery"
                            });
                            
                            $('#foto'+key+'>a>img').attr(
                            {
                              'src':ruta_files+value['file_name'],
                              'alt':value['nombre']
                             
                            });

                            $('#foto'+key).fadeIn(1000+(500*key), 'swing');

   
                            if (pagination['totalPage']==1) {
                              $('.paginationjs-pages').hide();
                            }

                            if (lista_index<=lista_limit) {
                              $('#foto'+key).show();
                            }
                            else{
                              $('#foto'+key).hide();
                            }

                            lista_index++;
    
                          }

                        });



                          $('.thumbnail').on('click',function(m){

                              m.preventDefault();
                              
                              $('.modal-body').empty();


                              $('.modal-content').append(' <a class="left carousel-control modal-control-left" href="#" role="button" data-slide="prev">'+
              '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>'+
              '<span class="sr-only">Previous</span>'+
            '</a>'+
            '<a class="right carousel-control modal-control-right" href="#" role="button" data-slide="next">'+
                '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'+
              '<span class="sr-only">Next</span>'+
            '</a>');

                              var elemento_item=$(this).parents('div').html();

                              $('.modal-control-left').click(function(){
                                alert(elemento_item);
                                 $('.modal-body').empty();
                              });


                              $('.modal-control-right').click(function(){
                                alert(elemento_item);
                                 $('.modal-body').empty();
                              });





                              
                              var title = $(this).parent('a').attr("title");
                              
                              $('.modal-title').html(title);
                              $($(this).parents('div').html()).appendTo('.modal-body');
                              $('#myModal').modal({show:true});

                              // $('.thumbnail_cont').animate({height:'auto'}, 1000);
                              $('.thumbnail_cont').css({height:'auto'});


                              //////console.log("modal_gal");
                          });//fin thumbs galeria y modal de galeria


                          $('#myModal').on('hide.bs.modal', function () {
                              $('.thumbnail_cont').css({height:'80px'});
                          });

                          $('.paginationjs-next').hide();


                      }
                  }); 

   
  
}




var click_al_tipo=function(btn_del_tipo, lista_fotos){
    var btn_del_tipo=$(btn_del_tipo);

    btn_del_tipo.on('click', function(){

      
     //////console.log("probando");

     funcion_click(btn_del_tipo, lista_fotos);

    });


  }



$(document).ready(function(){



  // $("[data-fancybox]").fancybox({
  //   // Options will go here
  // });

  ////console.log("iniciamos con la galeria");

  $.ajax({
      method: "POST",
      url: "external_html/galeria/control.php",
      data: { 
      }
    })
      .done(function( data ) {

        var data=JSON.parse(data);  

      console.log('-----GALERIA-----data');
      console.log(data);

      var lista_tipos=data['lista_tipos'];
      //////console.log(lista_tipos);
      var lista_fotos=data['lista_fotos'];
      //////console.log(lista_fotos);

      $('.nombre_tipo').hide();

      $('#tipos_cont>h2').css("cursor","pointer");




        var foto_fondo=$.grep(lista_fotos,function(value_a, key_a){   
              if (value_a['fondo']==1) {
                return value_a;
              }
         });


        $('#background_galeria').find('img').attr('src',ruta_files+foto_fondo[0].file_name);



        var fotos_slide=$.grep(lista_fotos,function(value_e, key_e){   
             return (value_e['slide']==1);
         });



         $.each(fotos_slide, function(key_slide, value_slide){

            $('.galeria_slide_item').clone().removeClass('galeria_slide_item').appendTo('.carousel_galeria').attr({
                'id':'foto_item_galeria'+key_slide
            });

            $('#foto_item_galeria'+key_slide+'>img').attr(
            {
              'src':ruta_files+value_slide['file_name'],
              'alt':value_slide['nombre']
             
            });

            

           $('.control_item').clone().removeClass('control_item').appendTo('.indicators_galeria').attr({
              'data-slide-to':key_slide,
              'id':'control-'+key_slide
           });


           if (key_slide != 0) {
              $('#foto_item_galeria'+key_slide).removeClass('active');
              $('#control-'+key_slide).removeClass('active');
          };


        });

          $('.galeria_slide_item').remove();
           $('.control_item').remove();





        console.log('-------foto_slide');
        console.log(fotos_slide);



      //colocar los tipos: por cada unon de los tipos contenidos en la lista de tipos vamos a generar un btn que permita obtener el id del tipo selccionado.

      $.each(lista_tipos, function(key, value){
        //////console.log("__________ L I S T A   D E   T I P O S _______");
        //////console.log(key);
        //////console.log(value);  

        var arrray_galeria=$.grep(lista_fotos,function(value_f, key_f){   
                    if (value_f['tipo']==value['id_tipo']) {
                      return value_f;
                    }
         } );


        ////console.log(arrray_galeria.length);


        if (arrray_galeria.length != 0) {

            $('.nombre_tipo').hide();

            $('.nombre_tipo').clone().appendTo('#tipos_cont').removeClass('nombre_tipo').attr(
            {
              "id":'tipo'+key,
              'data-id-tipo':value['id_tipo']
            }
            );

            $('#tipo'+key).show().text(value['nombre_tipo']);

            click_al_tipo('#tipo'+key,arrray_galeria);

            if (key == 0) {
              funcion_click('#tipo'+key, arrray_galeria);
            };

            };

          });

      


    
      // var galeria_data = $.grep(lista_tipos,function(value, key){
      //               if (value["id_tipo"]== opt.id_tipo) {
      //                 return value;
      //               };

      //             });
      // $('#nombre_ciudad').text(lista_tipos[0]["nombre"]);
      

      // var GLOBAL_TIPO = '.json_encode($valores_regreso).';

      //  var galeria_data = $.grep(GLOBAL_TIPO,function(value, key){
                      
      //               if (value["id_tipo"]== opt.id_tipo) {
      //                 return value;
      //               };

      //             });
      // $('#nombre_ciudad').text(galeria_data[0]["nombre"]);
      // //////console.log(nombre);

      //$.each(data,function(index,value){
      //  //////console.log(value);
      //  $("#contenedor_banners").append();
      //});
      // $.each(data, function(index,value){

      //     //////console.log(index);
      //     //////console.log(value['file_name']);
      //     active="";

      //     if (index == 0) {
      //       active="active";
      //     };

      //     $("#carousel_galery >.carousel-indicators").append('<li data-target="#carousel_galery" data-slide-to="'+index+'" class="'+active+'" ></li>');

      //     $("#carousel_galery > .carousel-inner").append('<div class="item '+active+'">'+
      //           '<img src="admin/paginas/galeria/'+value['file_name']+'" alt="'+value['nombre']+'">'+
      //           '<div class="carousel-caption">'+
      //             value['nombre']+
      //           '</div>'+
      //         '</div>'
      //     );
      //  });


      
    });



$.ajax({
      method: "POST",
      url: "external_html/galeria/control_texto.php",
      data: { 
      }
    })
      .done(function( data ) {

        var data=JSON.parse(data);  

      console.log('-----GALERIA-----data-------TEXTO');
      console.log(data.texto[0].p_izq);
      console.log(data.texto[0].titulo_izq);



        if (idioma == 'EN') {
          titulo=data.texto[0].p_izq_ingles;
       parrafo=data.texto[0].titulo_izq_ingles;
       
       
      }
      else{
       titulo=data.texto[0].p_izq;
       parrafo=data.texto[0].titulo_izq;
      };




      $('#titulo_galeria_ini').html(parrafo);
      $('#titulo_galeria_dos').html(titulo);
     

      
    });



    //fin del método ajax

    
    
});
//fin del document ready
