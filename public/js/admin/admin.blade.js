
$(document).ready(function () {
    //sidebar collapse
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    $('#sidebarToggle').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#sidebarToggle').find('span').toggleClass('glyphicon-menu-right glyphicon-menu-left');
    });

    //category create form
});