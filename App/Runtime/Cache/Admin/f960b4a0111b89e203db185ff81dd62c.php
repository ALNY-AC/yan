<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>意见反馈</title>

    <style>
        .view {
            width: 500px;
            margin: 0 auto;
            box-shadow: 0 1px 1px 1px rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            font-size: 14px;
        }

        .view-head {
            font-size: 1.1em;
            padding: 10px;
            border-bottom: solid 1px #eee;
        }

        .view-title {}

        .view-info {
            padding: 10px;
            font-size: 1em;
            display: inline-block;
        }

        .view-body {
            padding: 20px 10px;
            font-size: 1em;
            background-color: #f9f9f9;
        }

        .view-footer {
            border-top: solid 1px #eee;
            padding: 10px;
            font-size: 0.8em;
        }
    </style>



</head>

<body>

    <div class="view">
        <div class="view-head">
            <div class="view-title">
                意见反馈详情
            </div>
        </div>
        <div class="view-body">
            <?php echo ($feedback["feedback_info"]); ?>
        </div>
        <div class="view-footer">
            <?php echo ($feedback["add_time"]); ?>
            <div class="view-info">
                联系方式： <?php echo ($feedback["feedback_contact"]); ?>
            </div>
        </div>
    </div>

</body>





</html>