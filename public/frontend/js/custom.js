$(window).scroll(function(){
    var sticky = $('.navigation'),
    scroll = $(window).scrollTop();

    if (scroll >= 100) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
});


$(document).ready(function(){
    $('.toggle-bar').click(function(){
        $('.menubar ul').toggleClass('active');
    });
});