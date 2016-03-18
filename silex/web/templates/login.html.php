<?php
/**
 * @var $view
 */
?>

<?php $view->extend('layout.html.php') ?>


<div class="container">
    <div class="row first">
        <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron">
                <h3>Sign in here:</h3>
            </div>
            <div class="well">
                <form role="form" action="/login" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="passwordInput" id="pwd">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="stayLogged">Keep me logged in</label>
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>