jQuery(document).ready(function($) {
    if (!$('.map-visible').length) {
       $('button.view-map').click(function(){
            setTimeout(function() { 
                var svg = document.getElementById("regions");
                var svgDoc = svg.contentDocument;

                $.each(svg_popup_vars, function(key, value) {
                    var str = key.replace(/\s+/g, '-').toLowerCase();
                    $(svgDoc).find('a#'+str).attr({'data-toggle': 'popover', 'data-trigger': 'hover', "data-original-title": value});
                });
                $(svgDoc).find('[data-toggle="popover"]').popover({'container':'body'});
            }, 500) 
       });
    }
});