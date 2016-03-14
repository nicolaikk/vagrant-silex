

<?php $view->extend('imageheader.html.php') ?>


<div class="container-fluid">
    <div class="row first">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Übersicht
                </div>
                <div class="list-group">
                    <?php foreach ($allAccounts as $account) : ?>
                        <div class="list-group-item">
                            <?= $account['id'] ?> - <?= $account['username'] ?> -
                                <em><?= $account['created_at'] ?></em><br/>

                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
