//left side accordion
$(function() {
    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
        classExpand: 'dcjq-current-parent'
    });



});





var Script = function () {

    //  menu auto scrolling

    jQuery('.sidebar-menu .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 80 - o.top;
        if(diff>0)
            $(".sidebar-menu").scrollTo("-="+Math.abs(diff),500);
        else
            $(".sidebar-menu").scrollTo("+="+Math.abs(diff),500);
    });

    // toggle bar
//
//    $(function() {
//        var wd;
//        wd = $(window).width();
//        function responsiveView() {
//            var newd = $(window).width();
//            if(newd==wd){
//                return true;
//            }else{
//                wd = newd;
//            }
//            var wSize = $(window).width();
//            if (wSize < 768) {
//                $('#sidebar').addClass('hide-left-bar');
//
//            }
//            else{
//                $('#sidebar').removeClass('hide-left-bar');
//
//            }
//
//        }
//
//
//
//        $(window).on('resize', responsiveView);
//
//
//    });

    $('.sidebar-toggle-box .fa-bars').click(function (e) {
        $('.sidebar-menu').slimscroll({
            height: '100%',
            wheelStep: 1,
            railVisible: true,
//      alwaysVisible: true,
            color: '#1FB5AD',
            size: '3px',
            railColor: '#333',
            railOpacity: 0.5,
            opacity : .8,
            borderRadius: '0px',
            railBorderRadius: '0px',
            allowPageScroll: false
        });
        $('#sidebar').toggleClass('hide-left-bar');
        $('#main-content').toggleClass('merge-left');
        e.stopPropagation();
        if( $('#container').hasClass('open-right-panel')){
            $('#container').removeClass('open-right-panel')
        }
        if( $('.right-sidebar').hasClass('open-right-bar')){
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if( $('.header').hasClass('merge-header')){
            $('.header').removeClass('merge-header')
        }


    });
    $('.toggle-right-box .fa-bars').click(function (e) {
        $('#container').toggleClass('open-right-panel');
        $('.right-sidebar').toggleClass('open-right-bar');
        $('.header').toggleClass('merge-header');

        e.stopPropagation();
    });

    $('.header,#main-content,#sidebar').click(function () {
       if( $('#container').hasClass('open-right-panel')){
           $('#container').removeClass('open-right-panel')
       }
        if( $('.right-sidebar').hasClass('open-right-bar')){
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if( $('.header').hasClass('merge-header')){
            $('.header').removeClass('merge-header')
        }


    });



    /*Slim Scroll*/
    $(function () {
        $('.event-list').slimscroll({
            height: '305px',
            wheelStep: 20
        });
        $('.conversation-list').slimscroll({
            height: '360px',
            wheelStep: 35
        });
        $('.to-do-list').slimscroll({
            height: '300px',
            wheelStep: 35
        });
        $('.sidebar-menu').slimscroll({
            height: '100%',
            wheelStep: 1,
            railVisible: true,
//      alwaysVisible: true,
            color: '#1FB5AD',
            size: '3px',
            railColor: '#333',
            railOpacity: 0.5,
            opacity : .8,
            borderRadius: '0px',
            railBorderRadius: '0px',
            allowPageScroll: false
        });

        $('.right-side-accordion').slimscroll({
            height: '94%',
            wheelStep: 1,
            railVisible: true,
//      alwaysVisible: true,
            color: '#1FB5AD',
            size: '3px',
            railColor: '#333',
            railOpacity: 0.5,
            opacity : .8,
            borderRadius: '0px',
            railBorderRadius: '0px',
        });



    });



    // custom scroll bar
//    $("#sidebar").niceScroll({styler:"fb",cursorcolor:"#1FB5AD", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});
//    $(".right-sidebar").niceScroll({styler:"fb",cursorcolor:"#1FB5AD", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});


   // widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });

   // tool tips

    $('.tooltips').tooltip();

    // popovers

    $('.popovers').popover();




    /*==Collapsible==*/
    $(function() {
        $('.widget-head').click(function(e)
        {
            var widgetElem = $(this).children('.widget-collapse').children('i');

            $(this)
                .next('.widget-container')
                .slideToggle('slow');
            if ($(widgetElem).hasClass('ico-minus')) {
                $(widgetElem).removeClass('ico-minus');
                $(widgetElem).addClass('ico-plus');
            }
            else
            {
                $(widgetElem).removeClass('ico-plus');
                $(widgetElem).addClass('ico-minus');
            }
            e.preventDefault();
        });

    });

}();

