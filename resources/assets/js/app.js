$(document).ready(function () {
    $('[data-toggle="tab"]').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#tab-2').on('shown.bs.tab', function() {
        $('#myImage')[0].scrollIntoView()
    });


});
