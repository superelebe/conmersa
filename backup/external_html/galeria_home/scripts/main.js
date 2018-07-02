var path='external_html/galeria_home/';
var url_data={};
var lista_array={};


/////////////////////////////////////////////
/////////////// /*load page content*/
////////////////////////////////////////////

var getUrlData=function(){

var url_data={};

var seccion=currentURL.hash;

seccion = seccion.replace('#',"");
seccion =seccion.split('/');


$.each(seccion, function(key, value){
    value =value.split('=');
    url_data[value[0]]=value[1];
    // seccion[keyin]
});

// console.log(seccion);
// console.log("url_data");
// console.log(url_data);

return url_data;

};
/////////////////////////////////////////////
/////////////// /*POPULATE ACORDION*/
////////////////////////////////////////////
var populate_acordion=function(lista,opt){
 

  $.each(lista,function(key,value){
    // console.log(key);
    // console.log(value);

    

    var id_name="menu_"+(key+1);
    var menu_name="."+id_name;


    var id_name="menu_"+(key+1);
    var menu_name="."+id_name;
    
    var nombre="";
    var tipo="";
    var sector="";
    var descripcion="";

    if (idioma == "ES") {
      nombre=value.nombre;
      sector=value.sector["nombre"];
      tipo=value.tipo["nombre"];
      descripcion=value.descripcion;


    }else if(idioma == "EN"){
      nombre=value.name;
      sector=value.sector["name"];
      tipo=value.tipo["name"];
      descripcion=value.description;
    }


   
    $("#accordion_new").fadeIn(1000,"easeInQuart");
    $("#menu_template").hide().clone().appendTo( "#accordion_new").addClass(id_name).attr("id","");
    $(menu_name).fadeIn(1000*key,"easeOutQuart");
    $(menu_name).find('.panel-heading').attr("id","heading"+key);
    
    


    $(menu_name).find('.btn_colapse').attr({
      "href":"#collapse"+key,
      "aria-controls":"collapse"+key,
      "data-parent":"#accordion_new"
    });

    $(menu_name).find(".panel-collapse").attr({
      "id":"collapse"+key,
      "aria-labelledby":"heading"+key
    });
    $(menu_name).find('.titulo_marca').text(nombre);
    $(menu_name).find('.sector').text(sector);
    $(menu_name).find('.tipo').text(tipo);
    var sector_data=$.grep(GLOBAL_SECTOR,function(value_sector,key_sector){
       if(value_sector["id_sector"]==value.sector["id_sector"]){
        return value;
       };
    });
    // console.log("sector_data");
    // console.log(sector_data);


    $(menu_name).find('.descripcion').text(descripcion);
    $(menu_name).find('.direccion').text(value.direccion);

    $(menu_name).find('.direccion').attr("href","http://"+value.direccion);
    $(menu_name).find('.ciudad').prepend(value.ciudad.nombre);
    $(menu_name).find('.telefono').text(value.telefono);
    $(menu_name).find('.telefono').attr("href",'tel:'+value.telefono);
    // 
    $(menu_name).find('.correo').text(value.correo);
    $(menu_name).find('.correo').attr("href",'mailto:'+value.correo+'?Subject=GTO%20Fashion%20-%20HOla%20los%20he%20visto%20en%20la%20pagina%20gto-fashion.com.mx');
    
    $(menu_name).find('.lifestyle').attr("data-src",opt.
      path_foto+value.lifestyle['file_name']);

    console.log(value.logotipo['file_name']);

    if (value.logotipo['file_name'] != undefined) {
      
      console.log("existe----------->>>>");
      
      $(menu_name).find('.btn_colapse img').attr({
        "src":opt.path_foto+value.logotipo['file_name'],
        "alt":nombre
      });

      $(menu_name).find('.logotipo').attr({
        "data-src":opt.path_foto+value.logotipo['file_name'],
        "alt":nombre
      });
    
    }else{

      $(menu_name).find('.btn_colapse img').parent();
      var padre= $(menu_name).find('.btn_colapse img').parent();
      //"<h3 class='nologo_nombre'><img src='images/no_logo_GTO-FASHION.png' alt='No logo' /> "+nombre+"</h3>"
      $(menu_name).find('.btn_colapse img').remove();
      padre.prepend('<img class="nologo_imagen" src="images/no_logo_GTO-FASHION.png" alt="NO LOGO" /><h3 class="nologo_nombre">'+nombre+'</h3>');

      
      $(menu_name).find('.logotipo').remove();


    };
    

    $(menu_name).find('.fondo').attr("data-src",opt.path_foto+value.fondo['file_name']);
     $(menu_name).find('.sector_img').attr("data-src",opt.path_foto+sector_data[0]["file_name"]);

    if (key==0) {
       $("#collapse"+key).addClass("in");
         $(menu_name).find('.lifestyle').attr("src",opt.
      path_foto+value.lifestyle['file_name']);
    $(menu_name).find('.logotipo').attr("src",opt.path_foto+value.logotipo['file_name']);
    $(menu_name).find('.fondo').attr("src",opt.path_foto+value.fondo['file_name']);
     $(menu_name).find('.sector_img').attr("src",opt.
      path_foto+sector_data[0]["file_name"]);
    };
   
  });
}
/////////////////////////////////////////////
/////////////// /*EFECTO ACORDION*/
////////////////////////////////////////////

var target_actual="";
var target_anterior="";
var efect_acordion=function(data){

    target_actual=data.target.parentElement;

    if (target_actual != target_anterior) {
      // console.log("TESTIN");
      // console.log(data);
      // console.log(target_actual);

    };
    
    

  
    var actua_el = $(data.target.parentElement);
    

    var lifestyle_foto=actua_el.find('.lifestyle').attr("data-src");
    var logotipo_foto=actua_el.find('.logotipo').attr("data-src");
   var fondo_foto=actua_el.find('.fondo').attr("data-src");
   var sector_foto=actua_el.find('.sector_img').attr("data-src");


    actua_el.find('.lifestyle').attr("src",lifestyle_foto).hide().delay(1000).fadeIn(2000,"easeInOutQuart");
    actua_el.find('.logotipo').attr("src",logotipo_foto).hide().delay(500).fadeIn(1000,"easeInQuart");;
   actua_el.find('.fondo').attr("src",fondo_foto).hide().delay(1000).fadeIn(1000,"easeOutQuart");


   actua_el.find(".datos_content").children().each(function(key, value){
      console.log(value);
      $(value).css({"left":"+=1500","opacity":"0","position":"relative"});

      $(value).stop(true).animate({"left":"-=1500","opacity":"1"},1000+(300*key),"easeOutQuart");

       // $('body,html').animate({'scrollTop':0},0);  
   });

   actua_el.find('.sector_img').attr("src",sector_foto).hide().fadeIn( 500,"easeOutQuart");

   targer_anterior=target_actual;

 }
/////////////////////////////////////////////
/////////////// /*onWidthResize*/
////////////////////////////////////////////
var onWidthResize_p = function(callback_true,callback_false,min_width,data_callback_true, data_callback_false){
  console.log("onWidthResize_p");

  var onSwitch=true;

    if ($(window).width() < min_width) {

        console.log("ES MENROOOOORRRR  resize");
        console.log($(window).width());
        console.log(onSwitch);
        if (onSwitch) {  
          
         callback_true(data_callback_true);
           onSwitch=false;
        }
    }
    else if($(window).scrollTop()< 320) {
        if (!onSwitch) { 
          console.log(onSwitch);
          // console.log('More than'+min_width);
          callback_false(data_callback_false);      
          onSwitch=true;
        }  
    }

    $(window).on('resize', function() {
      
        
            if ($(window).width() < min_width) {
              

                if (onSwitch) {  
                  console.log(onSwitch);
                  // console.log('Less than '+min_width+' resize');
                  callback_true(data_callback_true);
                  onSwitch=false;
                }

            } else if($(window).scrollTop()< 320){

              
                if (!onSwitch) { 
                  console.log(onSwitch);
                  callback_false(data_callback_false);
                  // console.log('More than '+min_width+' resize');
                  onSwitch=true;
                }  
            }

        
    });

}


var callSeccion=function(url_data){
    var url_data=url_data;

    console.log("_________url_data.length"); 
    console.log(url_data);



    // var searching=currentURL.search;
    // console.log(searching);
    // searching = searching.replace('?',"");
    // searching =searching.split('&');

    // var url_data_s={};

    // $.each(searching, function(key, value){
    //     value =value.split('=');
    //     url_data_s[value[0]]=value[1];
    //     // seccion[keyin]
    // });
    if (url_data["sector"]==null && url_data["tipo"]==null && url_data["marca"]==null && url_data["ciudad"]!= null) {
       console.log("--+-++-+--+-+*-+*-+--+*-+*+-*+url_data CIUDAD");
      console.log("CIUDAD"); 


      list_display_home({
          url_data:url_data,
          name:"ciudad",
          lista:"",
          contenedor:".data-container",
          seccion:"ciudad",  
          path:path,
          id_ciudad:url_data["ciudad"]

        });
    };


     if (url_data["sector"]==null && url_data["tipo"]==null && url_data["marca"]!=null && url_data["ciudad"]== null) {
       console.log("--+-++-+--+-+*-+*-+--+*-+*+-*+url_data MARCA");
      console.log("MARCA"); 

      if (url_data["marca"] == "todos") {

        list_display_home({
          url_data:url_data,
          name:"todos",
          lista:"",
          contenedor:".data-container",
          seccion:"todos",  
          path:path

        });
      }
      else{
        list_display_home({
          url_data:url_data,
          name:"marca",
          lista:"",
          contenedor:".data-container",
          seccion:"marca",  
          path:path,
          id_marca:url_data["marca"]
        });
      }

    };



    if (url_data["sector"]==null && url_data["tipo"]==null && url_data["marca"]==null && url_data["ciudad"]== null) {
       console.log("--+-++-+--+-+*-+*-+--+*-+*+-*+url_data CLASE");
      console.log("inicio"); 


      list_display_home({
          url_data:url_data,
          name:"inicio",
          lista:"",
          contenedor:".data-container",
     
          seccion:"inicio",  
          path:path

        });

    };




    if (url_data["sector"]!="" && url_data["sector"]!=undefined && url_data["sector"] != null && url_data["marca"]==undefined && url_data["tipo"]==undefined && url_data["ciudad"]== undefined) {
      console.log("--+-++-+--+-+*-+*-+--+*-+*+-*+url_data SECTOR");
      console.log(url_data["sector"]); 
    
      list_display_home({
          url_data:url_data,
          name:"sector",
          id_clase:url_data["sector"],
          lista:"",
          contenedor:".data-container",
          seccion:"sector",  
          path:path

        });


    };

    if ( url_data["tipo"]!="" && url_data["tipo"]!=undefined && url_data["tipo"] != null && url_data["marca"]==undefined && url_data["ciudad"]== null) {

      console.log("--+-++-+--+-+*-+*-+--+*-+*+-*+url_data TIPO");
      console.log(url_data["tipo"]);

      list_display_home({
          url_data:url_data,
          name:"tipo",
          id_categoria:url_data["tipo"],
          lista:"",
          contenedor:".data-container",
      
          seccion:"tipo",  
          path:path

        });
       


    };
   

};




var list_display_home=function(parameters){
  
  var defaults = {
     url_data       :'',
     lista          :'',
     url_control    :'control.php',
     contenedor     :".data-container",
     path_foto      :'admin/paginas/marca/',
     path           :'',
     seccion        :'clase',
     id_clase       :'',
     id_categoria   :'',
     id_marca       :'',
     id_ciudad       :'',
     append_string  :'<div class="display_error"> </div>'
  };
 

  var opt = $.extend(defaults, parameters);

  // console.log("-----defaults");
  // console.log(defaults);
  // console.log("-----parameters");
  // console.log(parameters);
  // console.log("--------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
  // console.log("-----///OPT");
  // console.log(opt);
  // console.log(opt);


  $.ajax({
    method:"POST",
    url: opt.path+opt.url_control,
    data:{
      seccion:opt.seccion,
      id_clase:opt.id_clase,
      id_categoria:opt.id_categoria,
      id_marca:opt.id_marca,
      id_ciudad:opt.id_ciudad,
    }
  }).done(function( data )
  {
    var data=JSON.parse(data);
    console.log(data);
    if (data.lista == null || data.lista == "" ) {
        console.log("ITS NULLLLLL--------");
        // window.location.href="index.php?lgj="+idioma+"&seccion=error_busqueda";
         load_file(opt.contenedor,"error_busqueda.php");
        return false;

      };


        
      
      opt.lista=data;

      var tipo_nombre ="";
      var sector_nombre ="";
      var todos_nombre="";
     var ciudad_nombre=opt.lista["lista"][0]["ciudad"]["nombre"];

      if (idioma == "ES") {
        sector_nombre=opt.lista["lista"][0]["sector"]["nombre"];
        tipo_nombre=opt.lista["lista"][0]["tipo"]["nombre"];
        todos_nombre="TODAS LAS MARCAS FASHION GTO";
      }
      else if(idioma == "EN"){
        sector_nombre=opt.lista["lista"][0]["sector"]["name"];
        tipo_nombre=opt.lista["lista"][0]["tipo"]["name"];
        console.log("tipo_nombre---------"+tipo_nombre);
        todos_nombre="ALL BRANDS FASHION GTO";
      };
      
  

    // $('#pagination-container').pagination({
      
      // dataSource: opt.lista["lista"],
      // autoHidePrevious: true,
      // autoHideNext: true,
      // pageSize:4,

      // callback: function(lista, pagination) {
          
          // console.log("return pagination data");
          // console.log(opt.lista["lista"]);
          // console.log(pagination);
        
          
          console.log(opt.seccion);

          switch(opt.seccion)
          {
            case "inicio":

              $(opt.contenedor).children().remove();

               $.each(GLOBAL_CONCEPTO,function(key, value){

                  // console.log("------------------&////&///");
                  // console.log(value["concepto"]);


                 $("#accordion").hide();
                 $("#accordion").clone().appendTo(".data-container").attr("id","accordion_"+value["concepto"]);

                 
                  $("#accordion_"+value["concepto"]).on('show.bs.collapse', function (data) {
                                 efect_acordion(data);
                  }); 
               $("#accordion_"+value["concepto"]).on('hide.bs.collapse', function (data) {
                        
                          console.log("cerrando");
                          console.log(target_actual);
                          var actua_el = data.target.parentElement;
                          console.log(actua_el);
                          if (target_actual==actua_el) {
                            data.preventDefault();    
                          };
                           
                  }); 

             });



                var valor_concepto_actual="";
                var valor_concepto_anterior="";

                 $.each(opt.lista["lista"],function(key,value){
                        
//----------------------------------//----------------------------------//----------------------------------//----------------------------------//----//-// T E M P L A T E //--//-----------------------------//----------------------------------//----------------------------------//----------------------------------//----------------------------------//----------------------------------//----------------------------------//-------------------
                    //---------------------------------- I N I C I O -----------------
                    if (value.id_concepto != 0 && value.id_concepto!= null && value.id_concepto!= undefined ){

                      valor_concepto_actual=value.id_concepto;

  
                    
                      var id_name="menu_"+(key+1);
                      var menu_name="."+id_name;


                      var nombre="";
                      var tipo="";
                      var sector="";
                      var descripcion="";

                      if (idioma == "ES") {
                        nombre=value.nombre;
                        sector=value.sector["nombre"];
                        tipo=value.tipo["nombre"];
                        descripcion=value.descripcion;


                      }else if(idioma == "EN"){
                        nombre=value.name;
                        sector=value.sector["name"];
                        tipo=value.tipo["name"];
                        descripcion=value.description;
                      }




                     
                      $("#accordion_"+value.id_concepto).fadeIn(1000,"easeInQuart");

                      $("#menu_template").hide().clone().appendTo( "#accordion_"+value.id_concepto).addClass(id_name).attr("id","");

                      $(menu_name).fadeIn(1000*key,"easeOutQuart");

                      $(menu_name).find('.panel-heading').attr("id","heading"+key);
                      $(menu_name).find('.btn_colapse img').attr("src",opt.path_foto+value.logotipo['file_name']);
                      $(menu_name).find('.btn_colapse').attr({
                        "href":"#collapse"+key,
                        "aria-controls":"collapse"+key,
                        "data-parent":"#accordion_"+value.id_concepto
                      });

                      $(menu_name).find(".panel-collapse").attr({
                        "id":"collapse"+key,
                        "aria-labelledby":"heading"+key
                      });

                      $(menu_name).find('.titulo_marca').text(nombre);
                      
                      $(menu_name).find('.sector').text(sector);
                      $(menu_name).find('.tipo').text(tipo);


                      var sector_data=$.grep(GLOBAL_SECTOR,function(value_sector,key_sector){
                         if(value_sector["id_sector"]==value.sector["id_sector"]){
                          return value;
                         };
                      });

                 
                      // console.log("sector_data");
                      // console.log(value.ciudad.nombre);

                      $(menu_name).find('.descripcion').text(descripcion);
                      $(menu_name).find('.direccion').text(value.direccion);


                      $(menu_name).find('.direccion').attr("href","http://"+value.direccion);
                      $(menu_name).find('.ciudad').prepend(value.ciudad.nombre);
                      $(menu_name).find('.telefono').text(value.telefono);
                      $(menu_name).find('.telefono').attr("href",'tel:'+value.telefono);
                      // 
                      $(menu_name).find('.correo').text(value.correo);
                      $(menu_name).find('.correo').attr("href",'mailto:'+value.correo+'?Subject=GTO%20Fashion%20-%20HOla%20los%20he%20visto%20en%20la%20pagina%20gto-fashion.com.mx');
                      
                      $(menu_name).find('.lifestyle').attr("data-src",opt.
                        path_foto+value.lifestyle['file_name']);
                      $(menu_name).find('.logotipo').attr("data-src",opt.path_foto+value.logotipo['file_name']);
                      $(menu_name).find('.fondo').attr("data-src",opt.path_foto+value.fondo['file_name']);
                      $(menu_name).find('.sector_img').attr("data-src",opt.path_foto+sector_data[0]["file_name"]);

                      if (valor_concepto_actual!=valor_concepto_anterior) {
                         $("#collapse"+key).addClass("in");

                           $(menu_name).find('.lifestyle').attr("src",opt.
                        path_foto+value.lifestyle['file_name']);
                      $(menu_name).find('.logotipo').attr("src",opt.path_foto+value.logotipo['file_name']);
                      $(menu_name).find('.fondo').attr("src",opt.path_foto+value.fondo['file_name']);

                       $(menu_name).find('.sector_img').attr("src",opt.
                        path_foto+sector_data[0]["file_name"]);



                      };

                      valor_concepto_anterior=valor_concepto_actual;

                    };
                  });

                  break;

                    //---------------------------------- S E CT O  R -----------------
                  case "sector":


                  console.log("SECTOR");

                  $('#pagination-container').pagination(
                  {
                      dataSource: opt.lista["lista"],
                      autoHidePrevious: true,
                      autoHideNext: true,
                      pageSize:6,
                      callback: function(lista, pagination)
                      {

                        $(opt.contenedor).children().remove();


                           

                         $(opt.contenedor).prepend('<h1 class="titulo_prin">'+sector_nombre+'</h1>')


                         $("#accordion").hide();
                         $("#accordion").clone().appendTo(".data-container").attr("id","accordion_new");

                          $("#accordion_new").on('show.bs.collapse', function (data) {
                                efect_acordion(data);
                          }); 



                      
                         populate_acordion(lista, opt); 

                      }
                  }); 
            ///////-/-****** EN EACH

                  break;

                    case "tipo":


                  console.log("SECTOR");

                  $('#pagination-container').pagination(
                  {
                      dataSource: opt.lista["lista"],
                      autoHidePrevious: true,
                      autoHideNext: true,
                      pageSize:6,
                      callback: function(lista, pagination)
                      {

                        $(opt.contenedor).children().remove();


                         $(opt.contenedor).children().remove();

                       
                         $(opt.contenedor).prepend('<h1 class="titulo_prin">'+tipo_nombre+'</h1>')


                         $("#accordion").hide();
                         $("#accordion").clone().appendTo(".data-container").attr("id","accordion_new");

                          $("#accordion_new").on('show.bs.collapse', function (data) {
                               efect_acordion(data);
                          }); 




                          populate_acordion(lista, opt); 
                          

                      }
                  }); 
            ///////-/-****** EN EACH

                  break;



                   case "marca":


                  console.log("MARCOA------>>>>>>>>*****>**>***>*>**>");
     ///////-/-****** INIT EACH
                  $('#pagination-container').pagination(
                  {
                      dataSource: opt.lista["lista"],
                      autoHidePrevious: true,
                      autoHideNext: true,
                      pageSize:6,
                      callback: function(lista, pagination)
                      {

                        $(opt.contenedor).children().remove();


                         $("#accordion").hide();
                         $("#accordion").clone().appendTo(".data-container").attr("id","accordion_new");

                          $("#accordion_new").on('show.bs.collapse', function (data) {
                               efect_acordion(data);
                          }); 


                          $('.btn_colapse').unbind( "click" );

                          populate_acordion(lista, opt); 
                          

                      }
                  }); 
            ///////-/-****** EN EACH

                  break;



                   case "ciudad":


                  console.log("CIUDADOA------>>>>>>>>*****>**>***>*>**>");
                  console.log(opt.lista["lista"][0]["ciudad"]["nombre"]);

     ///////-/-****** INIT EACH
                  $('#pagination-container').pagination(
                  {
                      dataSource: opt.lista["lista"],
                      autoHidePrevious: true,
                      autoHideNext: true,
                      pageSize:6,
                      callback: function(lista, pagination)
                      {

                        $(opt.contenedor).children().remove();

                        

                      $(opt.contenedor).prepend('<h1 class="titulo_prin">'+ciudad_nombre+'</h1>')


                         $("#accordion").hide();
                         $("#accordion").clone().appendTo(".data-container").attr("id","accordion_new");

                          $("#accordion_new").on('show.bs.collapse', function (data) {
                               efect_acordion(data);
                          }); 
                          $('.btn_colapse').unbind( "click" );

                          populate_acordion(lista, opt); 
                          

                      }
                  }); 
            ///////-/-****** EN EACH

                  break;



                  case "todos":


                  console.log("TODOAS------>>>>>>>>*****>**>***>*>**>");
                  // console.log(opt.lista["lista"][0]["ciudad"]["nombre"]);

     ///////-/-****** INIT EACH
                  $('#pagination-container').pagination(
                  {
                      dataSource: opt.lista["lista"],
                      autoHidePrevious: true,
                      autoHideNext: true,
                      pageSize:6,
                      callback: function(lista, pagination)
                      {

                        $(opt.contenedor).children().remove();

                      

                      $(opt.contenedor).prepend('<h1 class="titulo_prin">'+todos_nombre+'</h1>')


                         $("#accordion").hide();
                         $("#accordion").clone().appendTo(".data-container").attr("id","accordion_new");

                          $("#accordion_new").on('show.bs.collapse', function (data) {
                               efect_acordion(data);
                          }); 
                          $('.btn_colapse').unbind( "click" );

                          populate_acordion(lista, opt); 
                          

                      }
                  }); 
            ///////-/-****** EN EACH

                  break;





                    //---------------------------------- DEFAULT -----------------
                  default:
                  console.log("default");
                  break;           
          }


         
      
  });
         // }
        // });
            ///////-/-****** EN EACH


          // if ($('#pagination-container').pagination('getTotalPage')==1) {
          //   $('#pagination-container').pagination('hide');
          // };

};





var click_list=function(opt){


  

    var btn='.'+opt.seccion+'_lista_element';
    

    switch(opt.seccion){
      case"inicio":
        console.log("INICIO+6+6+6+6+6+6+6");
        opt.seccion_siguiente="clase";
      break;
      case"clase":
        opt.seccion_siguiente="categoria";
      break;
      case"categoria":
        opt.seccion_siguiente="producto";
      break;
      case"producto":
        opt.seccion_siguiente="";
      break;
    }

    $(document).on("click",btn,function()
    {
      var current=$(this);
      var id= current.attr("id-element");
      var n_childs= current.attr("num-child");
      var id_childs= current.attr("id-child");
      var name_childs= current.attr("name-child");
      var img_childs= current.attr("img-child");
      var no_categoria=false;

      console.log("__________n_childs");
      console.log(id);

      if (n_childs==1) {
        opt.seccion_siguiente="categoria";
        // opt.contenedor=".galery_cont";
        id=id_childs;

        currentURL.hash=opt.seccion_siguiente+"="+id;

     
      };

      
      console.log("opt----------------------++++");
      console.log(opt);

      currentURL.hash=opt.seccion_siguiente+"="+id;
  

    });

};


var click_detail=function(opt){

    var btn='.'+opt.seccion+'_lista_element';
    

    $(document).on("click",btn,function()
    {
  

    });
};




///------ INIT -READY */ /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){

  console.log(currentURL.hash);

    console.log(url_data["tipo"]);

    url_data=getUrlData();

    callSeccion(url_data);


//////******____________


  $(window).on('hashchange',function(){ 

      // $(".navbar-collapse").collapse("hide");
      
      console.log("cambio");
      url_data=getUrlData();
      console.log(url_data);

      callSeccion(url_data);
     
      
      // console.log(seccion);
      console.log("url_data");
      console.log(url_data);

   

  });

 

});///------ END -READY */ /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    