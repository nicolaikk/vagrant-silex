<?php
/**
 * @var $post
 * @var $view
 */
?>

<?php $view->extend('layout.html.php') ?>

<div class="container-fluid">
    <div class="row first">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <p>by <strong><?= $post['username'] ?></strong> - <em><?= $post['created_at'] ?></em></p>
            <p><span class="content-field"><?= $post['text'] ?></span></p>
            <ul class="pager">
                <li class="previous" <?= $post['id'] == 1 ? 'style="display:none"' : '' ?>><a
                        href="<?= $post['id'] - 1 ?>">Vorheriger Post</a></li>
                <li class="next"><a href="<?= $post['id'] + 1 ?>">Nächster Post</a></li>
            </ul>
        </div>
    </div>
</div>
