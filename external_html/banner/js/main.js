$(document).ready(function(){
  //console.log("iniciamos banner");

  


  $.ajax({
      method: "POST",
      url: "external_html/banner/control.php",
      data: { 
         
      }
    }).done(function( data )
    {

      if (data != null) {
      // //console.log( "+++++++data" );
      // //console.log( data );

      var data=JSON.parse(data);  

      //console.log( "+++++++data" );
      //console.log( data );

      //$.each(data,function(index,value){
      //  //console.log(value);
      //  $("#contenedor_banners").append();
      //});



      // if (data.nombre != "") {};

      setTimeout(function(){
        

      if (idioma == 'EN') {
        ingles_value=1;
      }
      else{
        ingles_value=0;
      };

      
        data_final=$.grep(data,function(valor,key){
          // console.log('--------------DATA------BANER-------');
          // console.log(valor);
          return (valor.ingles==ingles_value);
        })   

          // console.log('--------------DATA------FINAL-----BANER-------');
          // console.log(data_final);
       

      $.each(data_final, function(index,value)
      {


          





        // index+=1;
         var active="";

        //console.log(index);
        //console.log(value['nombre']);

        if (index==0) { 
          active="active";
           //console.log("ES ACTIVO");

           $('#slide0').remove();
           $('#indicator0').remove();

        };

        $("#carousel_main > .carousel-indicators").append('<li data-target="#carousel_main" data-slide-to="'+index+'" class="'+active+'"></li>');

        $("#carousel_main > .carousel-inner").append(
          '<div id="slide'+index+'" class="item '+active+'" >'+
          '<h2 id="tit_bl_light" class="titulo_banner">'+value['nombre']+'</h2>'+
          

            '<a href="'+value["url"]+'">'+
                '<img src="admin/paginas/banner/'+value["file_name"]+'" alt="Slide '+index+'">'+

                '<div class="carousel-caption">'+

                 
                  
                '</div>'+
          '</a>'+
              '</div>'
          );

          if (value['url'] !=  '' && value['url'] !=  '#') {
            $('#slide'+index).append(  ' <a id="cono_btn_vid" href="#cert">'+
                '<div id="con_mas">CONOCER MÁS</div>'+
           ' </a> ');
          };


      });

    },1000);

           }else{

            //console.log("nobanner");

           }





           // $('#carousel_main').append('<a class="left carousel-control" href="#carousel_main" role="button" data-slide="prev">'+
           //  '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>'+
           //    '<span class="sr-only">Previous</span>'+
           //  '</a>'+
           //  '<a class="right carousel-control" href="#carousel_main" role="button" data-slide="next">'+
           //      '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'+
           //    '<span class="sr-only">Next</span>'+
           //  '</a>');

      
    });
//     //fin del método ajax

    
});
//fin del document ready
