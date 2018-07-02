
/*!
 * Plugin cambio_idiomas
 * Alternar textos entre ingles / español
 */
(function($) {

	$.fn.idiomsswifter = function(opts) {
	
		// default configuration
		var settings = $.extend({}, {
			info_es: {"menu_btn_1":"PALABRA"},
			info_en: {"menu_btn_1":"HOME"},
			idioma: "ES"
		}, opts);
		

		var contenido = {};

		if (settings.idioma=="ES") {
				contenido=settings.info_es;
			}
			else if(settings.idioma=="EN"){
				contenido=settings.info_en;
			}


		// main function
		function population(el) {
			var data_key=el.attr("data_key");
			el.html(contenido[data_key]);
			
		}

		// initialize every element
		this.each(function() {
			population($(this));
		});

		return this;
	};

	// start
	// $(function() {
	// 	$(".idioms").idiomsswifter();
	// });

})(jQuery);
