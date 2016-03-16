<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/***
 * @var $app Silex\Application
 * @var $dbConnection Doctrine\DBAL\Connection
 * @var $template Symfony\Component\Templating\DelegatingEngine
 * @var Doctrine\DBAL\Connection $db_connection
 ***/

$template = $app['templating'];
$dbConnection = $app['db'];
$pageHeading = '';
$auth = (null === ($user = $app['session']->get('user')));
$user = $app['session']->get('user');

/*necessary parameters for rendering templates
 *
 * Notification Engine:
 * - $messageType - sets what kind of error message pops up
 *   - 'danger'  - red
 *   - 'success' - green
 *   - ''        - no error message
 * - $messageText - sets the text for the message
 *
 * Session Management:
 * - $auth - is true if user is logged in
 * - $user - contains information of the active user
 *
 * Styling:
 * - pageHeading - sets headline of the imageheader
 * - active - sets the active link in the navbar
 *
 */


//$app->error(function (\Exception $e, $code) use ($app, $auth, $user, $template) {
    /* standard error page */
//    return new Response($template->render(
//        'start.html.php',
//        array(
//            'active' => '',
//            'auth' => $auth,
//            'pageHeading' => '',
//            'user' => $user['username'],
//            'messageType' => 'danger',
//            'messageText' => 'Ein Fehler ist aufgetreten, die von Ihnen angefragte Seite konnte nicht gefunden werden.'
//        )), 404);
//});


$app->get('/post/{postId}', function ($postId) use ($app, $auth, $user, $template, $dbConnection) {
    /* this is for the single post page */
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
            )), 404);
    } else {
        $post['text'] = nl2br($post['text']); /* required to render line breaks the user gave with his input */
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
    }
});

$app->get('/', function () use ($app, $auth, $user, $template) {
    /* the start page, this page is also used to react to a few errors */
    return $template->render(
        'start.html.php',
        array(
            'active' => 'home',
            'pageHeading' => 'Start getting productive right now',
            'auth' => $auth,
            'user' => $user['username'],
            'messageType' => '',
            'messageText' => ''

        ));

});

$app->match('/blog_new', function (Request $request) use ($app, $auth, $user, $template, $dbConnection) {
    /* route to write a new blog post - login is required */
    $pageHeading = 'Verfassen Sie hier einen neune Post';
    $alertMessage = '';
    $post = '';
    $postTitle = '';
    $sqlQuery = 'SELECT * FROM blog_post';
    $blogPosts = $dbConnection->fetchAssoc($sqlQuery);
    $user = $app['session']->get('user');
    if ($request->isMethod('GET')) {
        return $template->render(
            'blog_new.html.php',
            array(
                'active' => 'blog_new',
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
        $postTitle = substr($postTitle, 0, 80); /* only allow titles of the length 80 */
        $post = $request->get('post');
        if ($auth) {
            $alertMessage = 'Loggen Sie sich bitte ein, um einen post zu verfassen';
        } else {
            if (($postTitle == null) && ($post == null)) {
                $alertMessage = 'Titel und Text fehlt';
            } elseif ($postTitle == null) {
                $alertMessage = 'Titel fehlt';
            } elseif ($post == null) {
                $alertMessage = 'Text fehlt';
            } else {
                /* escaping to prevent xss */
                $postTitle = htmlentities($postTitle);
                $post = htmlentities($post);
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
        'blog_new.html.php',
        array(
            'active' => 'blog_new',
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


$app->get('/blog_show', function () use ($auth, $template, $user, $dbConnection) {
    /* fetches an array of blog posts from the db and renders the using a loop (see blog_show.html.php) */
    $pageHeading = 'Blog';
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

$app->get('/accounts_show', function () use ($auth, $template, $user, $dbConnection) {
    /* shows list of all users */
    $sqlQuery = 'SELECT * FROM account ORDER BY username DESC ';
    $allAccounts = $dbConnection->fetchAll($sqlQuery);
    return $template->render(
        'accounts_show.html.php',
        array(
            'active' => 'benutzer',
            'pageHeading' => '',
            'auth' => $auth,
            'user' => $user['username'],
            'messageType' => '',
            'messageText' => '',
            'allAccounts' => $allAccounts
        ));
});

$app->get('/account/{$author}', function ($author) use ($app, $auth, $user, $template, $dbConnection) {
    /* i have no idea why this isn't working */
    $sqlQuery = "SELECT * FROM blog_post WHERE author = $author ORDER BY id DESC";
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



$app->get('/links', function () use ($auth, $template, $user) {
    /* page for static content */
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
    /* the login page */
    if ($request->isMethod('POST')) {
        $referer = $request->headers->get('referer');
        $email = $request->get('email');
        $password = $request->get('passwordInput');
        $sqlQuery = "SELECT * FROM account WHERE email = '$email'";
        $storedUser = $dbConnection->fetchAssoc($sqlQuery);
        if (password_verify($password, $storedUser['password'])) {/* save way to verify the pwd */
            $sessionParameters = array(
                'id' => $storedUser['id'],
                'username' => $storedUser['username'],
                'email' => $storedUser['email'],
                'date' => $storedUser['created_at']);
            $app['session']->set('user', $sessionParameters);
            if (parse_url($referer, PHP_URL_PATH) == '/login') {
                return $app->redirect('/');
            } else {
                return $app->redirect($referer);
            }

        } else {
            return $template->render(
                'login.html.php',
                array(
                    'active' => 'links',
                    'pageHeading' => $email,
                    'auth' => $auth,
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
                'user' => $user['username'],
                'messageType' => '',
                'messageText' => ''

            ));
    } else {
        /*TODO:501 BAD METHOD*/
    }
});

$app->match('/register', function (Request $request) use ($app, $auth, $template, $dbConnection, $user) {
    /* registration pages - ensures that accounts have different names and email addresses */
    if ($request->isMethod('GET')) {
        return $template->render(
            'register.html.php',
            array(
                'active' => '',
                'pageHeading' => 'Registrieren',
                'auth' => $auth,
                'user' => $user['username'],
                'messageType' => '',
                'messageText' => ''

            ));

    } elseif ($request->isMethod('POST')) {
        $username = $request->get('userName');
        $email = $request->get('email');
        $password1 = $request->get('password1');
        $password2 = $request->get('password2');
        $username = htmlentities($username);
        $email = htmlentities($email);
        if ($password1 == $password2) {
            /* checks if the given pwds are the same */
            $sqlQuery = "SELECT * FROM account WHERE email = '$email'";
            $storedUser = $dbConnection->fetchAssoc($sqlQuery);
            $emailSet = isset($storedUser['id']);
            if ($emailSet) {
                /* checks if the email is already in the db */
                $alertMessage = 'Es existiert bereits ein Account mit dieser Email';
            } else {
                $sqlQuery = "SELECT * FROM account WHERE username = '$username'";
                $storedUser = $dbConnection->fetchAssoc($sqlQuery);
                $userSet = isset($storedUser['id']);
                if ($userSet) {
                    /* checks if the username is already in the db */
                    $alertMessage = 'Nutzername ist bereits vergeben';
                } else {
                    /* creates a new account and generates a hash which is needed for later verification */
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
                    $sessionParameters = array(
                        'id' => $storedUser['id'],
                        'username' => $storedUser['username'],
                        'email' => $storedUser['email'],
                        'date' => $storedUser['created_at']);
                    $app['session']->set('user', $sessionParameters);
                    return $app->redirect('/');

                }
            }
        } else {
            $alertMessage = 'Passwörter stimmen nicht überein';
        }
        return $template->render(
            'register.html.php',
            array(
                'active' => '',
                'pageHeading' => $username,
                'auth' => $auth,
                'user' => $user['username'],
                'messageType' => 'danger',
                'messageText' => $alertMessage
            )
        );
    }
});

$app->get('/account', function () use ($app, $user, $auth, $template) {
    /* gives information of the active account */
    if (null === $user = $app['session']->get('user')) {
        return new Response($template->render(
            'start.html.php',
            array(
                'active' => '',
                'auth' => $auth,
                'pageHeading' => '',
                'user' => $user['username'],
                'messageType' => 'danger',
                'messageText' => 'Sie müssen sich einloggen, um Ihr Profil zu bearbeiten'
            )), 403);
    }
    return $template->render(
        'account.html.php',
        array(
            'active' => '',
            'auth' => $auth,
            'user' => $user['username'],
            'userId' => $user['id'],
            'userEmail' => $user['email'],
            'userDate' => $user['date'],
            'messageType' => '',
            'messageText' => ''
        )
    );
});

$app->get('/logout', function (Request $request) use ($app, $user) {
    /* removes the user from the session - logout */
    $referer = $request->headers->get('referer');
    $app['session']->remove('user');
    if (isset($referer)) {
        return $app->redirect($referer);
    } else {
        return $app->redirect('/');
    }
});










