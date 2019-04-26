 
$(window).scroll(function () {
    var scroll = $(window).scrollTop();

    //>=, not <=
    if (scroll >= 550) {
        //clearHeader, not clearheader - caps H
        $(".navbar-fixed-top").addClass("navbar-fix-custom" );
    }
    else if (scroll<=550){
        $(".navbar-fixed-top").removeClass("navbar-fix-custom" );
    }
}); //missing );{
// animate scrol
$(document).ready(function(){
    $('a.nav-link').bind('click',function(event){
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        },1500,'easeInOutExpo');
        event.preventDefault();
    });
});
