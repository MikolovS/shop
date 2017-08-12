$(document).ready(function () {
    //менющка
    $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });
});

//pjax
$(document).pjax('a[data-container]', '#pjax-container');
$(document).pjax('a[data-content]', '#pjax-content');
//forms
$(document).on('submit', 'form[data-container]', function(event) {
    $.pjax.submit(event, '#pjax-container')
});
