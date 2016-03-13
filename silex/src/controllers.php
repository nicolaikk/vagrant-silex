<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/***
 * @var $app Silex\Application
 * @var $dbConnection Doctrine\DBAL\Connection
 * @var $template Symfony\Component\Templating\DelegatingEngine
 */

$template = $app['templating'];
$dbConnection = $app['db'];
$pageHeading = '';
$auth = (null === ($user = $app['session']->get('user')));

$app->get('/post/{postId}', function ($postId) use ($app, $auth, $template, $dbConnection) {
    /*$post = $dbConnection->fetchAssoc(
    //    'SELECT * FROM blog_post WHERE id = ?',
    //    array($postId)
    );*/
    $post = $dbConnection->fetchAssoc(
        'SELECT blog_post.id, blog_post.title, blog_post.text, blog_post.created_at, account.username FROM blog_post
         INNER JOIN account ON blog_post.author=account.id WHERE blog_post.id = ?',
        array($postId)
    );
    if (!isset($post['id'])) {
        return new Response($template->render(
            '404.html.php',
            array(
                'active' => '',
                'auth' => $auth,
                'pageHeading' => ''
            )), 404, array('X-Status-Code' => 200));
    }
    return $template->render(
        'post_show.html.php',
        array(
            'active' => 'blog_show',
            'auth' => $auth,
            'pageHeading' => $post['title'],
            'post' => $post
        ));
});

$app->get('/', function () use ($auth, $template) {
    return $template->render(
        'start.html.php',
        array(
            'active' => 'home',
            'pageHeading' => 'Start getting productive right now',
            'auth' => $auth
        ));

});

$app->match('/blog_new', function (Request $request) use ($app, $auth, $template, $dbConnection) {
    /** @var Doctrine\DBAL\Connection $db_connection */

    $pageHeading = 'Verfassen Sie hier einen neune Post';
    $alertMessage = '';
    $alertVisible = FALSE;
    $post = '';
    $postTitle = '';
    $blogPosts = $dbConnection->fetchAssoc('SELECT * FROM blog_post');
    $user = $app['session']->get('user');

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
                'postTitle' => $postTitle,
                'auth' => $auth
            )
        );

    } elseif ($request->isMethod('POST')) {
        $postTitle = $request->get('postTitle');
        $post = $request->get('post');
        if ($auth) {
            $alertVisible = true;
            $alertMessage = 'Loggen Sie sich bitte ein, um einen post zu verfassen';
        } else {
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
                $dbConnection->insert(
                    'blog_post',
                    array(
                        'title' => $postTitle,
                        'author' => $user['id'],
                        'text' => $post
                    )
                );
                return $app->redirect('/blog_show');

            }
        }
    }
    return $template->render(
        'blog.html.php',
        array(
            'active' => 'blog_new',
            'alertMessage' => $alertMessage,
            'alertVisible' => $alertVisible,
            'pageHeading' => $pageHeading,
            'blogPosts' => $blogPosts,
            'post' => $post,
            'postTitle' => $postTitle,
            'auth' => $auth
        )
    );
});


$app->get('/blog_show', function (Request $request) use ($auth, $template, $dbConnection) {
    /** @var Doctrine\DBAL\Connection $db_connection */
    $pageHeading = 'Blog';
    //$blogPosts = $dbConnection->fetchAll('SELECT * FROM blog_post ORDER BY created_at DESC');
    $blogPosts = $dbConnection->fetchAll('SELECT blog_post.id, blog_post.title, blog_post.text, blog_post.created_at,
                                          account.username FROM blog_post INNER JOIN account ON
                                          blog_post.author=account.id ORDER BY created_at DESC ');

    return $template->render(
        'blog_show.html.php',
        array(
            'active' => 'blog_show',
            'pageHeading' => $pageHeading,
            'blogPosts' => $blogPosts,
            'auth' => $auth
        )
    );
});

$app->get('/about', function () use ($auth, $template) {
    return $template->render(
        'about.html.php',
        array(
            'active' => 'about',
            'pageHeading' => '',
            'auth' => $auth
        ));
});

$app->get('/links', function () use ($auth, $template) {
    $pageHeading = 'Das ist ein Test';
    return $template->render(
        'layout.html.php',
        array(
            'active' => 'links',
            'pageHeading' => $pageHeading,
            'auth' => $auth
        ));
});

$app->match('/login', function (Request $request) use ($app, $auth, $template, $dbConnection) {
    if ($request->isMethod('POST')) {
        $referer = $request->headers->get('referer');
        $email = $request->get('email');
        $password = $request->get('passwordInput');
        $storedUser = $dbConnection->fetchAssoc("SELECT * FROM account WHERE email = '$email'");
        if (password_verify($password, $storedUser['password'])) {
            $app['session']->set('user', array('id' => $storedUser['id']));
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
                    'pageHeading' => $email,
                    'auth' => $auth
                ));
        }

    } elseif ($request->isMethod('GET')) {
        return $template->render(
            'login.html.php',
            array(
                'active' => 'links',
                'pageHeading' => 'login',
                'auth' => $auth
            ));
    }
});

$app->match('/register', function (Request $request) use ($app, $auth, $template, $dbConnection) {
    if ($request->isMethod('GET')) {
        return $template->render(
            'register.html.php',
            array(
                'active' => '',
                'pageHeading' => 'Registrieren',
                'auth' => $auth
            ));

    } elseif ($request->isMethod('POST')) {
        $username = $request->get('userName');
        $email = $request->get('email');
        $password1 = $request->get('password1');
        $password2 = $request->get('password2');
        if ($password1 == $password2) {
            $dbConnection->insert(
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
                'pageHeading' => $username,
                'auth' => $auth
            )
        );
    }
});

$app->get('/account', function () use ($app) {
    if (null === $user = $app['session']->get('user')) {
        return "Your not logged in {$user}";
    }

    return "Welcome {$user['id']}!";
});

$app->get('/logout', function (Request $request) use ($app) {
    $referer = $request->headers->get('referer');
    $app['session']->remove('user');
    return $app->redirect($referer);
});










