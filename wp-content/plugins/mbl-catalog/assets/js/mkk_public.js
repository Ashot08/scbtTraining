jQuery(function ($) {

    //countdown
    $('.product-countdown').each(function () {
        let el = $(this),
            end_date = el.data('count-to');
        countdown(end_date, el);
    });

    function countdown(end_date, el){
        timer = setInterval(function () {

            let now = new Date();
            let date = new Date(end_date);
            let ms_left = date - now;
            let str_timer = '';

            if (ms_left <= 0) {
                clearInterval(timer);
            }

            let res = new Date(ms_left);
            let timer_map = [
                {
                    selector: '.cd-year',
                    counter: '0' + res.getUTCFullYear() - 1970,
                },
                {
                    selector: '.cd-month',
                    counter: res.getUTCMonth(),
                },
                {
                    selector: '.cd-day',
                    counter: res.getUTCDate() - 1,
                },
                {
                    selector: '.cd-hour',
                    counter: res.getUTCHours(),
                },
                {
                    selector: '.cd-min',
                    counter: res.getUTCMinutes(),
                },
                {
                    selector: '.cd-sec',
                    counter: res.getUTCSeconds(),
                },
            ];

            timer_map.forEach(function (item) {
                let timerEl = el.find(item.selector);

                if (!item.counter && item.selector !== '.cd-sec') {
                    timerEl.closest('.cd-section').remove();
                }

                timerEl.html(String(item.counter).padStart(2, '0'));
            });

        }, 1000)
    }

});
