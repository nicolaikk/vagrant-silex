<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/***
 * @var $app Silex\Application
 * @var $db_connection Doctrine\DBAL\Connection
 * @var $template Symfony\Component\Templating\DelegatingEngine
 */

$template = $app['templating'];
$db_connection = $app['db'];
$pageHeading = '';

$app->get('/blog/{blogId}', function ($name) use ($template) {
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

$app->match('/blog_new', function (Request $request) use ($template, $db_connection) {
    /** @var Doctrine\DBAL\Connection $db_connection */

    $pageHeading = 'Verfassen Sie hier einen neune Post';
    $alertMessage = ' ';
    $alertVisible = FALSE;
    $blogPosts = $db_connection->fetchAssoc('SELECT * FROM blog_post');

    if ($request->isMethod('GET')) {
        return $template->render(
            'blog.html.php',
            array(
                'active' => 'blog_new',
                'alertMessage' => $alertMessage,
                'alertVisible' => $alertVisible,
                'pageHeading' => $pageHeading,
                'blogPosts' => $blogPosts)
        );

    } elseif ($request->isMethod('GET')) {
        $postTitle = $request->get('postTitle');
        $post = $request->get('post');
        $createdAt = date('c');

        if (($postTitle == null) && ($post == null)) {
            $alertVisible = true;
            $alertMessage = 'Titel und Text fehlt';
        } elseif ($postTitle == null) {
            $alertVisible = true;
            $alertMessage = 'Titel fehlt';
        } elseif ($post == null) {
            $alertVisible = true;
            $alertMessage = 'Text fehlt';
        } else {
            $alertVisible = false;
            $alertMessage = '';
            $db_connection->insert(
                'blog_post',
                array(
                    'title' => $postTitle,
                    'text' => $post,
                    'created_at' => $createdAt
                )
            );

        }
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

$app->get('/blog_show', function (Request $request) use ($template, $db_connection) {
    /** @var Doctrine\DBAL\Connection $db_connection */
    $pageHeading = 'Hier werden Blogposts angezeigt. Ferner ist dies ein nahezu endloser Text, der kaum enden möchte';
    $blogPosts = $db_connection->fetchAssoc('SELECT * FROM blog_post WHERE id == 3');
    return $template->render(
        'blog.html.php',
        array(
            'active' => 'blog_show',
            'pageHeading' => $pageHeading,
            'blogPost' => $blogPosts
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

$app->post('/login', function (Request $request) use ($app, $template, $db_connection) {
    $referer = $request->headers->get('referer');
    $username = $request->get('userInput');
    $password = $request->get('passwordInput');

    if ('admin' === $username && 'admin' === $password) {
        $app['session']->set('user', array('username' => $username));
        return $app->redirect($referer);
    }

    //$response = new Response();
    //$response->headers->set('WWW-Authenticate', sprintf('Basic realm="%s"', 'site_login'));
    //$response->setStatusCode(401, 'Please sign in.');
    return $template->render(
        'layout.html.php',
        array(
            'active' => ' ',
            'pageHeading' => 'Login failed'
        ));
});



