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
    /** @var Doctrine\DBAL\Connection $db_connection */
    $postTitle = $request->get('postTitle');
    $post = $request->get('post');
    $createdAt = date('c');

    if (($postTitle == NULL) && ($post == NULL)) {
        $alertVisible = TRUE;
        $alertMessage = "Titel und Text fehlt";
    } elseif ($postTitle == NULL) {
        $alertVisible = TRUE;
        $alertMessage = "Titel fehlt";
    } elseif ($post == NULL) {
        $alertVisible = TRUE;
        $alertMessage = "Text fehlt";
    } else {
        $alertVisible = FALSE;
        $alertMessage = "";
        $db_connection->insert(
            'blog_post',
            array(
                'title' => $postTitle,
                'text' => $post,
                'created_at' => $createdAt
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
    /** @var Doctrine\DBAL\Connection $db_connection */
    $alertMessage = "";
    $alertVisible = FALSE;
    $blogPosts = $db_connection->fetchAll('SELECT * FROM blog_post');

    return $template->render(
        'blog.html.php',
        array(
            'active' => 'blog',
            'alertMessage' => $alertMessage,
            'alertVisible' => $alertVisible,
            'blogPosts' => $blogPosts
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



