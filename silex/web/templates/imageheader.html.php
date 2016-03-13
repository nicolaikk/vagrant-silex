<?php
/**
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $view
 */

$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

        <div class="intro-header" style="background-image: url('/images/aerialphoto.jpg')">
            <div class="page-heading">
                <h1><?= $pageHeading ?></h1>
            </div>
        </div>



<?php $slots->output('_content'); ?>
