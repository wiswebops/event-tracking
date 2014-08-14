$(document).ready(function () {



    $("a.openform").click(function () {
        $.fancybox(
                $('.form').html(),
                {
                    'width'             : 1200,
                    'height'            : 1100,
                    'autoScale'         : false,
                    'transitionIn'      : 'none',
                    'transitionOut'     : 'none',
                    'hideOnContentClick': false,
                    'onStart': function () {
                      //On Start callback if needed  
                    }
                 }
            );
    });
}); // end ready