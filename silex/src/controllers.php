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
        'start.html.php',
        array('active' => 'home'));

});

$app->get('/blog', function (Request $request) use ($app){
    return $app['templating']->render(
        'blog.html.php',
        array('active' => 'blog'));
});

$app->match('/test', function (Request $request) use ($app) {
    $email = $request->get('email');
    $text = $request->get('text');
    $emailEmpty = $email == '';
    $textEmpty = $text == '';
    if ($emailEmpty && $textEmpty) {
        $alertMessage = 'Bitte geben Sie Ihre Email-Adresse und einen Blogpost ein.';
        $alertVisible = true;
        } elseif ($emailEmpty) {
        $alertMessage = 'Bitte geben Sie Ihre Email-Adresse an.';
        $alertVisible = true;
        } elseif ($textEmpty) {
        $alertMessage = 'Bitte geben Sie einen Blogpost ein.';
        $alertVisible = true;
        } else {
        $alertVisible = false;
        }

    return $app['templating']->render(
        'blog.html.php',
        array('active' => 'links', 'alertMessage' => $alertMessage, 'alertVisible' => $alertVisible));
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
