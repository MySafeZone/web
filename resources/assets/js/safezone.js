/*
* @Author: Florian Chédemail
* @Date:   2016-03-06 01:07:41
* @Last Modified by:   Florian Chédemail
* @Last Modified time: 2016-03-06 01:17:27
*/

jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
    $(".clickable-row").hover(function() {
        $(this).css('cursor','pointer');
    });
});