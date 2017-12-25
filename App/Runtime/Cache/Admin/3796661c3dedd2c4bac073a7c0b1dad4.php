<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>公告列表</title>
    <!-- css -->
<link href="/yan/Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="/yan/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/yan/Public/vendor/animate/animate.css" rel="stylesheet" type="text/css">
<link href="/yan/Public/vendor/spinkit/spinkit.css" rel="stylesheet" type="text/css">
<link href="/yan/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">


<!-- js -->
<script src="/yan/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="/yan/Public/vendor/jqueryUI/jqueryUI.js" type="text/javascript" charset="utf-8"></script>
<script src="/yan/Public/vendor/vue/vue.js"></script>
<script src="/yan/Public/vendor/layer/layer.js"></script>
<script src="/yan/Public/vendor/layui/layui.js"></script>

<script src="/yan/Public/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--  -->
<script src='/yan/Public/vendor/mTips/mTips.js'></script>
<script src="/yan/Public/Admin/dist/tool/tool.js"></script>

<style>
    /* .save-tool {
        position: fixed;
        right: 10px;
        bottom: 80px;
    }

    .save-tool .layui-btn {
        background-color: rgba(0, 0, 0, 0.8);
        height: 50px;
        line-height: 50px;
        text-align: center;
        color: #eee;
    } */

    .layui-black {
        /* border-radius: 1px; */
        color: #fff;
        text-align: center;
        background-color: #41464b;
        background-color: #666;
        transition: all 0.2s;
    }


    .layui-black:hover {
        background-color: #41464b;
        background-color: #666;
        opacity: 1;
        box-shadow: 0 2px 6px 0 rgba(0, 0, 0, .5);
    }


    .layui-btn-danger {
        background-color: rgb(253, 51, 51);
    }

    .layui-btn-danger:hover {
        background-color: rgb(253, 51, 51);
        box-shadow: 0 2px 6px 0 rgba(253, 51, 51, .5);
    }

    .form-black .layui-laypage .layui-laypage-curr .layui-laypage-em {
        background-color: #41464b;
        background-color: #666;
        box-shadow: 0 2px 6px 0 rgba(0, 0, 0, .5);
    }

    .form-black .layui-laypage a:hover {
        color: #777;
        text-shadow: 0 0 2px rgba(0, 0, 0, .2);
    }

    .layui-link {
        background-color: transparent;
        color: #333333;
    }

    .tooltip {
        z-index: 99999;
    }

    .layui-form-checked[lay-skin=primary] i {
        border-color: #41464b;
        border-color: #666;
        background-color: #41464b;
        background-color: #666;
        color: #fff;
    }

    .layui-form-checkbox[lay-skin=primary]:hover i {
        border-color: #41464b;
        border-color: #666;
        color: #fff;
    }

    .layui-ss {
        text-align: right;
    }

    .layui-input-sm {
        height: 30px;
        line-height: 30px;
        padding: 0 10px;
        font-size: 12px;
    }

    .layui-form-select dl dd.layui-this {
        background-color: #666;
        color: #fff;
    }

    /* a:focus,
    a:active,
    a:visited {} */
</style>

<script>

    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/, ' ');
    }

    function saveInfo(save, f) {
        var url = '/yan/index.php/Admin/Use/saveField';
        var obj = save;
        var fun = function (res) {

            try {
                res = JSON.parse(res);
            } catch (error) {
                //转换错误
                layer.msg('异步接口出错！', {
                    anim: 6
                });
                return
            }


            if (f != null) {
                f(res);
                return;
            }
            if (res.res > 0) {
                layer.msg('修改成功！');
            } else {
                layer.msg('修改失败：' + res.msg, {
                    anim: 6
                });
            }


        };
        $.post(url, obj, fun);

    }
    function del(delObj, f) {
        var url = '/yan/index.php/Admin/Use/del';
        var obj = delObj;
        var fun = function (res) {

            try {
                res = JSON.parse(res);
            } catch (error) {
                //转换错误
                layer.msg('异步接口出错！', {
                    anim: 6
                });
                return
            }
            if (res.res > 0) {
                layer.msg('删除成功！');
                if (f != null) {
                    f(res);
                }

            } else {
                layer.msg('删除失败：' + res.msg, {
                    anim: 6
                });
            }
        };
        $.post(url, obj, fun);
    }

    function delAll(obj, f) {


        var url = '/yan/index.php/Admin/Use/delAll';
        var fun = function (res) {

            try {
                res = JSON.parse(res);
            } catch (error) {
                //转换错误
                layer.msg('异步接口出错！', {
                    anim: 6
                });
                return
            }

            if (res.res > 0) {
                layer.msg('删除成功！');
                if (f != null) {
                    f(res);
                }


            } else {
                layer.msg('删除失败：' + res.msg, {
                    anim: 6
                });
            }
        };
        $.post(url, obj, fun);

    }



    /**
     * 创建时间：2017年9月15日 18:31:36
     * 修改时间：2017年9月15日 18:31:36
     * ===========================================
     * 作者：代码狮
     * ===========================================
     * QQ：1173197065
     * 微信：ajs0314
     * GitHub：https://github.com/ALNY-AC
     * ===========================================
     * 如发现有bug，请速联系作者。
     * 后来者不懂的地方，请联系作者。
     * ===========================================
     * 因为客户浏览器不统一，所以不实用es6语法
     * ===========================================
     * @author 代码狮
     * @param str string 必须，要转换的字符串，比如：1,2,3 或者1 2 3 或者 1|2|3|，分隔符自定。
     * @param code string 必须，要当做分隔符的字符串，自定。
     * @param f function|string 必须，当为string的时候，为指定键名，当为function的时候，则为调用函数
     */
    function strToArr(str, code, f) {

        // 将字符串按照code分割成数组
        var array = str.split(code);
        // 创建一个空数组，用于返回
        var arr = [];

        // 开始str分割后的数组
        for (var i = 0; i < array.length; i++) {
            // 获得每个元素
            var item = array[i];
            // 当f函数 不为空的时候
            if (f != null) {

                // 判断是不是字符串
                if (typeof (f) == 'string') {
                    //如果是字符串
                    arr[i] = {};        //创建一个json
                    arr[i][f] = item;   //让f当做键名，直接将item赋值给他
                }
                //判断是不是函数
                if (typeof (f) == 'function') {
                    //当f为function的时候
                    //调用这个函数，并且传值进去
                    /**
                    //  * @param i int 当前循环的索引值
                    //  * @param arr array 当前的这个数组
                    //  * @param item string str分割后的数组的元素
                     */
                    arr[i] = f(i, arr, item);
                }


            } else {
                arr[i] = item;
            }
        }
        return arr;

    }



    //回调控制
    var callback = function () {
        this._no;
        this._yes;
        this.yes = function (f) {
            this._yes = f;
            return this;
        };
        this.no = function (f) {
            this._no = f;
            return this;
        };
    }

    function addAll(obj) {

        var _callback = new callback();

        (function () {

            var url = '/yan/index.php/Admin/Use/addAll';
            var fun = function (res) {

                try {
                    res = JSON.parse(res);
                    _callback._yes(res);
                } catch (error) {
                    //异步接口出错！
                    e(error);
                    _callback._no(res);
                }
            };
            $.post(url, obj, fun);

        }());
        return _callback;
    }

    var HtmlUtil = {
        /*1.用浏览器内部转换器实现html转码*/
        htmlEncode: function (html) {
            //1.首先动态创建一个容器标签元素，如DIV
            var temp = document.createElement("div");
            //2.然后将要转换的字符串设置为这个元素的innerText(ie支持)或者textContent(火狐，google支持)
            (temp.textContent != undefined) ? (temp.textContent = html) : (temp.innerText = html);
            //3.最后返回这个元素的innerHTML，即得到经过HTML编码转换的字符串了
            var output = temp.innerHTML;
            temp = null;
            return output;
        },
        /*2.用浏览器内部转换器实现html解码*/
        htmlDecode: function (text) {
            //1.首先动态创建一个容器标签元素，如DIV
            var temp = document.createElement("div");
            //2.然后将要转换的字符串设置为这个元素的innerHTML(ie，火狐，google都支持)
            temp.innerHTML = text;
            //3.最后返回这个元素的innerText(ie支持)或者textContent(火狐，google支持)，即得到经过HTML解码的字符串了。
            var output = temp.innerText || temp.textContent;
            temp = null;
            return output;
        }
    };



    function Base64() {

        // private property  
        _keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        // public method for encoding  
        this.encode = function (input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;
            input = _utf8_encode(input);
            while (i < input.length) {
                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);
                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;
                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }
                output = output +
                    _keyStr.charAt(enc1) + _keyStr.charAt(enc2) +
                    _keyStr.charAt(enc3) + _keyStr.charAt(enc4);
            }
            return output;
        }

        // public method for decoding  
        this.decode = function (input) {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;
            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
            while (i < input.length) {
                enc1 = _keyStr.indexOf(input.charAt(i++));
                enc2 = _keyStr.indexOf(input.charAt(i++));
                enc3 = _keyStr.indexOf(input.charAt(i++));
                enc4 = _keyStr.indexOf(input.charAt(i++));
                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;
                output = output + String.fromCharCode(chr1);
                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }
            }
            output = _utf8_decode(output);
            return output;
        }

        // private method for UTF-8 encoding  
        _utf8_encode = function (string) {
            string = string.replace(/\r\n/g, "\n");
            var utftext = "";
            for (var n = 0; n < string.length; n++) {
                var c = string.charCodeAt(n);
                if (c < 128) {
                    utftext += String.fromCharCode(c);
                } else if ((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                } else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }

            }
            return utftext;
        }

        // private method for UTF-8 decoding  
        _utf8_decode = function (utftext) {
            var string = "";
            var i = 0;
            var c = c1 = c2 = 0;
            while (i < utftext.length) {
                c = utftext.charCodeAt(i);
                if (c < 128) {
                    string += String.fromCharCode(c);
                    i++;
                } else if ((c > 191) && (c < 224)) {
                    c2 = utftext.charCodeAt(i + 1);
                    string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                    i += 2;
                } else {
                    c2 = utftext.charCodeAt(i + 1);
                    c3 = utftext.charCodeAt(i + 2);
                    string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    i += 3;
                }
            }
            return string;
        }
    }

    function hoverTitle() {

        $(document).on('mouseenter', '[title]', function () {

            var tips = $(this).attr('data-tips') ? $(this).attr('data-tips') : '3';
            var color = $(this).attr('data-color') ? $(this).attr('data-color') : '#666';

            layer.tips(this.title, this, {
                tips: [tips, color]
            });
            return false;

        });
        $(document).on('mouseleave', '[title]', function () {
            layer.closeAll('tips');
            return false;
        });

    }



</script>
    <style>
        body {
            padding: 0 15px
        }

        .img-box {
            width: 100%;
            display: block;
        }

        .img-hover {
            max-width: 300px;
        }
    </style>

</head>

<body>
    <div class="page-header">
        <h1>
            <small>公告管理</small>
        </h1>
    </div>

    <ol class="breadcrumb">
        <li>
            公告列表
        </li>
        <li class="active">公告列表</li>
    </ol>

    <div class="layui-row" style="padding-top:10px">

        <div class="layui-btn-group">
            <button class="layui-btn layui-btn-sm layui-black" title='添加公告' id="add">
                <i class="layui-icon">&#xe654;</i>
            </button>
            <button class="layui-btn layui-btn-sm layui-black" id="removeAll" data-color='rgb(253, 51, 51)' title='批量删除'>
                <i class="layui-icon">&#xe640;</i>
            </button>
        </div>


    </div>

    <div class="form-black">
        <table id="table" lay-filter="table_filter"></table>
    </div>


    <script type="text/html" id="bar1">
      
        <a class="layui-btn layui-btn-xs layui-black" lay-event="edit" data-id='{{d.paper_id}}' title='编辑' >
            <i class="layui-icon">&#xe642;</i>
        </a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" title='删除'  data-color='rgb(253, 51, 51)' lay-event="del">
            <i class="layui-icon">&#xe640;</i>
        </a>
    </script>

    <script type="text/html" id="bar_url">

        <div class="img-box" data-mtpis='<img src="/yan/{{ d.paper_url }}" class="img-hover"  alt="">'>
                【图片】
        </div>
       
    </script>

    <script>
        var tableIns;
        var table;
        var upload;
        layui.use(['table', 'form', 'upload'], function () {
            upload = layui.upload;
            table = layui.table;
            form = layui.form;

            tableIns = table.render({
                id: 'table'
                , elem: '#table'
                , url: '/yan/index.php/Admin/Use/getListWhere' //数据接口
                , where: {
                    table: 'paper',
                    where: {
                        paper_type: 'notice'
                    }
                }
                , response: {
                    statusCode: 1 //成功的状态码，默认：0
                }
                , page: true //开启分页
                , limit: localStorage.limit == null ? 30 : localStorage.limit
                // , limits: [5, 10]
                , cols: [[ //表头
                    { type: 'checkbox', width: 50, fixed: 'left' }
                    , { field: 'paper_id', title: 'id', width: 100 }
                    , { field: 'paper_title', title: '公告标题', width: 500, edit: 'text', }
                    , { field: 'add_time', title: '添加时间', width: 200, sort: true }
                    , { field: 'edit_time', title: '最后修改时间', width: 200, sort: true }
                    , { fixed: 'right', width: 130, align: 'center', title: '操作', toolbar: '#bar1' } //这里的toolbar值是模板元素的选择器

                ]]
            });


            //监听工具条
            table.on('tool(table_filter)', function (obj) {
                //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的DOM对象

                if (layEvent === 'del') {
                    //删除

                    layer.confirm('真的删除此条数据吗？', function (index) {
                        //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令

                        var delObj = {
                            table: 'paper',
                            id: data.paper_id,
                            del_file: data.paper_url
                        };

                        del(delObj, function () {
                            obj.del();
                        })

                    });
                }

                if (layEvent === 'edit') {
                    //编辑
                    var url = '/yan/index.php/Admin/Paper/edit/paper_id/' + data.paper_id;

                    // window.location.href =
                    window.open(url);
                }
            });


            /**
             * 监听单元格编辑
            */
            table.on('edit(table_filter)', function (obj) { //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
                console.log(obj.value); //得到修改后的值
                console.log(obj.field); //当前编辑的字段名
                console.log(obj.data); //所在行的所有相关数据  

                var save = {
                    table: 'paper',
                    id: obj.data.paper_id,
                    save: {}
                };
                save['save'][obj.field] = obj.value;
                saveInfo(save);

            });


        });

        /**
        数据搜索
        */
        $(document).on('click', '#reload', function () {

            var key = $('#key').val();
            var key_where = 'paper_id|paper_title';
            //执行重载
            tableIns.reload({
                page: {
                    curr: 1 //重新从第 1 页s开始
                }
                , where: {
                    table: 'paper',
                    key: key,
                    key_where: key_where
                }
                , done: function (res, curr, count) {
                    //如果是异步请求数据方式，res即为你接口返回的信息。
                    //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                    console.log(res);

                    //得到当前页码
                    console.log(curr);

                    //得到数据总量
                    console.log(count);
                }
            });

        });

        /**
         * 批量删除
         */
        $(document).on('click', '#removeAll', function () {
            // w('开始批量删除');
            var o = table.checkStatus('table');
            if (o.data.length <= 0) {
                return;
            }

            layer.confirm('确定删除这些数据？', function (index) {

                var id = [];
                for (var i = 0; i < o.data.length; i++) {
                    id[i] = o.data[i].paper_id;
                }

                var obj = {
                    table: 'paper',
                    id: id
                };

                delAll(obj, function (params) {
                    tableIns.reload();
                });

            });

        });

        //添加
        $(document).on('click', '#add', function () {

            window.open('/yan/index.php/Admin/paper/edit/type/notice');

        });

        hoverTitle();
    </script>
</body>

</html>