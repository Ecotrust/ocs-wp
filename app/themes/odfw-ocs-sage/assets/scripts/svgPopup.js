jQuery(document).ready(function($) {
    if (!$('.map-visible').length) {
       $('a.view-map').click(function(){
            var svg = 'g#Layers';
            if ($(svg).length) {

                //loop through each key-value pair and assign contents to associated item in svg
                $.each(svg_popup_vars, function(key, value) {
                    var str = key.replace(/\s+/g, '-').toLowerCase();
                    $(svg).find('a#'+str).attr({
                        'data-toggle': 'popover', 
                        'data-trigger': 'hover focus',
                        'data-original-title': key, 
                        'data-content': value
                    });
                });

                $(svg).find('[data-toggle="popover"]').popover({
                    'container':'.ecoregion-svg',
                    'html': true,
                });
            }
        });
    }
});