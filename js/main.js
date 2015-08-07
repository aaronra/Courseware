//user nav
$('.child').show();
$('.parent').click(function () {
    $(this).find('ul').slideToggle();
});


$(".bookmark").click(function () {
    $('.bookmark').toggleClass('bookmark-active');
});
