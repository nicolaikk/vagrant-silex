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
                <h3>Write a new blog post</h3>
            </div>
            <div class="well">
                <form action="/blog_new" method="post" class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-10 col-sm-offset-1 control-label" for="postTitle">Title</label>
                        <div class="col-sm-10 col-sm-offset-1">
                            <input id="postTitle" name="postTitle" autofocus="autofocus" maxlength="80"
                                   onkeydown="checkIfEmpty()" type="text" class="form-control input-md"
                                <?= $postTitle ? 'value="' . $postTitle . '"' : 'placeholder="Enter your title"' ?>/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-10 col-sm-offset-1 control-label" for="post">Blog post</label>
                        <div class="col-sm-10 col-sm-offset-1">
                        <textarea class="form-control" id="post" name="post" rows="10" onkeydown="checkIfEmpty()"
                                  placeholder="Enter your blog post"><?= $post ? $post : '' ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-10 col-sm-offset-1 control-label" for="button1id"></label>
                        <div class="col-sm-10 col-sm-offset-1">
                            <button id="button1id" name="button1id" class="btn btn-success">Send</button>
                            <a id="button2id" class="btn btn-danger disabled" onclick="resetForm()">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



