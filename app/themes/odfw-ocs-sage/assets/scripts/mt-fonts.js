// This was in the document head but since it doesn't actually do anything, loading the tracking code directly
var MTUserId='7f335984-2508-4528-ae4c-dd0fb2d6c627';
var MTFontIds = new Array();

MTFontIds.push("903184"); // Neue Helvetica® eText W01 45 Light
MTFontIds.push("903187"); // Neue Helvetica® eText W01 46 Light Italic
MTFontIds.push("903196"); // Neue Helvetica® eText W01 65 Medium
MTFontIds.push("903202"); // Neue Helvetica® eText W01 75 Bold
(function() {
var mtTracking = document.createElement('script');
mtTracking.type='text/javascript';
mtTracking.async='true';
mtTracking.src='<?php echo get_stylesheet_directory_uri(); ?>/assets/scripts/mtiFontTrackingCode.js';

(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(mtTracking);
})();

