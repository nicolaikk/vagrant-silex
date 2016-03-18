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
            <div class="jumbotron">
                <h3>Sign up here and unleash the productivity in your team </h3>
            </div>
            <div class="well">
                <form role="form" action="/register" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="userName" id="username">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="password1" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Repead password:</label>
                        <input type="password" class="form-control" name="password2" id="pwd">
                    </div>
                    <button type="submit" class="btn btn-default">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</div>