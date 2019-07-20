var timer = {};

$('#menu_top').find('li').hover(function () {
    var tag = $(this);
    var timerAttr = tag.attr('data-time');
    clearTimeout(timer[timerAttr]);

    timer[timerAttr] = setTimeout(function () {
        $('>ul', tag).css('display', 'flex');
        tag.addClass('active-menu');
        $('>.submenue3', tag).css('display', 'flex');
    }, 250);


}, function () {
    var tag = $(this);
    var timerAttr = tag.attr('data-time');
    clearTimeout(timer[timerAttr]);
    timer[timerAttr] = setTimeout(function () {
        $('>ul', tag).fadeOut();
        tag.removeClass('active-menu');
        $('>.submenue3', tag).fadeOut();
    }, 250);

});
 
$("#product_cat li").hover(function ()
{
      
    if(this.id=='')
    {
        
        $('div',this).show();
         
    } 
    else
    {
        var id=this.id.replace('li','span');
         
        $('ul', this).css('display', 'flex');
    }


},function () {
    if(this.id=='')
    {
        $('div',this).hide();
    }
    else
    {
        var id=this.id.replace('li','span');
         
        $('ul', this).hide();
    }

});
var img_count=0;
var img=0;
load_slider=function(count)
{
    img_count=count;
    setInterval(next,5000);
};
next=function ()
{
    for(var i=0;i<img_count;i++)
    {
        var slide_img=document.getElementById('slide_img_'+i).style.display='none';
        var slider_li=document.getElementById('slider_li_'+i).className='slide_li';
        var slider_span=document.getElementById('slider_span_'+i).className='ab1';
    }
    if(img==(img_count-1))
    {
        img=-1;
    }
    img=img+1;
    document.getElementById('slide_img_'+img).style.display='block';
    document.getElementById('slider_li_'+img).className='slider_li_active';
    document.getElementById('slider_span_'+img).className='ab';


};
previous=function ()
{
    img=img-1;
    if(img==-1)
    {
        img=(img_count-1);
    }
    for(var i=0;i<img_count;i++)
    {
        var slide_img=document.getElementById('slide_img_'+i).style.display='none';
        var slider_li=document.getElementById('slider_li_'+i).className='slide_li';
        var slider_span=document.getElementById('slider_span_'+i).className='ab1';
    }

    document.getElementById('slide_img_'+img).style.display='block';
    document.getElementById('slider_li_'+img).className='slider_li_active';
    document.getElementById('slider_span_'+img).className='ab';

};


$('.slider_li li').click(function () {


    var id=this.id;
    img=parseInt(id.replace('slider_li_',''));
    for(var i=0;i<img_count;i++)
    {
        var slide_img=document.getElementById('slide_img_'+i).style.display='none';
        var slider_li=document.getElementById('slider_li_'+i).className='slide_li';
        var slider_span=document.getElementById('slider_span_'+i).className='ab1';
    }

    document.getElementById('slide_img_'+img).style.display='block';
    document.getElementById('slider_li_'+img).className='slider_li_active';
    document.getElementById('slider_span_'+img).className='ab';
});
show_amazing=function (key,count)
{
    for (var i=0;i<count;i++)
    {
        document.getElementById('amazing_div_'+i).style.display='none';
        document.getElementById('amazing_footer_'+i).style.background='#fff';
        document.getElementById('amazing_footer_'+i).style.color='#000';
    }
    document.getElementById('amazing_div_'+key).style.display='block';
    document.getElementById('amazing_footer_'+key).style.background='#FF5252';
    document.getElementById('amazing_footer_'+key).style.color='#ffffff';
};
show_review=function (key) {
    var c=document.getElementById('review_div_'+key).style.display;
    if(c=='none')
    {
        document.getElementById('review_title_'+key).className='review_title';
        $("#review_div_"+key).slideDown();
    }
    else
    {
        document.getElementById('review_title_'+key).className='review_title2';
        $("#review_div_"+key).slideUp();
    }
};
show_service=function ()
{
    var c=document.getElementById('service_box').style.display;
    if(c=='block')
    {
        document.getElementById('service_ic').className='service_ic';
        $("#service_box").slideUp();
    }
    else
    {
        document.getElementById('service_ic').className='service_ic2';
        $("#service_box").slideDown();
    }
};
function del_row(id,url,token)
{

    var route=url+"/";
    if (!confirm("آیا از حذف این آدرس اطمینان دارید !"))
        return false;

    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action",route+id);
    var hiddenField1 = document.createElement("input");
    hiddenField1.setAttribute("name", "_method");
    hiddenField1.setAttribute("value",'DELETE');
    form.appendChild(hiddenField1);
    var hiddenField2 = document.createElement("input");
    hiddenField2.setAttribute("name", "_token");
    hiddenField2.setAttribute("value",token);
    form.appendChild(hiddenField2);
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
set_pay=function (id)
{

    $("#tab_payment_1").removeClass('pay_type_table');
    $("#tab_payment_5").removeClass('pay_type_table');
    $("#tab_payment_6").removeClass('pay_type_table');
    $("#tab_payment_7").removeClass('pay_type_table');

    for (var i = 1; i < 8; i++)
    {
        var a=document.getElementById('pay_radio_' + i);
        if(a)
        {
            a.className = 'radio-control'
        }
    }
    if (id == 1)
    {
        document.getElementById('pay_radio_1').className = 'radio-control2 ';
        document.getElementById('pay_radio_3').className = 'radio-control2 custom-style-payment';
        document.getElementById('post_radio_3').setAttribute('checked','checked');
        $("#tab_payment_1").addClass('pay_type_table');
    }
    else if ((id == 2) || (id==3) || (id==4))
    {

        document.getElementById('pay_radio_1').className = 'radio-control2 ';
        document.getElementById('pay_radio_'+id).className = 'radio-control2 custom-style-payment';
        document.getElementById('post_radio_'+id).setAttribute('checked','checked');
        $("#tab_payment_1").addClass('pay_type_table');
    }
    else
    {
        document.getElementById('pay_radio_'+id).className = 'radio-control2 ';
        document.getElementById('post_radio_'+id).setAttribute('checked','checked');
        $("#tab_payment_"+id).addClass('pay_type_table');
    }

};
$('#addcheck').click(function () {
    document.getElementById('order_type').value = 1;
    $('#addcheck1').removeClass('checked_custom_shipping');
    $('.add-border2').removeClass('border-active');
    $('#addcheck').toggleClass('checked_custom_shipping');
    $('.add-border1').addClass('border-active');
});
$('#addcheck1').click(function () {
    document.getElementById('order_type').value = 2;
    $('#addcheck').removeClass('checked_custom_shipping');
    $('.add-border1').removeClass('border-active');
    $('#addcheck1').toggleClass('checked_custom_shipping') ;
    $('.add-border2').addClass('border-active');
});

const $menu = $('.dropdown');

$(document).mouseup(function (e) {
   if (!$menu.is(e.target) // if the target of the click isn't the container...
   && $menu.has(e.target).length === 0) // ... nor a descendant of the container
   {
     $menu.removeClass('is-active');
  }
 });

$('.toggle').on('click', () => {
  $menu.toggleClass('is-active' , 1000);
});

 

$(document).ready(function(){

$('.fa-search').click(function() {
    
    $('.toggle-search').slideToggle('slow');
  });
    
});

$(document).ready(function(){
    $("#show_team").click(function(){
      $("#show_ourteam").slideToggle();
    });
  });


  $(document).ready(function(){
    $("#show-mini-cart").click(function(){
      $(".cart").fadeToggle();
    });
  });





   
    $('.amazing').slick({
        rtl: true,
        speed: 900,
        slidesToShow: 3,
        slidesToScroll: 2,
        variableWidth: true,
        infinite: false
    });

 
                var sliderTag = $('#slider');
                var sliderItems = sliderTag.find('.item');
            
                var numItems = sliderItems.length;
                var nextSlide = 1;
                var timeout = 50000;
                var slidernavigator = sliderTag.find("#slider_navigator ul li");
            
                function slider() {
                    if (nextSlide > numItems) {
                        nextSlide = 1;
                    }
                    if (nextSlide < 1) {
                        nextSlide = numItems;
                    }
                    sliderItems.fadeOut(0);
                    sliderItems.eq(nextSlide - 1).fadeIn(100);
                    slidernavigator.removeClass('active');
                    slidernavigator.eq(nextSlide - 1).addClass('active');
                    nextSlide++;
            
            
                }
                slider();
                var sliderinterval = setInterval(slider, timeout);
                sliderTag.mouseleave(function () {
                    clearInterval((sliderinterval));
                    sliderinterval = setInterval(slider, timeout);
                });
            
            
                function gotonext() {
                    slider();
                }
            
                $(' #slider').find('#next').click(function () {
                    clearInterval(sliderinterval);
                    gotonext();
            
            
                });
            
                function gotoprev() {
                    nextSlide = nextSlide - 2;
                    slider();
                }
            
                $(' #slider  ').find('#prev').click(function () {
                    clearInterval(sliderinterval);
                    gotoprev()
            
                });
            
                function gotoslide(index) {
                    nextSlide = index;
                    slider();
            
                }
            
                $('#slider').find('#slider_navigator li ').click(function () {
                    clearInterval(sliderinterval);
            
                    var index = $(this).index();
                    gotoslide(index + 1);
            
            
                });


    var sliderTag2 = $('#slider2');
    var sliderItems2 = sliderTag2.find('.item');

    var numItems2 = sliderItems2.length;
    var nextSlide2 = 1;
    var timeout2 = 5000;
    var slidernavigator2 = sliderTag2.find("#slider2_navigator ul li");

    function slider2() {
        if (nextSlide2 > numItems2) {
            nextSlide2 = 1;
        }
        if (nextSlide2 < 1) {
            nextSlide2 = numItems2;
        }
        sliderItems2.fadeOut(0);
        sliderItems2.eq(nextSlide2 - 1).fadeIn(100);
        slidernavigator2.removeClass('active');
        slidernavigator2.eq(nextSlide2 - 1).addClass('active');
        nextSlide2++;


    }
    slider2();
    var sliderinterval2 = setInterval(slider2, timeout);
    sliderTag.mouseleave(function () {
        clearInterval((sliderinterval2));
        sliderinterval2 = setInterval(slider2, timeout2);
    });


    function gotonext2() {
        slider2();
    }


    function gotoslide2(index) {
        nextSlide2 = index;
        slider2();

    }

    $('#slider2').find('#slider2_navigator li ').click(function () {
            clearInterval(sliderinterval2);

            var index = $(this).index();
            gotoslide2(index + 1);


        }
    );

    //    end slider2

    //    timer

    
 
    $('.new_product').slick({
        infinite: true,
        dots: true,
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 4,
        rtl: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    for (var j = 0; j < amazing_time.length; j++) {
        var clock;

        clock = $('#amazing_clock_' + j).FlipClock({
            clockFace: 'HourlyCounter',
            autoStart: false,
            id: 'c_' + j,
            callbacks: {
                stop: function () {
                    var a = this.id.replace('c_', '');
                    $('#amazing_clock_' + a).hide();
                    $('#amazing_img_' + a).show();
                }
            }
        });

        clock.setTime(amazing_time[j]);
        clock.setCountdown(true);
        clock.start();
    }

 
    function checkValue(element) {
        // check if the input has any value (if we've typed into it)
        if ($(element).val())
            $(element).addClass('has-value');
        else
            $(element).removeClass('has-value');
    }

    $(document).ready(function () {
        // Run on page load
        $('.form-control').each(function () {
            checkValue(this);
        });
        // Run on input exit
        $('.form-control').blur(function () {
            checkValue(this);
        });

    });

 
    
 