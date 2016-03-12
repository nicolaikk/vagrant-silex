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

$app->match('/blog_new', function (Request $request) use ($app, $template, $db_connection) {
    /** @var Doctrine\DBAL\Connection $db_connection */

    $pageHeading = 'Verfassen Sie hier einen neune Post';
    $alertMessage = '';
    $alertVisible = FALSE;
    $post = '';
    $postTitle = '';
    $blogPosts = $db_connection->fetchAssoc('SELECT * FROM blog_post');

    if ($request->isMethod('GET')) {
        return $template->render(
            'blog.html.php',
            array(
                'active' => 'blog_new',
                'alertMessage' => $alertMessage,
                'alertVisible' => $alertVisible,
                'pageHeading' => $pageHeading,
                'blogPosts' => $blogPosts,
                'post' => $post,
                'postTitle' => $postTitle
            )
        );

    } elseif ($request->isMethod('POST')) {
        $postTitle = $request->get('postTitle');
        $post = $request->get('post');

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
                    'text' => $post
                )
            );

        }
    }
    return $app->redirect('/blog_show');
});

$app->get('/blog_show', function (Request $request) use ($template, $db_connection) {
    /** @var Doctrine\DBAL\Connection $db_connection */
    $pageHeading = 'Hier werden Blogposts angezeigt. Ferner ist dies ein nahezu endloser Text, der kaum enden möchte';
    $blogPosts = $db_connection->fetchAll('SELECT * FROM blog_post ORDER BY created_at DESC');
    return $template->render(
        'blog_show.html.php',
        array(
            'active' => 'blog_show',
            'pageHeading' => $pageHeading,
            'blogPosts' => $blogPosts
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

$app->match('/login', function (Request $request) use ($app, $template, $db_connection) {
    if ($request->isMethod('POST')) {
        $referer = $request->headers->get('referer');
        $email = $request->get('email');
        $password = $request->get('passwordInput');
        $storedHash = $db_connection->fetchAssoc("SELECT * FROM account WHERE email = '$email'");
        if (password_verify($password, $storedHash['password'])) {
            $app['session']->set('user', array('username' => $email));
            if (parse_url($referer, PHP_URL_PATH) == '/login') {
                return $app->redirect('/');
            } else {
                return $app->redirect($referer);
            }

        } else {
            //return $app->redirect('/login');
            return $template->render(
                'login.html.php',
                array(
                    'active' => 'links',
                    'pageHeading' => $email
                ));
        }
        //$response = new Response();
        //$response->headers->set('WWW-Authenticate', sprintf('Basic realm="%s"', 'site_login'));
        //$response->setStatusCode(401, 'Please sign in.');

    } elseif ($request->isMethod('GET')) {
        return $template->render(
            'login.html.php',
            array(
                'active' => 'links',
                'pageHeading' => 'login'
            ));
    }
});

$app->match('/register', function (Request $request) use ($app, $template, $db_connection) {
    if ($request->isMethod('GET')) {
        return $template->render(
            'register.html.php',
            array(
                'active' => '',
                'pageHeading' => 'Registrieren'
            ));

    } elseif ($request->isMethod('POST')) {
        $username = $request->get('userName');
        $email = $request->get('email');
        $password1 = $request->get('password1');
        $password2 = $request->get('password2');
        if ($password1 == $password2) {
            $db_connection->insert(
                'account',
                array(
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($password1, PASSWORD_DEFAULT)
                )
            );
            $alertMessage = 'Account angelegt';
            $alertVisible = false;
        } else {
            $alertMessage = 'Passwörter stimmen nicht überein';
            $alertVisible = true;
        }
        return $template->render(
            'register.html.php',
            array(
                'alertMessage' => $alertMessage,
                'alertVisible' => $alertVisible,
                'active' => '',
                'pageHeading' => $username
            )
        );
    }
});







