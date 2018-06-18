<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>hello index</h1>
    <h1><?=Html::encode($title) || '';?></h1>
    <h1><?=HtmlPurifier::process($title) || '';?></h1>
</body>
</html>