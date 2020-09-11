jQuery.fn.load = function(callback){ $(window).on("load", callback) };

var csrfParam = 0;
var csrfToken = 0;
var this_host = '';
var output = new Object();
var protocol_ht = window.location.protocol + "//";
var onDelete;
$(function(){
    this_host = window.location.protocol + "//" + window.location.hostname;
    csrfParam = $('meta[name="csrf-param"]').attr("content");
    csrfToken = $('meta[name="csrf-token"]').attr("content");


    $(window).resize(function() {
        position_modal_message();
    });
});

function nl2br(str) {
    return str.replace(/([^>])\n/g, '$1<br/>');
}

function position_modal_message(){
    $("#message_form .modal-content").css('width','700px');

    //var ww = $(window).width();
    var wh = $(window).height();
    //var mw = $("#modal_login .modal-content").outerWidth();
    var mh = $("#message_form .modal-content").outerHeight();
    var th = 0;
    //var lw = 0;
    if (wh > mh) {
        th = (wh/2) - (mh/2);
        //lw = (ww/2) - (mw/2);
        $("#message_form .modal-content").css('top',th+'px');
        //$("#modal_login .modal-content").css('left',lw+'px');
    }
}

function message(text,timer,header) {
    $(".message_form_text").text('');
    $(".message_text").html(text);
    $("#message_form").modal().show();
    $(".message_form_text").html(header);
    position_modal_message();
    if (timer >= 0 || !timer ) {
        if (!timer) timer = 1000;
        setTimeout(function(){
            $('#message_form').modal('hide');
        },timer);
    }
}