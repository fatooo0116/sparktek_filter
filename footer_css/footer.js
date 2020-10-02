(function($){
    $(document).ready(function(){
        $("#home_meta .sec h3").on("click",function(){
            let w = $(window).width();
            $(this).parent().siblings().each(function(){
                if($(this).find('h3').hasClass('open')){
                    $(this).find('h3').removeClass('open');
                    $(this).find('ul').slideToggle(300);
                }
            })



            if(w<768){
                if(!$(this).hasClass('open')){
                    $(this).addClass('open');
                    $(this).next('ul').slideToggle(300);
                }else{
                    $(this).removeClass('open');
                    $(this).next('ul').slideToggle(300);
                }
            }
           
        })
    });
})(jQuery);