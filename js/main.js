//user nav
$('.child').show();
$('.parent').click(function () {
    $(this).find('ul').slideToggle();
});