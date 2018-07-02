

        // El brn de tipos creado al darle click deberá vaciar el contenedor de la galeria de fotos y volver a poblar dicha galeria solo con las fotos correspondientes al ID TIPO seccionado.


var click_al_tipo=function(btn_del_tipo, lista_fotos){
    var btn_del_tipo=$(btn_del_tipo);

    btn_del_tipo.on('click', function(){

      
      var id_tipo=$(this).attr('data-id-tipo');

      

      $('.ele_galeria').hide().appendTo('body');


      $('#contenedor_thumbs').children().remove();


      var arrray_galeria=$.grep(lista_fotos,function(value_f, key_f){
                    if (value_f['tipo']==id_tipo) {
                      return value_f;
                    }
      } );


  $('#pagination-container').pagination(
                  {
                      dataSource:arrray_galeria,
                      autoHidePrevious: true,
                      autoHideNext: true,
                      pageSize:6,
                      callback: function(lista, pagination)
                      { 

                        $.each(lista, function(key, value){


                        console.log('_____ :......EN EL CLIC. ..... :: .____');
                      console.log(lista);
                     console.log(pagination);

                          $('.ele_galeria').clone().removeClass('ele_galeria').appendTo('#contenedor_thumbs').attr('id','foto'+key);
                          $('#foto'+key).fadeIn(1000+(500*key), 'swing');


                          if (pagination['totalPage']==1) {
                            $('.paginationjs-pages').hide();
                          }

                        });



                          $('.thumbnail').on('click',function(m){
    m.preventDefault();
        $('.modal-body').empty();
      var title = $(this).parent('a').attr("title");
      $('.modal-title').html(title);
      $($(this).parents('div').html()).appendTo('.modal-body');
      $('#myModal').modal({show:true});
      console.log("modal_gal");
  });//fin thumbs galeria y modal de galeria



                      }
                  }); 

   
  


    })

  }



$(document).ready(function(){
  console.log("iniciamos con la galeria");

  


  $.ajax({
      method: "POST",
      url: "external_html/main_slide/control.php",
      data: { 
      }
    })
      .done(function( data ) {

        var data=JSON.parse(data);  

      console.log(data);

      var lista_tipos=data['lista_tipos'];
      console.log(lista_tipos);
      var lista_fotos=data['lista_fotos'];
      console.log(lista_fotos);


      //colocar los tipos: por cada unon de los tipos contenidos en la lista de tipos vamos a generar un btn que permita obtener el id del tipo selccionado.

      $.each(lista_tipos, function(key, value){
        console.log("__________ L I S T A   D E   T I P O S _______");
        console.log(key);
        console.log(value);  

        $('.nombre_tipo').hide();

        $('.nombre_tipo').clone().appendTo('#tipos_cont').removeClass('nombre_tipo').attr(
        {
          "id":'tipo'+key,
          'data-id-tipo':value['id_tipo']
        }
        );

        $('#tipo'+key).show().text(value['nombre_tipo']);

        click_al_tipo('#tipo'+key,lista_fotos);

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
      // console.log(nombre);

      //$.each(data,function(index,value){
      //  console.log(value);
      //  $("#contenedor_banners").append();
      //});
      // $.each(data, function(index,value){

      //     console.log(index);
      //     console.log(value['file_name']);
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
    //fin del método ajax

    
    
});
//fin del document ready
