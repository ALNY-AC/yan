<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>颜帮科技后台登录</title>
    <link href="/yan/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
    <link href="/yan/Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <style>
        body {
            background-color: #f5f8fa;
            font-family: '微软雅黑';
            /* background-color: rgb(30, 30, 30); */
        }

        .zz {

            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);

        }

        .zz-img {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1.1);
            position: absolute;
            width: 100vw;
            height: 100vh;
            background-image: url('/yan/Public/assets/img/admin/5.jpg');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            filter: blur(10px);

        }

        #admin_code_img {
            margin: 0;
            height: 40px;
            max-width: 100%;
        }

        #basic-addon2 {
            padding: 0;
            width: 150px;
            background-color: transparent;
            border: none;
        }

        .box {
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            width: 450px;
            background-color: #ffffff;
            box-shadow: 0 5px 30px 1px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }


        .login-panel {
            position: absolute;
            width: 350px;
            margin: 0 auto;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* box-shadow: 0 5px 30px 5px rgba(0, 0, 0, 0.5); */
            transition: all 0.3s;
        }


        .login-head {
            padding: 13px 20px;
            /* background-color: #2a2a2a; */
            color: #333;
            font-size: 16px;
            text-align: center;
        }

        .login-title {
            text-align: left;
            font-family: '微软雅黑';
        }

        .login-body {
            background-color: #ffffff;
            padding: 20px;
            padding-top: 5px;
        }

        .form-control {
            border-radius: 2px;
            box-shadow: none;
            padding: 10px;
            height: auto;
        }

        .form-control:focus {
            outline: none;
            box-shadow: none;
            border-color: #777;
        }

        .btn-black {
            border-radius: 2px;
            background-color: #4a4a4a;
            outline: none;
            color: #ffffff;
            padding: 10px;

        }

        .btn-black:hover,
        .btn-black:focus {
            background-color: #4a4a4a;
            color: #ffffff;
            /* outline: solid 1px #ffae00; */
            /* box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.3); */
        }

        .footer {

            position: absolute;
            bottom: 10px;
            font-size: 11px;
            text-align: center;
            width: 100%;

        }
    </style>

</head>



<body>
    <div class="zz">
        <div class="zz-img"></div>
    </div>
    <div class="box">

        <div class="login-panel">
            <div class="login-head">
                <div class="login-title">
                    后台登录
                    <h4 class="text-muted">
                        <small>
                            颜帮科技
                        </small>
                    </h4>
                </div>
            </div>
            <div class="login-body">

                <form class="form text-center layui-form">

                    <div class="form-group">
                        <input type="text" lay-verify='required' autocomplete="off" placeholder="用户名" class="form-control" name="admin_id" id="admin_user">
                    </div>
                    <div class="form-group">
                        <input type="password" lay-verify='required' autocomplete="off" placeholder="密码" class="form-control" name="admin_pwd" id="admin_pwd">
                    </div>
                    <div class="form-group">
                        <div class="input-group" style="width: 100%">
                            <input type="text" id="admin_code" name="admin_code" lay-verify='required' class="form-control" placeholder="验证码" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">
                                <img src="" id="admin_code_img">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button lay-submit type="button" class="btn  btn-black btn-block" lay-filter="login">登录</button>
                    </div>

                </form>

            </div>


        </div>
        <div class="footer">
            <div class="login-footer">
            </div>
        </div>

    </div>


    <script src="/yan/Public/vendor/Jquery/jquery.js"></script>
    <!-- <script src="/yan/Public/vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="/yan/Public/vendor/layer/layer.js"></script>
    <script src="/yan/Public/vendor/layui/layui.js"></script>
    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <!-- <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script> -->
    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <!-- <script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> -->
    <script>



        layui.use('form', function () {
            var form = layui.form;

            //各种基于事件的操作，下面会有进一步介绍
            form.on('submit(login)', function (data) {
                // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                // console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}

                $.post('/yan/index.php/Admin/Login/login', data.field, function (res) {
                    res = JSON.parse(res);

                    if (res.res == 0) {
                        layer.msg(res.msg, {});
                        setTimeout(() => {
                            window.location.href = '<?php echo U("Index/index");?>';
                        }, 300);
                    } else {
                        obj.upCode();
                        layer.msg(res.msg, {
                            anim: 6
                        });
                    }

                })


                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });




        });


        var code = function () {
            obj = {
                config: {
                    el: ''
                },
                init: function () {
                    $(obj.config.el).css('cursor', 'pointer');
                    $(document).on('click', obj.config.el, function () {
                        obj.upCode();
                    });
                    obj.upCode();
                },
                upCode: function () {
                    $(obj.config.el).attr('src', '/yan/index.php/Admin/Login/getCode');
                }
            }
            return obj;
        }();


        code.config.el = '#admin_code_img';
        code.init();



    </script>
</body>

</html>