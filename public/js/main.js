

// $(document).ready(function() {
//     $('body').css('padding-bottom', $('footer').height() + 32);
// });

// $(window).resize(function(){
//     $('body').css('padding-bottom', $('footer').height() + 32);
// });

// $(document).on("click","",function() {
 
// }); 

$(function() {
    $("#product-dropdown").click(function() {
        $("#submenu").slideToggle(500);
    });
}); 









////counter///
$(document).ready(function() {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});

////uploader////
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

////slidup///
let slide = $(".more");
$(".sec-info").slideUp();
        slide.click(function(){
        let mainParent = $(this).parents(".sec-hLine").siblings();

        if($(this).hasClass("collapse") ) {
        (".sec-info", mainParent).slideUp();
        $(this).removeClass("collapse");
        $(this).find("img").css({"transform":"rotate(-90deg)"});
        $(this).find("p").text("More");

        } else {
        (".sec-info", mainParent).slideDown();
        $(this).addClass("collapse");
        $(this).find("img").css({"transform":"rotate(90deg)"});
        $(this).find("p").text("Less");
        }
});