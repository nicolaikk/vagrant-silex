<?php
/**
 * @var $view
 * @var $alertVisible
 * @var $alertMessage
 */
?>

<?php $view->extend('layout.html.php') ?>


<div class="container">
    <div class="row first">
        <div class="col-md-10 col-md-offset-1">
            <div class="well">
                <div class="alert alert-success alert-top" style="display:none">
                    <strong>Erfolg:</strong>
                </div>
                <div class="alert alert-danger" <?= $alertVisible ? '' : 'style="display:none"' ?>>
                    <div class="glyphicon glyphicon-remove"></div>
                    <strong>Fehler:</strong> <?= $alertMessage ? $alertMessage : '' ?>
                </div>
                <form role="form" action="/register" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="username">Nutzername:</label>
                        <input type="text" class="form-control" name="userName" id="username">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Passwort:</label>
                        <input type="password" class="form-control" name="password1" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Passwort wiederholen:</label>
                        <input type="password" class="form-control" name="password2" id="pwd">
                    </div>
                    <button type="submit" class="btn btn-default">Registrieren</button>
                </form>
            </div>
        </div>
    </div>
</div>