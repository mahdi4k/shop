 
 
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

