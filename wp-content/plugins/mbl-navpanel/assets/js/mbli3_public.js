$('[data-mbli3-menu-toggle]').on('click', function () {
    $('#mbli3-left-menu').toggleClass('menu-opened');
    $('#mbli3-telegram-news').removeClass('menu-opened');
    return false;
});

$('[data-mbli3-telegram-news-toggle]').on('click', function () {
    $('#mbli3-telegram-news').toggleClass('menu-opened');
    $('#mbli3-left-menu').removeClass('menu-opened');
    return false;
});

$('[data-mbli3-telegram-chat-toggle]').on('click', function () {
    $('#mbli3-telegram-chat').toggleClass('menu-opened');
    return false;
});