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
$user = $app['session']->get('user');

$app->get('/post/{postId}', function ($postId) use ($app, $auth, $user, $template, $dbConnection) {
    $sqlQuery = 'SELECT blog_post.id, blog_post.title, blog_post.text, blog_post.created_at, account.username FROM blog_post
                 INNER JOIN account ON blog_post.author=account.id WHERE blog_post.id = ?';
    $post = $dbConnection->fetchAssoc($sqlQuery, array($postId));
    $nextPost = $dbConnection->fetchAssoc($sqlQuery, array($postId + 1));
    if (isset($nextPost['id'])) {
        $nextPost = true;
    } else {
        $nextPost = false;
    }
    if (!isset($post['id'])) {
        $sqlQuery = 'SELECT blog_post.id, blog_post.title, blog_post.text, blog_post.created_at, account.username
                 FROM blog_post INNER JOIN account ON blog_post.author=account.id ORDER BY created_at DESC ';
        $blogPosts = $dbConnection->fetchAll($sqlQuery);
        return new Response($template->render(
            'blog_show.html.php',
            array(
                'active' => '',
                'auth' => $auth,
                'pageHeading' => '',
                'blogPosts' => $blogPosts,
                'post' => $post,
                'user' => $user['username'],
                'messageType' => 'danger',
                'messageText' => 'Der gesuchte Post ist nicht in der Datenbank vorhanden'
            )), 404, array('X-Status-Code' => 200));
    }
    return $template->render(
        'post_show.html.php',
        array(
            'active' => 'blog_show',
            'auth' => $auth,
            'pageHeading' => $post['title'],
            'post' => $post,
            'nextPost' => $nextPost,
            'user' => $user['username'],
            'messageType' => '',
            'messageText' => ''
        ));
});

$app->get('/', function () use ($app, $auth, $user, $template) {
    return $template->render(
        'start.html.php',
        array(
            'active' => 'home',
            'pageHeading' => 'Start getting productive right now',
            'auth' => $auth,
            'user' => $user['username'],
            'messageType' => 'danger',
            'messageText' => 'alles klar'

        ));

});

$app->match('/blog_new', function (Request $request) use ($app, $auth, $user, $template, $dbConnection) {
    /** @var Doctrine\DBAL\Connection $db_connection */

    $pageHeading = 'Verfassen Sie hier einen neune Post';
    $alertMessage = '';
    $alertVisible = FALSE;
    $post = '';
    $postTitle = '';
    $sqlQuery = 'SELECT * FROM blog_post';
    $blogPosts = $dbConnection->fetchAssoc($sqlQuery);
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
                'auth' => $auth,
                'user' => $user['username'],
                'messageType' => '',
                'messageText' => ''

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
                /*$alertVisible = false;*/
                /*$alertMessage = '';*/
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
            'auth' => $auth,
            'user' => $user['username'],
            'messageType' => 'danger',
            'messageText' => $alertMessage
        )
    );
});


$app->get('/blog_show', function (Request $request) use ($auth, $template, $user, $dbConnection) {
    /** @var Doctrine\DBAL\Connection $db_connection */
    $pageHeading = 'Blog';
    //$blogPosts = $dbConnection->fetchAll('SELECT * FROM blog_post ORDER BY created_at DESC');
    $sqlQuery = 'SELECT blog_post.id, blog_post.title, blog_post.text, blog_post.created_at, account.username
                 FROM blog_post INNER JOIN account ON blog_post.author=account.id ORDER BY created_at DESC ';
    $blogPosts = $dbConnection->fetchAll($sqlQuery);
    return $template->render(
        'blog_show.html.php',
        array(
            'active' => 'blog_show',
            'pageHeading' => $pageHeading,
            'blogPosts' => $blogPosts,
            'auth' => $auth,
            'user' => $user['username'],
            'messageType' => '',
            'messageText' => ''
        )
    );
});

$app->get('/about', function () use ($auth, $template, $user) {
    return $template->render(
        'about.html.php',
        array(
            'active' => 'about',
            'pageHeading' => '',
            'auth' => $auth,
            'user' => $user['username'],
            'messageType' => '',
            'messageText' => ''
        ));
});

$app->get('/links', function () use ($auth, $template, $user) {
    $pageHeading = 'Das ist ein Test';
    return $template->render(
        'layout.html.php',
        array(
            'active' => 'links',
            'pageHeading' => $pageHeading,
            'auth' => $auth,
            'user' => $user['username'],
            'messageType' => '',
            'messageText' => ''
        ));
});

$app->match('/login', function (Request $request) use ($app, $auth, $template, $dbConnection, $user) {
    if ($request->isMethod('POST')) {
        $referer = $request->headers->get('referer');
        $email = $request->get('email');
        $password = $request->get('passwordInput');
        $sqlQuery = "SELECT * FROM account WHERE email = '$email'";
        $storedUser = $dbConnection->fetchAssoc($sqlQuery);
        if (password_verify($password, $storedUser['password'])) {
            $app['session']->set('user', array('id' => $storedUser['id'], 'username' => $storedUser['username']));
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
                    'auth' => $auth,
                    'alertVisible' => true,
                    'user' => $user['username'],
                    'messageType' => 'danger',
                    'messageText' => 'Email oder Kennwort falsch'
                ));
        }

    } elseif ($request->isMethod('GET')) {
        return $template->render(
            'login.html.php',
            array(
                'active' => 'links',
                'pageHeading' => 'login',
                'auth' => $auth,
                'alertVisible' => false,
                'user' => $user['username'],
                'messageType' => '',
                'messageText' => ''

            ));
    } else {
        /*TODO:501 BAD METHOD*/
    }
});

$app->match('/register', function (Request $request) use ($app, $auth, $template, $dbConnection, $user) {
    if ($request->isMethod('GET')) {
        return $template->render(
            'register.html.php',
            array(
                'active' => '',
                'pageHeading' => 'Registrieren',
                'auth' => $auth,
                'alertVisible' => false,
                'alertMessage' => '',
                'successVisible' => false,
                'user' => $user['username'],
                'messageType' => '',
                'messageText' => ''

            ));

    } elseif ($request->isMethod('POST')) {
        $username = $request->get('userName');
        $email = $request->get('email');
        $password1 = $request->get('password1');
        $password2 = $request->get('password2');
        if ($password1 == $password2) {
            //Vergleich der beiden passwörter
            $sqlQuery = "SELECT * FROM account WHERE email = '$email'";
            $storedUser = $dbConnection->fetchAssoc($sqlQuery);
            $emailSet = isset($storedUser['id']);
            if ($emailSet) {
                //Datenbankabfrage auf gegebene email
                $alertMessage = 'Es existiert bereits ein Account mit dieser Email';
                $alertVisible = true;
                $successVisible = false;
            } else {
                $sqlQuery = "SELECT * FROM account WHERE username = '$username'";
                $storedUser = $dbConnection->fetchAssoc($sqlQuery);
                $userSet = isset($storedUser['id']);
                if ($userSet) {
                    //Datenbankabfrage auf gegebenen username
                    $alertMessage = 'Nutzername ist bereits vergeben';
                    $alertVisible = true;
                    $successVisible = false;
                } else {
                    //hier wird ein Account angelegt
                    $dbConnection->insert(
                        'account',
                        array(
                            'username' => $username,
                            'email' => $email,
                            'password' => password_hash($password1, PASSWORD_DEFAULT)
                        )
                    );
                    $sqlQuery = "SELECT * FROM account WHERE email = '$email'";
                    $storedUser = $dbConnection->fetchAssoc($sqlQuery);
                    $app['session']->set('user', array('id' => $storedUser['id']));
                    $alertMessage = '';
                    $alertVisible = false;
                    $successVisible = true;
                    $auth = true;//muss hier manuell gesetzt werden
                    return $app->redirect('/');

                }
            }
        } else {
            $alertMessage = 'Passwörter stimmen nicht überein';
            $alertVisible = true;
            $successVisible = false;
        }
        return $template->render(
            'register.html.php',
            array(
                'alertMessage' => $alertMessage,
                'alertVisible' => $alertVisible,
                'active' => '',
                'pageHeading' => $username,
                'auth' => $auth,
                'successVisible' => $successVisible,
                'user' => $user['username'],
                'messageType' => 'danger',
                'messageText' => $alertMessage
            )
        );
    }
});

$app->get('/account', function () use ($app, $user, $auth, $template) {
    if (null === $user = $app['session']->get('user')) {
        return "Your not logged in {$user}";
    }
    /*return "Welcome {$user['id']}!";*/
    return $template->render(
        'account.html.php',
        array(
            'active' => '',
            'auth' => $auth,
            'userName' => $user['username'],
            'userId' => $user['id'],
            'user' => $user['username']
        )
    );
});

$app->get('/logout', function (Request $request) use ($app, $user) {
    $referer = $request->headers->get('referer');
    $app['session']->remove('user');
    return $app->redirect($referer);
});










