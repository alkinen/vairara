<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <title>DEMO MVC</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
    <link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css"/>
    <script src="../assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // return a random integer between 0 and number
        function random(number) {

            return Math.floor(Math.random() * (number + 1));
        }
        ;

        // show random quote
        $(document).ready(function () {

            var quotes = $('.quote');
            quotes.hide();

            var qlen = quotes.length; //document.write( random(qlen-1) );
            $('.quote:eq(' + random(qlen - 1) + ')').show(); //tag:eq(1)
        });
    </script>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div id="logo">
            <a href="/">DEMO MVC</a>
        </div>
        <div id="menu">
            <ul>
                <li class="first active"><a href="/">Главная</a></li>
                <li><a href="/services">Услуги</a></li>
                <li><a href="/portfolio">Портфолио</a></li>
                <li class="last"><a href="/contacts">Контакты</a></li>
            </ul>
            <br class="clearfix"/>
        </div>
    </div>
    <div id="page">
        <div id="sidebar">

            <div class="side-box">
                <h3>Основное меню</h3>
                <ul class="list">
                    <li class="first "><a href="/">Главная</a></li>
                    <li><a href="/services">Услуги</a></li>
                    <li><a href="/portfolio">Портфолио</a></li>
                    <li class="last"><a href="/contacts">Контакты</a></li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div class="box">
                <?php include 'system/viewers/' . $content_view; ?>
            </div>
            <br class="clearfix"/>
        </div>
        <br class="clearfix"/>
    </div>
    <div id="page-bottom">
        <div id="page-bottom-sidebar">
            <h3>Наши контакты</h3>
            <ul class="list">
                <li class="first">phone: 095 555 55 55</li>
                <li>skypeid: MySkype</li>
                <li class="last">email: email@gmail.com</li>
            </ul>
        </div>
        <div id="page-bottom-content">
            <h3>О Компании</h3>
            <p>
                DEMO MVC
            </p>
        </div>
        <br class="clearfix"/>
    </div>
</div>
<div id="footer">
    <a href="/">DEMO MVC</a> &copy; 2016-2017</a>
</div>
</body>
</html>