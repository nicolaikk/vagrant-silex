<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <!-- TODO: maybe i should put the js-scripts at the end of the body for faster loading -->
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/vendor/css/style.css" rel="stylesheet">

        <script src="/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/vendor/bootstrap/dist/css/bootstrap.min.css"></script>


    </head>
    <body>
        <header>
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="glyphicon glyphicon-th-list"></span>
                        </button>
                        <a class="navbar-brand" href="#page-top">Start Bootstrap</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="hidden">
                                <a href="#page-top"></a>
                            </li>
                            <li class="page-scroll">
                                <a href="#portfolio" class="active">Portfolio</a>
                            </li>
                            <li class="page-scroll">
                                <a href="#about">About</a>
                            </li>
                            <li class="page-scroll">
                                <a href="#contact">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </nav>
        </header>


        <div class="container-fluid">
             <div class="row">
                <img src="/images/skyscraper.jpg" alt=""/>
                <div class="col-md-4" id="skyscraper">

                </div>
                <div class="col-lg-4" id="test">
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


    </body>
</html>

