<?php
/**
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $view
 */

$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<header class="row intro-header" style="background-image: url('/images/aerialphoto.jpg')">
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
