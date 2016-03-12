<?php $view->extend('layout.html.php') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Übersicht
                </div>
                <div class="list-group">
                    <?php foreach ($blogPosts as $post) : ?>
                        <div class="list-group-item">
                            <a href="/post/<?= $post['id'] ?>"
                               class="list-group-item"><strong><?= $post['title'] ?></strong> -
                                <em><?= $post['created_at'] ?></em><br/><?= implode(' ', array_slice(explode(' ', $post['text']), 0, 10)); ?>
                                [...]</a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>