<?php $view->extend('layout.html.php') ?>

<div class="container">
    <row>
        <div class="col-md-10">
            <div class="form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" id="usr">
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" rows="5" id="comment"></textarea>
            </div>
            <button type="button" class="btn btn-default">Submit</button>
            <button type="button" class="btn btn-default">Reset</button>
        </div>
    </row>
</div>

