define([
    "jquery",
    "jquery/ui"
], function($){
    "use strict";

    function main(config, element) {
        var $element = $(element);
        var AjaxCommentPostUrl = config.AjaxCommentPostUrl;

        var dataForm = $('#comment-form');
        dataForm.mage('validation', {});

        $(document).on('click','.submit',function() {

            if (dataForm.valid()){
                event.preventDefault();
                var param = dataForm.serialize();
                alert(param);
                $.ajax({
                    showLoader: true,
                    url: AjaxCommentPostUrl,
                    data: param,
                    type: "POST"
                }).done(function (data) {
                    $('.note').html(data);
                    $('.note').css('color', 'red');
                    document.getElementById("contact-form").reset();
                    return true;
                });
            }
        });
    };
    return main;


});