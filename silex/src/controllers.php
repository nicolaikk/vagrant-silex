<?php
use Symfony\Component\HttpFoundation\Request;

$app->get('/welcome/{name}', function ($name) use ($app) {
    return $app['templating']->render(
        'hello.html.php',
        array('name' => $name)
    );
});

$app->get('/', function () use ($app){
    return $app['templating']->render(
        'start.html.php');
});

$app->get('/blog', function () use ($app){
    return $app['templating']->render(
        'blog.html.php',
        array('active' => 'blog'));
});

$app->get('/about', function () use ($app){
    return $app['templating']->render(
        'about.html.php',
        array('active' => 'about'));
});

$app->get('/links', function () use ($app){
    return $app['templating']->render(
        'layout.html.php',
        array('active' => 'links'));
});



$app->get('/welcome-twig/{name}', function ($name) use ($app) {
    return $app['twig']->render(
        'hello.html.twig',
        array('name' => $name)
    );
});

// generate a link to the stylesheets in /css/styles.css
