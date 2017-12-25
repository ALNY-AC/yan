<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            background-color: #2a2a2a;
            padding: 20px;
            color: #eee;
            width: 300px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            border-right: solid 1px #111;
        }

        .item {
            padding: 10px;
            cursor: pointer;
            border-radius: 10px;

        }

        .item:hover,
        .item.active {
            transition: all 0.3s;
            background-color: #eee;
            color: #333;
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
            width: 50%;
            float: left;
            height: 100%;
            padding: 10px;
            overflow: auto;
        }



        .code-1 {
            border-right: solid 1px #222;
        }

        .code-2 {}

        hr {
            border: none;
            height: 1px;
            background-color: #222;
            box-shadow: none;
        }

        pre {
            font-family: '微软雅黑';
        }
    </style>
</head>

<body>


    <div id="aApp" class="item-box">
        <!-- <input type="text" class="input" v-model='url'> -->

        <label>测试：
            <input type="checkbox" v-model='debug'>
        </label>
        <label>格式化json：
            <input type="checkbox" v-model='form'>
        </label>
        <div v-bind:class="{active:item.is_active,item:item}" v-for='(item,index) in items' @click='show(item,index)' @mouseover='hover(item,index)'
            target="_blank">{{item.title}}</div>

    </div>

    <div class="code-view">

        <div class="code code-1">
            <pre></pre>
        </div>
        <div class="code code-2">
            <pre></pre>
        </div>

    </div>
    <script src='/yan/Public/vendor/vue/vue.js'></script>
    <script src='/yan/Public/vendor/jquery/jquery.js'></script>
    <script src='/yan/Public/Home/dist/index/index.js'></script>

    <script>


        var getUrl = '<?php echo U("Use/get","",null,true);?>';
        var getPaper = '<?php echo U("Use/getPaper","",null,true);?>';


        var aApp = new Vue({
            el: '#aApp',
            data: {
                debug: false,
                form: true,
                url: '',
                item: true,
                items: [
                    {
                        href: getUrl,
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
                        href: getUrl,
                        where: {
                            table: 'carousel'
                        },
                        title: '取轮播图',
                        is_active: false
                    },
                    {
                        href: getUrl,
                        where: {
                            table: 'hosp'
                        },
                        title: '取大医美医院列表',
                        is_active: false
                    },
                    {
                        href: getUrl,
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
                        href: getUrl,
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
                        href: getUrl,
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
                        href: getUrl,
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
                        href: getUrl,
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
                        href: getUrl,
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
                        href: getUrl,
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
                        href: getPaper,
                        where: {
                            table: 'paper',
                            super_id: '38f5688cfc913158a21bf61379bc27a6'
                        },
                        title: '通过 [ super_id ] 取文章（项目）',
                        is_active: false
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
                        href: '<?php echo U("Use/linkList","",null,true);?>',
                        where: {
                            info: '不传参数，直接返回自己下线的列表，但是要求要开始登录过',
                        },
                        title: '取自己下线的列表',
                        is_active: false,
                        ajax: false
                    },
                ]
            },
            methods: {

                show: function (item, index) {
                    var _this = this;

                    this.removeActive();

                    item.is_active = true;

                    var url = item.href;
                    var where = item.where;
                    // window.open(url);
                    where['debug'] = this.debug;

                    var formatWhere = formatJson(where);

                    $('.code-1 pre').empty();
                    $('.code-2 pre').empty();

                    $('.code-1 pre').append(url);
                    $('.code-1 pre').append('<hr/>');
                    $('.code-1 pre').append(formatWhere);

                    localStorage.ajaxIndex = index;

                    if (item.ajax || item.ajax == null) {

                        $.get(url, where, function (res) {

                            if (_this.form) {
                                res = formatJson(JSON.parse(res));
                            }
                            $('.code-2 pre').html(res);

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

        aApp.show(aApp.items[localStorage.ajaxIndex], localStorage.ajaxIndex);





    </script>



</body>

</html>