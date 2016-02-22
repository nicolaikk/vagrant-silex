<?php
/**
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $active
 *
 */

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
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="glyphicon glyphicon-th-list"></span>
                </button>
                <a class="navbar-brand" href="/">producify.io</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li <?= $active == 'blog' ? 'class="active"' : '' ?>>
                        <a href="/blog">Blog</a>
                    </li>
                    <li <?= $active == 'new_blog' ? 'class="active"' : '' ?>>
                        <a href="/blog">Neuer Blogpost</a>
                    </li>
                    <li <?= $active == 'about' ? 'class="active"' : 'class="page-scroll"' ?>>
                        <a href="/about">About us</a>
                    </li>
                    <li <?= $active == 'links' ? 'class="active"' : '' ?>>
                        <a href="/links">Links</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Angemeldet bleiben
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="bottom text-center">
                                        <a href="#">Registrieren</a>
                                    </div>
                                </div>
                            </li>
                </ul>
            </div>
        </div>

    </nav>
</header>

<header class="intro-header" style="background-image: url('/images/aerialphoto.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
                <div class="page-heading">
                    <h1><?= $pageHeading ?></h1>
                </div>
            </div>
        </div>
    </div>
</header>

<?php $slots->output('_content'); ?>

<container>
    <footer>
        <div class="panel panel-footer">
            <div class="panel-body">Some footer information</div>
        </div>
    </footer>
</container>

</body>
</html>

