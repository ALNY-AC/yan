<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/yan/Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <title>测试</title>
    <style>
        /*定义滚动条高宽及背景 高宽分别对应横竖滚动条的尺寸*/

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
            background-color: #000;
        }

        /*定义滚动条轨道 内阴影+圆角*/

        ::-webkit-scrollbar-track {
            border-radius: 0;
            background-color: #333;
        }

        /*定义滑块 内阴影+圆角*/

        ::-webkit-scrollbar-thumb {
            border-radius: 0;
            background-color: #777;
        }

        ::selection {
            background: #9cdcfe;
            /* color: #555; */
        }

        ::-moz-selection {
            background: #9cdcfe;
            /* color: #555; */
        }

        ::-webkit-selection {
            background: #9cdcfe;
            /* color: #555; */
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-size: 14px;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .item-box {
            background-color: rgb(37, 37, 38);
            color: #eee;
            width: 300px;
            position: fixed;
            left: 0;
            top: 37px;
            bottom: 0;
            overflow: auto;
        }

        .item {
            padding: 5px;
            cursor: pointer;
            outline-color: rgb(63, 63, 70);
            color: #cccccc;
            font-size: 14px;

        }

        .item .fa-log {
            margin-right: 5px;
        }

        .item:hover {
            /* outline: solid 1px rgb(63, 63, 70); */
            transition: all 0.3s;
            background-color: #2a2d2e;
        }

        .item:hover .fa-log:before,
        .item.active .fa-log:before {
            content: "\f20e";
        }


        .item.active {
            transition: all 0.3s;
            /* background-color: rgb(63, 63, 70); */
            background-color: #2a2d2e;
            color: #eee;
        }


        .input {
            display: block;
            width: 100%;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1;
            color: #555;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 10px 0;
        }

        label {
            display: block;
            margin: 10px 0;
            cursor: pointer;
        }


        .code-view {
            background-color: #333;
            color: #eee;
            line-height: 1.5;
            font-size: 14px;
            position: fixed;
            left: 300px;
            top: 0;
            bottom: 0;
            right: 0;
        }

        .code-view:after {
            clear: both;
            content: " ";
            display: table;
        }

        .code {
            position: relative;
            width: 50%;
            float: left;
            height: 100%;
            background-color: rgb(30, 30, 30);
            z-index: 1;
        }



        .code-1 {
            width: 40%;
            position: relative;
            border-right: solid 1px rgb(64, 64, 64);
            display: table;
        }

        .code-2 {
            width: 60%;
        }


        hr {
            border: none;
            height: 1px;
            background-color: rgb(64, 64, 64);
            box-shadow: none;
        }

        pre {
            background-color: transparent;
            color: #d7ba7d;
            border: none;
            padding: 41px 0;
            border-radius: 0;
            overflow: auto;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            z-index: 1;
        }

        .box {
            position: fixed;
            top: 0;
            left: 0;
            padding: 8px 15px;
            width: 300px;
            background-color: #383838;
            font-size: 15px;
            /* border-bottom: solid 1px rgb(64, 64, 64); */
            /* box-shadow: 3px 2px 10px 2px rgba(0, 0, 0, 0.3); */
        }

        .box * {
            font-size: 10px;
        }

        .line-box {
            /* border-bottom: solid 1px rgb(64, 64, 64); */
            padding: 8px 15px;
            font-size: 14px;
            color: #ccc;
            z-index: 9999;
            background-color: rgb(30, 30, 30);
            position: absolute;
            width: 100%;
            box-shadow: 3px 2px 10px 2px rgba(0, 0, 0, 0.3);
        }

        .line-box:before {
            content: " ";

        }

        .line-box:before {
            content: "";
        }


        .code-ul-1 {
            /* 代码 */
            /* float: left; */
            display: inline-block;
            vertical-align: top;
            position: absolute;
            right: 0;
            left: 53px;
            padding: 0;
            margin: 0;
            list-style: none;
        }



        .code-ul-1 li:hover {
            background-color: #333;
        }


        .code-ul-1 li {
            display: block;
            padding: 0 10px;
            width: 100%;
            font-size: 14px;
            line-height: 20px;

        }

        .code-ul-2 {
            /* 序号 */
            /* float: left; */
            display: inline-block;
            vertical-align: top;
            position: absolute;
            bottom: 0;
            top: 41px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .code-ul-2 li {
            line-height: 20px;
            border-right: 3px solid #0c7d9d;
        }

        .code-ul-2 li .i {
            display: inline-block;
            width: 50px;
            text-align: right;
            color: #5a5a5a;
            padding-right: 10px;
        }

        .item.item-nav {
            position: relative;
            background-color: rgba(128, 128, 128, 0.2);
            padding: 5px;
            box-shadow: 0 3px 1px 1px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>


    <div id="aApp" class="item-box">
        <!-- <input type="text" class="input" v-model='url'> -->

        <div class="box">
            CTOS接口测试工具
        </div>

        <div v-bind:class="[{active:item.is_active},{'item-nav':item.type=='nav'},'item']" v-for='(item,index) in items' @click='show(item,index)'
            @mouseover='hover(item,index)' target="_blank">
            <i v-bind:class="[{'fa-spin':!item.is_active},'fa fa-fw fa-log']"></i>
            {{item.title}}
        </div>

    </div>

    <div class="code-view">

        <div class="code code-1">
            <div class="line-box">
                url
            </div>
            <pre></pre>
        </div>
        <div class="code code-2">
            <div class="line-box">result</div>
            <pre></pre>
        </div>

    </div>
    <script src='/yan/Public/vendor/vue/vue.js'></script>
    <script src='/yan/Public/vendor/jquery/jquery.js'></script>
    <script src='/yan/Public/Home/dist/index/index.js'></script>

    <script src="/yan/Public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <link href="/yan/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script>



        var useUrl = '<?php echo U("Use/get","",null,true);?>';
        var getPaper = '<?php echo U("Use/getPaper","",null,true);?>';


        var aApp = new Vue({
            el: '#aApp',
            data: {
                debug: false,
                form: true,
                url: '',
                items: [

                    {
                        href: '<?php echo U("Index/server","",null,true);?>',
                        where: {
                        },
                        title: '取服务器地址',
                        is_active: true
                    },

                    {
                        href: useUrl,
                        where: {
                            table: 'paper',
                            where: {
                                super_id: 'introduce'
                            }
                        },
                        title: '取公司介绍',
                        is_active: true
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'carousel'
                        },
                        title: '取轮播图',
                        is_active: false
                    },
                    {
                        title: '取列表',
                        type: 'nav'
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'hosp'
                        },
                        title: '取大医美医院列表',
                        is_active: false
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'project',
                            where: {
                                super_id: '994595068839d632cb2081aa09fc5ee0',
                                type: 'hosp'
                            }
                        },
                        title: '根据医院取项目列表',
                        is_active: false
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'project',
                            where: {
                                type: 'healthy'
                            }

                        },
                        title: '取大健康项目列表',
                        is_active: false
                    },
                    {
                        title: '项目学习类接口',
                        type: 'nav'
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'project',
                            where: {
                                type: 'project_learning'
                            }
                        },
                        title: '取项目学习列表',
                        is_active: false
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'project',
                            where: {
                                type: 'career_learning_1'
                            }
                        },
                        title: '取事业学习列表（新人篇）',
                        is_active: false
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'project',
                            where: {
                                type: 'career_learning_2'
                            }
                        },
                        title: '取事业学习列表（进阶篇）',
                        is_active: false
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'project',
                            where: {
                                type: 'career_learning_3'
                            }
                        },
                        title: '取事业学习列表（高阶篇）',
                        is_active: false
                    },
                    {
                        title: '其他接口',
                        type: 'nav'
                    },
                    {
                        href: getPaper,
                        where: {
                            table: 'paper',
                            paper_type: 'notice'
                        },
                        title: '通过 [ paper_type ] 取公告',
                        is_active: false
                    },
                    {
                        href: getPaper,
                        where: {
                            table: 'paper',
                            super_id: '38f5688cfc913158a21bf61379bc27a6'
                        },
                        title: '通过 [ super_id ] 取文章（项目）',
                        is_active: false
                    },
                    {
                        title: '用户个人相关接口',
                        type: 'nav'
                    },
                    {
                        href: useUrl,
                        where: {
                            table: 'user',
                            where: {
                                openid: '110'
                            }
                        },
                        title: '取个人信息',
                        is_active: false
                    },


                    {
                        href: '<?php echo U("Use/linkList","",null,true);?>',
                        where: {
                            info: '不传参数，直接返回自己下线的列表，但是要求要开始登录过',
                        },
                        title: '取自己下线的列表',
                        is_active: false,
                        ajax: false
                    },
                    {
                        title: '功能接口',
                        type: 'nav'
                    },
                    {
                        href: '<?php echo U("Use/link","",null,true);?>',
                        where: {
                            openid: '上线的id',
                            openid_m: '自己的id'
                        },
                        title: '成为某某某的下线',
                        is_active: false,
                        ajax: false
                    },
                    {
                        title: 'web-view接口',
                        type: 'nav'
                    },
                    {
                        href: "<?php echo U('Use/showPaper','paper_id=67d7f00aee287d14339293e770f10459',null,true);?>",
                        where: {
                            url: '直接的url'
                        },
                        title: '查看文档',
                        type: 'open',
                        is_active: false,
                        ajax: false
                    },
                    // 

                ]
            },
            methods: {

                show: function (item, index) {
                    var _this = this;
                    $('.code-1 pre').empty();
                    $('.code-2 pre').empty();

                    this.removeActive();

                    item.is_active = true;

                    var url = item.href;
                    var where = item.where;

                    where['debug'] = this.debug;

                    var formatWhere = formatJson(where);

                    $('.code-1 .line-box').html(url);
                    // $('.code-1 pre').append(formatWhere);

                    var $ul = psCode(formatWhere);
                    $('.code-1 pre').html($ul);

                    localStorage.ajaxIndex = index;
                    if (item.type == 'open') {
                        window.open(url);
                        return;
                    }
                    if (item.ajax || item.ajax == null) {

                        $.get(url, where, function (res) {

                            if (_this.form) {
                                res = formatJson(JSON.parse(res));
                                var $ul = psCode(res);
                                $('.code-2 pre').html($ul);
                            }

                            // $('.code-2 pre').html(res);

                        });

                    }

                },
                hover: function (item, index) {

                    var url = item.href;
                    this.url = url;

                },
                removeActive: function () {

                    for (let index = 0; index < this.items.length; index++) {
                        const itme = this.items[index];
                        itme.is_active = false;
                    }
                }
            }
        });

        if (aApp.items[localStorage.ajaxIndex].type != 'open') {
            aApp.show(aApp.items[localStorage.ajaxIndex], localStorage.ajaxIndex);
        }



        function psCode(res) {


            res = res.split("\r\n")
            var $box = $('<div/>');

            var $ul1 = $('<ul/>').addClass('code-ul-1');
            for (let i = 0; i < res.length; i++) {
                const item = res[i];
                $ul1.append(`<li>${item}</li>`);
            }


            var $ul2 = $('<ul/>').addClass('code-ul-2');
            for (let i = 0; i < res.length; i++) {
                $ul2.append(`<li><span class='i'>${i + 1}</span></li>`);
            }

            $box.append($ul2);
            $box.append($ul1);
            return $box;

        }


    </script>



</body>

</html>