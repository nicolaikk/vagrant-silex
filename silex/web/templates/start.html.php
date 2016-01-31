<?php $view->extend('layout.html.php') ?>


             <div id="myCarousel" class="carousel slide" data-ride="carousel">
                 <!-- Indicators -->
                 <ol class="carousel-indicators">
                     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel" data-slide-to="1"></li>
                     <li data-target="#myCarousel" data-slide-to="2"></li>
                     <li data-target="#myCarousel" data-slide-to="3"></li>
                 </ol>

                 <!-- Wrapper for slides -->
                 <div class="carousel-inner" role="listbox">
                     <div class="item active">
                         <img src="/images/skyscraper.jpg" alt="picture of city at night">
                     </div>

                     <div class="item">
                         <img src="/images/servers.jpg" alt="picture of servers in a datacenter">
                     </div>

                     <div class="item">
                         <img src="/images/aerialphoto.jpg" alt="picture of a field from above">
                     </div>
                     <div class="item">
                         <img src="/images/forrest.jpg" alt="picture of a stream in the forrest">
                     </div>

                 </div>

                 <!-- Left and right controls -->
                 <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                     <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                     <span class="sr-only">Previous</span>
                 </a>
                 <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                     <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                     <span class="sr-only">Next</span>
                 </a>
             </div>




<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" id="test">
            <p>test</p>
            <p>lorem</p>
            <p>ipsum</p>
            <p>dolor</p>
            <p>sit</p>
            <p>amet</p>
            <p>test</p>
            <p>lorem</p>
            <p>ipsum</p>
            <p>dolor</p>
            <p>sit</p>
            <p>amet</p>
            <p>test</p>
            <p>lorem</p>
            <p>ipsum</p>
            <p>dolor</p>
            <p>sit</p>
            <p>amet</p>
            <p>test</p>
            <p>lorem</p>
            <p>ipsum</p>
            <p>dolor</p>
            <p>sit</p>
            <p>amet</p>
            <p>test</p>
            <p>lorem</p>
            <p>ipsum</p>
            <p>dolor</p>
            <p>sit</p>
            <p>amet</p>
            <p>test</p>
            <p>lorem</p>
            <p>ipsum</p>
            <p>dolor</p>
            <p>sit</p>
            <p>amet</p>
            <p>test</p>
            <p>lorem</p>
            <p>ipsum</p>
            <p>dolor</p>
            <p>sit</p>
            <p>amet</p>
            <p>test</p>
            <p>lorem</p>
            <p>ipsum</p>
            <p>dolor</p>
            <p>sit</p>
            <p>amet</p>
            <h1>
                <?php $view['slots']->output('title', 'Default title') ?>
            </h1>
            <hr/>
            <?php $view['slots']->output('_content') ?>
            <hr/>

            <footer>
            </footer>
        </div>
    </div>
</div>

