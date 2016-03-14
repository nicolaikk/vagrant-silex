<?php
/**
 * @var $view
 * @var $blogPosts
 */
?>

<?php $view->extend('layout.html.php') ?>

<div class="container-fluid">
    <div class="row first">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Übersicht
                </div>
                <div class="list-group">
                    <?php foreach ($blogPosts as $post) : ?>
                        <div class="list-group-item">
                            <a href="/post/<?= $post['id'] ?>"
                               class="list-group-item"><strong><?= $post['title'] ?></strong> - <?= $post['username'] ?>
                                <em><?= $post['created_at'] ?></em><br/><?= implode(' ', array_slice(explode(' ', $post['text']), 0, 10)); ?>
                                [...]</a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>