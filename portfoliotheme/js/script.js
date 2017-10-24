jQuery(document).ready(function($){

        $(window).bind('scroll', function(){
            if(!$('#main-menu').hasClass('fixed-to-top') && $(window).scrollTop() >= $(window).width() * 0.2 ){
                $('#main-menu').addClass( 'fixed-to-top' );
                $('.blog-masthead').addClass( 'add-margin-bottom' );

            }

            else if($('#main-menu').hasClass('fixed-to-top') && $(window).scrollTop() <  $(window).width() * 0.2){
                $('#main-menu').removeClass( 'fixed-to-top' );
                $('.blog-masthead').removeClass( 'add-margin-bottom' );
            }
        });

        //$(window).width() * 0.01

});



