"use strict";
$(document).ready(function(){
   
    $('.dataTable').DataTable();
    $('#menu-btn').on('click', function() {
        $('#ticket-setting').toggleClass("menu-active");
    });
    $('.content .nav-tabs li:first').addClass('active');
    $('.tab-content>.tab-pane:first').addClass('active');
    $('.tab-content .tab-text a:first').removeClass('collapsed');
    $('.tab-content .panel-collapse:first').addClass('in');

    $('.content .nav-tabs li a').on('click', function () {
        $('.content .nav-tabs li').removeClass('active');
    });

    $(".nav-tabs").slick({
        dots: false,
        arrows: true,
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1058,
                settings: {
                    arrows: true,
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 2
                }
            }
        ]

    });

});
(function($) {
    var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
        isIE = /msie/i.test( navigator.userAgent );
    $.fn.customFile = function() {
        return this.each(function() {

            var $file = $(this).addClass('custom-file-upload-hidden'),
                $wrap = $('<div class="file-upload-wrapper">'),
                $input = $('<input type="text" class="file-upload-input" />'),
                $button = $('<button type="button" class="file-upload-button">Select a File</button>'),
                $label = $('<label class="file-upload-button" for="'+ $file[0].id +'">Select a File</label>');
            $file.css({
                position: 'absolute',
                left: '-9999px'
            });

            $wrap.insertAfter( $file )
                .append( $file, $input, ( isIE ? $label : $button ) );

            $file.attr('tabIndex', -1);
            $button.attr('tabIndex', -1);
            $button.click(function () {
                $file.focus().click();
            });

            $file.change(function() {
                var files = [], fileArr, filename;
                if ( multipleSupport ) {
                    fileArr = $file[0].files;
                    for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                        files.push( fileArr[i].name );
                    }
                    filename = files.join(', ');
                } else {
                    filename = $file.val().split('\\').pop();
                }

                $input.val( filename )
                    .attr('title', filename)
                    .focus();

            });

            $input.on({
                blur: function() { $file.trigger('blur'); },
                keydown: function( e ) {
                    if ( e.which === 13 ) {
                        if ( !isIE ) { $file.trigger('click'); }
                    } else if ( e.which === 8 || e.which === 46 ) {
                        $file.replaceWith( $file = $file.clone( true ) );
                        $file.trigger('change');
                        $input.val('');
                    } else if ( e.which === 9 ){
                        return;
                    } else {
                        return false;
                    }
                }
            });

        });

    };

}(jQuery));

$('.custom-file-upload input').customFile();

