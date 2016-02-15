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


$app->post('/blog', function (Request $request) use ($app) {
    $email = $request->get('email');
    $text = $request->get('blog');
    if (($email == NULL) && ($text == NULL)) {
        $alertVisible = TRUE;
        $alertMessage = "Email und Text fehlt";
    } elseif ($email == NULL) {
        $alertVisible = TRUE;
        $alertMessage = "Email fehlt";
    } elseif ($text == NULL) {
        $alertVisible = TRUE;
        $alertMessage = "Text fehlt";
    } else {
        $alertVisible = FALSE;
        $alertMessage = "";

    }

    return $app['templating']->render(
        'blog.html.php',
        array('active' => 'links', 'alertMessage' => $alertMessage, 'alertVisible' => $alertVisible));
});

$app->get('/blog', function (Request $request) use ($app){
    $alertMessage = "";
    $alertVisible = FALSE;
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



