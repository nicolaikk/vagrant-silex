<?php $view->extend('layout.html.php') ?>
<?php /**TODO: give a message if post is successfully stored in the database**/ ?>
<?php /**TODO: keep the text of the input files if posting is not successful**/ ?>
<div class="container">


    <div class="col-md-10 col-md-offset-1">
        <div class="well">
            <form action="/blog" method="post" class="form-horizontal">
                <div class="alert alert-success alert-top" style="display:none">
                    <strong>Erfolg:</strong>
                </div>
                <div class="alert alert-danger" <?= $alertVisible ? '' : 'style="display:none"' ?>>
                    <div class="glyphicon glyphicon-remove"></div>
                    <strong>Fehler:</strong> <?= $alertVisible ? $alertMessage : '' ?>
                </div>

                <legend>Neuen Blogpost anlegen</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Titel*</label>
                    <div class="col-md-4">
                        <input id="textinput" name="postTitle" type="text" placeholder="Tragen Sie hier den Titel ein."
                               class="form-control input-md">
                        <span class="help-block">help</span>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Blogeintrag*</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="textarea" name="post"
                                  placeholder="Tragen Sie hier Ihren Blogeintrag ein."></textarea>
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="button1id">Double Button</label>
                    <div class="col-md-8">
                        <button id="button1id" name="button1id" class="btn btn-success">Abschicken</button>
                        <button id="button2id" name="button2id" class="btn btn-danger">Zurücksetzen</button>
                    </div>
                </div>
            </form>
            <?= $blogPosts['text'] ?>
        </div>
    </div>
</div>



