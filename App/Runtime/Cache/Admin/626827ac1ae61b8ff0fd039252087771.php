<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CTOS</title>
    <link href="/yan/Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/yan/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/yan/Public/vendor/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="/yan/Public/vendor/spinkit/spinkit.css" rel="stylesheet" type="text/css">
    <link href="/yan/Public/Admin/dist/ctos/ctos.css" rel="stylesheet" type="text/css">


</head>

<body>



    <div class="o-nav-list-left">

        <div class="o-nav-item logo">
            <i class="fa fa-connectdevelop"></i>
            CTOS
        </div>

        <div class="o-nav-item-panel">
            <div class="o-nav-item active">
                <a href="" data-panel-id='#user_config'>
                    <i class="fa fa-user fa-fw"></i>
                    账户配置

                    <div class="right">

                        <?php if($is_user_config): ?><span class="text-success nav-info" id="is_user_config">
                                <span class="title">
                                    已配置
                                </span>
                                <span class="glyphicon glyphicon-ok"></span>
                            </span>
                            <?php else: ?>
                            <span class="text-danger nav-info" id="is_user_config">
                                <span class="title">
                                    未配置
                                </span>
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                            </span><?php endif; ?>
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </a>
            </div>
            <div class="o-nav-item">
                <a href="" data-panel-id='#app_config'>
                    <i class="fa fa-cogs fa-fw"></i>
                    项目配置
                    <div class="right">
                        <?php if($is_app_config): ?><span class="text-success nav-info" id="is_app_config">
                                <span class="title">
                                    已配置
                                </span>
                                <span class="glyphicon glyphicon-ok"></span>
                            </span>
                            <?php else: ?>
                            <span class="text-danger nav-info" id="is_app_config">
                                <span class="title">
                                    未配置
                                </span>
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                            </span><?php endif; ?>
                        <i class="fa fa-chevron-right "></i>
                    </div>
                </a>
            </div>
            <div class="o-nav-item">
                <a href="/yan/index.php/Admin/Login/login">
                    <i class="fa fa-user fa-fw"></i>
                    登录
                    <div class="right">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <div class="o-body">
        <div class="o-panel o-panel-hide" id="app_config">
            <div class="o-panel-head">
                <div class="o-panel-title">
                    项目密匙
                </div>
            </div>
            <div class="o-panel-body">

                <div class="layui-form">
                    <div class="form-group">
                        <label for="">项目密匙</label>
                        <input type="text" class="o-form-control" disabled value="<?php echo (__KEY__); ?>">
                    </div>
                </div>

            </div>
            <div class="o-panel-footer">
            </div>
        </div>
        <div class="o-panel o-panel-hide" id="user_config">
            <div class="o-panel-head">
                <div class="o-panel-title">
                    账户配置
                </div>
            </div>
            <div class="o-panel-body ">

                <form class="layui-form">
                    <div class="form-group">
                        <label for="admin_id">账户</label>
                        <input type="text" lay-verify='required' autocomplete="off" class="o-form-control" id="admin_id" name="admin_id" placeholder="账户">
                    </div>
                    <div class="form-group">
                        <label for="admin_pwd">密码</label>
                        <input type="text" lay-verify='required' autocomplete="off" class="o-form-control" id="admin_pwd" name="admin_pwd" placeholder="密码">
                    </div>
                    <div class="form-group">
                        <label for="admin_pwd_2">确认密码</label>
                        <input type="text" lay-verify='required' autocomplete="off" class="o-form-control" id="admin_pwd_2" name="admin_pwd_2" placeholder="确认密码">
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-default o-btn" lay-submit lay-filter="userConfig">保存</button>
                    </div>
                </form>

            </div>
            <div class="o-panel-footer">
            </div>
        </div>


        <div class="o-panel o-panel-hide" id="app_config">
            <div class="o-panel-head">
                <div class="o-panel-title">
                    项目配置
                </div>
            </div>
            <div class="o-panel-body">

                <form class="layui-form">
                    <div class="form-group">
                        <label for="app_name">项目名</label>
                        <input type="text" class="o-form-control" lay-verify='required' value="颜帮科技" id="app_name" autocomplete="off" name="app_name"
                            placeholder="项目名">
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-default o-btn" autocomplete="off" lay-submit lay-filter="appConfig">保存</button>
                    </div>
                </form>

            </div>
            <div class="o-panel-footer">
            </div>
        </div>
        <div class="test"></div>

    </div>



    <script src="/yan/Public/vendor/jquery/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="/yan/Public/vendor/vue/vue.js"></script>
    <script src="/yan/Public/vendor/layer/layer.js"></script>
    <script src="/yan/Public/vendor/layui/layui.js"></script>
    <script src="/yan/Public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--  -->
    <script src="/yan/Public/Admin/dist/tool/tool.js"></script>
    <script src="/yan/Public/Admin/dist/ctos/ctos.js"></script>
    <script>


        layui.use('form', function () {
            var form = layui.form;

            form.on('submit(userConfig)', function (data) {
                // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                // console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}


                var url = '/yan/index.php/Admin/Ctos/userConfig/pwd/yh12138**';

                var obj = data.field;
                var fun = function (res) {
                    $('.test').html(res);
                    w(res);
                    try {
                        res = JSON.parse(res);
                    } catch (error) {
                        //转换错误
                        layer.msg('接口错误！', {
                            amin: 6
                        });
                        return
                    }

                    if (res.res >= 0) {
                        layer.msg('保存成功~');

                        $('#is_user_config').find('.glyphicon').removeClass('glyphicon-exclamation-sign');
                        $('#is_user_config').find('.glyphicon').addClass('glyphicon-ok');

                        $('#is_user_config').removeClass('text-danger');
                        $('#is_user_config').addClass('text-success');
                        $('#is_user_config').find('.title').text('已配置');


                    } else {
                        layer.msg('保存失败~', {
                            amin: 6
                        });
                    }

                };
                $.post(url, obj, fun);



                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

            form.on('submit(appConfig)', function (data) {
                // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                // console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}



                (function () {

                    var url = '/yan/index.php/Admin/Ctos/appConfig';
                    var obj = {
                        save: {
                            app_name: data.field.app_name
                        }

                    };
                    var fun = function (res) {
                        w(res);
                        try {
                            res = JSON.parse(res);
                        } catch (error) {
                            //转换错误
                            layer.msg('接口错误！', {
                                anim: 6
                            });
                            return
                        }

                        if (res.res >= 0) {
                            layer.msg('保存成功~');


                            $('#is_app_config').find('.glyphicon').removeClass('glyphicon-exclamation-sign');
                            $('#is_app_config').find('.glyphicon').addClass('glyphicon-ok');

                            $('#is_app_config').removeClass('text-danger');
                            $('#is_app_config').addClass('text-success');
                            $('#is_app_config').find('.title').text('已配置');


                        } else {
                            layer.msg('保存失败~', {
                                anim: 6
                            });
                        }

                    };
                    $.post(url, obj, fun);

                }());


                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });


        });

    </script>



</body>

</html>