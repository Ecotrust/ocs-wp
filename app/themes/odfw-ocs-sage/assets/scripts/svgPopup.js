jQuery(document).ready(function($) {
    if (!$('.map-visible').length) {
       $('button.view-map').click(function(){
            setTimeout(function() {
                var svg = document.getElementById('regions');
                if (svg != null) {
                    var svgDoc = svg.contentDocument;

                    //loop through each key-value pair and assign contents to associated item in svg
                    $.each(svg_popup_vars, function(key, value) {
                        var str = key.replace(/\s+/g, '-').toLowerCase();
                        $(svgDoc).find('a#'+str).attr({
                            'data-toggle': 'popover', 
                            'data-trigger': 'hover focus',
                            'data-original-title': key, 
                            'data-content': value
                        });
                    });

                    $(svgDoc).find('[data-toggle="popover"]').popover({
                        'container':'.ecoregion-svg',
                        'html': true,
                    });

                    $(svgDoc).mousemove(function(event) { 
                        var left = event.pageX + 10; 
                        var top = event.pageY - 65;
                        $('.popover').css({top: top,left: left}).show();
                    });
                }
            }, 750);
       });
    }
});