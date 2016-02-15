<?php
use Symfony\Component\HttpFoundation\Request;

/***
 * @var $app Silex\Application
 * @var $db_connection Doctrine\DBAL\Connection
 * @var $template Symfony\Component\Templating\DelegatingEngine
 */

$template = $app['templating'];
$db_connection = $app['db'];

$app->get('/welcome/{name}', function ($name) use ($template) {
    return $template->render(
        'hello.html.php',
        array('name' => $name)
    );
});

$app->get('/', function () use ($template){
    return $template->render(
        'start.html.php',
        array('active' => 'home'));

});


$app->post('/blog', function (Request $request) use ($template, $db_connection) {
    $email = $request->get('email');
    $text = $request->get('blog');
    $createdAt = date('c');

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
        $db_connection->insert(
            'blog_post',
            array(
                'title' => $email,
                'text' => $text
            )
        );
    }

    return $template->render(
        'blog.html.php',
        array(
            'active' => 'blog',
            'alertMessage' => $alertMessage,
            'alertVisible' => $alertVisible)
    );
});

$app->get('/blog', function (Request $request) use ($template, $db_connection){
    $alertMessage = "";
    $alertVisible = FALSE;
    return $template->render(
        'blog.html.php',
        array(
            'active' => 'blog',
            'alertMessage' => $alertMessage,
            'alertVisible' => $alertVisible
        )
    );
});



$app->get('/about', function () use ($template){
    return $template->render(
        'about.html.php',
        array('active' => 'about'));
});

$app->get('/links', function () use ($template){
    return $template->render(
        'layout.html.php',
        array('active' => 'links'));
});



