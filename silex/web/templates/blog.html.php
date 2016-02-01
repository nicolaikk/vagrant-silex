<?php $view->extend('layout.html.php') ?>

<div class="container">
    <row>
        <div class="col-md-10">
            <form action="/test" method="post">
                First name: <input type="text" name="email"><br>
                Last name: <input type="text" name="blog"><br>
                <button type="submit" value="Submit">Submit</button>
                <button type="reset" value="Reset">Reset</button>
            </form>
        </div>
    </row>
</div>


<div class="glyphicon glyphicon-apple">
    <?= $isEmpty ? 'leer':'nicht leer'?>
</div>


