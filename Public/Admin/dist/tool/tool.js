var tool = function () {

    var obj = {
        init: function () {

            window['l'] = console.log.bind(console);
            window['w'] = console.warn.bind(console);
            window['e'] = console.error.bind(console);
            window['i'] = console.info.bind(console);

        }

    }

    obj.init();

    return obj;



}();