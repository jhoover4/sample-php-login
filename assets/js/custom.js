// Babel processed script

$(document).ready(function () {
    "use strict";

    $('.btn-sort').click(function () {
        var url = window.location.href;
        var sortParam = $(this).children("input").eq(0).attr("sort_by");
        var newUrl;

        if (url.indexOf("sort_by") === -1) {
            newUrl = url += "?sort_by=" + sortParam;
        } else {
            newUrl = url.replace(/(?<=sort_by=).*/i, sortParam);
        }

        window.location.href = newUrl;
    });

    var $alertSuccess = $(".alert-success");
    if ($alertSuccess.length){
        $alertSuccess.fadeOut(4200);
    }
});
