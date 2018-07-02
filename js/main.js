var idioma=GLOBAL_GET_DATA.lgj;






/////////////// /*load file*/  Esta fucnión solo carga el archivo.
////////////////////////////////////////////
var load_file=function(elemento, file){  

      var elemento=$(elemento);

     elemento.load( file, function( response, status, xhr ) {
       
        ////console.log(this);

        $(this).hide().stop(true, true).fadeIn(1000, "swing");



        $(".idioms").idiomsswifter({
          info_en:english,
          info_es:espanol,
          idioma:idioma 
        });

        

        if ( status == "error" ) {
          var msg = "Lo sentimos hubo un error de carga.";
          //////console.log(msg);
          $( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
        }
      });
  };


  $(function(){ 
     var navMain = $("#bs-example-navbar-collapse-1");
     navMain.on("click", "a", null, function () {
         navMain.collapse('hide');
     });
 });


$(document).ready(function(){

  load_file('#el_banner_home',"external_html/banner/index.html");

  load_file('#empresacontent',"external_html/inicio/index.html");

  load_file('#servicios',"external_html/servicios/index.html") ;

  load_file('#galeria',"external_html/galeria/index.html"); 

  console.log("WE CHANGE");

  load_file('#bolsatrabajo',"external_html/bolsatrabajo/index.html"); 


  
  






$(".btn_idioma").click(function(e){

  e.preventDefault();

  // var idioma_origen = $(this).attr("data_idioma");
  
  console.log("*****");
  
  var pathname = location.pathname.split("/");
  pathname = pathname[pathname.length-1];

  var titulo="";

  if (idioma=="ES") {
    
    idioma_destino="EN";
    titulo="ENGLISH";

    // $('.catalogo_btn').attr("href","catalogo/GTO_Fashion_esp.pdf");
    
    console.log("__ES_______pathname");
    console.log(pathname);

    // location.href=pathname+'?lgj=EN';

  }else if(idioma=="EN") {
    idioma_destino="ES";
    titulo="ESPAÑOL";

    // $('.catalogo_btn').attr("href","catalogo/GTO_Fashion_eng.pdf");
     
     console.log("___ES______pathname");
    console.log(pathname);

    

  }
  // console.log(location.search.lgj);
  //  if (location.search.lgj =="") {
  //   destino=pathname+'?lgj='+idioma_destino;
  //  }
  //  else{
  //   destino=pathname+'&lgj='+idioma_destino;
  //  }

  location.hash='';
  location.search='?lgj='+idioma_destino;
  
 

  // $(this).attr("data_idioma",idioma);
  // $(this).text(titulo);

});






/*
      Modal para video
  */



  $(".btns_plus").click(function(e){//añadir funcion al click por cada boton y un parametro
    e.preventDefault();//utilizar el parametro para quitar el funcionamiento por default

      var p = $( "#texto_infografia" );//Establecer el contenido a buscar y crear variable.
      var offset = p.offset();//Variable con el método offset que proporciona la posición del elemento.
      //////console.log("*****offset.left y top*****");
      //////console.log(offset.left);//obtener posicion mediante left en la página
      //////console.log(offset.top);//obtener posicion mediante top en la página

      var valor_pos = Math.round(offset.top);//redondear el parametro top y colocarlo en una variable
      //////console.log("-------________***valor_redondeado***________-------");
      //////console.log(valor_pos);
      $('body,html').animate({'scrollTop':9000},0,"easeOutQuart",function(){//animar el body
          // $(this).animate({'scrollTop':'-=3125px'},2000,"easeOutQuart");//pasa el parametro de la posicion manualmente
          $(this).animate({'scrollTop':valor_pos+-100+"px"},2000,"easeOutQuart");
      });  
  }); 




/////////////////////////---------------INICIO







// hang_rev('.copo2', 2200);
// hang('.copo3', 1000);

  
$('.Scrollex').click(function(){
    $('body,html').animate({'scrollTop':'500px'},3000).animate({'scrollTop':'1050px'},4000);
  });
  
  


	/////////////////////////////////////////mailer///////////////////////////////////////////////////////////////////////////////////////////////////////////   

    var frm = $('#form_one');

    // frm.validationEngine();


    //////console.log("testing");
    //////console.log(frm);

    // $('#bnt_sumit').click(function(event){
    //   event.preventDefault();
    //   //////console.log("que pasa");
    // });

        // frm.submit(function (ev)
        // {

          $('#enviar_btn').click(function(ev){
      
          ev.preventDefault();
          //////console.log(this);


          if (frm.validationEngine('validate'))
          {
            $.ajax(
            {
                  cache: false,
                  contentType: false,
                  processData: false,
                  type: frm.attr('method'),
                  url: frm.attr('action'),
                  data: new FormData(frm[0]),
                  success: function (data) 
                  { 
                    //////console.log(data);
                    if (data == 1) {
                     
                      
                        //Animacion avioncito
                      $('button').toggleClass('clicked');
                      $('button p').text(function(i, text) {
                        return text === "Enviado!" ? "Enviar" : "Enviado!";
                        //////console.log("funcion_boton_enviar");
                      });
                      $('#enviar_btn').fadeOut(1000);

                      $('#id').css(
                        {
                          '-moz-transform':'rotateX(90deg',
                            '-webkit-transform':'rotateX(90deg)',
                            'transform':'rotateX(90deg)'
                        });
                      //////console.log($(".form-group input"));
                      $(".form-group").find("input , textarea").val("");
                      $('.res_contacto h3').text("¡Gracias por contactarnos!");
                      $('.res_contacto p').text("Pronto recibirás una respuesta.Que tengas un buen día");
                      $('.res_contacto').fadeIn(1000).delay(2500).fadeOut(500, function(){
                        $('#enviar_btn').fadeIn(100);
                      });

                    }
                    else{

                     
                       $('#id').css(
                        {
                          '-moz-transform':'rotateX(90deg',
                            '-webkit-transform':'rotateX(90deg)',
                            'transform':'rotateX(90deg)'
                        });
                      $('.back-face').text("Intenta mas tarde");
                      $('.back-face').css("background-color","red");
                      $('.back-face').attr("data-icon","x");

                      $('.res_contacto h3').text("¡Lo sentimos ha ocurrido un problema!");
                      $('.res_contacto p').html("No se ha podido enviar tu correo.<br>Intentalo más tarde. <br />¡Gracias!");
                      $('.res_contacto').fadeIn(1000).delay(2500).fadeOut(500, function(){
                        $('#enviar_btn').fadeIn(100);
                      });
                    };
                    
                  }
            });
            }
          });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 


});//fin document ready