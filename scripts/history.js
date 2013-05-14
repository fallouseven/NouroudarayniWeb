(function($){
	var isHistoryAvailable = (window.history && history.pushState && history.state !== undefined) ? true : false;
	var homePage = './includes/home.php';
	ajaxLoad(homePage);
	$('.ajax').live('click', function(event){
		event.preventDefault();
		var lien = $(this);
		if(isHistoryAvailable)
			history.pushState({key:$(lien).attr("href")}, '', basename($(lien).attr("href"), '.php'));
		ajaxLoad($(lien).attr("href"));
		return false;
	});
	function ajaxLoad(lien){
		$.ajax({
			   url:lien,
			   success: function(retour){
				  $("div.contenant").empty().append(retour);
				  console.log($(lien).attr("href"));
			   }
		});
	}
	
		 window.onpopstate = function(event){
		 	if(event.state != null){
		 		 console.log('key = '+event.state['key']);
		 		ajaxLoad(event.state['key']);
		 	}else{
		 		ajaxLoad(homePage);
		 	}
		 }

})(jQuery);