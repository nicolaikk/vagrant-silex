<?php
use Symfony\Component\HttpFoundation\Request;

/***
 * @var $app Silex\Application
 * @var $db_connection Doctrine\DBAL\Connection
 * @var $template Symfony\Component\Templating\DelegatingEngine
 */

$template = $app['templating'];
$db_connection = $app['db'];
$pageHeading = '';

$app->get('/welcome/{name}', function ($name) use ($template) {
    return $template->render(
        'hello.html.php',
        array('name' => $name)
    );
});

$app->get('/', function () use ($template) {
    return $template->render(
        'start.html.php',
        array(
            'active' => 'home',
            'pageHeading' => 'Start getting productive right now'
            ));

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
            'active' => 'about',
            'alertMessage' => $alertMessage,
            'alertVisible' => $alertVisible,
            'pageHeading' => $pageHeading)
    );
});

$app->get('/blog', function (Request $request) use ($template, $db_connection) {
    /** @var Doctrine\DBAL\Connection $db_connection */
    $alertMessage = "";
    $alertVisible = FALSE;
    $blogPosts = $db_connection->fetchAssoc('SELECT * FROM blog_post');

    return $template->render(
        'blog.html.php',
        array(
            'active' => 'blog',
            'alertMessage' => $alertMessage,
            'alertVisible' => $alertVisible,
            'blogPosts' => $blogPosts,
            'pageHeading' => $pageHeading
        )
    );
});

$app->get('/blog_show', function (Request $request) use ($template, $db_connection) {
    /** @var Doctrine\DBAL\Connection $db_connection */
    $pageHeading = 'Hier werden Blogposts angezeigt. Ferner ist dies ein nahezu endloser Text, der kaum enden möchte';
    return $template->render(
        'about.html.php',
        array(
            'active' => 'blog_show',
            'pageHeading' => $pageHeading
        )
    );
});


$app->get('/about', function () use ($template) {
    return $template->render(
        'about.html.php',
        array(
            'active' => 'about',
            'pageHeading' => $pageHeading
        ));
});

$app->get('/links', function () use ($template) {
    $pageHeading = 'Das ist ein Test';
    return $template->render(
        'layout.html.php',
        array(
            'active' => 'links',
            'pageHeading' => $pageHeading
        ));
});



