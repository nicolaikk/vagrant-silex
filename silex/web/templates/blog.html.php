<?php
/**
 * @var $view
 * @var $alertVisible
 * @var $alertMessage
 * @var $postTitle
 * @var $post
 * @var $blogPosts
 */
?>

<?php $view->extend('layout.html.php') ?>

<div class="container-fluid">
    <div class="row first">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="jumbotron">
                <h3>Hier können Sie einen neuen Beitrag schreiben</h3>
            </div>
            <div class="well">
                <form action="/blog_new" method="post" class="form-horizontal">
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-10 col-sm-offset-1 control-label" for="postTitle">Titel</label>
                        <div class="col-sm-10 col-sm-offset-1">
                            <input id="postTitle" name="postTitle" autofocus="autofocus" onkeydown="checkIfEmpty()"
                                   type="text" <?= $postTitle ? 'value="' . $postTitle . '"' : 'placeholder="Tragen Sie hier den Titel ein."' ?>
                                   class="form-control input-md"/>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-sm-10 col-sm-offset-1 control-label" for="post">Blogeintrag</label>
                        <div class="col-sm-10 col-sm-offset-1">
                        <textarea class="form-control" id="post" name="post" rows="10" onkeydown="checkIfEmpty()"
                                  placeholder="Tragen Sie hier Ihren Blogeintrag ein."><?= $post ? $post : '' ?></textarea>
                        </div>
                    </div>

                    <!-- Button (Double) -->
                    <div class="form-group">
                        <label class="col-sm-10 col-sm-offset-1 control-label" for="button1id"></label>
                        <div class="col-sm-10 col-sm-offset-1">
                            <button id="button1id" name="button1id" class="btn btn-success">Abschicken</button>
                            <a id="button2id" name="button2id" class="btn btn-danger disabled" onclick="resetForm()">Zurücksetzen</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



