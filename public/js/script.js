jQuery(document).on("click", "#updateCurrenciesButton",
	function() {
		jQuery(".loading").removeClass("hidden");

	   	jQuery.ajax({
   			url		 : "/currency/updateCurrencies",
	  		method	 : "POST",
		})

		.done(function($responce) {
		  if (true == $responce)
		  	jQuery("#responce").text("Данные успешно обновлены");
		  else
		  	jQuery("#responce").text("Ошибка обновления");
		})

		.fail(function( jqXHR, textStatus ) {
				jQuery("#responce").text("Произошла внутренняя ошибка");
				console.log("Request failed: " + textStatus);
		})

		.always(function(){
			jQuery(".loading").addClass("hidden");
		});
	});