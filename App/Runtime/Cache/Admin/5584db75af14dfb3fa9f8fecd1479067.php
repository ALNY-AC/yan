<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>预览文章</title>
    <style>
        * {
            font-family: '微软雅黑';

        }

        .view {
            width: 700px;
            margin: 0 auto;
            padding: 0 10px;
        }

        .view-content * {
            max-width: 100% !important;
        }

        .view-info {
            padding: 20px 10px;
            background-color: #eee;
            margin: 10px 0;
            /* border-radius: 5px; */
            border-left: solid 5px #ddd;
            color: #777;
        }

        .view-title {
            padding: 10px 0;
            margin: 10px 0;
            border-bottom: solid 1px #ddd;
            font-size: 23.33px;
            margin-top: 30px;
            font-weight: 500;
        }

        .view-time {
            color: #aaa;
            font-size: 13px;
        }

        .view-author {
            display: inline-block;
            margin: 0 10px;
        }

        @media screen and (max-width: 1000px) {
            .view {
                width: auto;
            }
        }
    </style>
</head>

<body>


    <div class="view">
        <div class="view-head">
            <div class="view-title">
                <?php echo ($paper["paper_title"]); ?>
            </div>
            <div class="view-time">
                <?php echo ($paper["add_time"]); ?>
                <div class="view-author">
                    颜帮科技
                </div>
            </div>
        </div>
        <div class="view-body">
            <div class="view-info">
                <?php echo ($paper["paper_info"]); ?>
            </div>
            <div class="view-content">
                <?php echo (htmlspecialchars_decode($paper["paper_content"])); ?>
            </div>
        </div>
    </div>

</body>

</html>