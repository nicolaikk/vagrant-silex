<?php
/**
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $active
 * @var $auth
 * @var $view
 * @var $messageType
 * @var $messageText
 * @var $user
 */

$slots = $view['slots'];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/css/style.css" rel="stylesheet">

    <script src="/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <title>producify.io</title>


</head>
<body>
<header>
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
                    <li <?= $active == 'blog_new' ? 'class="active"' : '' ?> <?= $auth ? 'style="display:none"' : '' ?> >
                        <a href="/blog_new">Neuer Post</a>
                    </li>
                    <li <?= $active == 'blog_show' ? 'class="active"' : '' ?>>
                        <a href="/blog_show">Blog</a>
                    </li>
                    <li <?= $active == 'benutzer' ? 'class="active"' : 'class="page-scroll"' ?>>
                        <a href="/accounts_show">Benutzer</a>
                    </li>
                    <li <?= $active == 'links' ? 'class="active"' : '' ?>>
                        <a href="/links">Links</a>
                    </li>
                    <li class="dropdown" <?= $auth ? 'style="display:none"' : '' ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong><?= $user ?></strong> <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu login-dp">
                            <li>
                                <div class="form-group">
                                    <a href="/account" class="btn btn-primary btn-block">Account</a>
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <a href="/logout" class="btn btn-danger btn-block">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown" <?= $auth ? '' : 'style="display:none"' ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Login</strong> <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu login-dp">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" method="post" action="/login" accept-charset="UTF-8"
                                              id="login-nav">
                                            <div class="form-group">
                                                <label class="sr-only" for="email">Email address</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                       placeholder="Email oder Accountname" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="passwordInput">Password</label>
                                                <input type="password" class="form-control" name="passwordInput"
                                                       id="passwordInput" placeholder="Passwort" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"/> Angemeldet bleiben
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="bottom text-center">
                                        <a href="/register">Registrieren</a>
                                    </div>
                                </div>

                        </ul>
                </ul>
            </div>
        </div>

    </nav>
</header>

<div class="alert alert-danger floating-message" <?= $messageType == 'danger' ? 'style="display:block"' : 'style="display:none"' ?>>
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Fehler:</strong> <?= $messageText ?>
</div>
<div class="alert alert-success floating-message" <?= $messageType == 'success' ? 'style="display:block"' : 'style="display:none"' ?>>
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Erfolg:</strong> <?= $messageText ?>
</div>

<?php $slots->output('_content'); ?>
<div class="container-fluid">
    <div class="row footer">
        <div class="col-sm-12">
            Some footer information
        </div>
    </div>
</div>
<script src="/vendor/js/scripts.js"></script>
</body>
</html>

