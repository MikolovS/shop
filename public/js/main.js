$(document).ready(function () {
    //менющка
    $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });
    //tooltips
    // $( '[title]' ).tooltip({
    //     position: {
    //         // my: 'right top',
    //         // at: 'right20 top+40',
    //         collision: 'none'
    //     }
    // });
});
//pjax
$(document).pjax('a[data-container]', '#pjax-container');
$(document).pjax('a[data-content]', '#pjax-content');
//forms
// $(document).on('submit', 'form[data-container]', function(event) {
//     $.pjax.submit(event, '#pjax-container')
// });
