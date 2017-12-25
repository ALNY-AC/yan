// @ts-nocheck


navEvent();
function navEvent() {
    $(document).on('click', '.o-nav-item>a', function (e) {
        var $this = $(this);
        var $next = $this.next();


        if ($next[0]) {
            showItme($this.parent());
            return false;
        }


    })
}


function showItme($this) {

    $this.siblings('.o-nav-item').removeClass('active');
    $this.toggleClass('active');
}

var srcEvent = (function () {
    var obj = {
        config: {
            url: ''
        },
        init: function () {

            //初始页面
            if (localStorage.admin_url != null && localStorage.admin_url != '') {
                $('#iframe').attr('src', localStorage.admin_url);
            } else {
                $('#iframe').attr('src', srcEvent.config.url + '/Index/home');
            }
            // o-nav-item
            //找到active
            $('.o-nav-list .o-nav-item').each(function (index) {
                $(this).attr('id', 'list_' + index);
            });

            $('.o-nav-list .o-nav-item li a').each(function (index) {
                $(this).attr('id', 'a_' + index);
            });

            $(localStorage.list_id).addClass('active');
            $(localStorage.a_id).addClass('active');


            $('.o-nav-list .o-nav-item').on('click', function () {
                localStorage.list_id = '#' + $(this).attr('id');
            });


            //添加事件
            $(document).on('click', 'a', function () {


                $('.o-nav-list .o-nav-item li a').removeClass('active');
                $(this).addClass('active');

                if ($(this).attr('data-src') != null && $(this).attr('data-src') != '') {

                    // localStorage.list_id = '#' + $(this).parent('.o-nav-item').attr('id');
                    // showItme($(this).parent());
                    localStorage.a_id = '#' + $(this).attr('id');


                    localStorage.admin_url = srcEvent.config.url + '/' + $(this).attr('data-src');
                    $('#iframe').attr('src', localStorage.admin_url);
                    return false;
                }
            })
        }
    }
    return obj;
}());
