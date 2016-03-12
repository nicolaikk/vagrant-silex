<?php
/**
 * @var $post
 */
?>

<?php $view->extend('layout.html.php') ?>

<div class="list-group-item">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p><strong><?= $post['title'] ?></strong> by <strong><?= $post['author'] ?></strong> - <em><?= $post['created_at'] ?></em></p>
                <span class="blog-content"><p><?= $post['text'] ?></p></span>
                <ul class="pager">
                    <li class="previous" <?= $post['id'] == 1 ? 'style="display:none"' : ''?>><a href="<?= $post['id']-1 ?>">Vorheriger Post</a></li>
                    <li class="next"><a href="<?= $post['id']+1 ?>">Nächster Post</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
