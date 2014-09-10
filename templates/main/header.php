<!DOCTYPE html>
<html>
    <head>
        <title>Orders</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/templates/main/styles.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:600,400&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="container">
            <div class="nav clear">  
                <div class="left">
                    <div class="title">Orders</div>
                </div>
                <div class="right">
                    <?if (isLogin()):?>
                    <?=userGetFullName()?> 
                    <?if (userGetGroup()==3):?>
                    <b>[20 000 руб.]</b>
                    <?endif;?>
                    <span class="divider">|</span> <a href="/?logout=yes">Выход</a>
                    <?endif;?>                    
                </div>
            </div>   
