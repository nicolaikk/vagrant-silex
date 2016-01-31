<?php
$slots = $view['slots'];
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/vendor/css/style.css" rel="stylesheet">

        <script src="/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>


    </head>
    <body>
        <header>
            <!-- TODO: login form -->
            <!-- TODO: arrow to indicate the use to scroll -->
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="glyphicon glyphicon-th-list"></span>
                        </button>
                        <a class="navbar-brand" href="/">Producify.io - Start getting productive right now!</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="hidden">
                                <a href="#page-top"></a>
                            </li>
                            <li class="page-scroll">
                                <a href="/blog" class="active">Blog</a>
                            </li>
                            <li class="page-scroll">
                                <a href="/about">About us</a>
                            </li>
                            <li class="page-scroll">
                                <a href="/links">Links</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </nav>
        </header>

        <?php $slots->output('_content'); ?>

        <footer>
                <div class="panel panel-footer">
                    <div class="panel-body">Some footer information</div>
                </div>
        </footer>
    </body>
</html>

