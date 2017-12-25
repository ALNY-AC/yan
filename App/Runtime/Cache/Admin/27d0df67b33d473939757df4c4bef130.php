<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/yan/Public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <title><?php echo ($msgTitle); ?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: rgb(30, 30, 30);
            color: #ccc;
        }

        .box {
            width: 350px;
            margin: 0 auto;
        }

        .panel {
            position: relative;
            width: 100%;
            box-shadow: 0 5px 30px 5px rgba(0, 0, 0, 0.5);
        }

        .panel-simple {
            color: #ccc;
        }

        .panel-head {
            padding: 15px 0;
        }

        .panel-title {
            text-align: center;
        }

        .panel-body {
            position: relative;
            background-color: #ffffff;
            color: #333;
            padding: 20px;
        }

        .panel-footer {}


        .panel-simple .panel-head {
            background-color: #2a2a2a;
            color: #fff;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-input {

            display: block;
            width: 100%;
            padding: 10px;
            font-size: 15px;
            border-radius: 2px;
            border: solid 1px #ccc;
            transition: all 0.3s;
            line-height: 1.4;

        }

        .form-input:focus {
            outline: none;
            border-color: #888;
        }

        .btn-black {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 15px;
            border-radius: 2px;
            border: solid 1px #ccc;
            color: #fff;
            transition: all 0.3s;
            line-height: 1.4;
            background-color: #2a2a2a;
            text-decoration: none;
            text-align: center;
        }

        .btn-black:focus {
            outline: none;
            border-color: #888;
        }

        .status {
            width: 100%;
            font-size: 50px;
            text-align: center;
        }
    </style>


</head>

<body>


    <div class="box">
        <div class="panel panel-simple">
            <div class="panel-head">
                <div class="panel-title"><?php echo ($msgTitle); ?></div>
            </div>
            <div class="panel-body">
                <?php if($status == 0): ?><div class="fa fa-times-circle status" style="color:#d9534f"></div>
                    <h1>
                        <?php echo ($error); ?>
                    </h1><?php endif; ?>
                <?php if($status == 1): ?><div class="fa fa-check-circle status" style="color:#5cb85c"></div>
                    <h1>
                        <?php echo ($message); ?>
                    </h1><?php endif; ?>

                <div class="form-group">

                    <?php if($status == 0): ?><a href="javascript:;" onclick='jump()' class="btn btn-black">返回
                            <span id="time" style="color:#d9534f"><?php echo ($waitSecond); ?></span>
                        </a><?php endif; ?>

                    <?php if($status == 1): ?><a href="javascript:;" onclick='jump()' class="btn btn-black">跳转
                            <span id="time" style="color:#5cb85c"><?php echo ($waitSecond); ?></span>
                        </a><?php endif; ?>

                </div>

            </div>
            <div class="panel-footer"></div>
        </div>
    </div>


    <?php if($status == 0): ?><script>

            localStorage.clear();


        </script><?php endif; ?>

    <script>


        var time = parseInt('<?php echo ($waitSecond); ?>');
        var doc = document.getElementById('time');
        doc.innerHTML = time;
        setInterval(function (params) {
            if (time <= 1) {
                jump();
            }
            time--;
            doc.innerHTML = time;
        }, 1000)

        function jump() {

            top.location.href = '<?php echo ($jumpUrl); ?>';

        }
    </script>




</body>

</html>