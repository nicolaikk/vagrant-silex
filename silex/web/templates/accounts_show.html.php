<?php
/**
 * @var $view
 * @var $allAccounts
 *
 */
?>

<?php $view->extend('layout.html.php') ?>


<div class="container-fluid">
    <div class="row first">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Benutzername</th>
                        <th>Email</th>
                        <th>Benutzernummer</th>
                        <th>Registriert seit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($allAccounts as $account) : ?>
                        <tr>
                            <td><?= $account['username'] ?></td>
                            <td><?= $account['email'] ?></td>
                            <td><?= $account['id'] ?></td>
                            <td><?= $account['created_at'] ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>