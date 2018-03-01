$("#NomClient").focusout(function() {
    if(this.value.length<3){
        $('li#li-nom').css("background-color","rgb(245,62,84)");
        return false;
    }
    else{
        $('li#li-nom').css("background-color","green");
        return true;
    }
});

$("#MailClient").focusout(function() {
    var myRegex = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;

    if(!myRegex.test(this.value)){
        $('li#li-mail').css("background-color","rgb(245,62,84)");
        return false;
    }
    else{
        $('li#li-mail').css("background-color","green");
        return true;
    }
});

$("#MessageClient").focusout(function() {
    if(this.value.length<10){
        $('li#MessageClient-li').css("background-color","rgb(245,62,84)");
        return false;
    }
    else{
        $('li#MessageClient-li').css("background-color","green");
        return true;
    }
});





/********************************/
$(".dropdown dt a").on('click', function() {
    $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
    $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
    return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="radio"]').on('click', function() {

    var title = $(this).closest('.mutliSelect').find('input[type="radio"]').val(),
        title = $(this).val() + ",";

    if ($(this).is(':checked')) {
        var html = '<span title="' + title + '">' + title + '</span>';
        $('.multiSel').append(html);
        $(".hida").hide();
    } else {
        $('span[title="' + title + '"]').remove();
        var ret = $(".hida");
        $('.dropdown dt a').append(ret);

    }
});

/***********************************/
$(document).ready(function(){
    $("#hide").click(function(){
        $("Btn-Submit").hide();
    });
    $("#show").click(function(){
        $("MessageClient-li").show();
    });
});