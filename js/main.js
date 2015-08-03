//user nav
$('.child').hide();
$('.parent').click(function() {
    $(this).find('ul').slideToggle();
});