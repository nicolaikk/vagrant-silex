<?php
/**
 * @var $post
 * @var $view
 * @var $nextPost
 */
?>

<?php $view->extend('imageheader.html.php') ?>

<div class="container-fluid">
    <div class="row first">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="well">
                <p>by <strong><a href="/account/<?= $post['author'] ?>"><?= $post['username'] ?></a></strong> - <em><?= $post['created_at'] ?></em></p>
                <p><span class="content-field"><?= $post['text'] ?></span></p>
                <hr/>
                <ul class="pager">
                    <li class="previous" <?= $post['id'] == 1 ? 'style="display:none"' : '' ?>><a
                            href="<?= $post['id'] - 1 ?>">Vorheriger Post</a></li>
                    <li class="next"  <?= $nextPost == 1 ? '' : 'style="display:none"' ?>>
                        <a href="<?= $post['id'] + 1 ?>">Nächster Post</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
