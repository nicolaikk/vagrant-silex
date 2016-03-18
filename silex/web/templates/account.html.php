<?php
/**
 * @var $view
 * @var $userName
 * @var $userId
 * @var $userEmail
 * @var $userDate
 * @var $user
 */
?>


<?php $view->extend('layout.html.php') ?>



<div class="container">
    <div class="row first">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="well">
                <h2><div class="glyphicon glyphicon-user"></div></h2>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Username</td>
                        <td><?= $user ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $userEmail ?></td>
                    </tr>
                    <tr>
                        <td>User ID</td>
                        <td><?= $userId ?></td>
                    </tr>
                    <tr>
                        <td>Registration date</td>
                        <td><?= $userDate ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

