<?php
/**
 * @var $slots \Symfony\Component\Templating\Helper\SlotsHelper
 * @var $view
 */

$slots = $view['slots'];
?>

<?php $view->extend('layout.html.php') ?>

<div class="intro-header">
    <div class="col-md-8 col-md-offset-2">
        <h1><?= $pageHeading ?></h1>
    </div>
</div>


<?php $slots->output('_content'); ?>
