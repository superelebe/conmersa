


var ruta_files_inicio='admin/paginas/secciones/';



$(document).ready(function(){


  //console.log("iniciamos EL INICIO---------");

  $.ajax({
      method: "POST",
      url: "external_html/inicio/control.php",
      data: { 
      }
    })
      .done(function( data ) {

        var data=JSON.parse(data);  

     

      if (idioma == 'EN') {

        titulo_principal=data.info.titulo_principal_ingles;
        titulo_izq=data.info.titulo_izq_ingles;
        p_izq=data.info.p_izq_ingles;
        titulo_der=data.info.titulo_der_ingles;
        p_der=data.info.p_der_ingles;

      }
      else{
        titulo_principal=data.info.titulo_principal;
        titulo_izq=data.info.titulo_izq;
        p_izq=data.info.p_izq;
        titulo_der=data.info.titulo_der;
        p_der=data.info.p_der;

      };


      $('#titulo_prin_inicio').html(titulo_principal);

      $('#titulo_izq_inicio').html(titulo_izq);

      $('#p_izq_inicio').html(p_izq);

      $('#titulo_der_inicio').html(titulo_der);

      $('#p_der_inicio').html(p_der);

      $('#img_der_inicio').attr('src',ruta_files_inicio+data.imagenes[0].file_name);

      $('#img_izq_inicio').attr('src',ruta_files_inicio+data.imagenes[1].file_name);
      
       $('#youtube_content').attr('src',"https://www.youtube.com/embed/"+data.info.yotube_link+"?autoplay=1&controls=0");

      



        // $('.launch-modal').on('click', function(e){
        // e.preventDefault();
        // $( '#' + $(this).data('modal-id') ).modal();
        // });//fin modal video


      
    });
    //fin del método ajax

    
    
});
//fin del document ready
