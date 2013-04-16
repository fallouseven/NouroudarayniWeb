$(document).ready(function(){
			  	$.ajax({
						   url:$(".home").attr("href"),
						   success: function(retour){
						  $("div.contenant").empty().append(retour);
						   }
					   });

    // Used to detect initial (useless) popstate.
    // If history.state exists, pushState() has created the current entry so we can
    // assume browser isn't going to fire initial popstate
    var popped = ('state' in window.history && window.history.state !== null), initialURL = location.href;

    var content = $('div.contenant');

    var ajaxLoadPage = function (url) {

        console.log('Loading ' + url.replace(/^.*\/|\.[^.]*$/g, '') + ' fragment');
        content.load(url + '?fragment=true');

    }

    // Handle click event of all links with href not starting with http, https or #
    $("a.ajax").click(function(e) {

        e.preventDefault();
        var href = $(this).attr('href');
        ajaxLoadPage(href);
        history.pushState({page:href}, null, href.replace(/^.*\/|\.[^.]*$/g, ''));

    });

    $(window).bind('popstate', function(event){

        // Ignore inital popstate that some browsers fire on page load
        var initialPop = !popped && location.href == initialURL;
        popped = true;
        if (initialPop) return;

        console.log('Popstate');

        // By the time popstate has fired, location.pathname has been changed
        ajaxLoadPage('./includes/'+location.pathname);

    });

});