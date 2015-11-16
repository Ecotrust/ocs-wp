jQuery(document).ready(function($) {
    if (!$('.map-visible').length) {
       $('button.view-map').click(function(){
            setTimeout(function() { 
                var svg = document.getElementById("regions");
                var svgDoc = svg.contentDocument;
                $(svgDoc).find('a').attr({'data-toggle': 'popover', 'data-trigger': 'hover', "data-original-title": "blah"});
                $(svgDoc).find('[data-toggle="popover"]').popover({'container':'compass'});
            }, 500) 
            console.log( svg_popup_vars );
       });
    }
});