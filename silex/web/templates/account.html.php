<?php
/**
 * @var $view
 * @var $userName
 * @var $userId
 */
?>

<div class="container">
    <div class="row first">
        <div class="col-md-10 col-md-offset-1">
            <div class="well">
                <?php $view->extend('layout.html.php') ?>
                <?= $userName ?>
                <?= $userId ?>
            </div>
        </div>
    </div>
</div>
