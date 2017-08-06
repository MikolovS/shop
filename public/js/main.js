$(document).ready(function () {
    $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });
});

//pjax
$(document).pjax('a[data-container]', '#pjax-container');
//forms
// $(document).on('submit', 'form[data-container]', function(event) {
//     $.pjax.submit(event, '#pjax-container')
// })